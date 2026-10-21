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

    # if [[ "${OPTIMIZE_MENUS:-false}" != "true" ]]; then
    #     log "Skipping menu optimization (not requested)"
    #     return 0
    # fi
    #
    # log "=== Optimizing Menus ==="
    
    local menu_db="/var/www/db/menu.db"
    
    if [[ ! -f "${menu_db}" ]]; then
        log "WARNING: Menu database not found, skipping optimization"
        return 0
    fi
    
    # Backup
    local backup_file="/var/www/db/menu_backup_$(date +%Y%m%d_%H%M%S).db"
    cp "${menu_db}" "${backup_file}" 2>/dev/null || log "WARNING: Failed to backup menu.db"
    
    # Remove unwanted menus
    sqlite3 "${menu_db}" "DELETE FROM menu WHERE id = 'billing';" 2>/dev/null || log "WARNING: Failed to delete billing menu"
    sqlite3 "${menu_db}" "DELETE FROM menu WHERE id = 'graphic_report';" 2>/dev/null || log "WARNING: Failed to delete graphic_report menu"
    sqlite3 "${menu_db}" "DELETE FROM menu WHERE id = 'channelusage';" 2>/dev/null || log "WARNING: Failed to delete channelusage menu"
    sqlite3 "${menu_db}" "DELETE FROM menu WHERE IdParent = 'email_admin' AND id != 'remote_smtp';" 2>/dev/null || log "WARNING: Failed to delete email_admin submenus"
    
    log "=== Menus Optimized ==="
    return 0
}

main "$@"