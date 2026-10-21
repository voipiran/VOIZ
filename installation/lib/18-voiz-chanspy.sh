#!/bin/bash
# Install VOIZ Asterisk ChanSpy from the upstream repository

set -euo pipefail

CHANSPY_LOG="${LOG_FILE:-voiz-installation.log}"
CHANSPY_REPOSITORY="${VOIZ_CHANSPY_REPOSITORY:-https://github.com/voipiran/voiz-asterisk-chanspy.git}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${CHANSPY_LOG}"
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
    (
        cd "${checkout_dir}"
        ./install.sh 2>&1 | tee -a "${CHANSPY_LOG}"
    )

    log "=== VOIZ Asterisk ChanSpy Installation Complete ==="
}

main "$@"
