#!/bin/bash
# Install VOIZ WebPhone

set -euo pipefail

WEBPHONE_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${WEBPHONE_LOG}"
}

main() {
    log "=== Installing VOIZ WebPhone ==="
    
    local www_html="/var/www/html"
    
    # Remove existing installation
    rm -rf "${www_html}/phone" 2>/dev/null || true
    
    # Download from GitHub
    log "Downloading WebPhone..."
    git clone https://github.com/voipiran/VOIZ-WebPhone /tmp/VOIZ-WebPhone 2>/dev/null || {
        log "ERROR: Failed to clone VOIZ-WebPhone repository"
        return 1
    }
    
    # Move Phone directory
    if [[ -d /tmp/VOIZ-WebPhone/Phone ]]; then
        mv /tmp/VOIZ-WebPhone/Phone "${www_html}/phone" 2>/dev/null || {
            log "ERROR: Failed to move WebPhone files"
            return 1
        }
    else
        log "ERROR: Phone directory not found in repository"
        return 1
    fi
    
    # Run external install script if exists
    if [[ -f /tmp/VOIZ-WebPhone/install.sh ]]; then
        bash /tmp/VOIZ-WebPhone/install.sh 2>/dev/null || log "WARNING: WebPhone install.sh failed"
    fi
    
    # Set permissions
    chmod -R 755 "${www_html}/phone" 2>/dev/null || true
    chown -R asterisk:asterisk "${www_html}/phone" 2>/dev/null || true
    
    # Cleanup
    rm -rf /tmp/VOIZ-WebPhone 2>/dev/null || true
    
    log "=== WebPhone Installation Complete ==="
    return 0
}

main "$@"