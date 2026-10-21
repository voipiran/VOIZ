#!/bin/bash
# Install Asternic CDR module

set -euo pipefail

ASTERNIC_CDR_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${ASTERNIC_CDR_LOG}"
}

main() {
    log "=== Installing Asternic CDR ==="

    local modules_src="${VOIZ_ROOT}/integrations/issabel/modules"
    local www_html="/var/www/html"
    local admin_modules="${www_html}/admin/modules"
    local rootpw="${MYSQL_ROOT_PASSWORD:-}"
    local module_enabled

    if [[ -z "${rootpw}" ]]; then
        log "ERROR: MySQL root password is required to check Asternic CDR module status"
        return 1
    fi

    if ! module_enabled=$(mysql -N -s -uroot -p"${rootpw}" asterisk \
        -e "SELECT enabled FROM modules WHERE modulename='asternic_cdr' LIMIT 1;" 2>/dev/null); then
        log "ERROR: Failed to check Asternic CDR status in the Issabel module registry"
        return 1
    fi

    if [[ "${module_enabled}" == "1" ]]; then
        log "Asternic CDR is already registered and enabled; skipping file installation"
        log "=== Asternic CDR Installation Complete ==="
        return 0
    fi
    
    if [[ ! -d "${modules_src}" ]]; then
        log "ERROR: Asternic CDR source not found at ${modules_src}"
        return 1
    fi
    
    if [[ -d "${modules_src}/asternic_cdr" ]]; then
        mkdir -p "${admin_modules}"
        cp -rf "${modules_src}/asternic_cdr" "${admin_modules}/"
        chown -R asterisk:asterisk "${admin_modules}/asternic_cdr" 2>/dev/null || true
        chmod -R 755 "${admin_modules}/asternic_cdr" 2>/dev/null || true
        
        # Registration via amportal is deferred. On Issabel 5 it can leave
        # retrieve_conf blocked and break the PBX Apply action.
        log "Asternic CDR files installed; registration deferred"
    else
        log "WARNING: asternic_cdr directory not found, skipping"
    fi
    
    log "=== Asternic CDR Installation Complete ==="
    return 0
}

main "$@"