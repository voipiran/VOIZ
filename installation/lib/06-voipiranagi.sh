#!/bin/bash
# Install voipiranagi (Survey AGI)

set -euo pipefail

AGI_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${AGI_LOG}"
}

main() {
    log "=== Installing voipiranagi (Survey AGI) ==="
    
    local agi_src="${VOIZ_ROOT}/integrations/asterisk/agi/voipiranagi"
    local agi_dst="/var/lib/asterisk/agi-bin/voipiranagi"
    local rootpw="${MYSQL_ROOT_PASSWORD:-}"
    
    if [[ ! -d "${agi_src}" ]]; then
        log "ERROR: voipiranagi source not found at ${agi_src}"
        return 1
    fi
    
    # Copy AGI scripts
    mkdir -p "${agi_dst}"
    cp -rf "${agi_src}/"* "${agi_dst}/"
    
    # Set permissions
    chmod -R 755 "${agi_dst}" 2>/dev/null || true
    chown -R asterisk:asterisk "${agi_dst}" 2>/dev/null || true
    
    # Add survey destination to database
    if [[ -n "${rootpw}" ]]; then
        local query="REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
        mysql -hlocalhost -uroot -p"${rootpw}" asterisk -e "${query}" 2>/dev/null || log "WARNING: Failed to add survey to database"
    else
        log "WARNING: MySQL root password not available, skipping survey database entry"
    fi
    
    log "=== voipiranagi Installed ==="
    return 0
}

main "$@"