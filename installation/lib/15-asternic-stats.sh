#!/bin/bash
# Install Asternic Call Stats Lite

set -euo pipefail

ASTERNIC_STATS_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${ASTERNIC_STATS_LOG}"
}

main() {
    log "=== Installing Asternic Call Stats Lite ==="
    
    local www_html="/var/www/html"
    local rootpw="${MYSQL_ROOT_PASSWORD:-}"
    
    if [[ -z "${rootpw}" ]]; then
        log "ERROR: MySQL root password required for Asternic Call Stats Lite"
        return 1
    fi
    
    # Check for bundled tarball
    local tarball=""
    if [[ -f "${VOIZ_ROOT}/integrations/issabel/software/asternic-stats-1.8.tgz" ]]; then
        tarball="${VOIZ_ROOT}/integrations/issabel/software/asternic-stats-1.8.tgz"
    elif [[ -f "${VOIZ_ROOT}/software/asternic-stats-1.8.tgz" ]]; then
        tarball="${VOIZ_ROOT}/software/asternic-stats-1.8.tgz"
    fi
    
    if [[ -z "${tarball}" ]] || [[ ! -f "${tarball}" ]]; then
        log "ERROR: Asternic Call Stats Lite tarball not found"
        return 1
    fi
    
    # Extract
    cd /tmp
    tar xzf "${tarball}" 2>/dev/null || {
        log "ERROR: Failed to extract Asternic Call Stats Lite"
        return 1
    }
    
    cd asternic-stats || {
        log "ERROR: asternic-stats directory not found"
        return 1
    }
    
    # Create database and user
    mysqladmin -u root -p"${rootpw}" create qstatslite 2>/dev/null || true
    mysql -u root -p"${rootpw}" qstatslite < sql/qstats.sql 2>/dev/null || log "WARNING: Failed to import qstats.sql"
    mysql -u root -p"${rootpw}" -e "CREATE USER 'qstatsliteuser'@'localhost' IDENTIFIED BY '${rootpw}'" 2>/dev/null || true
    mysql -u root -p"${rootpw}" -e "GRANT SELECT,INSERT,UPDATE,DELETE ON qstatslite.* TO 'qstatsliteuser'@'localhost'" 2>/dev/null || true
    mysql -u root -p"${rootpw}" -e "ALTER DATABASE qstatslite CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null || true
    mysql -u root -p"${rootpw}" -e "ALTER TABLE qstatslite.queue_stats CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null || true
    mysql -u root -p"${rootpw}" -e "ALTER TABLE qstatslite.qname CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null || true
    mysql -u root -p"${rootpw}" -e "ALTER TABLE qstatslite.qevent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null || true
    mysql -u root -p"${rootpw}" -e "ALTER TABLE qstatslite.qagent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null || true
    
    # Copy web files
    cp -rf html "${www_html}/queue-stats" 2>/dev/null || true
    cp -rf parselog /usr/local/parseloglite 2>/dev/null || true
    
    # Configure
    sed -i "s/= ''/= '${rootpw}'/g" "${www_html}/queue-stats/config.php" 2>/dev/null || true
    sed -i "s/admin/phpconfig/g" "${www_html}/queue-stats/config.php" 2>/dev/null || true
    sed -i "s/amp111/php[onfig/g" "${www_html}/queue-stats/config.php" 2>/dev/null || true
    sed -i "s/= ''/= '${rootpw}'/g" /usr/local/parseloglite/config.php 2>/dev/null || true
    
    # Add cron job
    (crontab -l 2>/dev/null; echo "*/15 * * * * php -q /usr/local/parseloglite/parselog.php convertlocal") | crontab - 2>/dev/null || true
    
    # Merge menu
    if [[ -f "${VOIZ_ROOT}/integrations/issabel/software/asternic.xml" ]]; then
        issabel-menumerge "${VOIZ_ROOT}/integrations/issabel/software/asternic.xml" 2>/dev/null || true
    elif [[ -f "${VOIZ_ROOT}/software/asternic.xml" ]]; then
        issabel-menumerge "${VOIZ_ROOT}/software/asternic.xml" 2>/dev/null || true
    elif [[ -f /tmp/asternic-stats/asternic.xml ]]; then
        issabel-menumerge /tmp/asternic-stats/asternic.xml 2>/dev/null || true
    fi
    
    cd - >/dev/null
    
    log "=== Asternic Call Stats Lite Installation Complete ==="
    return 0
}

main "$@"