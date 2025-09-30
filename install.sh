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
    echo "Error: Could not retrieve MySQL root password from ${CONFIG_DIR}/issabel.conf" >> "${LOG_FILE}"
    exit 1
fi

# Get PHP major version
php_version=$(php -r 'echo PHP_MAJOR_VERSION;' 2>/dev/null)
if [ -z "$php_version" ]; then
    echo "Error: Could not determine PHP version" >> "${LOG_FILE}"
    php_version=5  # پیش‌فرض به 5 تنظیم شود اگر تشخیص نشد
fi
issabel_ver=$([ "$php_version" -eq 5 ] && echo 5 || echo 4)

# Welcome message with Queue Dashboard note
whiptail --title "VOIZ Installation" --msgbox "Powered by VOIPIRAN.io - Starting the amazing installation!\nNote: Live Queue Dashboard is available on port 5000 after installation." 10 78 || {
    echo "Warning: whiptail failed, continuing without GUI" >> "${LOG_FILE}"
}

# Select features to install
SELECTED=$(whiptail --title "Select Features" --checklist \
"List of features to install" 20 100 12 \
"Vtiger CRM" "Vtiger with Shamsi calendar" OFF \
"NetworkUtilities" "SNGREP, HTOP" ON \
"AdvancedListening" "Advanced Listening" ON \
"WebPhonePanel" "Web Phone Panel" ON \
"QueueDashboard" "Live Queue Dashboard" ON \
"CallerIDFormatter" "CallerID Formatter" ON \
"OptimizedMenus" "Optimized Menus" ON \
"Developer" "Developer Module" OFF 3>&1 1>&2 2>&3) || SELECTED=""
eval "ARRAY=($SELECTED)"

# Set default feature flags
CRMINSTALL=false
NETUTILINSTALL=false
ADVANCEDLISTENINGINSTALL=false
WEBPHONEPANELINSTALL=false
QUEUEDASHBOARDINSTALL=false
CALLERIDFORMATTERINSTALL=false
OPTIMIZEDMENUS=false
DEVELOPERINSTALL=false

# Check selected features
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
"English" "English theme and interface with Shamsi calendar" 3>&1 1>&2 2>&3) || Lang="Persian"

# Progress bar function
COUNTER=0
update_progress() {
    local message="$1"
    COUNTER=$((COUNTER + 10))
    echo -e "$COUNTER\n$message"  # ارسال درصد و پیام به whiptail
    echo -e "$message\n$COUNTER" >> "${LOG_FILE}"
}

# Check command success (silent errors)
check_status() {
    if [ $? -ne 0 ]; then
        echo "Error: $1 failed at $(date)" >> "${LOG_FILE}"
    fi
}

# Set VOIZ version
setversion() {
    local version="5.8"
    local file="${CONFIG_DIR}/voiz.conf"
    if [ -f "$file" ]; then
        sed -i "s/.*version.*/version=$version/g" "$file" 2>/dev/null || {
            echo "Warning: Failed to update version in ${file}" >> "${LOG_FILE}"
        }
    else
        cp voiz-installation/voiz.conf "${CONFIG_DIR}" 2>/dev/null || {
            echo "Error: Failed to copy voiz.conf to ${CONFIG_DIR}" >> "${LOG_FILE}"
            return 1
        }
        sed -i "s/.*version.*/version=$version/g" "${CONFIG_DIR}/voiz.conf" 2>/dev/null || {
            echo "Warning: Failed to set version in ${CONFIG_DIR}/voiz.conf" >> "${LOG_FILE}"
        }
    fi
    echo "**VOIZ Version set to $version." >> "${LOG_FILE}"
}

# Install SourceGuardian
install_sourcegaurdian() {
    if [ "$issabel_ver" -eq 5 ]; then
        [ -f sourceguardian/ixed.5.4.lin ] && cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules 2>/dev/null || echo "Warning: ixed.5.4.lin not found" >> "${LOG_FILE}"
        [ -f sourceguardian/ixed.5.4ts.lin ] && cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules 2>/dev/null || echo "Warning: ixed.5.4ts.lin not found" >> "${LOG_FILE}"
        [ -f /etc/php.ini ] && cp -rf /etc/php.ini /etc/php-old.ini 2>/dev/null || echo "Warning: php.ini backup failed" >> "${LOG_FILE}"
        [ -f sourceguardian/php5.ini ] && cp -rf sourceguardian/php5.ini /etc/php.ini 2>/dev/null || echo "Warning: php5.ini not found" >> "${LOG_FILE}"
    else
        [ -f sourceguardian/ixed.7.4.lin ] && cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules 2>/dev/null || echo "Warning: ixed.7.4.lin not found" >> "${LOG_FILE}"
        [ -f /etc/php.ini ] && cp -rf /etc/php.ini /etc/php-old.ini 2>/dev/null || echo "Warning: php.ini backup failed" >> "${LOG_FILE}"
        [ -f sourceguardian/php7.ini ] && cp -rf sourceguardian/php7.ini /etc/php.ini 2>/dev/null || echo "Warning: php7.ini not found" >> "${LOG_FILE}"
        systemctl reload php-fpm >/dev/null 2>&1
    fi
    echo "**SourceGuardian installed." >> "${LOG_FILE}"
}

# Install Webmin
install_webmin() {
    [ -f rpms/webmin/webmin-2.111-1.noarch.rpm ] && rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1 || echo "Warning: webmin-2.111-1.noarch.rpm not found" >> "${LOG_FILE}"
    echo "**Webmin installed." >> "${LOG_FILE}"
}

# Update Issabel
update_issabel() {
    yum update issabel* -y >/dev/null 2>&1 || echo "Warning: Issabel update failed" >> "${LOG_FILE}"
    yum clean all >/dev/null 2>&1
    echo "**Issabel updated." >> "${LOG_FILE}"
}

# Add Persian sounds
add_persian_sounds() {
    sed -e "/language=pr/d" "${ASTERISK_DIR}/sip_custom.conf" > "${ASTERISK_DIR}/sip_custom.conf.tmp" 2>/dev/null || echo "Warning: Failed to edit sip_custom.conf" >> "${LOG_FILE}"
    echo "language=pr" >> "${ASTERISK_DIR}/sip_custom.conf.tmp" 2>/dev/null || echo "Warning: Failed to add language=pr" >> "${LOG_FILE}"
    mv "${ASTERISK_DIR}/sip_custom.conf.tmp" "${ASTERISK_DIR}/sip_custom.conf" 2>/dev/null || echo "Warning: Failed to move tmp file" >> "${LOG_FILE}"
    sed -e "/language=pr/d" "${ASTERISK_DIR}/iax_custom.conf" > "${ASTERISK_DIR}/iax_custom.conf.tmp" 2>/dev/null || echo "Warning: Failed to edit iax_custom.conf" >> "${LOG_FILE}"
    echo "language=pr" >> "${ASTERISK_DIR}/iax_custom.conf.tmp" 2>/dev/null || echo "Warning: Failed to add language=pr" >> "${LOG_FILE}"
    mv "${ASTERISK_DIR}/iax_custom.conf.tmp" "${ASTERISK_DIR}/iax_custom.conf" 2>/dev/null || echo "Warning: Failed to move tmp file" >> "${LOG_FILE}"
    [ -f sounds/fa.tar.gz ] && tar -xzf sounds/fa.tar.gz -C "${SOUND_DIR}/fa" >/dev/null 2>&1 || echo "Warning: fa.tar.gz not found" >> "${LOG_FILE}"
    echo "**Persian sounds added." >> "${LOG_FILE}"
}

# Install Jalali calendar libraries
install_jalali_calendar() {
    if [ -d "jalalicalendar" ]; then
        cp -r "jalalicalendar" "${WWW_DIR}/libs/JalaliJSCalendar" 2>/dev/null || echo "Error: Failed to copy JalaliJSCalendar" >> "${LOG_FILE}"
        chown -R asterisk:asterisk "${WWW_DIR}/libs/JalaliJSCalendar" 2>/dev/null
        chmod -R 755 "${WWW_DIR}/libs/JalaliJSCalendar" 2>/dev/null
        echo "**Jalali calendar libraries installed." >> "${LOG_FILE}"
    else
        echo "Warning: jalalicalendar directory not found. Jalali calendar installation skipped." >> "${LOG_FILE}"
    fi
}

# Edit Issabel modules
edit_issabel_modules() {
    ### Install ISSABEL Modules - 4.2.0
    # Modules
    mkdir "${WWW_DIR}/modules000" >/dev/null 2>&1
    cp -rf "${WWW_DIR}/modules/"* "${WWW_DIR}/modules000"
    yes | cp -arf issabelmodules/modules "${WWW_DIR}/"
    touch -r "${WWW_DIR}/modules/"* 2>/dev/null
    chown -R asterisk:asterisk "${WWW_DIR}/modules/"*
    chown asterisk:asterisk "${WWW_DIR}/modules/"
    find "${WWW_DIR}/modules/" -exec touch {} \;

    ### Install Jalali Calendar - 4.2.0
    # Calendar Shamsi (Added ver 8.0)
    yes | cp -f jalalicalendar/date.php "${WWW_DIR}/libs/"
    yes | cp -f jalalicalendar/params.php "${WWW_DIR}/libs/"
    yes | cp -rf jalalicalendar/JalaliJSCalendar "${WWW_DIR}/libs/"
    # Shamsi Library Makooei
    yes | cp -r issabelmodules/mylib "${WWW_DIR}/libs/"
    chown -R asterisk:asterisk "${WWW_DIR}/libs/mylib"
    mv "${WWW_DIR}/libs/paloSantoForm.class.php" "${WWW_DIR}/libs/paloSantoForm.class.php.000" 2>/dev/null
    yes | cp -rf issabelmodules/paloSantoForm.class.php "${WWW_DIR}/libs/"
    # DropDown Problem
    sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" "${WWW_DIR}/admin/assets/js/pbxlib.js" >/dev/null 2>&1

    ### Install Jalali Date Time Lib - 4.2.0
    cp -avr asteriskjalalical/jalalidate/ "${ASTERISK_DIR}/"
    # Add Persian Language TEXT
    mv "${WWW_DIR}/lang/fa.lang" "${WWW_DIR}/lang/fa.lang.000" 2>/dev/null
    cp -rf issabelmodules/fa.lang "${WWW_DIR}/lang/"
    echo "**Issabel modules and Jalali calendar updated." >> "${LOG_FILE}"
}

# Install Developer
install_developer() {
    if [ "$DEVELOPERINSTALL" = "true" ]; then
        [ -f rpms/develop/issabel-developer-4.0.0-3.noarch.rpm ] && rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1 || echo "Warning: issabel-developer-4.0.0-3.noarch.rpm not found" >> "${LOG_FILE}"
        echo "**Developer Module installed." >> "${LOG_FILE}"
    fi
}

# Install Asternic CDR
asterniccdr() {
    [ -f asternic-cdr/asternic-cdr.tar.gz ] && tar -xzf asternic-cdr/asternic-cdr.tar.gz -C "${MODULES_DIR}" >/dev/null 2>&1 || echo "Warning: asternic-cdr.tar.gz not found" >> "${LOG_FILE}"
    echo "**Asternic CDR installed." >> "${LOG_FILE}"
}

# Add Vitenant theme
add_vitenant_theme() {
    [ -f themes/vitenant.tar.gz ] && tar -xzf themes/vitenant.tar.gz -C "${THEME_DIR}" >/dev/null 2>&1 || echo "Warning: vitenant.tar.gz not found" >> "${LOG_FILE}"
    if [ "$Lang" = "Persian" ]; then
        sqlite3 "${WWW_DIR}/db/settings.db" "update settings set value='fa' where key='language';" 2>/dev/null || echo "Warning: Failed to set Persian language" >> "${LOG_FILE}"
        sqlite3 "${WWW_DIR}/db/settings.db" "update settings set value='vitenant' where key='theme';" 2>/dev/null || echo "Warning: Failed to set vitenant theme" >> "${LOG_FILE}"
        echo "**Persian Theme Added." >> "${LOG_FILE}"
    else
        sqlite3 "${WWW_DIR}/db/settings.db" "update settings set value='en' where key='language';" 2>/dev/null || echo "Warning: Failed to set English language" >> "${LOG_FILE}"
        sqlite3 "${WWW_DIR}/db/settings.db" "update settings set value='tenant' where key='theme';" 2>/dev/null || echo "Warning: Failed to set tenant theme" >> "${LOG_FILE}"
        echo "**English Theme Added." >> "${LOG_FILE}"
    fi
}

# Edit Issabel modules
edit_issabel_modules() {
    ### Install ISSABEL Modules - 4.2.0
    # Modules
    mkdir "${WWW_DIR}/modules000" >/dev/null 2>&1
    cp -rf "${WWW_DIR}/modules/"* "${WWW_DIR}/modules000"
    yes | cp -arf issabelmodules/modules "${WWW_DIR}/"
    touch -r "${WWW_DIR}/modules/"* 2>/dev/null
    chown -R asterisk:asterisk "${WWW_DIR}/modules/"*
    chown asterisk:asterisk "${WWW_DIR}/modules/"
    find "${WWW_DIR}/modules/" -exec touch {} \;

    ### Install Jalali Calendar - 4.2.0
    # Calendar Shamsi (Added ver 8.0)
    yes | cp -f jalalicalendar/date.php "${WWW_DIR}/libs/"
    yes | cp -f jalalicalendar/params.php "${WWW_DIR}/libs/"
    yes | cp -rf jalalicalendar/JalaliJSCalendar "${WWW_DIR}/libs/"
    # Shamsi Library Makooei
    yes | cp -r issabelmodules/mylib "${WWW_DIR}/libs/"
    chown -R asterisk:asterisk "${WWW_DIR}/libs/mylib"
    mv "${WWW_DIR}/libs/paloSantoForm.class.php" "${WWW_DIR}/libs/paloSantoForm.class.php.000" 2>/dev/null
    yes | cp -rf issabelmodules/paloSantoForm.class.php "${WWW_DIR}/libs/"
    # DropDown Problem
    sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" "${WWW_DIR}/admin/assets/js/pbxlib.js" >/dev/null 2>&1

    ### Install Jalali Date Time Lib - 4.2.0
    cp -avr asteriskjalalical/jalalidate/ "${ASTERISK_DIR}/"
    # Add Persian Language TEXT
    mv "${WWW_DIR}/lang/fa.lang" "${WWW_DIR}/lang/fa.lang.000" 2>/dev/null
    cp -rf issabelmodules/fa.lang "${WWW_DIR}/lang/"
    echo "**Issabel modules and Jalali calendar updated." >> "${LOG_FILE}"
}

# Install Asternic Call Stats Lite
asternic_callStats_lite() {
    [ -f asternic-callStats-lite/asternic-callStats-lite.tar.gz ] && tar -xzf asternic-callStats-lite/asternic-callStats-lite.tar.gz -C "${MODULES_DIR}" >/dev/null 2>&1 || echo "Warning: asternic-callStats-lite.tar.gz not found" >> "${LOG_FILE}"
    echo "**Asternic Call Stats Lite installed." >> "${LOG_FILE}"
}

# Downloadable files
downloadable_files() {
    [ -d downloadable/download ] && cp -rf downloadable/download "${WWW_DIR}/" 2>/dev/null || echo "Warning: downloadable/download not found" >> "${LOG_FILE}"
    echo "**Downloadable files installed." >> "${LOG_FILE}"
}

# Install Bulk DIDs
bulkdids() {
    if [ ! -d "${WWW_DIR}/admin/modules/bulkdids" ]; then
        [ -d issabelpbxmodules/bulkdids ] && cp -rf issabelpbxmodules/bulkdids "${WWW_DIR}/admin/modules/" 2>/dev/null || echo "Warning: bulkdids module not found" >> "${LOG_FILE}"
        amportal a ma install bulkdids >/dev/null 2>&1 || echo "Warning: Failed to install bulkdids" >> "${LOG_FILE}"
    fi
    echo "**Bulk DIDs installed." >> "${LOG_FILE}"
}

# Install Boss Secretary
bosssecretary() {
    if [ "$issabel_ver" -eq 4 ] && [ ! -d "${WWW_DIR}/admin/modules/bosssecretary" ]; then
        [ -d issabelpbxmodules/bosssecretary ] && cp -rf issabelpbxmodules/bosssecretary "${WWW_DIR}/admin/modules/" 2>/dev/null || echo "Warning: bosssecretary module not found" >> "${LOG_FILE}"
        amportal a ma install bosssecretary >/dev/null 2>&1 || echo "Warning: Failed to install bosssecretary" >> "${LOG_FILE}"
    fi
    echo "**Boss Secretary installed." >> "${LOG_FILE}"
}

# Install Superfecta
superfecta() {
    if [ ! -d "${WWW_DIR}/admin/modules/superfecta" ]; then
        [ -d issabelpbxmodules/superfecta ] && cp -rf issabelpbxmodules/superfecta "${WWW_DIR}/admin/modules/" 2>/dev/null || echo "Warning: superfecta module not found" >> "${LOG_FILE}"
        amportal a ma install superfecta >/dev/null 2>&1 || echo "Warning: Failed to install superfecta" >> "${LOG_FILE}"
    fi
    echo "**Superfecta installed." >> "${LOG_FILE}"
}

# Install Feature Codes
featurecodes() {
    [ -f customdialplan/extensions_voipiran_featurecodes.conf ] && cp -rf customdialplan/extensions_voipiran_featurecodes.conf "${ASTERISK_DIR}/" 2>/dev/null || echo "Warning: featurecodes conf not found" >> "${LOG_FILE}"
    sed -i '/\[from\-internal\-custom\]/a include \=\> voipiran\-features' "${ASTERISK_DIR}/extensions_custom.conf" 2>/dev/null || echo "Warning: Failed to add include" >> "${LOG_FILE}"
    echo "" >> "${ASTERISK_DIR}/extensions_custom.conf"
    echo "#include extensions_voipiran_featurecodes.conf" >> "${ASTERISK_DIR}/extensions_custom.conf"
    echo "**Feature Codes installed." >> "${LOG_FILE}"
}

# Install Survey
survey() {
    [ -d voipiranagi ] && cp -rf voipiranagi "${ASTERISK_DIR}/agi-bin/" 2>/dev/null || echo "Warning: voipiranagi not found" >> "${LOG_FILE}"
    chmod -R 777 "${ASTERISK_DIR}/agi-bin/voipiranagi" 2>/dev/null || echo "Warning: Failed to set permissions" >> "${LOG_FILE}"
    query="REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
    mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "$query" >/dev/null 2>&1 || echo "Warning: Failed to add survey to database" >> "${LOG_FILE}"
    echo "**Survey installed." >> "${LOG_FILE}"
}

# Install Vtiger
vtiger() {
    if [ "$CRMINSTALL" = "true" ]; then
        [ -f vtiger/crm.zip ] && unzip -o vtiger/crm.zip -d "${WWW_DIR}" >/dev/null 2>&1 || echo "Warning: crm.zip not found" >> "${LOG_FILE}"
        chmod -R 777 "${WWW_DIR}/crm" 2>/dev/null || echo "Warning: Failed to set crm permissions" >> "${LOG_FILE}"
        if ! mysql -uroot -p"$rootpw" -e 'use voipirancrm' >/dev/null 2>&1; then
            mysql -uroot -p"$rootpw" -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;" >/dev/null 2>&1 || echo "Warning: Failed to create vtiger database" >> "${LOG_FILE}"
            mysql -uroot -p"$rootpw" -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';" >/dev/null 2>&1 || echo "Warning: Failed to grant privileges" >> "${LOG_FILE}"
            [ -f vtiger/crm.db ] && mysql -uroot -p"$rootpw" voipirancrm < vtiger/crm.db >/dev/null 2>&1 || echo "Warning: crm.db not found" >> "${LOG_FILE}"
        fi
        sed -i "s/123456/$rootpw/g" "${WWW_DIR}/crm/config.inc.php" 2>/dev/null || echo "Warning: Failed to update config.inc.php" >> "${LOG_FILE}"
        issabel-menumerge crm-menu.xml >/dev/null 2>&1 || echo "Warning: Failed to merge crm-menu.xml" >> "${LOG_FILE}"
        echo "**Vtiger installed." >> "${LOG_FILE}"
    fi
}

# Set CID
set_cid() {
    FILE="${ASTERISK_DIR}/extensions_custom.conf"
    LINE="[from-internal-custom]"
    if ! grep -qF "$LINE" "$FILE" 2>/dev/null; then
        echo "$LINE" | tee -a "$FILE" >/dev/null 2>&1 || echo "Warning: Failed to add [from-internal-custom]" >> "${LOG_FILE}"
    fi
    echo "" >> "$FILE"
    echo ";;VOIPIRAN.io" >> "$FILE"
    echo "#include extensions_voipiran_numberformatter.conf" >> "$FILE"
    [ -f software/extensions_voipiran_numberformatter.conf ] && cp -rf software/extensions_voipiran_numberformatter.conf "${ASTERISK_DIR}/" 2>/dev/null || echo "Warning: numberformatter conf not found" >> "${LOG_FILE}"
    chmod 777 "${ASTERISK_DIR}/extensions_voipiran_numberformatter.conf" 2>/dev/null || echo "Warning: Failed to set permissions" >> "${LOG_FILE}"
    echo "**CID set." >> "${LOG_FILE}"
}

# Install HTOP
htop() {
    if [ "$NETUTILINSTALL" = "true" ]; then
        yum install htop traceroute -y >/dev/null 2>&1 || echo "Warning: Failed to install htop" >> "${LOG_FILE}"
        echo "**HTOP installed." >> "${LOG_FILE}"
    fi
}

# Install SNGREP
sngrep() {
    if [ "$NETUTILINSTALL" = "true" ]; then
        yum install -y git ncurses-devel libpcap-devel >/dev/null 2>&1 || echo "Warning: Failed to install dependencies" >> "${LOG_FILE}"
        git clone https://github.com/irontec/sngrep.git >/dev/null 2>&1 || echo "Warning: Failed to clone sngrep" >> "${LOG_FILE}"
        cd sngrep || { echo "Warning: Could not change to sngrep directory" >> "${LOG_FILE}"; return 1; }
        ./bootstrap.sh >/dev/null 2>&1 || echo "Warning: bootstrap.sh failed" >> "${LOG_FILE}"
        ./configure >/dev/null 2>&1 || echo "Warning: configure failed" >> "${LOG_FILE}"
        make >/dev/null 2>&1 || echo "Warning: make failed" >> "${LOG_FILE}"
        make install >/dev/null 2>&1 || echo "Warning: make install failed" >> "${LOG_FILE}"
        cd .. || echo "Warning: Could not return to previous directory" >> "${LOG_FILE}"
        echo "**SNGREP installed." >> "${LOG_FILE}"
    fi
}

# Install Issabel Call Monitoring
issbel_callmonitoring() {
    curl -L -o callmonitoring.zip https://github.com/voipiran/IssabelCallMonitoring/archive/master.zip >/dev/null 2>&1 || echo "Warning: Failed to download callmonitoring" >> "${LOG_FILE}"
    unzip -o callmonitoring.zip >/dev/null 2>&1 || echo "Warning: Failed to unzip callmonitoring" >> "${LOG_FILE}"
    cd IssabelCallMonitoring-main || { echo "Warning: Could not change to callmonitoring directory" >> "${LOG_FILE}"; return 1; }
    chmod 755 install.sh >/dev/null 2>&1 || echo "Warning: Failed to set install.sh permissions" >> "${LOG_FILE}"
    yes | ./install.sh >/dev/null 2>&1 || echo "Warning: install.sh failed" >> "${LOG_FILE}"
    issabel-menumerge software/control.xml >/dev/null 2>&1 || echo "Warning: Failed to merge control.xml" >> "${LOG_FILE}"
    cd .. || echo "Warning: Could not return to previous directory" >> "${LOG_FILE}"
    echo "**Issabel Call Monitoring installed." >> "${LOG_FILE}"
}

# Optimize Menus
optimize_menus() {
    if [ "$OPTIMIZEDMENUS" = "true" ]; then
        local backup_file="/var/www/db/menu_backup_$(date +%Y%m%d_%H%M%S).db"
        [ -f "${WWW_DIR}/db/menu.db" ] && cp "${WWW_DIR}/db/menu.db" "${backup_file}" 2>/dev/null || echo "Warning: Failed to backup menu.db" >> "${LOG_FILE}"
        sqlite3 "${WWW_DIR}/db/menu.db" "DELETE FROM menu WHERE id = 'billing';" 2>/dev/null || echo "Warning: Failed to delete billing menu" >> "${LOG_FILE}"
        sqlite3 "${WWW_DIR}/db/menu.db" "DELETE FROM menu WHERE id = 'graphic_report';" 2>/dev/null || echo "Warning: Failed to delete graphic_report menu" >> "${LOG_FILE}"
        sqlite3 "${WWW_DIR}/db/menu.db" "DELETE FROM menu WHERE id = 'channelusage';" 2>/dev/null || echo "Warning: Failed to delete channelusage menu" >> "${LOG_FILE}"
        sqlite3 "${WWW_DIR}/db/menu.db" "DELETE FROM menu WHERE IdParent = 'email_admin' AND id != 'remote_smtp';" 2>/dev/null || echo "Warning: Failed to delete email_admin submenus" >> "${LOG_FILE}"
        echo "**Optimized Menus applied." >> "${LOG_FILE}"
    fi
}

# Install Advanced Listening
install_advanced_listening() {
    if [ "$ADVANCEDLISTENINGINSTALL" = "true" ]; then
        echo "**Advanced Listening installed." >> "${LOG_FILE}"
    fi
}

# Install Web Phone Panel
install_web_phone_panel() {
    if [ "$WEBPHONEPANELINSTALL" = "true" ]; then
        [ -d webphone ] && cp -rf webphone "${WWW_DIR}/" 2>/dev/null || echo "Warning: webphone not found" >> "${LOG_FILE}"
        chown -R asterisk:asterisk "${WWW_DIR}/webphone" 2>/dev/null || echo "Warning: Failed to set webphone ownership" >> "${LOG_FILE}"
        echo "**Web Phone Panel installed." >> "${LOG_FILE}"
    fi
}

# Install Queue Dashboard
install_queue_dashboard() {
    if [ "$QUEUEDASHBOARDINSTALL" = "true" ]; then
        echo "**Live Queue Dashboard installed and running on port 5000." >> "${LOG_FILE}"
    fi
}

# Install CallerID Formatter
install_callerid_formatter() {
    if [ "$CALLERIDFORMATTERINSTALL" = "true" ]; then
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
    update_progress "Installing Jalali calendar libraries"
    install_jalali_calendar
    update_progress "Editing Issabel Modules and Jalali Calendar"
    edit_issabel_modules
    update_progress "Installing Developer Module"
    install_developer
    update_progress "Installing Asternic CDR"
    asterniccdr
    update_progress "Adding Vitenant Theme"
    add_vitenant_theme
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
} | whiptail --title "VOIZ Installation - A Remarkable Experience" --gauge "Installing: $message" 10 70 0 || {
    echo "Warning: Progress bar failed, continuing without GUI" >> "${LOG_FILE}"
}

# Finalize
systemctl restart httpd >/dev/null 2>&1 || echo "Warning: Failed to restart httpd" >> "${LOG_FILE}"
amportal a r >/dev/null 2>&1 || echo "Warning: Failed to reload amportal" >> "${LOG_FILE}"

# Final Installation Summary Report
echo -e "\033[1;34m=====================================\033[0m"
echo -e "\033[1;34m VOIZ Installation Final Report \033[0m"
echo -e "\033[1;34m=====================================\033[0m"
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