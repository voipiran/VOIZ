#!/bin/bash
# Optimize Issabel menus (optional)

set -euo pipefail

OPTIMIZE_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${OPTIMIZE_LOG}"
}

main() {
    # Temporarily disabled. Do not remove or shorten Issabel menus.
    log "Skipping menu optimization (temporarily disabled)"
    return 0
}

main "$@"