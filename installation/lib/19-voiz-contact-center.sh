#!/bin/bash
# Install VOIZ Contact Center from the upstream repository

set -euo pipefail

CC_LOG="${LOG_FILE:-voiz-installation.log}"
CC_REPOSITORY="${VOIZ_CONTACT_CENTER_REPOSITORY:-https://github.com/voipiran/voiz-contact-center.git}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${CC_LOG}"
}

main() {
    log "=== Installing VOIZ Contact Center ==="

    if ! command -v git >/dev/null 2>&1; then
        log "ERROR: git is required to install VOIZ Contact Center"
        return 1
    fi

    local checkout_dir
    checkout_dir=$(mktemp -d /tmp/voiz-contact-center.XXXXXX)
    trap 'rm -rf "${checkout_dir}"' EXIT

    log "Cloning ${CC_REPOSITORY}..."
    git clone --depth 1 "${CC_REPOSITORY}" "${checkout_dir}" 2>&1 | tee -a "${CC_LOG}"

    if [[ ! -f "${checkout_dir}/install.sh" ]]; then
        log "ERROR: Contact Center installer was not found in the repository"
        return 1
    fi

    chmod 755 "${checkout_dir}/install.sh"
    log "Running the Contact Center installer..."
    (
        cd "${checkout_dir}"
        ./install.sh 2>&1 | tee -a "${CC_LOG}"
    )

    log "=== VOIZ Contact Center Installation Complete ==="
    return 0
}

main "$@"