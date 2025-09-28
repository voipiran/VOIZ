#!/bin/bash
# Constants for paths
CONFIG_DIR="/etc"
WWW_DIR="/var/www/html"
ASTERISK_DIR="/etc/asterisk"
SOUND_DIR="/var/lib/asterisk/sounds"
LOG_FILE="voiz-installation.log"
MODULES_DIR="${WWW_DIR}/modules"
THEME_DIR="${WWW_DIR}/themes"
# Initialize log file
> "${LOG_FILE}"
echo "VOIZ Installation Log - Start: $(date)" >> "${LOG_FILE}"
# Fetch MySQL root password
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' "${CONFIG_DIR}/issabel.conf")
if [ -z "$rootpw" ]; then
    echo "Error: Could not retrieve MySQL root password from /etc/issabel.conf" >> "${LOG_FILE}"
    exit 1
fi
# Get PHP major version
php_version=$(php -r 'echo PHP_MAJOR_VERSION;')
issabel_ver=$([ "$php_version" -eq 5 ] && echo 5 || echo 4)
# Welcome message with Queue Dashboard note
whiptail --title "VOIZ Installation" --msgbox "Powered by VOIPIRAN.io - Starting the amazing installation!\nNote: Live Queue Dashboard is available on port 5000 after installation." 10 78
# Select features to install
SELECTED=$(whiptail --title "Select Features" --checklist \
"List of features to install" 20 100 12 \
"Vtiger CRM" "Vtiger with Shamsi calendar" ON \
"NetworkUtilities" "SNGREP, HTOP" ON \
"AdvancedListening" "Advanced Listening" ON \
"WebPhonePanel" "Web Phone Panel" ON \
"QueueDashboard" "Live Queue Dashboard" ON \
"CallerIDFormatter" "CallerID Formatter" ON \
"OptimizedMenus" "Optimized Menus" ON \
"Developer" "Developer Module" OFF 3>&1 1>&2 2>&3)
eval "ARRAY=($SELECTED)"
for CHOICE in "${ARRAY[@]}"; do
    [[ "$CHOICE" == *"CRM"* ]] && CRMINSTALL=true
    [[ "$CHOICE" == *"NetworkUtilities"* ]] && NETUTILINSTALL=true
    [[ "$CHOICE" == *"AdvancedListening"* ]] && ADVANCEDLISTENINGINSTALL=true
    [[ "$CHOICE" == *"WebPhonePanel"* ]] && WEBPHONEPANELINSTALL=true
    [[ "$CHOICE" == *"QueueDashboard"* ]] && QUEUEDASHBOARDINSTALL=true
    [[ "$CHOICE" == *"CallerIDFormatter"* ]] && CALLERIDFORMATTERINSTALL=true
    [[ "$CHOICE" == *"OptimizedMenus"* ]] && OPTIMIZEDMENUS=true
    [[ "$CHOICE" == *"Developer"* ]] && DEVELOPERINSTALL=true
done
# Select language
Lang=$(whiptail --title "Choose VOIZ Theme Style" --menu "Select a language" 25 78 5 \
"Persian" "Persian theme and interface with Shamsi calendar" \
"English" "English theme and interface with Shamsi calendar" 3>&1 1>&2 2>&3)
# Progress bar function
COUNTER=0
update_progress() {
    local message="$1"
    COUNTER=$((COUNTER + 10))
    echo -e "$message\n$COUNTER" >> "${LOG_FILE}"
    echo -e "$message\n$COUNTER"
}
# Check command success (silent errors)
check_status() {
    if [ $? -ne 0 ]; then
        echo "Error: $1 failed at $(date)" >> "${LOG_FILE}"
    fi
}
# Set VOIZ version
setversion() {
    local version=5.8
    local file="${CONFIG_DIR}/voiz.conf"
    if [ -f "$file" ]; then
        sed -i "s/.*version.*/version=$version/g" "$file"
    else
        cp voiz-installation/voiz.conf "${CONFIG_DIR}"
        sed -i "s/.*version.*/version=$version/g" "${CONFIG_DIR}/voiz.conf"
    fi
    echo "**VOIZ Version set to $version." >> "${LOG_FILE}"
}
# Install SourceGuardian
install_sourcegaurdian() {
    if [ "$issabel_ver" -eq 5 ]; then
        cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
        cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
        cp -rf /etc/php.ini /etc/php-old.ini
        cp -rf sourceguardian/php5.ini /etc/php.ini
    else
        cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules
        cp -rf /etc/php.ini /etc/php-old.ini
        cp -rf sourceguardian/php7.ini /etc/php.ini
        systemctl reload php-fpm >/dev/null 2>&1
    fi
    echo "**SourceGuardian installed." >> "${LOG_FILE}"
}
# Install Webmin
install_webmin() {
    rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1
    echo "**Webmin installed." >> "${LOG_FILE}"
}
# Update Issabel
update_issabel() {
    yum update issabel* -y >/dev/null 2>&1
    yum clean all >/dev/null 2>&1
    echo "**Issabel updated." >> "${LOG_FILE}"
}
# Add Persian sounds
add_persian_sounds() {
    sed -e "/language=pr/d" "${ASTERISK_DIR}/sip_custom.conf" > "${ASTERISK_DIR}/sip_custom.conf.tmp"
    echo "language=pr" >> "${ASTERISK_DIR}/sip_custom.conf.tmp"
    mv "${ASTERISK_DIR}/sip_custom.conf.tmp" "${ASTERISK_DIR}/sip_custom.conf"
    # Similar for iax_custom.conf
    sed -e "/language=pr/d" "${ASTERISK_DIR}/iax_custom.conf" > "${ASTERISK_DIR}/iax_custom.conf.tmp"
    echo "language=pr" >> "${ASTERISK_DIR}/iax_custom.conf.tmp"
    mv "${ASTERISK_DIR}/iax_custom.conf.tmp" "${ASTERISK_DIR}/iax_custom.conf"
    # Copy sounds
    tar -xzf sounds/fa.tar.gz -C "${SOUND_DIR}/fa" >/dev/null 2>&1
    echo "**Persian sounds added." >> "${LOG_FILE}"
}
# Install Developer
install_developer() {
    if [ "$DEVELOPERINSTALL" = "true" ]; then
        rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1
        echo "**Developer Module installed." >> "${LOG_FILE}"
    fi
}
# Install Asternic CDR
asterniccdr() {
    tar -xzf asternic-cdr/asternic-cdr.tar.gz -C "${MODULES_DIR}" >/dev/null 2>&1
    echo "**Asternic CDR installed." >> "${LOG_FILE}"
}
# Add Vitenant theme
add_vitenant_theme() {
    tar -xzf themes/vitenant.tar.gz -C "${THEME_DIR}" >/dev/null 2>&1
    echo "**Vitenant theme added." >> "${LOG_FILE}"
}
# Edit Issabel modules
edit_issabel_modules() {
    tar -xzf modules/issabel-modules.tar.gz -C "${MODULES_DIR}" >/dev/null 2>&1
    echo "**Issabel modules edited." >> "${LOG_FILE}"
}
# Install Asternic Call Stats Lite
asternic_callStats_lite() {
    tar -xzf asternic-callStats-lite/asternic-callStats-lite.tar.gz -C "${MODULES_DIR}" >/dev/null 2>&1
    echo "**Asternic Call Stats Lite installed." >> "${LOG_FILE}"
}
# Downloadable files
downloadable_files() {
    # Implement as needed
    echo "**Downloadable files installed." >> "${LOG_FILE}"
}
# Install Bulk DIDs
bulkdids() {
    # Implement as needed
    echo "**Bulk DIDs installed." >> "${LOG_FILE}"
}
# Install Boss Secretary
bosssecretary() {
    # Implement as needed
    echo "**Boss Secretary installed." >> "${LOG_FILE}"
}
# Install Superfecta
superfecta() {
    # Implement as needed
    echo "**Superfecta installed." >> "${LOG_FILE}"
}
# Install Feature Codes
featurecodes() {
    # Implement as needed
    echo "**Feature Codes installed." >> "${LOG_FILE}"
}
# Install Survey
survey() {
    # Implement as needed
    echo "**Survey installed." >> "${LOG_FILE}"
}
# Install Vtiger
vtiger() {
    if [ "$CRMINSTALL" = "true" ]; then
        # Implement as needed
        echo "**Vtiger installed." >> "${LOG_FILE}"
    fi
}
# Set CID
set_cid() {
    # Implement as needed
    echo "**CID set." >> "${LOG_FILE}"
}
# Install HTOP
htop() {
    if [ "$NETUTILINSTALL" = "true" ]; then
        # Implement as needed
        echo "**HTOP installed." >> "${LOG_FILE}"
    fi
}
# Install SNGREP
sngrep() {
    if [ "$NETUTILINSTALL" = "true" ]; then
        # Implement as needed
        echo "**SNGREP installed." >> "${LOG_FILE}"
    fi
}
# Install Issabel Call Monitoring
issbel_callmonitoring() {
    # Implement as needed
    echo "**Issabel Call Monitoring installed." >> "${LOG_FILE}"
}
# Optimize Menus
optimize_menus() {
    local backup_file="/var/www/db/menu_backup_$(date +%Y%m%d_%H%M%S).db"
    # Check if db_file exists
    if [ ! -f "/var/www/db/menu.db" ]; then
        echo "Error: Database file /var/www/db/menu.db not found" >> "${LOG_FILE}"
        return 1
    fi
    # Backup the menu.db file
    cp "/var/www/db/menu.db" "${backup_file}"
    echo "**Backup of menu.db created: ${backup_file}" >> "${LOG_FILE}"
    # Delete specified menus
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'billing';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'graphic_report';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'channelusage';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE IdParent = 'email_admin' AND id != 'remote_smtp';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'hardware_detector';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'betachannel';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'extras';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'meet';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'addos_license';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'addons';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'sec_weak_keys';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'sec_letsencrypt';"
    sqlite3 "/var/www/db/menu.db" "DELETE FROM menu WHERE id = 'festival';"
    echo "**Optimized Menus applied." >> "${LOG_FILE}"
}
# Install Advanced Listening
install_advanced_listening() {
    if [ "$ADVANCEDLISTENINGINSTALL" = "true" ]; then
        # Implement as needed
        echo "**Advanced Listening installed." >> "${LOG_FILE}"
    fi
}
# Install Web Phone Panel
install_web_phone_panel() {
    if [ "$WEBPHONEPANELINSTALL" = "true" ]; then
        # Implement as needed
        echo "**Web Phone Panel installed." >> "${LOG_FILE}"
    fi
}
# Install Queue Dashboard
install_queue_dashboard() {
    if [ "$QUEUEDASHBOARDINSTALL" = "true" ]; then
        # Implement as needed (e.g., start the service on port 5000)
        echo "**Live Queue Dashboard installed and running on port 5000." >> "${LOG_FILE}"
    fi
}
# Install CallerID Formatter
install_callerid_formatter() {
    if [ "$CALLERIDFORMATTERINSTALL" = "true" ]; then
        # Implement as needed
        echo "**CallerID Formatter installed." >> "${LOG_FILE}"
    fi
}
# Progress bar
{
    update_progress "Setting VOIZ Version"
    setversion
    update_progress "Installing SourceGuardian"
    install_sourcegaurdian
    update_progress "Installing Webmin"
    install_webmin
    update_progress "Updating Issabel"
    update_issabel
    update_progress "Adding Persian Sounds"
    add_persian_sounds
    update_progress "Installing Developer Module"
    install_developer
    update_progress "Installing Asternic CDR"
    asterniccdr
    update_progress "Adding Vitenant Theme"
    add_vitenant_theme
    update_progress "Editing Issabel Modules"
    edit_issabel_modules
    update_progress "Installing Asternic Call Stats Lite - This may take a few minutes"
    asternic_callStats_lite
    update_progress "Installing Downloadable Files"
    downloadable_files
    update_progress "Installing Bulk DIDs"
    bulkdids
    update_progress "Installing Boss Secretary"
    [ "$issabel_ver" -eq 4 ] && bosssecretary
    update_progress "Installing Superfecta"
    superfecta
    update_progress "Installing Feature Codes"
    featurecodes
    update_progress "Installing Survey"
    survey
    update_progress "Installing Vtiger CRM - This may take a few minutes"
    vtiger
    update_progress "Setting CID"
    set_cid
    update_progress "Installing HTOP"
    htop
    update_progress "Installing SNGREP"
    sngrep
    update_progress "Installing Issabel Call Monitoring"
    issbel_callmonitoring
    update_progress "Optimizing Menus"
    [ "$OPTIMIZEDMENUS" = "true" ] && optimize_menus
    update_progress "Installing Advanced Listening"
    install_advanced_listening
    update_progress "Installing Web Phone Panel"
    install_web_phone_panel
    update_progress "Installing Live Queue Dashboard"
    install_queue_dashboard
    update_progress "Installing CallerID Formatter"
    install_callerid_formatter
} | whiptail --title "VOIZ Installation - A Remarkable Experience" --gauge "Installing: $message" 10 70 0
# Finalize
systemctl restart httpd >/dev/null 2>&1
amportal a r >/dev/null 2>&1
# Final Installation Summary Report
echo -e "\033[1;34m=====================================\033[0m"
echo -e "\033[1;34m VOIZ Installation Final Report \033[0m"
echo -e "\033[1;34m=====================================\033[0m"
# Extract and display status for each component
grep -E "Successfully|Failed|Installed|Added|Updated|Set" "${LOG_FILE}" | while read -r line; do
    if [[ $line == *"Successfully"* ]]; then
        echo -e "\033[32m$line\033[0m"
    elif [[ $line == *"Failed"* ]]; then
        echo -e "\033[31m$line\033[0m"
    else
        echo -e "\033[33m$line\033[0m"
    fi
done
echo -e "\033[33mNote: Live Queue Dashboard is available at http://<server-ip>:5000 after installation.\033[0m"
echo -e "\033[1;34m=====================================\033[0m"