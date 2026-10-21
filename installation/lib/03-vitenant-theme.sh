#!/bin/bash
# Install Vitenant theme

set -euo pipefail

THEME_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${THEME_LOG}"
}

main() {
    log "=== Installing Vitenant Theme ==="
    
    local theme_src="${VOIZ_ROOT}/core/theme"
    local www_html="/var/www/html"
    local lang="${VOIZ_LANG:-Persian}"
    
    if [[ ! -d "${theme_src}/vitenant" ]] || [[ ! -d "${theme_src}/pbxconfig" ]]; then
        log "ERROR: Theme source not found"
        return 1
    fi
    
    # Copy favicon
    if [[ -f "${theme_src}/vitenant/images/favicon.ico" ]]; then
        cp -f "${theme_src}/vitenant/images/favicon.ico" "${www_html}/"
    elif [[ -f "${theme_src}/vitenant/favicon.ico" ]]; then
        cp -f "${theme_src}/vitenant/favicon.ico" "${www_html}/"
    fi
    
    # Copy vitenant theme
    mkdir -p "${www_html}/themes"
    cp -rf "${theme_src}/vitenant" "${www_html}/themes/"
    
    # Set language/theme in Issabel's settings database. The database path
    # differs between Issabel installations and versions.
    local settings_db=""
    local config_db_dir=""
    if [[ -f /etc/issabel.conf ]]; then
        config_db_dir=$(awk -F= '$1 == "dbdir" {print $2; exit}' /etc/issabel.conf 2>/dev/null || true)
    fi

    local candidate
    local candidates=(
        "${config_db_dir:+${config_db_dir}/settings.db}"
        "/var/www/db/settings.db"
        "${www_html}/db/settings.db"
        "/var/lib/issabel/db/settings.db"
    )
    for candidate in "${candidates[@]}"; do
        if [[ -n "${candidate}" && -f "${candidate}" ]]; then
            settings_db="${candidate}"
            break
        fi
    done

    if [[ -z "${settings_db}" ]]; then
        log "ERROR: Issabel settings database not found in known locations"
        return 1
    fi
    log "Using Issabel settings database: ${settings_db}"
    if ! command -v sqlite3 >/dev/null 2>&1; then
        log "ERROR: sqlite3 is required to configure the Issabel language and theme"
        return 1
    fi
    if ! sqlite3 "${settings_db}" \
        "SELECT 1 FROM sqlite_master WHERE type='table' AND name='settings';" \
        | grep -qx '1'; then
        log "ERROR: Invalid Issabel settings database: settings table not found"
        return 1
    fi

    local language_value="en"
    local theme_value="tenant"
    local language_label="English"
    if [[ "${lang}" == "Persian" ]]; then
        language_value="fa"
        theme_value="vitenant"
        language_label="Persian"
    fi

    if ! sqlite3 "${settings_db}" \
        "BEGIN; UPDATE settings SET value='${language_value}' WHERE key='language'; UPDATE settings SET value='${theme_value}' WHERE key='theme'; COMMIT;"; then
        log "ERROR: Failed to update Issabel language/theme settings"
        return 1
    fi

    local configured_language configured_theme
    configured_language=$(sqlite3 "${settings_db}" \
        "SELECT value FROM settings WHERE key='language';")
    configured_theme=$(sqlite3 "${settings_db}" \
        "SELECT value FROM settings WHERE key='theme';")
    if [[ "${configured_language}" != "${language_value}" ]] ||
       [[ "${configured_theme}" != "${theme_value}" ]]; then
        log "ERROR: Issabel settings verification failed (language=${configured_language}, theme=${configured_theme})"
        return 1
    fi
    log "${language_label} language and ${theme_value} theme configured"
    
    # Copy PBX configuration assets.
    mkdir -p "${www_html}/admin/assets"
    cp -rf "${theme_src}/pbxconfig/css" "${www_html}/admin/assets/"
    chmod -R 755 "${www_html}/admin/assets/css" 2>/dev/null || true
    chown -R asterisk:asterisk "${www_html}/admin/assets/css" 2>/dev/null || true
    
    mkdir -p "${www_html}/admin/images"
    cp -f "${theme_src}/pbxconfig/images/issabelpbx_small.png" "${www_html}/admin/images/" 2>/dev/null || true
    cp -f "${theme_src}/pbxconfig/images/tango.png" "${www_html}/admin/images/" 2>/dev/null || true
    chmod 644 "${www_html}/admin/images/issabelpbx_small.png" "${www_html}/admin/images/tango.png" 2>/dev/null || true
    
    mkdir -p "${www_html}/admin/views"
    cp -f "${theme_src}/pbxconfig/footer_content.php" "${www_html}/admin/views/" 2>/dev/null || true
    chmod 644 "${www_html}/admin/views/footer_content.php" 2>/dev/null || true
    chown -R asterisk:asterisk "${www_html}/admin/views/footer_content.php" 2>/dev/null || true
    
    # Set permissions on theme
    chown -R asterisk:asterisk "${www_html}/themes/vitenant" 2>/dev/null || true
    chmod -R 755 "${www_html}/themes/vitenant" 2>/dev/null || true
    
    log "=== Vitenant Theme Installed ==="
    return 0
}

main "$@"