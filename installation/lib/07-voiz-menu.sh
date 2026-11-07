#!/bin/bash
# Install VOIZ menu database

set -euo pipefail

MENU_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${MENU_LOG}"
}

main() {
    # Temporarily disabled. Keep the existing Issabel menu unchanged until
    # the VOIZ menu definition has been reviewed.
    log "Skipping VOIZ Menu changes (temporarily disabled)"
    return 0
}

main "$@"