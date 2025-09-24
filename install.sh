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
echo "VOIZ Installation Log:" >> "${LOG_FILE}"

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
whiptail --title "VOIZ Installation" --msgbox "Powered by VOIPIRAN.io..." 8 78

# Select features to install
SELECTED=$(whiptail --title "SELECT Features TO INSTALL" --checklist \
"List of Features to install" 20 100 10 \
"Vtiger CRM" "ویتایگر با تقویم شمسی" ON \
"NetworkUtilities" "SNGREP, HTOP" ON 3>&1 1>&2 2>&3)

eval "ARRAY=($SELECTED)"
for CHOICE in "${ARRAY[@]}"; do
    [[ "$CHOICE" == *"CRM"* ]] && CRMINSTALL=true
    [[ "$CHOICE" == *"NetworkUtilities"* ]] && NETUTILINSTALL=true
done

# Select language
Lang=$(whiptail --title "Choose VOIZ Theme Style:" --menu "Choose a Language" 25 78 5 \
"Persian" "پوسته و محیط فارسی به همراه تقویم شمسی" \
"English" "پوسته و محیط انگلیسی به همراه تقویم شمسی" 3>&1 1>&2 2>&3)

# Progress bar function
COUNTER=0
update_progress() {
    COUNTER=$((COUNTER + 10))
    echo "${COUNTER}"
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
}

# Install SourceGuardian
install_sourcegaurdian() {
    if [ "$php_version" -eq 5 ]; then
        echo "PHP 5 detected. Installing SourceGuardian for PHP 5."
        cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
        cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
        cp -f /etc/php.ini /etc/php-old.ini
        cp -f sourceguardian/php5.ini /etc/php.ini
    else
        echo "PHP 7 detected. Installing SourceGuardian for PHP 7."
        cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules
        cp -f /etc/php.ini /etc/php-old.ini
        cp -f sourceguardian/php7.ini /etc/php.ini
        systemctl reload php-fpm > /dev/null
    fi
    echo "**SourceGuardian Installed" >> "${LOG_FILE}"
}

# Install Webmin
install_webmin() {
    rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1
    echo "**Webmin Installed" >> "${LOG_FILE}"
}

# Install Developer Module
install_developer() {
    rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1
    echo "**Developer Module Installed" >> "${LOG_FILE}"
}

# Add Persian Sounds
add_persian_sounds() {
    for conf in sip_custom.conf iax_custom.conf pjsip_custom.conf; do
        [ "$conf" = "pjsip_custom.conf" ] && [ "$issabel_ver" -ne 5 ] && continue
        sed -e "/language=pr/d" "${ASTERISK_DIR}/${conf}" > "${ASTERISK_DIR}/${conf}.000"
        echo -e "\nlanguage=pr" >> "${ASTERISK_DIR}/${conf}.000"
        mv -f "${ASTERISK_DIR}/${conf}.000" "${ASTERISK_DIR}/${conf}"
    done

    cp -f persiansounds/say.conf "${ASTERISK_DIR}"
    chmod 777 "${ASTERISK_DIR}/say.conf"
    chown asterisk:asterisk "${ASTERISK_DIR}/say.conf"

    cp -rf persiansounds/pr "${SOUND_DIR}"
    chmod -R 777 "${SOUND_DIR}/pr"
    chown -R asterisk:asterisk "${SOUND_DIR}/pr"
    echo "**Persian Sounds Added" >> "${LOG_FILE}"
}

# Add Vitenant Theme
add_vitenant_theme() {
    cp -f theme/favicon.ico "${WWW_DIR}"
    cp -rf theme/vitenant "${THEME_DIR}"
    touch -r "${WWW_DIR}"/* "${THEME_DIR}"/* "${THEME_DIR}/vitenant"/*

    if [ "$Lang" = "Persian" ]; then
        sqlite3 /var/www/db/settings.db "update settings set value='fa' where key='language';"
        sqlite3 /var/www/db/settings.db "update settings set value='vitenant' where key='theme';"
        echo "**Persian Theme Added" >> "${LOG_FILE}"
    else
        sqlite3 /var/www/db/settings.db "update settings set value='en' where key='language';"
        sqlite3 /var/www/db/settings.db "update settings set value='tenant' where key='theme';"
        echo "**English Theme Added" >> "${LOG_FILE}"
    fi

    cp -rf theme/pbxconfig/css "${WWW_DIR}/admin/assets"
    chmod -R 777 "${WWW_DIR}/admin/assets/css"
    chown -R asterisk:asterisk "${WWW_DIR}/admin/assets/css"

    cp -f theme/pbxconfig/images/issabelpbx_small.png "${WWW_DIR}/admin/images/"
    cp -f theme/pbxconfig/images/tango.png "${WWW_DIR}/admin/images/"
    chmod -R 777 "${WWW_DIR}/admin/images/"*.png
    cp -f theme/pbxconfig/footer_content.php "${WWW_DIR}/admin/views"
    chmod 777 "${WWW_DIR}/admin/views/footer_content.php"
    chown -R asterisk:asterisk "${WWW_DIR}/admin/views/footer_content.php"
}

# Edit Issabel Modules
edit_issabel_modules() {
    cp -rf /var/www/html/modules/* /var/www/html/modules000
    cp -rf issabelmodules/modules "${MODULES_DIR}"
    touch -r "${MODULES_DIR}"/*
    chown -R asterisk:asterisk "${MODULES_DIR}"/*
    chown asterisk:asterisk "${MODULES_DIR}"

    cp -f jalalicalendar/date.php "${WWW_DIR}/libs/"
    cp -f jalalicalendar/params.php "${WWW_DIR}/libs/"
    cp -rf jalalicalendar/JalaliJSCalendar "${WWW_DIR}/libs/"
    cp -rf issabelmodules/mylib "${WWW_DIR}/libs/"
    chown -R asterisk:asterisk "${WWW_DIR}/libs/mylib"
    mv "${WWW_DIR}/libs/paloSantoForm.class.php" "${WWW_DIR}/libs/paloSantoForm.class.php.000"
    cp -f issabelmodules/paloSantoForm.class.php "${WWW_DIR}/libs/"

    sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" "${WWW_DIR}/admin/assets/js/pbxlib.js"
    cp -rf asteriskjalalical/jalalidate/ "${ASTERISK_DIR}"
    mv "${WWW_DIR}/lang/fa.lang" "${WWW_DIR}/lang/fa.lang.000"
    cp -f issabelmodules/fa.lang "${WWW_DIR}/lang/"
    echo "**Issabel Modules Edited" >> "${LOG_FILE}"
}

# Install Downloadable Files
downloadable_files() {
    cp -rf downloadable/download "${WWW_DIR}/"
    echo "**Downloadable Files Added" >> "${LOG_FILE}"
}

# Install Bulk DIDs Module
bulkdids() {
    if [ ! -d "${WWW_DIR}/admin/modules/bulkdids" ]; then
        cp -rf issabelpbxmodules/bulkdids "${WWW_DIR}/admin/modules/"
        amportal a ma install bulkdids
    fi
    echo "**Bulk DIDs Module Added" >> "${LOG_FILE}"
}

# Install Asternic CDR
asterniccdr() {
    if [ ! -d "${WWW_DIR}/admin/modules/asternic_cdr" ]; then
        cp -rf issabelpbxmodules/asternic_cdr "${WWW_DIR}/admin/modules/"
        amportal a ma install asternic_cdr
    fi
    echo "**Asternic CDR Module Added" >> "${LOG_FILE}"
}

# Install Asternic Call Stats Lite
asternic-callStats-lite() {
    cd software
    tar zvxf asternic-stats-1.8.tgz
    cd asternic-stats
    mysqladmin -u root -p"$rootpw" create qstatslite 2>/dev/null
    mysql -u root -p"$rootpw" qstatslite < sql/qstats.sql 2>/dev/null
    mysql -u root -p"$rootpw" -e "CREATE USER 'qstatsliteuser'@'localhost' IDENTIFIED BY '$rootpw';"
    mysql -u root -p"$rootpw" -e "GRANT select,insert,update,delete ON qstatslite.* TO qstatsliteuser;"
    mysql -u root -p"$rootpw" -e "ALTER DATABASE qstatslite CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
    for table in queue_stats qname qevent qagent; do
        mysql -u root -p"$rootpw" -e "ALTER TABLE qstatslite.$table CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
    done
    cp -rf html "${WWW_DIR}/queue-stats"
    cp -rf parselog /usr/local/parseloglite
    sed -i "s/= ''/= '$rootpw'/g" "${WWW_DIR}/queue-stats/config.php"
    sed -i "s/admin/phpconfig/g" "${WWW_DIR}/queue-stats/config.php"
    sed -i "s/amp111/php[onfig/g" "${WWW_DIR}/queue-stats/config.php"
    sed -i "s/= ''/= '$rootpw'/g" /usr/local/parseloglite/config.php
    (crontab -l ; echo "*/15 * * * * php -q /usr/local/parseloglite/parselog.php convertlocal") | crontab -
    cd ..
    issabel-menumerge asternic.xml
    cd ..
    echo "**Asternic Call Stats Lite Installed" >> "${LOG_FILE}"
}

# Install Boss Secretary Module
bosssecretary() {
    if [ "$issabel_ver" -eq 4 ] && [ ! -d "${WWW_DIR}/admin/modules/bosssecretary" ]; then
        cp -rf issabelpbxmodules/bosssecretary "${WWW_DIR}/admin/modules/"
        amportal a ma install bosssecretary
    fi
    echo "**Boss Secretary Module Added" >> "${LOG_FILE}"
}

# Install Superfecta Module
superfecta() {
    if [ ! -d "${WWW_DIR}/admin/modules/superfecta" ]; then
        cp -rf issabelpbxmodules/superfecta "${WWW_DIR}/admin/modules/"
        amportal a ma install superfecta
    fi
    echo "**Superfecta Module Added" >> "${LOG_FILE}"
}

# Install Feature Codes
featurecodes() {
    cp -f customdialplan/extensions_voipiran_featurecodes.conf "${ASTERISK_DIR}/"
    sed -i '/\[from\-internal\-custom\]/a include => voipiran-features' "${ASTERISK_DIR}/extensions_custom.conf"
    echo -e "\n#include extensions_voipiran_featurecodes.conf" >> "${ASTERISK_DIR}/extensions_custom.conf"

    local queries=(
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATETIME-Jalali','VOIZ-بیان تاریخ و زمان شمسی','*200',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*200'"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATE-Jalali','VOIZ-بیان تاریخ به شمسی','*201',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*201'"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-TIME-Jalali','VOIZ-بیان زمان به فارسی','*202',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*202'"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chanspy-Simple','VOIZ-شنود ساده، کد + شماره مقصد','*30',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Whisper','VOIZ-شنود و نجوا، کد + شماره مقصد','*31',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Only-Listen','VOIZ-شنود صدای کارشناس، کد + شماره مقصد','*32',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Private-Whisper','VOIZ-صحبت با کارشناس بدون شنود، کد + شماره مقصد','*33',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Barge','VOIZ-شنود و مکالمه با هر دو طرف، کد + شماره مقصد','*34',NULL,'1','1')"
        "insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-DTMF','VOIZ-شنود و تغییر حالت شنود حین مکالمه با 4 و 5 و 6، کد + شماره مقصد','*35',NULL,'1','1')"
    )
    for query in "${queries[@]}"; do
        mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "$query" >/dev/null 2>&1
    done
    echo "**VOIZ Feature Codes Added" >> "${LOG_FILE}"
}

# Install EasyVPN
easyvpn() {
    yum install issabel-easyvpn --nogpgcheck -y >/dev/null 2>&1
    echo "**OpenVPN Module Added" >> "${LOG_FILE}"
}

# Install Survey
survey() {
    cp -rf voipiranagi /var/lib/asterisk/agi-bin
    chmod -R 777 /var/lib/asterisk/agi-bin/voipiranagi
    mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
    echo "**Queue Survey Module Added" >> "${LOG_FILE}"
}

# Install Vtiger CRM
vtiger() {
    cat vtiger/crm.zip* > vtiger/crm.zip
    unzip -o vtiger/crm.zip -d "${WWW_DIR}" >/dev/null 2>&1
    touch -r "${WWW_DIR}/crm"/*
    chmod -R 777 "${WWW_DIR}/crm"
    if ! mysql -uroot -p"$rootpw" -e 'use voipirancrm' >/dev/null 2>&1; then
        mysql -uroot -p"$rootpw" -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;"
        mysql -uroot -p"$rootpw" -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';"
        mysql -uroot -p"$rootpw" voipirancrm < vtiger/crm.db >/dev/null 2>&1
    fi
    sed -i "s/123456/$rootpw/g" "${WWW_DIR}/crm/config.inc.php"
    issabel-menumerge crm-menu.xml
    echo "**Vtiger CRM Installed" >> "${LOG_FILE}"
}

# Install Webphone
webphone() {
    cp -rf webphone "${WWW_DIR}"
    chown -R asterisk:asterisk "${WWW_DIR}/webphone"/*
    chown asterisk:asterisk "${WWW_DIR}/webphone"
    echo "**WebPhone Module Added" >> "${LOG_FILE}"
}

# Install Htop
htop() {
    yum install htop traceroute -y >/dev/null 2>&1
    echo "**HTOP Util Installed" >> "${LOG_FILE}"
}

# Install SNGREP
sngrep() {
    yum install -y git ncurses-devel libpcap-devel >/dev/null 2>&1
    git clone https://github.com/irontec/sngrep.git >/dev/null 2>&1
    cd sngrep
    ./bootstrap.sh
    ./configure
    make
    make install
    cd ..
    echo "**SNGREP Util Installed" >> "${LOG_FILE}"
}

# Install VOIZ Menu
voiz_menu() {
    mv /var/www/db/menu.db /var/www/db/menu.db.000
    cp -f voiz-installation/menu.db /var/www/db/
    chown asterisk:asterisk /var/www/db/menu.db
    echo "**VOIZ Guide Menu Added" >> "${LOG_FILE}"
}

# Set CID
set_cid() {
    local FILE="${ASTERISK_DIR}/extensions_custom.conf"
    local LINE="[from-internal-custom]"
    if ! grep -qF "$LINE" "$FILE"; then
        echo "$LINE" >> "$FILE"
    fi
    echo -e "\n;;VOIPIRAN.io\n#include extensions_voipiran_numberformatter.conf" >> "$FILE"
    cp -f software/extensions_voipiran_numberformatter.conf "${ASTERISK_DIR}"
    chown asterisk:asterisk "${ASTERISK_DIR}/extensions_voipiran_numberformatter.conf"
    chmod 777 "${ASTERISK_DIR}/extensions_voipiran_numberformatter.conf"

    echo -e "\n;;VOIPIRAN.io\n[to-cidformatter]\nexten => _.,1,Set(IS_PSTN_CALL=1)\nexten => _.,n,NoOp(start-from-pstn)\nexten => _.,n,Gosub(numberformatter,s,1)\nexten => _.,n,NoOp(end-from-pstn)\nexten => _.,n,Goto(from-pstn,s,1)" >> "$FILE"
    echo "**Set CID Module Added" >> "${LOG_FILE}"
}

# Install Issabel Call Monitoring
issbel-callmonitoring() {
    curl -L -o callmonitoring.zip https://github.com/voipiran/IssabelCallMonitoring/archive/master.zip
    unzip -o callmonitoring.zip
    cd IssabelCallMonitoring-main
    chmod 755 install.sh
    ./install.sh
    issabel-menumerge software/control.xml
    cd ..
    echo "**Issabel Call Monitoring Installed" >> "${LOG_FILE}"
}

# Update Issabel
update_issabel() {
    yum update -y >/dev/null 2>&1
    echo "**Issabel Updated" >> "${LOG_FILE}"
}

# Main installation process
{
    update_issabel
    update_progress
    setversion
    update_progress
    install_sourcegaurdian
    update_progress
    install_webmin
    update_progress
    add_persian_sounds
    update_progress
    install_developer
    update_progress
    asterniccdr
    update_progress
    add_vitenant_theme
    update_progress
    edit_issabel_modules
    update_progress
    asternic-callStats-lite
    update_progress
    downloadable_files
    update_progress
    bulkdids
    update_progress
    [ "$issabel_ver" -eq 4 ] && bosssecretary
    update_progress
    superfecta
    update_progress
    featurecodes
    update_progress
    survey
    update_progress
    [ "$CRMINSTALL" = "true" ] && vtiger
    update_progress
    set_cid
    update_progress
    [ "$NETUTILINSTALL" = "true" ] && htop
    update_progress
    [ "$NETUTILINSTALL" = "true" ] && sngrep
    update_progress
    issbel-callmonitoring
    update_progress
    voiz_menu
    update_progress
} | whiptail --gauge "Sit back, enjoy coffee, VOIPIRAN." 6 50 0

# Finalize
systemctl restart httpd >/dev/null 2>&1
amportal a r >/dev/null 2>&1
clear
cat voiz-installation/logo.txt
cat "${LOG_FILE}"