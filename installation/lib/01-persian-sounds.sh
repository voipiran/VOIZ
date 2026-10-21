#!/bin/bash
# Install Persian sounds for Asterisk

set -euo pipefail

PERSIAN_SOUNDS_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${PERSIAN_SOUNDS_LOG}"
}

main() {
    log "=== Installing Persian Sounds ==="
    
    local sounds_src="${VOIZ_ROOT}/core/sounds/pr"
    local sounds_dst="/var/lib/asterisk/sounds/pr"
    local asterisk_etc="/etc/asterisk"
    
    if [[ ! -d "${sounds_src}" ]]; then
        log "ERROR: Persian sounds source not found at ${sounds_src}"
        return 1
    fi
    
    # Update sip_custom.conf
    local sip_conf="${asterisk_etc}/sip_custom.conf"
    if [[ -f "${sip_conf}" ]]; then
        sed -i '/language=pr/d' "${sip_conf}" 2>/dev/null || true
    fi
    echo "language=pr" >> "${sip_conf}"
    chown asterisk:asterisk "${sip_conf}" 2>/dev/null || true
    chmod 644 "${sip_conf}" 2>/dev/null || true
    
    # Update iax_custom.conf
    local iax_conf="${asterisk_etc}/iax_custom.conf"
    if [[ -f "${iax_conf}" ]]; then
        sed -i '/language=pr/d' "${iax_conf}" 2>/dev/null || true
    fi
    echo "language=pr" >> "${iax_conf}"
    chown asterisk:asterisk "${iax_conf}" 2>/dev/null || true
    chmod 644 "${iax_conf}" 2>/dev/null || true
    
    # Copy say.conf
    cp -f "${sounds_src}/say.conf" "${asterisk_etc}/" 2>/dev/null || true
    chown asterisk:asterisk "${asterisk_etc}/say.conf" 2>/dev/null || true
    chmod 644 "${asterisk_etc}/say.conf" 2>/dev/null || true
    
    # Copy sound files
    mkdir -p "${sounds_dst}"
    cp -rf "${sounds_src}/"* "${sounds_dst}/"
    chown -R asterisk:asterisk "${sounds_dst}"
    chmod -R 755 "${sounds_dst}"
    
    
    
    log "=== Persian Sounds Installed ==="
    return 0
}

main "$@"