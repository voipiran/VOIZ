#!/bin/bash
# Install VOIZ configuration

set -euo pipefail

CONFIG_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${CONFIG_LOG}"
}

main() {
    log "=== Installing VOIZ Configuration ==="
    
    local config_src="${VOIZ_ROOT}/core/config/voiz.conf"
    local config_dst="/etc/voiz.conf"
    local version="6.0.0"
    
    if [[ ! -f "${config_src}" ]]; then
        log "ERROR: VOIZ config not found at ${config_src}"
        return 1
    fi
    
    # Create /etc if needed
    mkdir -p /etc
    
    # Copy and update version
    cp -f "${config_src}" "${config_dst}"
    sed -i "s/^version=.*/version=${version}/" "${config_dst}" 2>/dev/null || true
    
    # Set permissions
    chmod 644 "${config_dst}" 2>/dev/null || true
    chown asterisk:asterisk "${config_dst}" 2>/dev/null || true
    
    log "=== VOIZ Configuration Installed (version ${version}) ==="
    return 0
}

main "$@"