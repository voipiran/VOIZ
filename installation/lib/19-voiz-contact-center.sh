#!/bin/bash
# Install VOIZ Contact Center from the voiz-console repository

set -euo pipefail

CC_LOG="${LOG_FILE:-voiz-installation.log}"
CC_ARCHIVE_URL="${VOIZ_CONTACT_CENTER_ARCHIVE_URL:-https://github.com/voipiran/voiz-console/archive/refs/heads/main.tar.gz}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${CC_LOG}"
}

main() {
    log "=== Installing VOIZ Contact Center ==="

    if ! command -v curl >/dev/null 2>&1 || ! command -v tar >/dev/null 2>&1; then
        log "ERROR: curl and tar are required to install VOIZ Contact Center"
        return 1
    fi

    local checkout_dir
    checkout_dir=$(mktemp -d /tmp/voiz-contact-center.XXXXXX)
    trap 'rm -rf "${checkout_dir}"' EXIT

    log "Downloading the Contact Center package from ${CC_ARCHIVE_URL}..."
    curl -fL --connect-timeout 15 --max-time 300 "${CC_ARCHIVE_URL}" -o "${checkout_dir}/voiz-console.tar.gz" 2>&1 | tee -a "${CC_LOG}"
    if curl -fL --connect-timeout 15 --max-time 120 "${CC_ARCHIVE_URL}.sha256" \
        -o "${checkout_dir}/voiz-console.tar.gz.sha256" 2>/dev/null; then
        local expected_checksum actual_checksum
        expected_checksum=$(awk 'NR == 1 {print $1; exit}' "${checkout_dir}/voiz-console.tar.gz.sha256")
        actual_checksum=$(sha256sum "${checkout_dir}/voiz-console.tar.gz" | awk '{print $1}')
        if [[ ! "${expected_checksum}" =~ ^[[:xdigit:]]{64}$ ||
            "${expected_checksum}" != "${actual_checksum}" ]]; then
            log "ERROR: Contact Center archive checksum verification failed"
            return 1
        fi
    else
        log "WARNING: Contact Center archive checksum file is not published; HTTPS transfer was used"
    fi
    tar -xzf "${checkout_dir}/voiz-console.tar.gz" --strip-components=1 -C "${checkout_dir}" 2>&1 | tee -a "${CC_LOG}"

    if [[ ! -f "${checkout_dir}/install-console.sh" ]]; then
        log "ERROR: VOIZ Console installer was not found in the downloaded package"
        return 1
    fi

    chmod 755 "${checkout_dir}/install-console.sh"
    log "Running the VOIZ Console installer..."
    (
        cd "${checkout_dir}"
        bash ./install-console.sh 2>&1 | tee -a "${CC_LOG}"
    )

    log "=== VOIZ Contact Center Installation Complete ==="
    return 0
}

main "$@"