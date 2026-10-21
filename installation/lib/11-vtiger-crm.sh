#!/bin/bash
# Install Vtiger CRM

set -euo pipefail

VTIGER_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${VTIGER_LOG}"
}

main() {
    log "=== Installing Vtiger CRM ==="
    
    local www_html="/var/www/html"
    local rootpw="${MYSQL_ROOT_PASSWORD:-}"
    
    # Download Vtiger from GitHub
    log "Downloading Vtiger CRM..."
    curl -L -o /tmp/VOIZ-Vtiger.zip https://github.com/voipiran/VOIZ-Vtiger/archive/main.zip 2>/dev/null || {
        log "ERROR: Failed to download Vtiger CRM"
        return 1
    }
    
    # Extract
    unzip -o /tmp/VOIZ-Vtiger.zip -d /tmp 2>/dev/null || {
        log "ERROR: Failed to unzip Vtiger CRM"
        return 1
    }
    
    # Copy files
    mkdir -p "${www_html}/vtiger"
    cp -rf /tmp/VOIZ-Vtiger-main/* "${www_html}/vtiger/" 2>/dev/null || {
        log "ERROR: Failed to copy Vtiger files"
        return 1
    }
    
    # Set permissions
    chmod -R 755 "${www_html}/vtiger" 2>/dev/null || true
    chown -R asterisk:asterisk "${www_html}/vtiger" 2>/dev/null || true
    
    # Setup database
    if [[ -n "${rootpw}" ]]; then
        if ! mysql -uroot -p"${rootpw}" -e 'use voipirancrm' >/dev/null 2>&1; then
            log "Creating Vtiger database..."
            mysql -uroot -p"${rootpw}" -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;" 2>/dev/null || true
            mysql -uroot -p"${rootpw}" -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';" 2>/dev/null || true
            
            if [[ -f /tmp/VOIZ-Vtiger-main/vtiger.sql ]]; then
                mysql -uroot -p"${rootpw}" voipirancrm < /tmp/VOIZ-Vtiger-main/vtiger.sql 2>/dev/null || log "WARNING: Failed to import vtiger.sql"
            fi
        fi
        
        # Update config
        if [[ -f "${www_html}/vtiger/config.inc.php" ]]; then
            sed -i "s/123456/${rootpw}/g" "${www_html}/vtiger/config.inc.php" 2>/dev/null || true
        fi
        
        # Merge menu
        if [[ -f /tmp/VOIZ-Vtiger-main/crm-menu.xml ]]; then
            issabel-menumerge /tmp/VOIZ-Vtiger-main/crm-menu.xml 2>/dev/null || true
        fi
    else
        log "WARNING: MySQL root password not available, skipping database setup"
    fi
    
    # Cleanup
    rm -rf /tmp/VOIZ-Vtiger.zip /tmp/VOIZ-Vtiger-main 2>/dev/null || true
    
    log "=== Vtiger CRM Installation Complete ==="
    return 0
}

main "$@"