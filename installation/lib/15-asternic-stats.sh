#!/bin/bash
# Clone and install Asternic Call Center Stats Lite.

set -euo pipefail

ASTERNIC_STATS_LOG="${LOG_FILE:-voiz-installation.log}"
ASTERNIC_STATS_REPOSITORY="${ASTERNIC_STATS_REPOSITORY:-https://github.com/voipiran/asternic-stats-lite.git}"
ASTERNIC_STATS_SOURCE="${ASTERNIC_STATS_SOURCE:-/usr/src/asternic-stats-lite}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${ASTERNIC_STATS_LOG}"
}

main() {
    log "=== Installing Asternic Call Stats Lite from ${ASTERNIC_STATS_REPOSITORY} ==="

    if ! command -v git >/dev/null 2>&1; then
        log "ERROR: git is required to install Asternic Call Stats Lite"
        return 1
    fi

    mkdir -p "$(dirname "${ASTERNIC_STATS_SOURCE}")"

    if [[ -d "${ASTERNIC_STATS_SOURCE}/.git" ]]; then
        log "Updating existing Asternic repository at ${ASTERNIC_STATS_SOURCE}"
        if ! git -C "${ASTERNIC_STATS_SOURCE}" pull --ff-only; then
            log "ERROR: Existing Asternic repository could not be fast-forwarded; refusing to install a stale or mixed version"
            return 1
        fi
    elif [[ -e "${ASTERNIC_STATS_SOURCE}" ]]; then
        log "ERROR: ${ASTERNIC_STATS_SOURCE} exists but is not a Git repository"
        return 1
    else
        log "Cloning Asternic repository"
        git clone --depth 1 "${ASTERNIC_STATS_REPOSITORY}" "${ASTERNIC_STATS_SOURCE}"
    fi

    [[ -f "${ASTERNIC_STATS_SOURCE}/install.sh" ]] || {
        log "ERROR: Asternic install.sh not found in ${ASTERNIC_STATS_SOURCE}"
        return 1
    }
    [[ -f "${ASTERNIC_STATS_SOURCE}/html/css/voiz-asternic.css" ]] || {
        log "ERROR: Asternic repository is missing the VOIZ theme; update the repository before installing"
        return 1
    }
    [[ -f "${ASTERNIC_STATS_SOURCE}/html/js/jalali.js" ]] || {
        log "ERROR: Asternic repository is missing the Jalali date integration; update the repository before installing"
        return 1
    }

    chmod 755 "${ASTERNIC_STATS_SOURCE}/install.sh"
    LOG_FILE="${ASTERNIC_STATS_LOG}" bash "${ASTERNIC_STATS_SOURCE}/install.sh"

    log "=== Asternic Call Center Stats Lite installation complete ==="
    return 0
}

main "$@"
