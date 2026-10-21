#!/bin/bash
# Install VOIZ Asterisk CallerID Formatter from the upstream repository

set -euo pipefail

CID_LOG="${LOG_FILE:-voiz-installation.log}"
CID_REPOSITORY="${VOIZ_CALLERID_REPOSITORY:-https://github.com/voipiran/voiz-asterisk-callerid-formatter.git}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${CID_LOG}"
}

main() {
    log "=== Installing VOIZ Asterisk CallerID Formatter ==="

    if ! command -v git >/dev/null 2>&1; then
        log "ERROR: git is required to install VOIZ Asterisk CallerID Formatter"
        return 1
    fi

    local checkout_dir
    checkout_dir=$(mktemp -d /tmp/voiz-asterisk-callerid-formatter.XXXXXX)
    trap 'rm -rf "${checkout_dir}"' EXIT

    log "Cloning ${CID_REPOSITORY}..."
    git clone --depth 1 "${CID_REPOSITORY}" "${checkout_dir}" 2>&1 | tee -a "${CID_LOG}"

    if [[ ! -f "${checkout_dir}/install.sh" ]]; then
        log "ERROR: CallerID Formatter installer was not found in the repository"
        return 1
    fi

    chmod 755 "${checkout_dir}/install.sh"
    log "Running the CallerID Formatter installer..."
    (
        cd "${checkout_dir}"
        ./install.sh 2>&1 | tee -a "${CID_LOG}"
    )

    log "=== VOIZ Asterisk CallerID Formatter Installation Complete ==="
}

main "$@"
