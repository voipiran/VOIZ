#!/bin/bash
# Install VOIZ Asterisk ChanSpy from the upstream repository

set -euo pipefail

CHANSPY_LOG="${LOG_FILE:-voiz-installation.log}"
CHANSPY_REPOSITORY="${VOIZ_CHANSPY_REPOSITORY:-https://github.com/voipiran/voiz-asterisk-chanspy.git}"
CHANSPY_INSTALL_TIMEOUT_SECONDS="${VOIZ_CHANSPY_TIMEOUT_SECONDS:-600}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${CHANSPY_LOG}"
}

chanspy_configuration_is_ready() {
    local root_password
    local registered_codes

    [[ -f /etc/asterisk/extensions_custom.conf ]] || return 1
    grep -qF "[voipiran-chanspypro]" /etc/asterisk/extensions_custom.conf || return 1
    grep -qF "include => voipiran-chanspypro" /etc/asterisk/extensions_custom.conf || return 1
    command -v mysql >/dev/null 2>&1 || return 1
    [[ -f /etc/issabel.conf ]] || return 1

    root_password=$(sed -ne 's/.*mysqlrootpwd=//p' /etc/issabel.conf | tr -d '[:space:]')
    [[ -n "${root_password}" ]] || return 1

    registered_codes=$(mysql -N -B \
        -h127.0.0.1 \
        -uroot \
        -p"${root_password}" \
        asterisk \
        -e "SELECT COUNT(DISTINCT defaultcode) FROM featurecodes WHERE defaultcode IN ('*930', '*931', '*932', '*933', '*934', '*935') AND enabled = '1';" \
        2>/dev/null) || return 1

    [[ "${registered_codes}" -eq 6 ]]
}

main() {
    log "=== Installing VOIZ Asterisk ChanSpy ==="

    if ! command -v git >/dev/null 2>&1; then
        log "ERROR: git is required to install VOIZ Asterisk ChanSpy"
        return 1
    fi

    local checkout_dir
    checkout_dir=$(mktemp -d /tmp/voiz-asterisk-chanspy.XXXXXX)
    trap 'rm -rf "${checkout_dir}"' EXIT

    log "Cloning ${CHANSPY_REPOSITORY}..."
    git clone --depth 1 "${CHANSPY_REPOSITORY}" "${checkout_dir}" 2>&1 | tee -a "${CHANSPY_LOG}"

    if [[ ! -f "${checkout_dir}/install.sh" ]]; then
        log "ERROR: ChanSpy installer was not found in the repository"
        return 1
    fi

    chmod 755 "${checkout_dir}/install.sh"
    log "Running the ChanSpy installer..."
    local installer_status=0
    if (
        cd "${checkout_dir}"
        timeout --foreground "${CHANSPY_INSTALL_TIMEOUT_SECONDS}" \
            ./install.sh -y </dev/null 2>&1 | tee -a "${CHANSPY_LOG}"
    ); then
        installer_status=0
    else
        installer_status=$?
    fi

    if chanspy_configuration_is_ready; then
        if [[ "${installer_status}" -ne 0 ]]; then
            log "WARNING: ChanSpy installer returned ${installer_status}, but its dialplan and feature codes are ready"
        fi
    else
        if [[ "${installer_status}" -eq 124 ]]; then
            log "ERROR: ChanSpy installer timed out after ${CHANSPY_INSTALL_TIMEOUT_SECONDS} seconds"
        fi
        log "ERROR: ChanSpy installer failed and ChanSpy dialplan or feature codes are incomplete"
        if [[ "${installer_status}" -eq 0 ]]; then
            return 1
        fi
        return "${installer_status}"
    fi

    log "ChanSpy dialplan and feature codes are ready"
    log "=== VOIZ Asterisk ChanSpy Installation Complete ==="
}

main "$@"
