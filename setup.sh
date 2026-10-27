#!/bin/bash
# VOIZ 6.0.0 Setup Script
# Modular installer for VOIZ - Persian Unified Communication

set -euo pipefail

# ==========================================
# Configuration
# ==========================================
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
export VOIZ_ROOT="${SCRIPT_DIR}"
export LOG_FILE="${VOIZ_ROOT}/voiz-installation.log"
export LIB_DIR="${VOIZ_ROOT}/installation/lib"
QUIET_CONSOLE=0

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
MAGENTA='\033[1;35m'
BOLD='\033[1m'
NC='\033[0m'

# ==========================================
# System Detection (Early - used throughout installation)
# ==========================================
detect_system() {
    # Detect Issabel version (4 or 5)
    local php_version
    php_version=$(php -r 'echo PHP_MAJOR_VERSION;' 2>/dev/null || echo "0")
    export PHP_MAJOR_VERSION="${php_version}"
    if [[ "${php_version}" -ge 7 ]]; then
        export ISSABEL_VERSION=5
    else
        export ISSABEL_VERSION=4
    fi
    
    # Detect Asterisk major version
    local asterisk_version
    asterisk_version=$(asterisk -V 2>/dev/null | head -1 | grep -oE '[0-9]+\.[0-9]+' | head -1 || echo "0")
    if [[ -n "${asterisk_version}" ]]; then
        export ASTERISK_MAJOR_VERSION=$(echo "${asterisk_version}" | cut -d. -f1)
    else
        export ASTERISK_MAJOR_VERSION=0
    fi
    
    # Detect OS name and version
    if [[ -f /etc/os-release ]]; then
        # shellcheck source=/dev/null
        . /etc/os-release
        export OS_NAME="${NAME:-Unknown}"
        export OS_VERSION="${VERSION_ID:-Unknown}"
        export OS_ID="${ID:-unknown}"
    elif [[ -f /etc/redhat-release ]]; then
        local release_info
        release_info=$(cat /etc/redhat-release)
        export OS_NAME="${release_info}"
        export OS_VERSION=$(echo "${release_info}" | grep -oE '[0-9]+\.[0-9]+' | head -1 || echo "Unknown")
        export OS_ID="rhel"
    else
        export OS_NAME="Unknown"
        export OS_VERSION="Unknown"
        export OS_ID="unknown"
    fi
    
    # Log detected values
    log "=== System Detection ==="
    log "Issabel Version: ${ISSABEL_VERSION}"
    log "Asterisk Version: ${ASTERISK_MAJOR_VERSION}"
    log "OS: ${OS_NAME} ${OS_VERSION} (${OS_ID})"
}

load_mysql_password() {
    local rootpw
    rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf 2>/dev/null || true)
    if [[ -n "${rootpw}" ]]; then
        export MYSQL_ROOT_PASSWORD="${rootpw}"
    fi
}

normalize_module_line_endings() {
    local script
    for script in "${LIB_DIR}"/*.sh; do
        [[ -f "${script}" ]] || continue
        sed -i 's/\r$//' "${script}"
    done
}

# ==========================================
# Helper Functions
# ==========================================
mkdir -p "$(dirname "/opt/voiz-contact-center/voiz/voiz-installation.log")"
log() {
    if [[ "${QUIET_CONSOLE:-0}" -eq 1 ]]; then
        echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" >> "${LOG_FILE}"
    else
        echo "[$(date '+%Y-%m-%d %H:%M:%S')] $*" | tee -a "${LOG_FILE}"
    fi
}

run_module() {
    local module="$1"
    local description="$2"
    local script="${LIB_DIR}/${module}"
    
    if [[ ! -f "${script}" ]]; then
        printf '[FAIL] %s (module not found)\n' "${description}"
        log "ERROR: Module not found: ${script}"
        return 1
    fi
    
    installation_step_start "${description}"
    if bash "${script}" >/dev/null 2>&1; then
        installation_step_done
        return 0
    else
        installation_step_failed
        return 1
    fi
}

run_module_non_blocking() {
    local module="$1"
    local description="$2"
    local script="${LIB_DIR}/${module}"
    
    if [[ ! -f "${script}" ]]; then
        log "WARNING: Module not found: ${script}"
        CURRENT_STEP_DESCRIPTION="${description}"
        INSTALL_STEP=$((INSTALL_STEP + 1))
        if [[ "${USE_GAUGE:-0}" -eq 1 ]]; then
            installation_step_warning
        else
            printf '[WARN] %s (module not found)\n' "${description}"
        fi
        return 0
    fi
    
    installation_step_start "${description}"
    if bash "${script}" >/dev/null 2>&1; then
        installation_step_done
        return 0
    else
        installation_step_warning
        return 0
    fi
}

installation_step_start() {
    INSTALL_STEP=$((INSTALL_STEP + 1))
    CURRENT_STEP_DESCRIPTION="$1"
    STEP_STATUS[$((INSTALL_STEP - 1))]="running"
    if [[ "${USE_GAUGE:-0}" -eq 1 ]]; then
        gauge_render
    else
        printf '[%02d/%02d] %s ... ' "${INSTALL_STEP}" "${TOTAL_STEPS}" "${CURRENT_STEP_DESCRIPTION}"
    fi
}

installation_step_done() {
    log "RESULT: [OK] ${CURRENT_STEP_DESCRIPTION}"
    STEP_STATUS[$((INSTALL_STEP - 1))]="ok"
    if [[ "${USE_GAUGE:-0}" -eq 1 ]]; then
        gauge_render
    else
        printf '[OK]\n'
    fi
}

installation_step_failed() {
    log "RESULT: [FAIL] ${CURRENT_STEP_DESCRIPTION}"
    STEP_STATUS[$((INSTALL_STEP - 1))]="fail"
    if [[ "${USE_GAUGE:-0}" -eq 1 ]]; then
        gauge_render
    else
        printf '[FAIL]\n'
    fi
}

installation_step_warning() {
    log "RESULT: [OK] ${CURRENT_STEP_DESCRIPTION}"
    STEP_STATUS[$((INSTALL_STEP - 1))]="warn"
    if [[ "${USE_GAUGE:-0}" -eq 1 ]]; then
        gauge_render
    else
        printf '[OK]\n'
    fi
}

gauge_render() {
    local current_message="${1:-}"
    local percentage=0
    local index status marker label checklist terminal_lines terminal_columns \
        dialog_height dialog_width

    if [[ "${TOTAL_STEPS}" -gt 0 ]]; then
        percentage=$((INSTALL_STEP * 100 / TOTAL_STEPS))
    fi

    checklist="Progress: ${percentage}%\n\n"
    for ((index = 0; index < ${#STEP_LABELS[@]}; index++)); do
        status="${STEP_STATUS[${index}]:-pending}"
        label="${STEP_LABELS[${index}]}"
        case "${status}" in
            ok) marker="[OK]" ;;
            warn) marker="[WARN]" ;;
            fail) marker="[FAIL]" ;;
            running) marker="[...]" ;;
            *) marker="[ ]" ;;
        esac
        checklist+="${marker} [$((index + 1))/${TOTAL_STEPS}] ${label}\n"
    done
    if [[ -n "${current_message}" ]]; then
        checklist+="\n${current_message}\n"
    fi

    terminal_lines=$(tput lines 2>/dev/null || printf '24')
    terminal_columns=$(tput cols 2>/dev/null || printf '100')
    dialog_height=$((terminal_lines - 2))
    dialog_width=$((terminal_columns - 4))
    if [[ "${dialog_height}" -lt 12 ]]; then dialog_height=12; fi
    if [[ "${dialog_height}" -gt 24 ]]; then dialog_height=24; fi
    if [[ "${dialog_width}" -lt 72 ]]; then dialog_width=72; fi
    if [[ "${dialog_width}" -gt 100 ]]; then dialog_width=100; fi

    # Keep one stable progress page instead of reopening whiptail --infobox
    # for every step. Infobox exits immediately and causes visible flicker.
    local bar_width=32
    local filled=$((percentage * bar_width / 100))
    local empty=$((bar_width - filled))
    local bar
    printf -v bar '%*s' "${filled}" ''
    bar="${bar// /#}"
    local empty_bar
    printf -v empty_bar '%*s' "${empty}" ''
    empty_bar="${empty_bar// /-}"

    printf '\033[2J\033[H'
    printf '\033[1;36m+------------------------------------------------------------+\033[0m\n'
    printf '\033[1;36m| %-58s |\033[0m\n' "VOIZ 6 | Installation Progress"
    printf '\033[1;36m+------------------------------------------------------------+\033[0m\n\n'
    printf 'Progress: \033[1;33m%3d%%\033[0m  [\033[1;32m%s\033[0m%s]\n\n' \
        "${percentage}" "${bar}" "${empty_bar}"
    for ((index = 0; index < ${#STEP_LABELS[@]}; index++)); do
        status="${STEP_STATUS[${index}]:-pending}"
        label="${STEP_LABELS[${index}]}"
        case "${status}" in
            ok) marker="[OK]"; color='\033[1;32m' ;;
            warn) marker="[OK]"; color='\033[1;32m' ;;
            fail) marker="[FAIL]"; color='\033[1;31m' ;;
            running) marker="[... ]"; color='\033[1;36m' ;;
            *) marker="[    ]"; color='\033[0;37m' ;;
        esac
        printf '%b%-6s\033[0m [%02d/%02d] %s\n' \
            "${color}" "${marker}" "$((index + 1))" "${TOTAL_STEPS}" "${label}"
    done
    if [[ -n "${current_message}" ]]; then
        printf '\n\033[1;36m%s\033[0m\n' "${current_message}"
    fi
}

update_issabel() {
    log "=== Updating Issabel (non-blocking) ==="
    
    # Simple non-interactive update using yum (Issabel standard)
    # Use timeout to prevent hanging
    log "Running yum update for Issabel packages (non-interactive)..."
    if timeout 120 yum update -y issabel-* --exclude=asterisk* --exclude=freepbx* --exclude=issabel-pbx* 2>&1 | tail -20; then
        log "<<< Issabel Update - DONE"
        return 0
    else
        local exit_code=$?
        if [[ $exit_code -eq 124 ]]; then
            log "WARNING: Issabel update timed out (120s), continuing installation"
        else
            log "WARNING: Issabel update had issues (exit: $exit_code), continuing installation"
        fi
        return 1
    fi
}

install_contact_center() (
    local install_log="/var/log/voiz-contact-center-install.log"
    local archive="/opt/voiz-contact-center.tar.gz"
    local project="/opt/voiz-contact-center"

    {
        echo "VOIZ ContactCenter installation"
        echo "Started: $(date -Is)"
        echo "[COMMAND] cd /opt && rm -rf voiz-contact-center voiz-contact-center.tar.gz && curl -fL https://github.com/voipiran/voiz-contact-center/archive/refs/heads/main.tar.gz -o voiz-contact-center.tar.gz && tar -xzf voiz-contact-center.tar.gz && mv voiz-contact-center-main voiz-contact-center && cd voiz-contact-center && sudo bash install.sh"
    } > "${install_log}"

    cd /opt || return 1
    rm -rf voiz-contact-center voiz-contact-center.tar.gz || return 1
    curl -fL https://github.com/voipiran/voiz-contact-center/archive/refs/heads/main.tar.gz \
        -o voiz-contact-center.tar.gz >> "${install_log}" 2>&1 || return 1
    tar -xzf "${archive}" >> "${install_log}" 2>&1 || return 1
    mv voiz-contact-center-main voiz-contact-center >> "${install_log}" 2>&1 || return 1
    cd "${project}" || return 1

    # The bundled ContactCenter installer is also invoked by the web license
    # flow, where no terminal or TERM variable is available. Keep older
    # published bundles from aborting on their unconditional `clear`.
    if grep -qx 'clear' install.sh 2>/dev/null; then
        sed -i '/^clear$/c\
if [[ -t 1 \&\& -n "${TERM:-}" ]] \&\& command -v clear >/dev/null 2>\&1; then\
    clear || true\
fi' install.sh
        echo "[INFO] Patched non-interactive terminal handling in ContactCenter installer." >> "${install_log}"
    fi

    local started_at
    local elapsed
    local installer_pid
    local installer_status
    local last_log_line
    started_at=$(date +%s)
    bash install.sh >> "${install_log}" 2>&1 &
    installer_pid=$!
    echo "[INFO] ContactCenter installer started. PID=${installer_pid}" >> "${install_log}"

    while kill -0 "${installer_pid}" 2>/dev/null; do
        elapsed=$(( $(date +%s) - started_at ))
        last_log_line=$(tail -n 1 "${install_log}" 2>/dev/null | tr '\r\n' ' ')
        [[ -n "${last_log_line}" ]] || last_log_line="waiting for installer output"
        log "ContactCenter still running (${elapsed}s, PID=${installer_pid}): ${last_log_line}"
        gauge_msg "ContactCenter running (${elapsed}s): ${last_log_line:0:90}"
        sleep 5
    done

    wait "${installer_pid}"
    installer_status=$?
    echo "[EXIT] bash install.sh returned ${installer_status}" >> "${install_log}"
    if [[ "${installer_status}" -ne 0 ]]; then
        log "ERROR: ContactCenter installer failed with exit code ${installer_status}; see ${install_log}"
        return "${installer_status}"
    fi

    for required_path in /opt/OpDesk/backend /opt/OpDesk/frontend /opt/OpDesk/start.sh; do
        if [[ ! -e "${required_path}" ]]; then
            echo "[ERROR] Required path was not created: ${required_path}" >> "${install_log}"
            return 1
        fi
    done

    local opdesk_python=""
    local python_candidate
    for python_candidate in /usr/local/bin/python /usr/bin/python3.11 python python3; do
        if command -v "${python_candidate}" >/dev/null 2>&1 && \
           "${python_candidate}" -c 'from contextlib import asynccontextmanager' >/dev/null 2>&1; then
            opdesk_python="$(command -v "${python_candidate}")"
            break
        fi
    done

    if [[ -z "${opdesk_python}" ]]; then
        echo "[ERROR] No Python interpreter with contextlib.asynccontextmanager was found." >> "${install_log}"
        command -v python 2>&1 >> "${install_log}" || true
        command -v python3 2>&1 >> "${install_log}" || true
        python --version 2>&1 >> "${install_log}" || true
        python3 --version 2>&1 >> "${install_log}" || true
        return 1
    fi

    echo "[INFO] Configuring opdesk.service to use ${opdesk_python}." >> "${install_log}"
    mkdir -p /etc/systemd/system/opdesk.service.d || return 1
    cat > /etc/systemd/system/opdesk.service.d/voiz-python.conf <<EOF
[Service]
Environment=PYTHON_BIN=${opdesk_python}
EOF
    systemctl daemon-reload || return 1
    systemctl restart opdesk.service >> "${install_log}" 2>&1 || true

    if ! systemctl is-enabled --quiet opdesk.service 2>/dev/null; then
        echo "[ERROR] opdesk.service is not enabled." >> "${install_log}"
        systemctl status opdesk.service --no-pager >> "${install_log}" 2>&1 || true
        return 1
    fi

    if ! systemctl is-active --quiet opdesk.service 2>/dev/null; then
        echo "[ERROR] opdesk.service is not active." >> "${install_log}"
        systemctl status opdesk.service --no-pager >> "${install_log}" 2>&1 || true
        journalctl -u opdesk.service -n 80 --no-pager >> "${install_log}" 2>&1 || true
        return 1
    fi

    local health_attempt
    for health_attempt in {1..12}; do
        if curl -kfsS --max-time 5 https://127.0.0.1:9001/dashboard >/dev/null 2>>"${install_log}"; then
            echo "[OK] ContactCenter service is active and HTTPS dashboard responds on port 9001." >> "${install_log}"
            return 0
        fi
        sleep 5
    done

    echo "[ERROR] HTTPS dashboard did not respond on https://127.0.0.1:9001/dashboard." >> "${install_log}"
    ss -lntp >> "${install_log}" 2>&1 || true
    systemctl status nginx --no-pager >> "${install_log}" 2>&1 || true
    journalctl -u opdesk.service -n 80 --no-pager >> "${install_log}" 2>&1 || true
    return 1
)

select_features() {
    local selected
    selected=$(whiptail --title "SELECT OPTIONAL MODULES TO INSTALL" --checklist \
        "Core components (Persian Sounds, Jalali Calendar, Theme, Issabel Modules, voipiranAGI, VOIZ Menu) are installed automatically.\n\nSelect additional modules:" 24 100 16 \
        "UpdateIssabel" "Update Issabel (non-blocking)" ON \
        "JalaliModulePatch" "Apply Jalali Calendar to Monitoring/CDR/Voicemail" OFF \
        "IssabelCallcenterCE" "Issabel Callcenter CE" OFF \
        "VoizMonitoring" "VOIZ Issabel Monitoring" OFF \
        "CalleridFormatter" "VOIZ Asterisk Caller ID Formatter" OFF \
        "Chanspy" "VOIZ Asterisk Chanspy" OFF \
        "VOIZContactCenter" "VOIZContactCenter" OFF \
        "WebPhone" "WebPhone Client" OFF \
        "AsternicStats" "Asternic Call Stats Lite" OFF \
        "AsternicCDR" "Asternic CDR Processing" OFF \
        "VtigerCRM" "Vtiger CRM Integration" OFF \
        3>&1 1>&2 2>&3) || return 1
    
    eval "FEATURES=($selected)"
    log "Selected optional features: ${FEATURES[*]}"
}

gauge_msg() {
    if [[ "${USE_GAUGE:-0}" -eq 1 ]]; then
        gauge_render "[..] $1"
    fi
}

show_banner() {
    clear
    echo -e "${MAGENTA}╔═══════════════════════════════════════════════════════════════════╗${NC}"
    echo -e "${MAGENTA}║${NC}                                                                      ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}    ${CYAN}${BOLD}    ██╗   ██╗ ██████╗ ██╗██████╗ ██╗██████╗  █████╗ ███╗   ██╗${NC}              ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}    ${CYAN}${BOLD}    ██║   ██║██╔═══██╗██║██╔══██╗██║██╔══██╗██╔══██╗████╗  ██║${NC}              ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}    ${CYAN}${BOLD}    ██║   ██║██║   ██║██║██████╔╝██║██████╔╝██║  ██║██╔██╗ ██║${NC}              ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}    ${CYAN}${BOLD}    ╚██╗ ██╔╝██║   ██║██║██╔═══╝ ██║██╔══██╗██╔══██║██║╚██╗██║${NC}              ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}    ${CYAN}${BOLD}     ╚████╔╝ ╚██████╔╝██║██║     ██║██████╔╝██║  ██║██║ ╚████║${NC}              ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}    ${CYAN}${BOLD}      ╚═══╝   ╚═════╝ ╚═╝╚═╝     ╚═╝╚═════╝ ╚═╝╚═══╝╚═╝  ╚═══╝${NC}              ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}                                                                      ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}                        ${BOLD}${MAGENTA}VOIZ 6${NC}                                               ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}                        ${YELLOW}powered by VOIPIRAN${NC}                                 ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}                        ${CYAN}https://voipiran.io${NC}                                   ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}║${NC}                                                                      ${MAGENTA}║${NC}"
    echo -e "${MAGENTA}╚═══════════════════════════════════════════════════════════════════╝${NC}"
    echo
}

show_project_details() {
    local terminal_lines terminal_columns dialog_height dialog_width
    terminal_lines=$(tput lines 2>/dev/null || printf '24')
    terminal_columns=$(tput cols 2>/dev/null || printf '100')
    dialog_height=$((terminal_lines - 2))
    dialog_width=$((terminal_columns - 4))
    if [[ "${dialog_height}" -lt 12 ]]; then dialog_height=12; fi
    if [[ "${dialog_height}" -gt 30 ]]; then dialog_height=30; fi
    if [[ "${dialog_width}" -lt 72 ]]; then dialog_width=72; fi
    if [[ "${dialog_width}" -gt 100 ]]; then dialog_width=100; fi

    whiptail --title "V O I Z  v6 | VOIPIRAN" --msgbox \
        "    ██╗   ██╗ ██████╗ ██╗███████╗\n\
    ██║   ██║██╔═══██╗██║╚══███╔╝\n\
    ██║   ██║██║   ██║██║  ███╔╝\n\
    ╚██╗ ██╔╝██║   ██║██║ ███╔╝\n\
     ╚████╔╝ ╚██████╔╝██║███████╗\n\
      ╚═══╝   ╚═════╝ ╚═╝╚══════╝\n\
                         v6\n\n\
  Issabel enhancement installer\n\
  Simple, reliable and Persian-ready.\n\n\
  Powered by VOIPIRAN\n\
  https://voipiran.io\n\n\
  Project Manager\n\
  Hamed Kouhfallah\n\
  k.haamed@gmail.com\n\n\
  Includes Persian language, Jalali calendar,\n\
  Vitenant theme, AGI and optional PBX tools.\n\n\
  Target: Issabel ${ISSABEL_VERSION} | PHP ${PHP_MAJOR_VERSION} | Asterisk ${ASTERISK_MAJOR_VERSION}\n\
  ${OS_NAME} ${OS_VERSION} (${OS_ID})\n\n\
  Log: ${LOG_FILE}" "${dialog_height}" "${dialog_width}"
}

# ==========================================
# Main Installation Flow
# ==========================================
main() {
    # Initialize log
    > "${LOG_FILE}"
    QUIET_CONSOLE=1
    log "VOIZ Installation Log - Start: $(date)"
    log "VOIZ Root: ${VOIZ_ROOT}"
    
    # Detect system early (used throughout installation)
    detect_system
    load_mysql_password

    # Normalize module scripts before the first one runs; preflight itself
    # must also be executable when the project was transferred with CRLF.
    if command -v sed >/dev/null 2>&1; then
        printf '[....] Preparing installer scripts...\n'
        normalize_module_line_endings
    fi

    # Run pre-flight checks
    printf '\n=== VOIZ Pre-flight Checks ===\n'
    log "Running pre-flight checks..."
    if ! bash "${LIB_DIR}/00-preflight.sh"; then
        printf '\nPre-flight checks failed. Details are in %s\n' "${LOG_FILE}"
        log "ERROR: Pre-flight checks failed"
        whiptail --title "VOIZ 6 | Pre-flight Error" --msgbox \
            "Pre-flight checks failed.\n\nReview the details in:\n${LOG_FILE}" 10 72
        exit 1
    fi
    printf '=== Pre-flight Checks Passed ===\n\n'
    show_banner

    # Page 1: graphical welcome and project information
    show_project_details
    
    # Page 2: graphical feature selection
    select_features

    # Default to Persian (RTL with Jalali calendar)
    export VOIZ_LANG="Persian"
    
    # Parse selected features
    export INSTALL_PERSIAN_SOUNDS=true
    export INSTALL_JALALI_CALENDAR=true
    export INSTALL_VITENTANT_THEME=true
    export INSTALL_ISSABEL_MODULES=true
    export INSTALL_FEATURE_CODES=true
    export INSTALL_VOIPERAN_AGI=true
    export INSTALL_VOIZ_MENU=true
    export INSTALL_UPDATE_ISSABEL=false
    export INSTALL_VOIZ_MONITORING=false
    export INSTALL_CALLERID_FORMATTER=false
    export INSTALL_CHANSPY=false
    export INSTALL_CONTACT_CENTER=false
    export INSTALL_WEB_PHONE=false
    export INSTALL_ASTERNIC_STATS=false
    export INSTALL_ASTERNIC_CDR=false
    export INSTALL_VTIGER=false
    export INSTALL_JALALI_MODULE_PATCH=false
    export INSTALL_BULKDIDS=false
    export INSTALL_ISSABELCALLCENTERCE=false


    for feature in "${FEATURES[@]}"; do
        case "${feature}" in
            "UpdateIssabel") export INSTALL_UPDATE_ISSABEL=true ;;
            "IssabelCallcenterCE") export INSTALL_ISSABELCALLCENTERCE=true ;;
            "VoizMonitoring") export INSTALL_VOIZ_MONITORING=true ;;
            "CalleridFormatter") export INSTALL_CALLERID_FORMATTER=true ;;
            "Chanspy") export INSTALL_CHANSPY=true ;;
            "VOIZContactCenter") export INSTALL_CONTACT_CENTER=true ;;
            "WebPhone") export INSTALL_WEB_PHONE=true ;;
            "AsternicStats") export INSTALL_ASTERNIC_STATS=true ;;
            "AsternicCDR") export INSTALL_ASTERNIC_CDR=true ;;
            "VtigerCRM") export INSTALL_VTIGER=true ;;
            "JalaliModulePatch") export INSTALL_JALALI_MODULE_PATCH=true ;;
        esac
    done
    
    log "=== Beginning Installation ==="
    
    # Installation with progress gauge
    COUNTER=0
    INSTALL_STEP=0
    INSTALL_STATUS_LINES=""
    TOTAL_STEPS=6 # core modules installed on every run
    
    # Count steps
    [[ "${INSTALL_UPDATE_ISSABEL}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_ISSABELCALLCENTERCE}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_VOIZ_MONITORING}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_CALLERID_FORMATTER}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_CHANSPY}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_CONTACT_CENTER}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_WEB_PHONE}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_ASTERNIC_STATS}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_ASTERNIC_CDR}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_VTIGER}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    [[ "${INSTALL_JALALI_MODULE_PATCH}" == "true" ]] && TOTAL_STEPS=$((TOTAL_STEPS + 1))
    TOTAL_STEPS=$((TOTAL_STEPS + 1)) # voiz-config
    TOTAL_STEPS=$((TOTAL_STEPS + 1)) # finalize

    STEP_LABELS=(
        "Persian Sounds"
        "Jalali Calendar"
        "Vitenant Theme"
        "Issabel Modules"
        "voipiranagi (Survey AGI)"
        "VOIZ Menu"
    )
    [[ "${INSTALL_UPDATE_ISSABEL}" == "true" ]] && STEP_LABELS+=("Updating Issabel")
    [[ "${INSTALL_ISSABELCALLCENTERCE}" == "true" ]] && STEP_LABELS+=("Issabel Callcenter CE")
    [[ "${INSTALL_VOIZ_MONITORING}" == "true" ]] && STEP_LABELS+=("VOIZ Issabel Monitoring")
    [[ "${INSTALL_CALLERID_FORMATTER}" == "true" ]] && STEP_LABELS+=("Caller ID Formatter")
    [[ "${INSTALL_CHANSPY}" == "true" ]] && STEP_LABELS+=("Chanspy")
    [[ "${INSTALL_CONTACT_CENTER}" == "true" ]] && STEP_LABELS+=("VOIZ ContactCenter")
    [[ "${INSTALL_WEB_PHONE}" == "true" ]] && STEP_LABELS+=("WebPhone")
    [[ "${INSTALL_ASTERNIC_STATS}" == "true" ]] && STEP_LABELS+=("Asternic Call Stats Lite")
    [[ "${INSTALL_ASTERNIC_CDR}" == "true" ]] && STEP_LABELS+=("Asternic CDR")
    [[ "${INSTALL_VTIGER}" == "true" ]] && STEP_LABELS+=("Vtiger CRM")
    [[ "${INSTALL_JALALI_MODULE_PATCH}" == "true" ]] && STEP_LABELS+=("Jalali Module Patch")
    STEP_LABELS+=("VOIZ Configuration" "Finalize")
    STEP_STATUS=()
    
    local step_increment=0
    if [[ ${TOTAL_STEPS} -gt 0 ]]; then
        step_increment=$((100 / TOTAL_STEPS))
    fi
    
    # Show installation progress in a graphical checklist-style gauge.
    USE_GAUGE=1
    
    if [[ ${USE_GAUGE} -eq 1 ]]; then
        # Use gauge if available
        {
            gauge_msg "Starting VOIZ installation..."
            sleep 1
            
            # Core components (always installed)
            gauge_msg "Installing Persian Sounds..."
             run_module "01-persian-sounds.sh" "Persian Sounds"
         sleep 1
             sleep 1
            COUNTER=$((COUNTER + step_increment))
            
            gauge_msg "Installing Jalali Calendar..."
             run_module "02-jalali-calendar.sh" "Jalali Calendar"
         sleep 1
             sleep 1
            COUNTER=$((COUNTER + step_increment))
            
            gauge_msg "Installing Vitenant Theme..."
             run_module "03-vitenant-theme.sh" "Vitenant Theme"
         sleep 1
             sleep 1
            COUNTER=$((COUNTER + step_increment))
            
            gauge_msg "Installing Issabel Modules..."
             run_module "04-issabel-modules.sh" "Issabel Modules"
         sleep 1
             sleep 1
            COUNTER=$((COUNTER + step_increment))
            
            gauge_msg "Installing voipiranagi..."
             run_module "06-voipiranagi.sh" "voipiranagi (Survey AGI)"
         sleep 1
             sleep 1
            COUNTER=$((COUNTER + step_increment))
            
            gauge_msg "Installing VOIZ Menu..."
             run_module "07-voiz-menu.sh" "VOIZ Menu"
         sleep 1
             sleep 1
            COUNTER=$((COUNTER + step_increment))
            

            
             if [[ "${INSTALL_UPDATE_ISSABEL}" == "true" ]]; then
                 gauge_msg "Updating Issabel..."
                 installation_step_start "Updating Issabel"
                 if update_issabel >> "${LOG_FILE}" 2>&1; then
                     installation_step_done
                 else
                     installation_step_warning
                 fi
                 COUNTER=$((COUNTER + step_increment))
             fi
             # Optional modules (installed based on user selection)
            if [[ "${INSTALL_VOIZ_MONITORING}" == "true" ]]; then
                gauge_msg "Installing VOIZ Issabel Monitoring..."
                 run_module_non_blocking "16-voiz-issabel-monitoring.sh" "VOIZ Issabel Monitoring"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi
            
            if [[ "${INSTALL_CALLERID_FORMATTER}" == "true" ]]; then
                gauge_msg "Installing Caller ID Formatter..."
                 run_module_non_blocking "17-voiz-callerid-formatter.sh" "Caller ID Formatter"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi
            
            if [[ "${INSTALL_CHANSPY}" == "true" ]]; then
                gauge_msg "Installing Chanspy..."
                 run_module_non_blocking "18-voiz-chanspy.sh" "Chanspy"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi
            
            if [[ "${INSTALL_CONTACT_CENTER}" == "true" ]]; then
                gauge_msg "Installing VOIZ ContactCenter..."
                installation_step_start "Installing VOIZ ContactCenter"
                if install_contact_center; then
                    installation_step_done
                else
                    installation_step_failed
                fi
                COUNTER=$((COUNTER + step_increment))
                sleep 1
            fi
            
            if [[ "${INSTALL_WEB_PHONE}" == "true" ]]; then
                gauge_msg "Installing WebPhone..."
                 run_module_non_blocking "14-webphone.sh" "WebPhone"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi
            
            if [[ "${INSTALL_ASTERNIC_STATS}" == "true" ]]; then
                gauge_msg "Installing Asternic Call Stats Lite..."
                 run_module_non_blocking "15-asternic-stats.sh" "Asternic Call Stats Lite"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi

            if [[ "${INSTALL_ASTERNIC_CDR}" == "true" ]]; then
                gauge_msg "Installing Asternic CDR..."
                 run_module_non_blocking "10-asternic-cdr.sh" "Asternic CDR"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi

            if [[ "${INSTALL_VTIGER}" == "true" ]]; then
                gauge_msg "Installing Vtiger CRM..."
                 run_module_non_blocking "11-vtiger-crm.sh" "Vtiger CRM"
             sleep 1
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi

            if [[ "${INSTALL_JALALI_MODULE_PATCH}" == "true" ]]; then
                gauge_msg "Applying Jalali Calendar to Modules..."
                 run_module_non_blocking "20-jalali-module-patch.sh" "Jalali Module Patch"
                 sleep 1
                COUNTER=$((COUNTER + step_increment))
            fi


            
               if [[ "${INSTALL_ISSABELCALLCENTERCE}" == "true" ]]; then
                   gauge_msg "Installing Issabel Callcenter CE..."
                   installation_step_start "Installing Issabel Callcenter CE"
                   if curl -fsSL https://raw.githubusercontent.com/voipiran/callcenter-issabel5/master/install-voipiran.sh?nocache=$(date +%s) | bash >> "${LOG_FILE}" 2>&1; then
                       installation_step_done
                   else
                       installation_step_warning
                   fi
                   COUNTER=$((COUNTER + step_increment))
                   sleep 1
              fi
              # VOIZ Config (always)
             gauge_msg "Installing VOIZ Configuration..."
             run_module "09-voiz-config.sh" "VOIZ Configuration"
             COUNTER=$((COUNTER + step_increment))
             sleep 1
             # Finalize (always)
             gauge_msg "Finalizing installation..."
             run_module "99-finalize.sh" "Finalize"
             COUNTER=100
             sleep 1
        }
    else
        # Fallback: simple console output
        log "Installing VOIZ (console mode)..."
        
        # Core components (always installed)
        log "Installing Persian Sounds..."
        run_module "01-persian-sounds.sh" "Persian Sounds"
        
        log "Installing Jalali Calendar..."
        run_module "02-jalali-calendar.sh" "Jalali Calendar"
        
        log "Installing Vitenant Theme..."
        run_module "03-vitenant-theme.sh" "Vitenant Theme"
        
        log "Installing Issabel Modules..."
        run_module "04-issabel-modules.sh" "Issabel Modules"
        
        log "Installing voipiranagi..."
        run_module "06-voipiranagi.sh" "voipiranagi (Survey AGI)"
        
        log "Installing VOIZ Menu..."
        run_module "07-voiz-menu.sh" "VOIZ Menu"
        
        # Update Issabel (if selected)
         if [[ "${INSTALL_UPDATE_ISSABEL}" == "true" ]]; then
             installation_step_start "Updating Issabel"
             if update_issabel >> "${LOG_FILE}" 2>&1; then
                 installation_step_done
             else
                 installation_step_warning
             fi
             sleep 1
         fi
        
        # Optional modules (installed based on user selection)
        if [[ "${INSTALL_VOIZ_MONITORING}" == "true" ]]; then
            log "Installing VOIZ Issabel Monitoring..."
            run_module_non_blocking "16-voiz-issabel-monitoring.sh" "VOIZ Issabel Monitoring"
        fi
        
        if [[ "${INSTALL_CALLERID_FORMATTER}" == "true" ]]; then
            log "Installing Caller ID Formatter..."
            run_module_non_blocking "17-voiz-callerid-formatter.sh" "Caller ID Formatter"
        fi
        
        if [[ "${INSTALL_CHANSPY}" == "true" ]]; then
            log "Installing Chanspy..."
            run_module_non_blocking "18-voiz-chanspy.sh" "Chanspy"
        fi
        
        if [[ "${INSTALL_CONTACT_CENTER}" == "true" ]]; then
            log "Installing VOIZ ContactCenter..."
            installation_step_start "Installing VOIZ ContactCenter"
            if install_contact_center; then
                installation_step_done
            else
                installation_step_failed
            fi
        fi
        
        if [[ "${INSTALL_WEB_PHONE}" == "true" ]]; then
            log "Installing WebPhone..."
            run_module_non_blocking "14-webphone.sh" "WebPhone"
        fi
        
        if [[ "${INSTALL_ASTERNIC_STATS}" == "true" ]]; then
            log "Installing Asternic Call Stats Lite..."
            run_module_non_blocking "15-asternic-stats.sh" "Asternic Call Stats Lite"
        fi
        
        if [[ "${INSTALL_ASTERNIC_CDR}" == "true" ]]; then
            log "Installing Asternic CDR..."
            run_module_non_blocking "10-asternic-cdr.sh" "Asternic CDR"
        fi
        
        if [[ "${INSTALL_VTIGER}" == "true" ]]; then
            log "Installing Vtiger CRM..."
            run_module_non_blocking "11-vtiger-crm.sh" "Vtiger CRM"
        fi
        
         if [[ "${INSTALL_JALALI_MODULE_PATCH}" == "true" ]]; then
             log "Applying Jalali Calendar to Modules..."
              run_module_non_blocking "20-jalali-module-patch.sh" "Jalali Module Patch"
          fi
          sleep 1
        if [[ "${INSTALL_ISSABELCALLCENTERCE}" == "true" ]]; then
              log "Installing Issabel Callcenter CE..."
              installation_step_start "Installing Issabel Callcenter CE"
              if curl -fsSL https://raw.githubusercontent.com/voipiran/callcenter-issabel5/master/install-voipiran.sh?nocache=$(date +%s) | bash >> "${LOG_FILE}" 2>&1; then
                  installation_step_done
              else
                  installation_step_warning
              fi
              sleep 1
          fi


         
         # VOIZ Config (always)
         log "Installing VOIZ Configuration..."
         run_module "09-voiz-config.sh" "VOIZ Configuration"
         sleep 1
         # Finalize (always)
         log "Finalizing installation..."
         run_module "99-finalize.sh" "Finalize"
         sleep 1
    fi

    printf '\033[2J\033[H'
    printf '\033[1;32mInstallation completed.\033[0m\n'
    printf 'Log file: %s\n' "${LOG_FILE}"
    if grep -q 'RESULT: \[WARN\]\|RESULT: \[FAIL\]' "${LOG_FILE}" 2>/dev/null; then
        printf '\033[1;33mWarnings or failures were recorded. Review the log above.\033[0m\n'
    else
        printf '\033[1;32mAll installation steps completed successfully.\033[0m\n'
    fi

}

# ==========================================
# Entry Point
# ==========================================
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi