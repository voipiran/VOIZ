#!/bin/bash
# Install VOIZ Issabel Monitoring from the upstream repository

set -euo pipefail

MONITORING_LOG="${LOG_FILE:-voiz-installation.log}"
MONITORING_REPOSITORY="${VOIZ_MONITORING_REPOSITORY:-https://github.com/voipiran/voiz-issabel-monitoring.git}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${MONITORING_LOG}"
}

main() {
    log "=== Installing VOIZ Issabel Monitoring ==="

    if ! command -v git >/dev/null 2>&1; then
        log "ERROR: git is required to install VOIZ Issabel Monitoring"
        return 1
    fi

    local checkout_dir
    checkout_dir=$(mktemp -d /tmp/voiz-issabel-monitoring.XXXXXX)
    trap 'rm -rf "${checkout_dir}"' EXIT

    log "Cloning ${MONITORING_REPOSITORY}..."
    git clone --depth 1 "${MONITORING_REPOSITORY}" "${checkout_dir}" 2>&1 | tee -a "${MONITORING_LOG}"

    if [[ ! -f "${checkout_dir}/install.sh" ]]; then
        log "ERROR: Monitoring installer was not found in the repository"
        return 1
    fi

    chmod 755 "${checkout_dir}/install.sh"
    log "Running the Issabel Monitoring installer..."
    (
        cd "${checkout_dir}"
        ./install.sh 2>&1 | tee -a "${MONITORING_LOG}"
    )

    log "=== VOIZ Issabel Monitoring Installation Complete ==="
}

main "$@"
