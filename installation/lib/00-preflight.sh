#!/bin/bash
# Pre-flight checks for VOIZ installation

set -euo pipefail

PREFLIGHT_LOG="${LOG_FILE:-voiz-installation.log}"

log() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${PREFLIGHT_LOG}"
}

check_root() {
    if [[ $EUID -ne 0 ]]; then
        log "ERROR: This script must be run as root"
        return 1
    fi
    log "OK: Running as root"
}

check_os() {
    if [[ ! -f /etc/redhat-release ]] && [[ ! -f /etc/centos-release ]] && [[ ! -f /etc/rocky-release ]] && [[ ! -f /etc/almalinux-release ]]; then
        log "WARNING: This installer is designed for RHEL/CentOS/Rocky/AlmaLinux"
        log "Continuing anyway..."
    else
        log "OK: Supported OS detected"
    fi
}

check_issabel() {
    if [[ ! -f /etc/issabel.conf ]]; then
        log "ERROR: /etc/issabel.conf not found. Is Issabel installed?"
        return 1
    fi
    log "OK: Issabel configuration found"
}

check_mysql_password() {
    local rootpw
    rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf 2>/dev/null || true)
    if [[ -z "${rootpw}" ]]; then
        log "ERROR: MySQL root password not found in /etc/issabel.conf"
        return 1
    fi
    export MYSQL_ROOT_PASSWORD="${rootpw}"
    log "OK: MySQL root password retrieved"
}

check_php_version() {
    # Use already detected variables from main setup.sh
    if [[ -z "${ISSABEL_VERSION:-}" ]]; then
        local php_version
        php_version=$(php -r 'echo PHP_MAJOR_VERSION;' 2>/dev/null || true)
        if [[ -z "${php_version}" ]]; then
            log "ERROR: PHP not found or version detection failed"
            return 1
        fi
        export PHP_MAJOR_VERSION="${php_version}"
        export ISSABEL_VERSION=$([[ "${php_version}" -ge 7 ]] && echo 5 || echo 4)
    else
        if [[ -z "${PHP_MAJOR_VERSION:-}" ]]; then
            export PHP_MAJOR_VERSION=$([[ "${ISSABEL_VERSION}" -eq 5 ]] && echo 7 || echo 5)
        fi
    fi
    log "OK: PHP ${PHP_MAJOR_VERSION} detected (Issabel ${ISSABEL_VERSION})"
}

check_required_commands() {
    local missing=()
    for cmd in whiptail mysql sed awk sqlite3 bc; do
        if ! command -v "${cmd}" >/dev/null 2>&1; then
            missing+=("${cmd}")
        fi
    done
    if [[ ${#missing[@]} -gt 0 ]]; then
        log "WARNING: Missing required commands: ${missing[*]}"
        log "Installing packages required by the missing commands..."
        local packages=()
        local package_manager=""
        for cmd in "${missing[@]}"; do
            case "${cmd}" in
                whiptail) packages+=("newt") ;;
                mysql) packages+=("mariadb") ;;
                sqlite3) packages+=("sqlite") ;;
                awk) packages+=("gawk") ;;
                *) packages+=("${cmd}") ;;
            esac
        done

        if command -v dnf >/dev/null 2>&1; then
            package_manager="dnf"
        elif command -v yum >/dev/null 2>&1; then
            package_manager="yum"
        else
            log "ERROR: Neither dnf nor yum is available to install: ${packages[*]}"
            return 1
        fi

        if ! "${package_manager}" install -y "${packages[@]}"; then
            log "ERROR: ${package_manager} failed to install packages: ${packages[*]}"
            log "Install them manually, then rerun the installer."
            return 1
        fi

        local still_missing=()
        for cmd in "${missing[@]}"; do
            if ! command -v "${cmd}" >/dev/null 2>&1; then
                still_missing+=("${cmd}")
            fi
        done
        if [[ ${#still_missing[@]} -gt 0 ]]; then
            log "ERROR: Commands are still unavailable after package installation: ${still_missing[*]}"
            return 1
        fi
        log "OK: Installed missing commands: ${missing[*]}"
    fi
    log "OK: All required commands available"
}

check_disk_space() {
    local available_kb
    available_kb=$(df /var/www --output=avail | tail -1 | tr -d ' ')
    if [[ ${available_kb} -lt 500000 ]]; then
        log "WARNING: Low disk space on /var/www (${available_kb}KB available)"
    else
        log "OK: Sufficient disk space (${available_kb}KB available)"
    fi
}

check_selinux() {
    if command -v getenforce >/dev/null 2>&1; then
        local status
        status=$(getenforce 2>/dev/null || true)
        if [[ "${status}" == "Enforcing" ]]; then
            log "WARNING: SELinux is Enforcing. Some operations may fail."
            log "Consider: setenforce 0 (temporary) or configure policies"
        else
            log "OK: SELinux status: ${status}"
        fi
    fi
}

main() {
    log "=== VOIZ Pre-flight Checks ==="
    
    check_root || return 1
    check_os
    check_issabel || return 1
    check_mysql_password || return 1
    check_php_version || return 1
    check_required_commands || return 1
    check_disk_space
    check_selinux
    
    log "=== Pre-flight checks completed ==="
    return 0
}

main "$@"