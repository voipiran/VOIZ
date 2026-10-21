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

    # log "=== Installing VOIZ Menu ==="
    
    local menu_src="${VOIZ_ROOT}/installation/config/menu.db"
    local menu_dst="/var/www/db/menu.db"
    
    if [[ ! -f "${menu_src}" ]]; then
        log "ERROR: Menu database not found at ${menu_src}"
        return 1
    fi
    
    # Backup existing menu
    if [[ -f "${menu_dst}" ]]; then
        cp "${menu_dst}" "${menu_dst}.000_$(date +%Y%m%d_%H%M%S)" 2>/dev/null || true
    fi
    
    # Copy new menu
    mkdir -p "$(dirname "${menu_dst}")"
    cp -f "${menu_src}" "${menu_dst}"
    
    # Set permissions
    chmod 644 "${menu_dst}" 2>/dev/null || true
    chown asterisk:asterisk "${menu_dst}" 2>/dev/null || true
    
    log "=== VOIZ Menu Installed ==="
    return 0
}

main "$@"