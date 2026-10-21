#!/bin/bash
# Install Jalali calendar libraries

set -euo pipefail

JALALI_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${JALALI_LOG}"
}

main() {
    log "=== Installing Jalali Calendar ==="
    
    local jalali_src="${VOIZ_ROOT}/core/jalali"
    local www_libs="/var/www/html/libs"
    
    if [[ ! -d "${jalali_src}" ]]; then
        log "ERROR: Jalali calendar source not found at ${jalali_src}"
        return 1
    fi
    
    # Copy JalaliJSCalendar
    mkdir -p "${www_libs}"
    cp -rf "${jalali_src}/JalaliJSCalendar" "${www_libs}/"
    
    # Copy PHP date/params files
    cp -f "${jalali_src}/date.php" "${www_libs}/"
    cp -f "${jalali_src}/params.php" "${www_libs}/"
    
    # Set permissions
    chown -R asterisk:asterisk "${www_libs}/JalaliJSCalendar" 2>/dev/null || true
    chown asterisk:asterisk "${www_libs}/date.php" 2>/dev/null || true
    chown asterisk:asterisk "${www_libs}/params.php" 2>/dev/null || true
    chmod -R 755 "${www_libs}/JalaliJSCalendar" 2>/dev/null || true
    chmod 644 "${www_libs}/date.php" "${www_libs}/params.php" 2>/dev/null || true
    
    # Copy jalalidate to Asterisk
    local asterisk_etc="/etc/asterisk"
    if [[ -d "${VOIZ_ROOT}/core/asterisk/jalalidate" ]]; then
        cp -rf "${VOIZ_ROOT}/core/asterisk/jalalidate" "${asterisk_etc}/"
        chown -R asterisk:asterisk "${asterisk_etc}/jalalidate" 2>/dev/null || true
        chmod -R 755 "${asterisk_etc}/jalalidate" 2>/dev/null || true
        chmod +x "${asterisk_etc}/jalalidate/jdate.sh" 2>/dev/null || true
    fi
    
    log "=== Jalali Calendar Installed ==="
    return 0
}

main "$@"