#!/bin/bash
# Apply Jalali patches only to report modules (safe targeted overlay)

set -euo pipefail

JALALI_PATCH_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${JALALI_PATCH_LOG}"
}

copy_patch_file() {
    local modules_src="$1"
    local www_modules="$2"
    local rel_path="$3"
    local backup_dir="$4"
    local src="${modules_src}/${rel_path}"
    local dst="${www_modules}/${rel_path}"

    if [[ ! -f "${src}" ]]; then
        log "WARNING: Patch source missing, skipping ${rel_path}"
        return 0
    fi

    if [[ -f "${dst}" ]]; then
        local backup_target="${backup_dir}/${rel_path}"
        mkdir -p "$(dirname "${backup_target}")"
        cp -a "${dst}" "${backup_target}"
    fi

    mkdir -p "$(dirname "${dst}")"
    cp -f "${src}" "${dst}"
    chown asterisk:asterisk "${dst}" 2>/dev/null || true
    log "Patched ${rel_path}"
    return 0
}

main() {
    log "=== Applying Jalali Calendar to Modules ==="
    
    local modules_src="${VOIZ_ROOT}/core/issabel-modules/modules"
    local www_modules="/var/www/html/modules"
    local backup_dir="/var/www/html/modules000_jalali_$(date +%Y%m%d_%H%M%S)"
    mkdir -p "${backup_dir}"

    local files=(
        "monitoring/index.php"
        "monitoring/themes/default/filter.tpl"
        "voicemail/index.php"
        "voicemail/themes/default/filter.tpl"
        "cdrreport/index.php"
    )

    local rel_path
    for rel_path in "${files[@]}"; do
        copy_patch_file "${modules_src}" "${www_modules}" "${rel_path}" "${backup_dir}"
    done

    # Calendar module Jalali conversion is intentionally not forced here to avoid
    # breaking event date/time serialization in Issabel 5.
    if [[ -f "${www_modules}/calendar/lang/fa.lang" ]]; then
        log "Calendar module Persian language is present"
    else
        log "WARNING: Calendar module Persian language not found"
    fi
    
    log "Jalali module patch backup: ${backup_dir}"
    log "=== Jalali Calendar Module Patching Complete ==="
    return 0
}

main "$@"