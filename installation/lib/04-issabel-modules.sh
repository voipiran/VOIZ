#!/bin/bash
# Install the dashboard and Issabel compatibility files.

set -euo pipefail

MODULES_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${MODULES_LOG}"
}

main() {
    log "=== Installing Issabel Modules ==="
    
    local modules_src="${VOIZ_ROOT}/core/issabel-modules"
    local www_html="/var/www/html"
    local backup_dir="${www_html}/voiz-modules-backup_$(date +%Y%m%d_%H%M%S)"
    
    if [[ ! -d "${modules_src}" ]]; then
        log "ERROR: Issabel modules source not found at ${modules_src}"
        return 1
    fi

    mkdir -p "${backup_dir}"

    backup_and_copy() {
        local src="$1"
        local dst="$2"

        if [[ ! -e "${src}" ]]; then
            log "WARNING: Source not found, skipping: ${src}"
            return 0
        fi

        if [[ -e "${dst}" ]]; then
            local rel="${dst#/var/www/html/}"
            local backup_target="${backup_dir}/${rel}"
            mkdir -p "$(dirname "${backup_target}")"
            cp -a "${dst}" "${backup_target}"
        fi

        mkdir -p "$(dirname "${dst}")"
        if [[ -d "${src}" ]]; then
            rm -rf "${dst}"
            cp -a "${src}" "${dst}"
        else
            cp -f "${src}" "${dst}"
        fi
    }

    local dashboard_src="${modules_src}/modules/dashboard"
    local dashboard_dst="${www_html}/modules/dashboard"
    if [[ ! -d "${dashboard_src}" ]]; then
        log "ERROR: Dashboard module source not found at ${dashboard_src}"
        return 1
    fi

    # Replace the dashboard as a unit so its RTL assets and templates are deployed together.
    backup_and_copy "${dashboard_src}" "${dashboard_dst}"
    chown -R asterisk:asterisk "${dashboard_dst}" 2>/dev/null || true
    log "Replaced dashboard module from VOIZ source with backup at ${backup_dir}/modules/dashboard"

    # Shared libraries required by Jalali-enabled report modules.
    backup_and_copy "${modules_src}/mylib" "${www_html}/libs/mylib"
    backup_and_copy "${modules_src}/paloSantoForm.class.php" "${www_html}/libs/paloSantoForm.class.php"

    # Global Persian language file.
    backup_and_copy "${modules_src}/fa.lang" "${www_html}/lang/fa.lang"

    # Module-level Persian language files (safe text-only overlays).
    local source_lang_file rel_path copied_lang_count
    copied_lang_count=0
    while IFS= read -r source_lang_file; do
        rel_path="${source_lang_file#${modules_src}/modules/}"
        backup_and_copy \
            "${source_lang_file}" \
            "${www_html}/modules/${rel_path}"
        copied_lang_count=$((copied_lang_count + 1))
    done < <(find "${modules_src}/modules" -type f -path "*/lang/fa.lang" | sort)

    chown -R asterisk:asterisk "${www_html}/libs/mylib" 2>/dev/null || true
    chown asterisk:asterisk "${www_html}/libs/paloSantoForm.class.php" 2>/dev/null || true
    chown asterisk:asterisk "${www_html}/lang/fa.lang" 2>/dev/null || true
    while IFS= read -r source_lang_file; do
        rel_path="${source_lang_file#${modules_src}/modules/}"
        chown asterisk:asterisk "${www_html}/modules/${rel_path}" 2>/dev/null || true
    done < <(find "${modules_src}/modules" -type f -path "*/lang/fa.lang" | sort)

    log "Copied ${copied_lang_count} module Persian language files"
    log "Compatibility files installed with backup at ${backup_dir}"
    
    log "=== Issabel Modules Installed ==="
    return 0
}

main "$@"