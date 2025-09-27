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
# Welcome message
whiptail --title "VOIZ Installation" --msgbox "Powered by VOIPIRAN.io - Starting the amazing installation!" 8 78
# Select features to install
SELECTED=$(whiptail --title "Select Features" --checklist \
"List of features to install" 20 100 12 \
"Vtiger CRM" "Vtiger with Shamsi calendar" ON \
"NetworkUtilities" "SNGREP, HTOP" ON \
"AdvancedListening" "Advanced Listening" ON \
"WebPhonePanel" "Web Phone Panel" ON \
"QueueDashboard" "Live Queue Dashboard" ON \
"CallerIDFormatter" "CallerID Formatter" ON 3>&1 1>&2 2>&3)
eval "ARRAY=($SELECTED)"
for CHOICE in "${ARRAY[@]}"; do
    [[ "$CHOICE" == *"CRM"* ]] && CRMINSTALL=true
    [[ "$CHOICE" == *"NetworkUtilities"* ]] && NETUTILINSTALL=true
    [[ "$CHOICE" == *"AdvancedListening"* ]] && ADVANCEDLISTENINGINSTALL=true
    [[ "$CHOICE" == *"WebPhonePanel"* ]] && WEBPHONEPANELINSTALL=true
    [[ "$CHOICE" == *"QueueDashboard"* ]] && QUEUEDASHBOARDINSTALL=true
    [[ "$CHOICE" == *"CallerIDFormatter"* ]] && CALLERIDFORMATTERINSTALL=true
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
    local version=5.6
    local file="${CONFIG_DIR}/voiz.conf"
    if [ -f "$file" ]; then
        sed -i "s/.*version.*/version=$version/g" "$file"
    else
        cp voiz-installation/voiz.conf "${CONFIG_DIR}"
        sed -i "s/.*version.*/version=$version/g" "${CONFIG_DIR}/voiz.conf"
    fi
    echo "**VOIZ Version Set to $version" >> "${LOG_FILE}"
    check_status "Setting VOIZ version"
}
# Install SourceGuardian
install_sourcegaurdian() {
    if [ "$php_version" -eq 5 ]; then
        echo "PHP 5 detected. Installing SourceGuardian for PHP 5."
        cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules >/dev/null 2>&1
        cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules >/dev/null 2>&1
        cp -f /etc/php.ini /etc/php-old.ini >/dev/null 2>&1
        cp -f sourceguardian/php5.ini /etc/php.ini >/dev/null 2>&1
    else
        echo "PHP 7 detected. Installing SourceGuardian for PHP 7."
        cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules >/dev/null 2>&1
        cp -f /etc/php.ini /etc/php-old.ini >/dev/null 2>&1
        cp -f sourceguardian/php7.ini /etc/php.ini >/dev/null 2>&1
        systemctl reload php-fpm >/dev/null 2>&1
    fi
    echo "**SourceGuardian Installed" >> "${LOG_FILE}"
    check_status "Installing SourceGuardian"
}
# Install Webmin
install_webmin() {
    rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1
    echo "**Webmin Installed" >> "${LOG_FILE}"
    check_status "Installing Webmin"
}
# Install Developer Module
install_developer() {
    rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1
    echo "**Developer Module Installed" >> "${LOG_FILE}"
    check_status "Installing Developer Module"
}
# Add Persian Sounds
add_persian_sounds() {
    for conf in sip_custom.conf iax_custom.conf pjsip_custom.conf; do
        [ "$conf" = "pjsip_custom.conf" ] && [ "$issabel_ver" -ne 5 ] && continue
        sed -e "/language=pr/d" "${ASTERISK_DIR}/${conf}" > "${ASTERISK_DIR}/${conf}.000" >/dev/null 2>&1
        echo -e "\nlanguage=pr" >> "${ASTERISK_DIR}/${conf}.000" >/dev/null 2>&1
        mv -f "${ASTERISK_DIR}/${conf}.000" "${ASTERISK_DIR}/${conf}" >/dev/null 2>&1
    done
    cp -f persiansounds/say.conf "${ASTERISK_DIR}" >/dev/null 2>&1
    chmod 777 "${ASTERISK_DIR}/say.conf" >/dev/null 2>&1
    chown asterisk:asterisk "${ASTERISK_DIR}/say.conf" >/dev/null 2>&1
    cp -rf persiansounds/pr "${SOUND_DIR}" >/dev/null 2>&1
    chmod -R 777 "${SOUND_DIR}/pr" >/dev/null 2>&1
    chown -R asterisk:asterisk "${SOUND_DIR}/pr" >/dev/null 2>&1
    echo "**Persian Sounds Added" >> "${LOG_FILE}"
    check_status "Adding Persian Sounds"
}
# Add Vitenant Theme
add_vitenant_theme() {
    cp -f theme/favicon.ico "${WWW_DIR}" >/dev/null 2>&1
    cp -rf theme/vitenant "${THEME_DIR}" >/dev/null 2>&1
    touch -r "${WWW_DIR}"/* "${THEME_DIR}"/* "${THEME_DIR}/vitenant"/* >/dev/null 2>&1
    if [ "$Lang" = "Persian" ]; then
        sqlite3 /var/www/db/settings.db "update settings set value='fa' where key='language';" >/dev/null 2>&1
        sqlite3 /var/www/db/settings.db "update settings set value='vitenant' where key='theme';" >/dev/null 2>&1
        echo "**Persian Theme Added" >> "${LOG_FILE}"
    else
        sqlite3 /var/www/db/settings.db "update settings set value='en' where key='language';" >/dev/null 2>&1
        sqlite3 /var/www/db/settings.db "update settings set value='tenant' where key='theme';" >/dev/null 2>&1
        echo "**English Theme Added" >> "${LOG_FILE}"
    fi
    cp -rf theme/pbxconfig/css "${WWW_DIR}/admin/assets" >/dev/null 2>&1
    chmod -R 777 "${WWW_DIR}/admin/assets/css" >/dev/null 2>&1
    chown -R asterisk:asterisk "${WWW_DIR}/admin/assets/css" >/dev/null 2>&1
    cp -f theme/pbxconfig/images/issabelpbx_small.png "${WWW_DIR}/admin/images/" >/dev/null 2>&1
    cp -f theme/pbxconfig/images/tango.png "${WWW_DIR}/admin/images/" >/dev/null 2>&1
    chmod -R 777 "${WWW_DIR}/admin/images/"*.png >/dev/null 2>&1
    cp -f theme/pbxconfig/footer_content.php "${WWW_DIR}/admin/views" >/dev/null 2>&1
    chmod 777 "${WWW_DIR}/admin/views/footer_content.php" >/dev/null 2>&1
    chown -R asterisk:asterisk "${WWW_DIR}/admin/views/footer_content.php" >/dev/null 2>&1
    check_status "Adding Vitenant Theme"
}
# Edit Issabel Modules
edit_issabel_modules() {
    cp -rf /var/www/html/modules/* /var/www/html/modules000 >/dev/null 2>&1
    cp -rf issabelmodules/modules "${MODULES_DIR}" >/dev/null 2>&1
    touch -r "${MODULES_DIR}"/* >/dev/null 2>&1
    chown -R asterisk:asterisk "${MODULES_DIR}"/* >/dev/null 2>&1
    chown asterisk:asterisk "${MODULES_DIR}" >/dev/null 2>&1
    cp -f jalalicalendar/date.php "${WWW_DIR}/libs/" >/dev/null 2>&1
    cp -f jalalicalendar/params.php "${WWW_DIR}/libs/" >/dev/null 2>&1
    cp -rf jalalicalendar/JalaliJSCalendar "${WWW_DIR}/libs/" >/dev/null 2>&1
    cp -rf issabelmodules/mylib "${WWW_DIR}/libs/" >/dev/null 2>&1
    chown -R asterisk:asterisk "${WWW_DIR}/libs/mylib" >/dev/null 2>&1
    mv "${WWW_DIR}/libs/paloSantoForm.class.php" "${WWW_DIR}/libs/paloSantoForm.class.php.000" >/dev/null 2>&1
    cp -f issabelmodules/paloSantoForm.class.php "${WWW_DIR}/libs/" >/dev/null 2>&1
    sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" "${WWW_DIR}/admin/assets/js/pbxlib.js" >/dev/null 2>&1
    cp -rf asteriskjalalical/jalalidate/ "${ASTERISK_DIR}" >/dev/null 2>&1
    mv "${WWW_DIR}/lang/fa.lang" "${WWW_DIR}/lang/fa.lang.000" >/dev/null 2>&1
    cp -f issabelmodules/fa.lang "${WWW_DIR}/lang/" >/dev/null 2>&1
    echo "**Issabel Modules Edited" >> "${LOG_FILE}"
    check_status "Editing Issabel Modules"
}
# Install Downloadable Files
downloadable_files() {
    cp -rf downloadable/download "${WWW_DIR}/" >/dev/null 2>&1
    echo "**Downloadable Files Added" >> "${LOG_FILE}"
    check_status "Installing Downloadable Files"
}
# Install Bulk DIDs Module
bulkdids() {
    if [ ! -d "${WWW_DIR}/admin/modules/bulkdids" ]; then
        cp -rf issabelpbxmodules/bulkdids "${WWW_DIR}/admin/modules/" >/dev/null 2>&1
        amportal a ma install bulkdids >/dev/null 2>&1
    fi
    echo "**Bulk DIDs Module Added" >> "${LOG_FILE}"
    check_status "Installing Bulk DIDs"
}
# Install Asternic CDR
asterniccdr() {
    if [ ! -d "${WWW_DIR}/admin/modules/asternic_cdr" ]; then
        cp -rf issabelpbxmodules/asternic_cdr "${WWW_DIR}/admin/modules/" >/dev/null 2>&1
        amportal a ma install asternic_cdr >/dev/null 2>&1
    fi
    echo "**Asternic CDR Module Added" >> "${LOG_FILE}"
    check_status "Installing Asternic CDR"
}
# Install Asternic Call Stats Lite
asternic_callStats_lite() {
    cd software >/dev/null 2>&1
    tar zvxf asternic-stats-1.8.tgz >/dev/null 2>&1
    cd asternic-stats >/dev/null 2>&1
    mysqladmin -u root -p"$rootpw" create qstatslite 2>/dev/null
    mysql -u root -p"$rootpw" qstatslite < sql/qstats.sql 2>/dev/null
    mysql -u root -p"$rootpw" -e "CREATE USER 'qstatsliteuser'@'localhost' IDENTIFIED BY '$rootpw';" >/dev/null 2>&1
    mysql -u root -p"$rootpw" -e "GRANT select,insert,update,delete ON qstatslite.* TO qstatsliteuser;" >/dev/null 2>&1
    mysql -u root -p"$rootpw" -e "ALTER DATABASE qstatslite CHARACTER SET utf8 COLLATE utf8_unicode_ci;" >/dev/null 2>&1
    for table in queue_stats qname qevent qagent; do
        mysql -u root -p"$rootpw" -e "ALTER TABLE qstatslite.$table CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" >/dev/null 2>&1
    done
    cp -rf html "${WWW_DIR}/queue-stats" >/dev/null 2>&1
    cp -rf parselog /usr/local/parseloglite >/dev/null 2>&1
    sed -i "s/= ''/= '$rootpw'/g" "${WWW_DIR}/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/admin/phpconfig/g" "${WWW_DIR}/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/amp111/php[onfig/g" "${WWW_DIR}/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/= ''/= '$rootpw'/g" /usr/local/parseloglite/config.php >/dev/null 2>&1
    (crontab -l ; echo "*/15 * * * * php -q /usr/local/parseloglite/parselog.php convertlocal") | crontab - >/dev/null 2>&1
    cd .. >/dev/null 2>&1
    issabel-menumerge asternic.xml >/dev/null 2>&1
    cd .. >/dev/null 2>&1
    echo "**Asternic Call Stats Lite Installed" >> "${LOG_FILE}"
    check_status "Installing Asternic Call Stats Lite"
}
# Install Boss Secretary Module
bosssecretary() {
    if [ "$issabel_ver" -eq 4 ] && [ ! -d "${WWW_DIR}/admin/modules/bosssecretary" ]; then
        cp -rf issabelpbxmodules/bosssecretary "${WWW_DIR}/admin/modules/" >/dev/null 2>&1
        amportal a ma install bosssecretary >/dev/null 2>&1
    fi
    echo "**Boss Secretary Module Added" >> "${LOG_FILE}"
    check_status "Installing Boss Secretary"
}
# Install Superfecta Module
superfecta() {
    if [ ! -d "${WWW_DIR}/admin/modules/superfecta" ]; then
        cp -rf issabelpbxmodules/superfecta "${WWW_DIR}/admin/modules/" >/dev/null 2>&1
        amportal a ma install superfecta >/dev/null 2>&1
    fi
    echo "**Superfecta Module Added" >> "${LOG_FILE}"
    check_status "Installing Superfecta"
}
# Install Feature Codes
featurecodes() {
    cp -f customdialplan/extensions_voipiran_featurecodes.conf "${ASTERISK_DIR}/" >/dev/null 2>&1
    sed -i '/\[from\-internal\-custom\]/a include => voipiran-features' "${ASTERISK_DIR}/extensions_custom.conf" >/dev/null 2>&1
    echo -e "\n#include extensions_voipiran_featurecodes.conf" >> "${ASTERISK_DIR}/extensions_custom.conf" >/dev/null 2>&1
    local queries=(
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATETIME-Jalali','VOIZ-Announce Jalali Date and Time','*200',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*200'"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATE-Jalali','VOIZ-Announce Jalali Date','*201',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*201'"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-TIME-Jalali','VOIZ-Announce Time in Persian','*202',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*202'"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chanspy-Simple','VOIZ-Simple Listening, Code + Destination Number','*30',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Whisper','VOIZ-Listen and Whisper, Code + Destination Number','*31',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Only-Listen','VOIZ-Listen to Agent Voice, Code + Destination Number','*32',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Private-Whisper','VOIZ-Talk to Agent Without Listening, Code + Destination Number','*33',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Barge','VOIZ-Listen and Talk to Both Parties, Code + Destination Number','*34',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-DTMF','VOIZ-Listen and Switch Listening Mode During Call with 4, 5, 6, Code + Destination Number','*35',NULL,'1','1')"
    )
    for query in "${queries[@]}"; do
        mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "$query" >/dev/null 2>&1
    done
    echo "**VOIZ Feature Codes Added" >> "${LOG_FILE}"
    check_status "Installing Feature Codes"
}
# Install EasyVPN
easyvpn() {
    yum install issabel-easyvpn --nogpgcheck -y >/dev/null 2>&1
    echo "**OpenVPN Module Added" >> "${LOG_FILE}"
    check_status "Installing EasyVPN"
}
# Install Survey
survey() {
    cp -rf voipiranagi /var/lib/asterisk/agi-bin >/dev/null 2>&1
    chmod -R 777 /var/lib/asterisk/agi-bin/voipiranagi >/dev/null 2>&1
    mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "REPLACE INTO miscdests (id,description,destdial) VALUES('101','VOIZ-Survey','4454')" >/dev/null 2>&1
    echo "**Queue Survey Module Added" >> "${LOG_FILE}"
    check_status "Installing Survey"
}
# Install Vtiger CRM
vtiger() {
    cd /tmp >/dev/null 2>&1
    curl -L -o crm.zip https://github.com/voipiran/VOIZ-Vtiger/archive/main.zip >/dev/null 2>&1
    unzip -o crm.zip >/dev/null 2>&1
    mv VOIZ-Vtiger-main /tmp/vtiger >/dev/null 2>&1
    cd vtiger >/dev/null 2>&1
    cat crm.zip* > crm.zip >/dev/null 2>&1
    unzip -o crm.zip -d "${WWW_DIR}" >/dev/null 2>&1
    touch -r "${WWW_DIR}/crm"/* >/dev/null 2>&1
    chmod -R 777 "${WWW_DIR}/crm" >/dev/null 2>&1
    if ! mysql -uroot -p"$rootpw" -e 'use voipirancrm' >/dev/null 2>&1; then
        mysql -uroot -p"$rootpw" -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;" >/dev/null 2>&1
        mysql -uroot -p"$rootpw" -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';" >/dev/null 2>&1
        mysql -uroot -p"$rootpw" voipirancrm < crm.db >/dev/null 2>&1
    fi
    sed -i "s/123456/$rootpw/g" "${WWW_DIR}/crm/config.inc.php" >/dev/null 2>&1
    issabel-menumerge crm-menu.xml >/dev/null 2>&1
    echo "**Vtiger CRM Installed" >> "${LOG_FILE}"
    check_status "Installing Vtiger CRM"
    cd /tmp >/dev/null 2>&1
    rm -rf vtiger crm.zip >/dev/null 2>&1
}
# Install Webphone
webphone() {
    cp -rf webphone "${WWW_DIR}" >/dev/null 2>&1
    chown -R asterisk:asterisk "${WWW_DIR}/webphone"/* >/dev/null 2>&1
    chown asterisk:asterisk "${WWW_DIR}/webphone" >/dev/null 2>&1
    echo "**WebPhone Module Added" >> "${LOG_FILE}"
    check_status "Installing Webphone"
}
# Install Htop
htop() {
    yum install htop traceroute -y >/dev/null 2>&1
    echo "**HTOP Util Installed" >> "${LOG_FILE}"
    check_status "Installing HTOP"
}
# Install SNGREP
sngrep() {
    yum install -y git ncurses-devel libpcap-devel >/dev/null 2>&1
    git clone https://github.com/irontec/sngrep.git >/dev/null 2>&1
    cd sngrep >/dev/null 2>&1
    ./bootstrap.sh >/dev/null 2>&1
    ./configure >/dev/null 2>&1
    make >/dev/null 2>&1
    make install >/dev/null 2>&1
    cd .. >/dev/null 2>&1
    echo "**SNGREP Util Installed" >> "${LOG_FILE}"
    check_status "Installing SNGREP"
}
# Install VOIZ Menu
voiz_menu() {
    #mv /var/www/db/menu.db /var/www/db/menu.db.000 >/dev/null 2>&1
    #cp -f voiz-installation/menu.db /var/www/db/ >/dev/null 2>&1
    #chown asterisk:asterisk /var/www/db/menu.db >/dev/null 2>&1
    #echo "**VOIZ Guide Menu Added" >> "${LOG_FILE}"
    #check_status "Installing VOIZ Menu"
}
# Set CID
set_cid() {
    local FILE="${ASTERISK_DIR}/extensions_custom.conf"
    local LINE="[from-internal-custom]"
    if ! grep -qF "$LINE" "$FILE" >/dev/null 2>&1; then
        echo "$LINE" >> "$FILE" >/dev/null 2>&1
    fi
    echo -e "\n;;VOIPIRAN.io\n#include extensions_voipiran_numberformatter.conf" >> "$FILE" >/dev/null 2>&1
    cp -f software/extensions_voipiran_numberformatter.conf "${ASTERISK_DIR}" >/dev/null 2>&1
    chown asterisk:asterisk "${ASTERISK_DIR}/extensions_voipiran_numberformatter.conf" >/dev/null 2>&1
    chmod 777 "${ASTERISK_DIR}/extensions_voipiran_numberformatter.conf" >/dev/null 2>&1
    echo -e "\n;;VOIPIRAN.io\n[to-cidformatter]\nexten => _.,1,Set(IS_PSTN_CALL=1)\nexten => _.,n,NoOp(start-from-pstn)\nexten => _.,n,Gosub(numberformatter,s,1)\nexten => _.,n,NoOp(end-from-pstn)\nexten => _.,n,Goto(from-pstn,s,1)" >> "$FILE" >/dev/null 2>&1
    echo "**Set CID Module Added" >> "${LOG_FILE}"
    check_status "Setting CID"
}
# Install Issabel Call Monitoring
issbel_callmonitoring() {
    curl -L -o callmonitoring.zip https://github.com/voipiran/IssabelCallMonitoring/archive/master.zip >/dev/null 2>&1
    unzip -o callmonitoring.zip >/dev/null 2>&1
    cd IssabelCallMonitoring-main >/dev/null 2>&1
    chmod 755 install.sh >/dev/null 2>&1
    ./install.sh >/dev/null 2>&1
    issabel-menumerge software/control.xml >/dev/null 2>&1
    cd .. >/dev/null 2>&1
    echo "**Issabel Call Monitoring Installed" >> "${LOG_FILE}"
    check_status "Installing Issabel Call Monitoring"
}
# Install Advanced Listening (AsteriskChanSpyPro)
install_advanced_listening() {
    cd /tmp >/dev/null 2>&1
    curl -L -o voipiran_chanspy.zip https://github.com/voipiran/AsteriskChanSpyPro/archive/main.zip >/dev/null 2>&1
    unzip -o voipiran_chanspy.zip >/dev/null 2>&1
    cd AsteriskChanSpyPro-main >/dev/null 2>&1
    chmod 755 install.sh >/dev/null 2>&1
    ./install.sh -y >/dev/null 2>&1
    cd /tmp >/dev/null 2>&1
    if [ $? -eq 0 ]; then
        echo "**Advanced Listening Installed Successfully" >> "${LOG_FILE}"
    else
        echo "**Advanced Listening Installation Failed" >> "${LOG_FILE}"
    fi
    check_status "Installing Advanced Listening"
}
# Install Web Phone Panel (VOIZ-WebPhone)
install_web_phone_panel() {
    cd /tmp >/dev/null 2>&1
    git clone https://github.com/voipiran/VOIZ-WebPhone /tmp/VOIZ-WebPhone >/dev/null 2>&1
    mv /tmp/VOIZ-WebPhone/Phone /var/www/html/phone >/dev/null 2>&1
    cd /var/www/html/phone >/dev/null 2>&1
    chmod 755 install.sh >/dev/null 2>&1
    bash install.sh >/dev/null 2>&1
    cd /tmp >/dev/null 2>&1
    if [ $? -eq 0 ]; then
        echo "**Web Phone Panel Installed Successfully" >> "${LOG_FILE}"
    else
        echo "**Web Phone Panel Installation Failed" >> "${LOG_FILE}"
    fi
    check_status "Installing Web Phone Panel"
}
# Install Queue Dashboard (VOIZ-QueuePanel)
install_queue_dashboard() {
    cd /tmp >/dev/null 2>&1
    sudo git clone https://github.com/voipiran/VOIZ-QueuePanel /tmp/VOIZ-QueuePanel >/dev/null 2>&1
    sudo mv /tmp/VOIZ-QueuePanel /var/www/html/qpanel >/dev/null 2>&1
    cd /var/www/html/qpanel >/dev/null 2>&1
    sudo chmod 755 install.sh >/dev/null 2>&1
    sudo bash install.sh >/dev/null 2>&1
    cd /tmp >/dev/null 2>&1
    if [ $? -eq 0 ]; then
        echo "**Queue Dashboard Installed Successfully" >> "${LOG_FILE}"
    else
        echo "**Queue Dashboard Installation Failed" >> "${LOG_FILE}"
    fi
    check_status "Installing Queue Dashboard"
}
# Install CallerID Formatter (AsteriskCalleridFormatter)
install_callerid_formatter() {
    cd /tmp >/dev/null 2>&1
    curl -L -o AsteriskCalleridFormatter.zip https://github.com/voipiran/AsteriskCalleridFormatter/archive/master.zip >/dev/null 2>&1
    unzip -o AsteriskCalleridFormatter.zip >/dev/null 2>&1
    cd AsteriskCalleridFormatter-main >/dev/null 2>&1
    chmod 755 install.sh >/dev/null 2>&1
    ./install.sh -y >/dev/null 2>&1
    cd /tmp >/dev/null 2>&1
    if [ $? -eq 0 ]; then
        echo "**CallerID Formatter Installed Successfully" >> "${LOG_FILE}"
    else
        echo "**CallerID Formatter Installation Failed" >> "${LOG_FILE}"
    fi
    check_status "Installing CallerID Formatter"
}
# Main installation process
{
    setversion
    update_progress "Setting VOIZ Version"
    install_sourcegaurdian
    update_progress "Installing SourceGuardian"
    install_webmin
    update_progress "Installing Webmin"
    add_persian_sounds
    update_progress "Adding Persian Sounds"
    install_developer
    update_progress "Installing Developer Module"
    asterniccdr
    update_progress "Installing Asternic CDR"
    add_vitenant_theme
    update_progress "Adding Vitenant Theme"
    edit_issabel_modules
    update_progress "Editing Issabel Modules"
    asternic_callStats_lite
    update_progress "Installing Asternic Call Stats Lite - This may take a few minutes"
    downloadable_files
    update_progress "Installing Downloadable Files"
    bulkdids
    update_progress "Installing Bulk DIDs"
    [ "$issabel_ver" -eq 4 ] && bosssecretary
    update_progress "Installing Boss Secretary"
    superfecta
    update_progress "Installing Superfecta"
    featurecodes
    update_progress "Installing Feature Codes"
    survey
    update_progress "Installing Survey"
    [ "$CRMINSTALL" = "true" ] && vtiger
    update_progress "Installing Vtiger CRM - This may take a few minutes"
    set_cid
    update_progress "Setting CID"
    [ "$NETUTILINSTALL" = "true" ] && htop
    update_progress "Installing HTOP"
    [ "$NETUTILINSTALL" = "true" ] && sngrep
    update_progress "Installing SNGREP"
    issbel_callmonitoring
    update_progress "Installing Issabel Call Monitoring"
    voiz_menu
    update_progress "Installing VOIZ Menu"
    [ "$ADVANCEDLISTENINGINSTALL" = "true" ] && install_advanced_listening
    update_progress "Installing Advanced Listening"
    [ "$WEBPHONEPANELINSTALL" = "true" ] && install_web_phone_panel
    update_progress "Installing Web Phone Panel"
    [ "$QUEUEDASHBOARDINSTALL" = "true" ] && install_queue_dashboard
    update_progress "Installing Live Queue Dashboard"
    [ "$CALLERIDFORMATTERINSTALL" = "true" ] && install_callerid_formatter
    update_progress "Installing CallerID Formatter"
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
echo -e "\033[1;34m=====================================\033[0m"