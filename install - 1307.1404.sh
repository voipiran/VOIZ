#!/bin/bash

# بررسی نسخه PHP
issabel_ver=$(php -r 'echo PHP_MAJOR_VERSION;')

# اطمینان از وجود دستورات مورد نیاز
command -v whiptail >/dev/null 2>&1 || { echo "whiptail is required but not installed. Please install it."; exit 1; }
command -v mysql >/dev/null 2>&1 || { echo "mysql is required but not installed. Please install it."; exit 1; }

# تعریف متغیرهای ثابت
WWW_DIR="/var/www"
LOG_FILE="voiz-installation.log"

## FUNCTIONS

function setversion() {
    version=5.6
    file="/etc/voiz.conf"
    if [ -f "$file" ]; then
        sed -i "s/.*version.*/version=$version/g" "$file"
    else
        mkdir -p /etc
        cp -f voiz-installation/voiz.conf /etc/voiz.conf
        sed -i "s/.*version.*/version=$version/g" /etc/voiz.conf
        chmod 644 /etc/voiz.conf
        chown asterisk:asterisk /etc/voiz.conf
    fi
    echo "**VOIZ version set to $version." >> "$LOG_FILE"
}

function install_sourcegaurdian() {
    issabel_ver=$(php -r 'echo PHP_MAJOR_VERSION;')
    if [ "$issabel_ver" -eq 5 ]; then
        echo "PHP 5 detected. Performing action A."
        echo "Install SourceGuardian Files"
        echo "------------Copy SourceGuard-----------------"
        [ -d sourceguardian ] || { echo "SourceGuardian directory not found."; exit 1; }
        yes | cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
        yes | cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
        [ -f /etc/php.ini ] && yes | cp -rf /etc/php.ini /etc/php-old.ini
        yes | cp -rf sourceguardian/php5.ini /etc/php.ini
        echo "SourceGuardian Files have moved successfully"
        sleep 1
    else
        echo "PHP 7 (or newer) detected. Performing action B."
        echo "Install SourceGuardian Files"
        echo "------------Copy SourceGuard-----------------"
        [ -d sourceguardian ] || { echo "SourceGuardian directory not found."; exit 1; }
        yes | cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules
        [ -f /etc/php.ini ] && yes | cp -rf /etc/php.ini /etc/php-old.ini
        yes | cp -rf sourceguardian/php7.ini /etc/php.ini
        echo "SourceGuardian Files have moved successfully"
        systemctl reload php-fpm >/dev/null 2>&1 || echo "Failed to reload php-fpm."
    fi
    echo "**SourceGuardian installed." >> "$LOG_FILE"
}

function install_webmin() {
    echo "------------Installing WEBMIN-----------------"
    [ -f rpms/webmin/webmin-2.111-1.noarch.rpm ] || { echo "Webmin RPM not found."; exit 1; }
    rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1
    echo "**WEBMIN Util Installed." >> "$LOG_FILE"
}

function install_developer() {
    echo "------------Installing Issabel DEVELOPER-----------------"
    [ -f rpms/develop/issabel-developer-4.0.0-3.noarch.rpm ] || { echo "Developer RPM not found."; exit 1; }
    rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1
    echo "**Developer Module Installed." >> "$LOG_FILE"
}

function add_persian_sounds() {
    echo "Add Persian Language"
    [ -d persiansounds ] || { echo "Persian sounds directory not found."; exit 1; }
    sed -e "/language=pr/d" /etc/asterisk/sip_custom.conf > /etc/asterisk/sip_custom.conf.000
    echo >> /etc/asterisk/sip_custom.conf.000
    echo "language=pr" >> /etc/asterisk/sip_custom.conf.000
    cp -f /etc/asterisk/sip_custom.conf.000 /etc/asterisk/sip_custom.conf
    chmod 644 /etc/asterisk/sip_custom.conf
    chown asterisk:asterisk /etc/asterisk/sip_custom.conf

    sed -e "/language=pr/d" /etc/asterisk/iax_custom.conf > /etc/asterisk/iax_custom.conf.000
    echo >> /etc/asterisk/iax_custom.conf.000
    echo "language=pr" >> /etc/asterisk/iax_custom.conf.000
    cp -f /etc/asterisk/iax_custom.conf.000 /etc/asterisk/iax_custom.conf
    chmod 644 /etc/asterisk/iax_custom.conf
    chown asterisk:asterisk /etc/asterisk/iax_custom.conf

    cp -rf persiansounds/say.conf /etc/asterisk
    chmod 644 /etc/asterisk/say.conf
    chown asterisk:asterisk /etc/asterisk/say.conf

    yes | cp -ar persiansounds/pr/ /var/lib/asterisk/sounds/
    chmod -R 755 /var/lib/asterisk/sounds/pr
    chown -R asterisk:asterisk /var/lib/asterisk/sounds/pr

    if [ "$issabel_ver" -eq 5 ]; then
        sed -e "/language=pr/d" /etc/asterisk/pjsip_custom.conf > /etc/asterisk/pjsip_custom.conf.000
        echo >> /etc/asterisk/pjsip_custom.conf.000
        echo "language=pr" >> /etc/asterisk/pjsip_custom.conf.000
        cp -f /etc/asterisk/pjsip_custom.conf.000 /etc/asterisk/pjsip_custom.conf
        chmod 644 /etc/asterisk/pjsip_custom.conf
        chown asterisk:asterisk /etc/asterisk/pjsip_custom.conf
    fi
    echo "**Persian Sounds Added." >> "$LOG_FILE"
}

function add_vitenant_theme() {
    echo "------------Installing VOIPIRAN Theme-----------------"
    sleep 1
    [ -f theme/favicon.ico ] || { echo "Favicon not found."; exit 1; }
    cp -f theme/favicon.ico "$WWW_DIR/html"
    touch -r "$WWW_DIR/html/*"
    cp -rf theme/vitenant "$WWW_DIR/html/themes/"
    touch -r "$WWW_DIR/html/themes/*"
    touch -r "$WWW_DIR/html/themes/vitenant/*"
    if [ "$Lang" = "Persian" ]; then
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='fa' where key='language';"
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='vitenant' where key='theme';"
        echo "**Persian Theme Added." >> "$LOG_FILE"
    elif [ "$Lang" = "English" ]; then
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='en' where key='language';"
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='tenant' where key='theme';"
        echo "**English Theme Added." >> "$LOG_FILE"
    fi
    yes | cp -rf theme/pbxconfig/css "$WWW_DIR/html/admin/assets"
    chmod -R 755 "$WWW_DIR/html/admin/assets/css"
    chown -R asterisk:asterisk "$WWW_DIR/html/admin/assets/css"
    yes | cp -rf theme/pbxconfig/images/issabelpbx_small.png "$WWW_DIR/html/admin/images/"
    chmod 644 "$WWW_DIR/html/admin/images/issabelpbx_small.png"
    yes | cp -rf theme/pbxconfig/images/tango.png "$WWW_DIR/html/admin/images/"
    chmod 644 "$WWW_DIR/html/admin/images/tango.png"
    yes | cp -rf theme/pbxconfig/footer_content.php "$WWW_DIR/html/admin/views"
    chmod 644 "$WWW_DIR/html/admin/views/footer_content.php"
    chown -R asterisk:asterisk "$WWW_DIR/html/admin/views/footer_content.php"
}

function edit_issabel_modules() {
    mkdir -p "$WWW_DIR/html/modules000"
    cp -rf "$WWW_DIR/html/modules/*" "$WWW_DIR/html/modules000"
    yes | cp -arf issabelmodules/modules "$WWW_DIR/html"
    touch -r "$WWW_DIR/html/modules/*"
    chown -R asterisk:asterisk "$WWW_DIR/html/modules/*"
    find "$WWW_DIR/html/modules/" -exec touch {} \;
    yes | cp -f jalalicalendar/date.php "$WWW_DIR/html/libs/"
    yes | cp -f jalalicalendar/params.php "$WWW_DIR/html/libs/"
    yes | cp -rf jalalicalendar/JalaliJSCalendar "$WWW_DIR/html/libs/"
    yes | cp -r issabelmodules/mylib "$WWW_DIR/html/libs/"
    chown -R asterisk:asterisk "$WWW_DIR/html/libs/mylib"
    [ -f "$WWW_DIR/html/libs/paloSantoForm.class.php" ] && mv "$WWW_DIR/html/libs/paloSantoForm.class.php" "$WWW_DIR/html/libs/paloSantoForm.class.php.000"
    yes | cp -rf issabelmodules/paloSantoForm.class.php "$WWW_DIR/html/libs/"
    sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" "$WWW_DIR/html/admin/assets/js/pbxlib.js" >/dev/null 2>&1
    cp -avr asteriskjalalical/jalalidate/ /etc/asterisk
    [ -f "$WWW_DIR/html/lang/fa.lang" ] && mv "$WWW_DIR/html/lang/fa.lang" "$WWW_DIR/html/lang/fa.lang.000"
    cp -rf issabelmodules/fa.lang "$WWW_DIR/html/lang/"
    echo "**Issabel Modules Edited." >> "$LOG_FILE"
}

function downloadable_files() {
    cp -rf downloadable/download "$WWW_DIR/html/"
    chmod -R 755 "$WWW_DIR/html/download"
    chown -R asterisk:asterisk "$WWW_DIR/html/download"
    echo "**Downloadable Files Added." >> "$LOG_FILE"
}

function bulkdids() {
    if [ ! -d "$WWW_DIR/html/admin/modules/bulkdids" ]; then
        yes | cp -rf issabelpbxmodules/bulkdids "$WWW_DIR/html/admin/modules/"
        amportal a ma install bulkdids
    fi
    echo "**Bulk DIDs Module Added." >> "$LOG_FILE"
}

function asterniccdr() {
    if [ ! -d "$WWW_DIR/html/admin/modules/asternic_cdr" ]; then
        yes | cp -rf issabelpbxmodules/asternic_cdr "$WWW_DIR/html/admin/modules/"
        amportal a ma install asternic_cdr
    fi
    echo "**Asternic CDR Module Added." >> "$LOG_FILE"
}

function asternic-callStats-lite() {
    [ -d software ] || { echo "Software directory not found."; exit 1; }
    cd software
    tar zvxf asternic-stats-1.8.tgz
    cd asternic-stats
    mysqladmin -u root -p"$rootpw" create qstatslite 2>/dev/null
    mysql -u root -p"$rootpw" qstatslite < sql/qstats.sql 2>/dev/null
    mysql -u root -p"$rootpw" -e "CREATE USER 'qstatsliteuser'@'localhost' IDENTIFIED BY '$rootpw'" 2>/dev/null
    mysql -u root -p"$rootpw" -e "GRANT SELECT,INSERT,UPDATE,DELETE ON qstatslite.* TO 'qstatsliteuser'@'localhost'" 2>/dev/null
    mysql -u root -p"$rootpw" -e "ALTER DATABASE qstatslite CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
    mysql -u root -p"$rootpw" -e "ALTER TABLE qstatslite.queue_stats CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
    mysql -u root -p"$rootpw" -e "ALTER TABLE qstatslite.qname CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
    mysql -u root -p"$rootpw" -e "ALTER TABLE qstatslite.qevent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
    mysql -u root -p"$rootpw" -e "ALTER TABLE qstatslite.qagent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
    yes | cp -rf html "$WWW_DIR/html/queue-stats"
    yes | cp -rf parselog /usr/local/parseloglite
    sed -i "s/= ''/= '$rootpw'/g" "$WWW_DIR/html/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/admin/phpconfig/g" "$WWW_DIR/html/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/amp111/php[onfig/g" "$WWW_DIR/html/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/= ''/= '$rootpw'/g" /usr/local/parseloglite/config.php >/dev/null 2>&1
    (crontab -l ; echo "*/15 * * * * php -q /usr/local/parseloglite/parselog.php convertlocal") | crontab -
    cd ..
    issabel-menumerge asternic.xml
    cd ..
    echo "**Asternic Call Stats Lite Installed." >> "$LOG_FILE"
}

function bosssecretary() {
    if [ "$issabel_ver" -eq 4 ] && [ ! -d "$WWW_DIR/html/admin/modules/bosssecretary" ]; then
        yes | cp -rf issabelpbxmodules/bosssecretary "$WWW_DIR/html/admin/modules/"
        amportal a ma install bosssecretary
    fi
    echo "**Boss Secretary Module Added." >> "$LOG_FILE"
}

function superfecta() {
    if [ ! -d "$WWW_DIR/html/admin/modules/superfecta" ]; then
        yes | cp -rf issabelpbxmodules/superfecta "$WWW_DIR/html/admin/modules/"
        amportal a ma install superfecta
    fi
    echo "**Superfecta Module Added." >> "$LOG_FILE"
}

function featurecodes() {
    cp -rf customdialplan/extensions_voipiran_featurecodes.conf /etc/asterisk/
    sed -i '/\[from\-internal\-custom\]/a include => voipiran-features' /etc/asterisk/extensions_custom.conf
    echo "" >> /etc/asterisk/extensions_custom.conf
    echo "#include extensions_voipiran_featurecodes.conf" >> /etc/asterisk/extensions_custom.conf
    queries=(
        "INSERT INTO featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATETIME-Jalali','VOIZ-بیان تاریخ و زمان شمسی','*200',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*200'"
        "INSERT INTO featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATE-Jalali','VOIZ-بیان تاریخ به شمسی','*201',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*201'"
        "INSERT INTO featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-TIME-Jalali','VOIZ-بیان زمان به فارسی','*202',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*202'"

    )
    for query in "${queries[@]}"; do
        mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "$query" >/dev/null 2>&1
    done
    echo "**VOIZ Feature Codes Added." >> "$LOG_FILE"
}

function easyvpn() {
    yum install issabel-easyvpn --nogpgcheck -y >/dev/null 2>&1
    echo "**OpenVPN Module Added." >> "$LOG_FILE"
}

function survey() {
    cp -rf voipiranagi /var/lib/asterisk/agi-bin
    chmod -R 755 /var/lib/asterisk/agi-bin/voipiranagi
    chown -R asterisk:asterisk /var/lib/asterisk/agi-bin/voipiranagi
    query="REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
    mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "$query" >/dev/null 2>&1
    echo "**Queue Survey Module Added." >> "$LOG_FILE"
}

function vtiger() {
    echo "------------Installing VOIZ Vtiger CRM-----------------"
    curl -L -o VOIZ-Vtiger.zip https://github.com/voipiran/VOIZ-Vtiger/archive/master.zip || { echo "Failed to download Vtiger."; exit 1; }
    unzip -o VOIZ-Vtiger.zip
    cd VOIZ-Vtiger-master
    yes | cp -rf * "$WWW_DIR/html/vtiger/"
    cd ..
    chmod -R 755 "$WWW_DIR/html/vtiger"
    chown -R asterisk:asterisk "$WWW_DIR/html/vtiger"
    if ! mysql -uroot -p"$rootpw" -e 'use voipirancrm' >/dev/null 2>&1; then
        echo "-------------Adding VTIGER DATABASE"
        mysql -uroot -p"$rootpw" -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;" >/dev/null 2>&1
        mysql -uroot -p"$rootpw" -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';" >/dev/null 2>&1
        [ -f "VOIZ-Vtiger-master/vtiger.sql" ] && mysql -uroot -p"$rootpw" voipirancrm < VOIZ-Vtiger-master/vtiger.sql >/dev/null 2>&1
    fi
    [ -f "$WWW_DIR/html/vtiger/config.inc.php" ] && sed -i "s/123456/$rootpw/g" "$WWW_DIR/html/vtiger/config.inc.php" >/dev/null 2>&1
    [ -f VOIZ-Vtiger-master/crm-menu.xml ] && issabel-menumerge VOIZ-Vtiger-master/crm-menu.xml
    rm -rf VOIZ-Vtiger.zip VOIZ-Vtiger-master
    echo "**VOIZ Vtiger CRM Installed." >> "$LOG_FILE"
}

function install_queue_panel() {
    echo "------------Installing VOIZ Queue Panel-----------------"
    curl -L -o /tmp/VOIZ-QueuePanel.zip https://github.com/voipiran/VOIZ-QueuePanel/archive/master.zip || { echo "Failed to download VOIZ Queue Panel."; exit 1; }
    unzip -o /tmp/VOIZ-QueuePanel.zip -d /tmp || { echo "Failed to unzip VOIZ-QueuePanel.zip."; exit 1; }
    mv /tmp/VOIZ-QueuePanel-master /tmp/VOIZ-QueuePanel || { echo "Failed to rename VOIZ-QueuePanel-master to VOIZ-QueuePanel."; exit 1; }
    mv /tmp/VOIZ-QueuePanel "$WWW_DIR/html/qpanel"
    [ -f /var/www/html/qpanel/install.sh ] && bash /var/www/html/qpanel/install.sh
    chmod -R 755 "$WWW_DIR/html/qpanel"
    chown -R asterisk:asterisk "$WWW_DIR/html/qpanel"
    cd -
    rm -rf /tmp/VOIZ-QueuePanel.zip /tmp/VOIZ-QueuePanel
    echo "**VOIZ Queue Panel Installed." >> "$LOG_FILE"
}

function install_web_phone() {
    echo "------------Installing VOIZ Web Phone-----------------"
    curl -L -o /tmp/VOIZ-WebPhone.zip https://github.com/voipiran/VOIZ-WebPhone/archive/master.zip || { echo "Failed to download VOIZ Web Phone."; exit 1; }
    unzip -o /tmp/VOIZ-WebPhone.zip -d /tmp || { echo "Failed to unzip VOIZ-WebPhone.zip."; exit 1; }
    mv /tmp/VOIZ-WebPhone-master /tmp/VOIZ-WebPhone || { echo "Failed to rename VOIZ-WebPhone-master to VOIZ-WebPhone."; exit 1; }
    mv /tmp/VOIZ-WebPhone/Phone "$WWW_DIR/html/phone"
    [ -f /tmp/VOIZ-WebPhone/install.sh ] && bash /tmp/VOIZ-WebPhone/install.sh
    chmod -R 755 "$WWW_DIR/html/phone"
    chown -R asterisk:asterisk "$WWW_DIR/html/phone"
    cd -
    rm -rf /tmp/VOIZ-WebPhone.zip /tmp/VOIZ-WebPhone
    echo "**VOIZ Web Phone Installed." >> "$LOG_FILE"
}

function install_callerid_formatter() {
    echo "------------Installing Asterisk Callerid Formatter-----------------"
    curl -L -o /tmp/AsteriskCalleridFormatter.zip https://github.com/voipiran/AsteriskCalleridFormatter/archive/master.zip || { echo "Failed to download Asterisk Callerid Formatter."; exit 1; }
    unzip -o /tmp/AsteriskCalleridFormatter.zip -d /tmp || { echo "Failed to unzip AsteriskCalleridFormatter.zip."; exit 1; }
    mv /tmp/AsteriskCalleridFormatter-main /tmp/AsteriskCalleridFormatter || { echo "Failed to rename AsteriskCalleridFormatter-main to AsteriskCalleridFormatter."; exit 1; }
    cd /tmp/AsteriskCalleridFormatter
    chmod 755 /tmp/AsteriskCalleridFormatter/install.sh
    [ -f /tmp/AsteriskCalleridFormatter/install.sh ] && bash /tmp/AsteriskCalleridFormatter/install.sh  
    cd -
    rm -rf /tmp/AsteriskCalleridFormatter.zip /tmp/AsteriskCalleridFormatter
    echo "**Asterisk Callerid Formatter Installed." >> "$LOG_FILE"
}

function install_chanspy_pro() {
    echo "------------Installing Asterisk ChanSpy Pro-----------------"
    curl -L -o voipiran_chanspy.zip https://github.com/voipiran/AsteriskChanSpyPro/archive/main.zip || { echo "Failed to download Asterisk ChanSpy Pro."; exit 1; }
    unzip -o voipiran_chanspy.zip
    cd AsteriskChanSpyPro-main
    chmod 755 install_voipiran_chansp.sh
    ./install_voipiran_chansp.sh -y
    cd ..
    rm -rf voipiran_chanspy.zip AsteriskChanSpyPro-main
    echo "**Asterisk ChanSpy Pro Installed." >> "$LOG_FILE"
}

function htop() {
    yum install htop traceroute -y >/dev/null 2>&1
    echo "**HTOP Util Installed." >> "$LOG_FILE"
}

function sngrep() {
    echo "------------Installing SNGREP-----------------"
    yum install -y ncurses-devel libpcap-devel >/dev/null 2>&1
    curl -L -o sngrep.zip https://github.com/irontec/sngrep/archive/master.zip || { echo "Failed to download sngrep."; exit 1; }
    unzip -o sngrep.zip
    cd sngrep-master
    ./bootstrap.sh
    ./configure
    make
    make install
    cd ..
    rm -rf sngrep.zip sngrep-master
    echo "**SNGREP Util Installed." >> "$LOG_FILE"
}

function voiz_menu() {
    mv "$WWW_DIR/db/menu.db" "$WWW_DIR/db/menu.db.000"
    cp -rf voiz-installation/menu.db "$WWW_DIR/db/"
    chmod 644 "$WWW_DIR/db/menu.db"
    chown asterisk:asterisk "$WWW_DIR/db/menu.db"
    echo "**VOIZ Guide Menu Added." >> "$LOG_FILE"
}

function optimize_menus() {
    if [ "$OPTIMIZEDMENUS" = "true" ]; then
        local backup_file="$WWW_DIR/db/menu_backup_$(date +%Y%m%d_%H%M%S).db"
        [ -f "$WWW_DIR/db/menu.db" ] && cp "$WWW_DIR/db/menu.db" "$backup_file" 2>/dev/null || echo "Warning: Failed to backup menu.db" >> "$LOG_FILE"
        sqlite3 "$WWW_DIR/db/menu.db" "DELETE FROM menu WHERE id = 'billing';" 2>/dev/null || echo "Warning: Failed to delete billing menu" >> "$LOG_FILE"
        sqlite3 "$WWW_DIR/db/menu.db" "DELETE FROM menu WHERE id = 'graphic_report';" 2>/dev/null || echo "Warning: Failed to delete graphic_report menu" >> "$LOG_FILE"
        sqlite3 "$WWW_DIR/db/menu.db" "DELETE FROM menu WHERE id = 'channelusage';" 2>/dev/null || echo "Warning: Failed to delete channelusage menu" >> "$LOG_FILE"
        sqlite3 "$WWW_DIR/db/menu.db" "DELETE FROM menu WHERE IdParent = 'email_admin' AND id != 'remote_smtp';" 2>/dev/null || echo "Warning: Failed to delete email_admin submenus" >> "$LOG_FILE"
        echo "**Optimized Menus applied." >> "$LOG_FILE"
    fi
}

function welcome() {
    whiptail --title "VOIZ Installation" --msgbox "Powered by VOIPIRAN.io..." 8 78
}

function menu-order() {
    issabel-menumerge callcenter-menu.xml
    echo "**Callcenter Menu Added." >> "$LOG_FILE"
}

function install-on-issabel() {
    yum --enablerepo=issabel-beta update -y >/dev/null 2>&1
    echo "**install-on-issabel" >> "$LOG_FILE"
}

function install-on-centos() {
    echo "**install-on-centos" >> "$LOG_FILE"
}

function install-on-nightly() {
    yum update -y >/dev/null 2>&1
    echo "**install-on-rocky" >> "$LOG_FILE"
}

function update_issabel() {
    yum update -y >/dev/null 2>&1
    echo "**install-on-issabel" >> "$LOG_FILE"
}

function issbel-callmonitoring() {
    echo "------------Installing Issabel Call Monitoring-----------------"
    curl -L -o callmonitoring.zip https://github.com/voipiran/IssabelCallMonitoring/archive/master.zip || { echo "Failed to download Issabel Call Monitoring."; exit 1; }
    unzip -o callmonitoring.zip
    cd IssabelCallMonitoring-main
    chmod 755 install.sh
    ./install.sh -y
    cd ..
    issabel-menumerge software/control.xml
    rm -rf callmonitoring.zip IssabelCallMonitoring-main
    echo "**Issabel Call Monitoring Installed." >> "$LOG_FILE"
}

#########START#########

# Fetch DB root password
echo "185.51.200.2 mirrors.fedoraproject.org" | tee -a /etc/hosts
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)
[ -z "$rootpw" ] && { echo "MySQL root password not found in /etc/issabel.conf."; exit 1; }
> "$LOG_FILE"
echo "VOIZ Installation Log:" >> "$LOG_FILE"

# Get PHP version
php_version=$(php -r "echo PHP_MAJOR_VERSION;")
if [ "$php_version" -eq 5 ]; then
    issabel_ver=5
else
    issabel_ver=4
fi

welcome

# SELECT FEATURES GUI
SELECTED=$(whiptail --title "SELECT Features TO INSTALL" --checklist \
"List of Features to install" 20 100 10 \
"NetworkUtilities" "SNGREP, HTOP" ON \
"QueuePanel" "VOIZ Queue Panel" ON \
"WebPhone" "VOIZ Web Phone" ON \
"CallerIDFormatter" "Asterisk Callerid Formatter" ON \
"ChanSpyPro" "Asterisk ChanSpy Pro" ON \
"Vtiger CRM" "ویتایگر با تقویم شمسی" OFF \
"OptimizedMenus" "Optimized Menus" ON 3>&1 1>&2 2>&3)

eval "ARRAY=($SELECTED)"
echo "Selected: ${ARRAY[@]}" >> "$LOG_FILE"

for CHOICE in "${ARRAY[@]}"; do
    case "$CHOICE" in
        *"CRM"*) CRMINSTALL=true ;;
        *"NetworkUtilities"*) NETUTILINSTALL=true ;;
        *"QueuePanel"*) QUEUEPANELINSTALL=true ;;
        *"WebPhone"*) WEBPHONEINSTALL=true ;;
        *"CallerIDFormatter"*) CALLERIDFORMATTERINSTALL=true ;;
        *"ChanSpyPro"*) CHANSPYPROINSTALL=true ;;
        *"OptimizedMenus"*) OPTIMIZEDMENUS=true ;;
    esac
done

# SELECT LANGUAGE GUI
Lang=$(whiptail --title "Choose VOIZ Theme Style:" --menu "Choose a Language" 25 78 5 \
"Persian" "پوسته و محیط فارسی به همراه تقویم شمسی" \
"English" "پوسته و محیط انگلیسی به همراه تقویم شمسی" 3>&1 1>&2 2>&3)

COUNTER=0
while [[ ${COUNTER} -le 100 ]]; do
    sleep 1
    MESSAGE="Setting VOIZ version..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    setversion
    MESSAGE="Installing SourceGuardian..."
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    install_sourcegaurdian
    FILE="/etc/asterisk/extensions_custom.conf"
    LINE="[from-internal-custom]"
    MESSAGE="Checking and updating Asterisk custom extensions..."
    if grep -qF "$LINE" "$FILE"; then
        echo "The line '$LINE' exists in the file '$FILE'."
    else
        echo "The line '$LINE' does not exist in the file '$FILE'. Adding the line."
        echo "$LINE" | tee -a "$FILE"
    fi
    MESSAGE="Updating Issabel system..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    update_issabel
    MESSAGE="Installing Webmin..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    install_webmin
    MESSAGE="Adding Persian sounds..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    add_persian_sounds
    MESSAGE="Installing Issabel Developer module..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    install_developer
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    MESSAGE="Installing Asternic CDR module..."
    asterniccdr
    MESSAGE="Adding Vitenant theme..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    add_vitenant_theme
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    MESSAGE="Editing Issabel modules..."
    edit_issabel_modules
    MESSAGE="Installing Asternic Call Stats Lite..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    asternic-callStats-lite
    MESSAGE="Adding downloadable files..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    downloadable_files
    MESSAGE="Installing Bulk DIDs module..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    bulkdids
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    if [ "$issabel_ver" -eq 4 ]; then
        MESSAGE="Installing Boss Secretary module..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        bosssecretary
    fi
    MESSAGE="Installing Superfecta module..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    superfecta
    MESSAGE="Adding VOIZ feature codes..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    featurecodes
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    MESSAGE="Installing Queue Survey module..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    survey
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    if [ "$CRMINSTALL" = "true" ]; then
        MESSAGE="Installing VOIZ Vtiger CRM..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        vtiger
    fi
    if [ "$QUEUEPANELINSTALL" = "true" ]; then
        MESSAGE="Installing VOIZ Queue Panel..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        install_queue_panel
    fi
    if [ "$WEBPHONEINSTALL" = "true" ]; then
        MESSAGE="Installing VOIZ Web Phone..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        install_web_phone
    fi
    if [ "$CALLERIDFORMATTERINSTALL" = "true" ]; then
        MESSAGE="Installing Asterisk CallerID Formatter..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        install_callerid_formatter
    fi
    if [ "$CHANSPYPROINSTALL" = "true" ]; then
        MESSAGE="Installing Asterisk ChanSpy Pro..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        install_chanspy_pro
    fi
    if [ "$OPTIMIZEDMENUS" = "true" ]; then
        MESSAGE="Optimizing Issabel menus..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        optimize_menus
    fi
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    if [ "$NETUTILINSTALL" = "true" ]; then
        MESSAGE="Installing HTOP and Traceroute..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        htop
    fi
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    if [ "$NETUTILINSTALL" = "true" ]; then
        MESSAGE="Installing SNGREP..."
        echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
        sngrep
    fi
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    MESSAGE="Installing Issabel Call Monitoring..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    issbel-callmonitoring
    MESSAGE="Finalizing installation..."
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
    cd ..
    #voiz_menu
    amportal a r >/dev/null 2>&1
    COUNTER=$((COUNTER+10))
    echo "XXX\n${COUNTER}\n${MESSAGE}\nXXX"
done | whiptail --gauge "Installing VOIZ components..." 6 50 0

systemctl restart httpd >/dev/null 2>&1
clear
cat voiz-installation/logo.txt
cat "$LOG_FILE"