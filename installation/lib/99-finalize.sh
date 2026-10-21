#!/bin/bash
# Finalize installation - restart services safely

set -euo pipefail

FINALIZE_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${FINALIZE_LOG}"
}

safe_systemctl() {
    local action="$1"
    local service="$2"
    
    if systemctl is-active --quiet "${service}" 2>/dev/null; then
        log "Restarting ${service}..."
        if systemctl "${action}" "${service}" 2>/dev/null; then
            log "${service} restarted successfully"
        else
            log "WARNING: Failed to ${action} ${service}"
        fi
    else
        log "${service} not running, skipping ${action}"
    fi
}

main() {
    log "=== Finalizing Installation ==="
    
    # Restart Apache gracefully
    safe_systemctl restart httpd
    
    # Restart PHP-FPM if Issabel 5
    if [[ "${ISSABEL_VERSION:-4}" -eq 5 ]]; then
        safe_systemctl restart php-fpm
    fi
    
    # Clear opcache if available
    if command -v php >/dev/null 2>&1; then
        php -r 'opcache_reset();' 2>/dev/null && log "PHP opcache cleared" || log "opcache_reset unavailable"
    fi
    
    # Do not run amportal retrieve_conf here - can hang on this Issabel installation.
    # Each Apply creates another blocked process. Run manually after validation.
    log "Skipping Asterisk configuration reload (amportal); run Apply manually after validation"
    
    log "=== Installation Complete ==="
    return 0
}

main "$@"