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
function initial() {
    if ! command -v git >/dev/null 2>&1; then
        yum install git -y >/dev/null 2>&1 || { echo "Failed to install git."; exit 1; }
    fi
    echo "**Git installed successfully." >> "$LOG_FILE"
    rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)
    [ -z "$rootpw" ] && { echo "MySQL root password not found in /etc/issabel.conf."; exit 1; }
    echo "**MySQL root password retrieved successfully." >> "$LOG_FILE"
    version=5.10.0
    file="/etc/voiz.conf"
    if [ -f "$file" ]; then
        sed -i "s/.*version.*/version=$version/g" "$file" || { echo "Failed to update voiz.conf."; exit 1; }
    else
        mkdir -p /etc || { echo "Failed to create /etc directory."; exit 1; }
        cp -f voiz-installation/voiz.conf /etc/voiz.conf || { echo "Failed to copy voiz.conf."; exit 1; }
        sed -i "s/.*version.*/version=$version/g" /etc/voiz.conf || { echo "Failed to update voiz.conf."; exit 1; }
        chmod 644 /etc/voiz.conf || { echo "Failed to set permissions for voiz.conf."; exit 1; }
        chown asterisk:asterisk /etc/voiz.conf || { echo "Failed to set ownership for voiz.conf."; exit 1; }
    fi
    echo "**VOIZ version set to $version." >> "$LOG_FILE"
    [ -f /etc/resolv.conf ] && cp /etc/resolv.conf /etc/resolv.conf.bak || { echo "Failed to backup resolv.conf."; exit 1; }
    echo "nameserver 8.8.8.8" > /etc/resolv.conf || { echo "Failed to set DNS 8.8.8.8."; exit 1; }
    echo "nameserver 4.2.2.4" >> /etc/resolv.conf || { echo "Failed to set DNS 4.2.2.4."; exit 1; }
    echo "**DNS servers set to 8.8.8.8 and 4.2.2.4." >> "$LOG_FILE"
    > "$LOG_FILE" || { echo "Failed to create log file."; exit 1; }
    echo "VOIZ Installation Log:" >> "$LOG_FILE"
    php_version=$(php -r "echo PHP_MAJOR_VERSION;") || { echo "Failed to retrieve PHP version."; exit 1; }
    if [ "$php_version" -eq 5 ]; then
        issabel_ver=5
    else
        issabel_ver=4
    fi
    echo "**PHP version set to $issabel_ver." >> "$LOG_FILE"
}

function install_sourcegaurdian() {
    issabel_ver=$(php -r 'echo PHP_MAJOR_VERSION;')
    if [ "$issabel_ver" -eq 5 ]; then
        [ -d sourceguardian ] || { echo "SourceGuardian directory not found."; exit 1; }
        yes | cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules 2>/dev/null
        yes | cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules 2>/dev/null
        [ -f /etc/php.ini ] && yes | cp -rf /etc/php.ini /etc/php-old.ini 2>/dev/null
        yes | cp -rf sourceguardian/php5.ini /etc/php.ini 2>/dev/null
        echo "**SourceGuardian Files have moved successfully" >> "$LOG_FILE"
    else
        [ -d sourceguardian ] || { echo "SourceGuardian directory not found."; exit 1; }
        yes | cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules 2>/dev/null
        [ -f /etc/php.ini ] && yes | cp -rf /etc/php.ini /etc/php-old.ini 2>/dev/null
        yes | cp -rf sourceguardian/php7.ini /etc/php.ini 2>/dev/null
        systemctl reload php-fpm >/dev/null 2>&1 || echo "Failed to reload php-fpm." >> "$LOG_FILE"
        echo "**SourceGuardian Files have moved successfully" >> "$LOG_FILE"
    fi
    echo "**SourceGuardian installed." >> "$LOG_FILE"
}

function install_webmin() {
    [ -f rpms/webmin/webmin-2.111-1.noarch.rpm ] || { echo "Webmin RPM not found."; exit 1; }
    rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1
    echo "**WEBMIN Util Installed." >> "$LOG_FILE"
}

function install_developer() {
    [ -f rpms/develop/issabel-developer-4.0.0-3.noarch.rpm ] || { echo "Developer RPM not found."; exit 1; }
    rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1
    echo "**Developer Module Installed." >> "$LOG_FILE"
}

function add_persian_sounds() {
    [ -d persiansounds ] || { echo "Persian sounds directory not found."; exit 1; }
    sed -e "/language=pr/d" /etc/asterisk/sip_custom.conf > /etc/asterisk/sip_custom.conf.000 2>/dev/null
    echo >> /etc/asterisk/sip_custom.conf.000
    echo "language=pr" >> /etc/asterisk/sip_custom.conf.000
    cp -f /etc/asterisk/sip_custom.conf.000 /etc/asterisk/sip_custom.conf 2>/dev/null
    chmod 644 /etc/asterisk/sip_custom.conf 2>/dev/null
    chown asterisk:asterisk /etc/asterisk/sip_custom.conf 2>/dev/null
    sed -e "/language=pr/d" /etc/asterisk/iax_custom.conf > /etc/asterisk/iax_custom.conf.000 2>/dev/null
    echo >> /etc/asterisk/iax_custom.conf.000
    echo "language=pr" >> /etc/asterisk/iax_custom.conf.000
    cp -f /etc/asterisk/iax_custom.conf.000 /etc/asterisk/iax_custom.conf 2>/dev/null
    chmod 644 /etc/asterisk/iax_custom.conf 2>/dev/null
    chown asterisk:asterisk /etc/asterisk/iax_custom.conf 2>/dev/null
    cp -rf persiansounds/say.conf /etc/asterisk 2>/dev/null
    chmod 644 /etc/asterisk/say.conf 2>/dev/null
    chown asterisk:asterisk /etc/asterisk/say.conf 2>/dev/null
    yes | cp -ar persiansounds/pr/ /var/lib/asterisk/sounds/ 2>/dev/null
    chmod -R 755 /var/lib/asterisk/sounds/pr 2>/dev/null
    chown -R asterisk:asterisk /var/lib/asterisk/sounds/pr 2>/dev/null
    if [ "$issabel_ver" -eq 5 ]; then
        sed -e "/language=pr/d" /etc/asterisk/pjsip_custom.conf > /etc/asterisk/pjsip_custom.conf.000 2>/dev/null
        echo >> /etc/asterisk/pjsip_custom.conf.000
        echo "language=pr" >> /etc/asterisk/pjsip_custom.conf.000
        cp -f /etc/asterisk/pjsip_custom.conf.000 /etc/asterisk/pjsip_custom.conf 2>/dev/null
        chmod 644 /etc/asterisk/pjsip_custom.conf 2>/dev/null
        chown asterisk:asterisk /etc/asterisk/pjsip_custom.conf 2>/dev/null
    fi
    echo "**Persian Sounds Added." >> "$LOG_FILE"
}

function add_vitenant_theme() {
    sleep 1
    [ -f theme/favicon.ico ] || { echo "Favicon not found."; exit 1; }
    cp -f theme/favicon.ico "$WWW_DIR/html" 2>/dev/null
    if ls "$WWW_DIR/html/"* >/dev/null 2>&1; then touch -r "$WWW_DIR/html/"* 2>/dev/null; fi
    cp -rf theme/vitenant "$WWW_DIR/html/themes/" 2>/dev/null
    if ls "$WWW_DIR/html/themes/"* >/dev/null 2>&1; then touch -r "$WWW_DIR/html/themes/"* 2>/dev/null; fi
    if ls "$WWW_DIR/html/themes/vitenant/"* >/dev/null 2>&1; then touch -r "$WWW_DIR/html/themes/vitenant/"* 2>/dev/null; fi
    if [ "$Lang" = "Persian" ]; then
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='fa' where key='language';" 2>/dev/null
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='vitenant' where key='theme';" 2>/dev/null
        echo "**Persian Theme Added." >> "$LOG_FILE"
    elif [ "$Lang" = "English" ]; then
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='en' where key='language';" 2>/dev/null
        sqlite3 "$WWW_DIR/db/settings.db" "update settings set value='tenant' where key='theme';" 2>/dev/null
        echo "**English Theme Added." >> "$LOG_FILE"
    fi
    yes | cp -rf theme/pbxconfig/css "$WWW_DIR/html/admin/assets" 2>/dev/null
    chmod -R 755 "$WWW_DIR/html/admin/assets/css" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/admin/assets/css" 2>/dev/null
    yes | cp -rf theme/pbxconfig/images/issabelpbx_small.png "$WWW_DIR/html/admin/images/" 2>/dev/null
    chmod 644 "$WWW_DIR/html/admin/images/issabelpbx_small.png" 2>/dev/null
    yes | cp -rf theme/pbxconfig/images/tango.png "$WWW_DIR/html/admin/images/" 2>/dev/null
    chmod 644 "$WWW_DIR/html/admin/images/tango.png" 2>/dev/null
    yes | cp -rf theme/pbxconfig/footer_content.php "$WWW_DIR/html/admin/views" 2>/dev/null
    chmod 644 "$WWW_DIR/html/admin/views/footer_content.php" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/admin/views/footer_content.php" 2>/dev/null
    echo "**VOIPIRAN Theme Installed." >> "$LOG_FILE"
}

function edit_issabel_modules() {
    mkdir -p "$WWW_DIR/html/modules000" 2>/dev/null
    if ls "$WWW_DIR/html/modules/"* >/dev/null 2>&1; then cp -rf "$WWW_DIR/html/modules/"* "$WWW_DIR/html/modules000" 2>/dev/null; fi
    yes | cp -arf issabelmodules/modules "$WWW_DIR/html" 2>/dev/null
    if ls "$WWW_DIR/html/modules/"* >/dev/null 2>&1; then touch -r "$WWW_DIR/html/modules/"* 2>/dev/null; fi
    if ls "$WWW_DIR/html/modules/"* >/dev/null 2>&1; then chown -R asterisk:asterisk "$WWW_DIR/html/modules/"* 2>/dev/null; fi
    find "$WWW_DIR/html/modules/" -exec touch {} \; 2>/dev/null
    yes | cp -f jalalicalendar/date.php "$WWW_DIR/html/libs/" 2>/dev/null
    yes | cp -f jalalicalendar/params.php "$WWW_DIR/html/libs/" 2>/dev/null
    yes | cp -rf jalalicalendar/JalaliJSCalendar "$WWW_DIR/html/libs/" 2>/dev/null
    yes | cp -r issabelmodules/mylib "$WWW_DIR/html/libs/" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/libs/mylib" 2>/dev/null
    [ -f "$WWW_DIR/html/libs/paloSantoForm.class.php" ] && mv "$WWW_DIR/html/libs/paloSantoForm.class.php" "$WWW_DIR/html/libs/paloSantoForm.class.php.000" 2>/dev/null
    yes | cp -rf issabelmodules/paloSantoForm.class.php "$WWW_DIR/html/libs/" 2>/dev/null
    sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" "$WWW_DIR/html/admin/assets/js/pbxlib.js" >/dev/null 2>&1
    cp -avr asteriskjalalical/jalalidate/ /etc/asterisk 2>/dev/null
    [ -f "$WWW_DIR/html/lang/fa.lang" ] && mv "$WWW_DIR/html/lang/fa.lang" "$WWW_DIR/html/lang/fa.lang.000" 2>/dev/null
    cp -rf issabelmodules/fa.lang "$WWW_DIR/html/lang/" 2>/dev/null
    echo "**Issabel Modules Edited." >> "$LOG_FILE"
}

function downloadable_files() {
    cp -rf downloadable/download "$WWW_DIR/html/" 2>/dev/null
    chmod -R 755 "$WWW_DIR/html/download" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/download" 2>/dev/null
    echo "**Downloadable Files Added." >> "$LOG_FILE"
}

function bulkdids() {
    if [ ! -d "$WWW_DIR/html/admin/modules/bulkdids" ]; then
        yes | cp -rf issabelpbxmodules/bulkdids "$WWW_DIR/html/admin/modules/" 2>/dev/null
        amportal a ma install bulkdids 2>/dev/null
    fi
    echo "**Bulk DIDs Module Added." >> "$LOG_FILE"
}

function asterniccdr() {
    if [ ! -d "$WWW_DIR/html/admin/modules/asternic_cdr" ]; then
        yes | cp -rf issabelpbxmodules/asternic_cdr "$WWW_DIR/html/admin/modules/" 2>/dev/null
        amportal a ma install asternic_cdr 2>/dev/null
    fi
    echo "**Asternic CDR Module Added." >> "$LOG_FILE"
}

function asternic-callStats-lite() {
    [ -d software ] || { echo "Software directory not found."; exit 1; }
    cd software
    tar zvxf asternic-stats-1.8.tgz 2>/dev/null
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
    yes | cp -rf html "$WWW_DIR/html/queue-stats" 2>/dev/null
    yes | cp -rf parselog /usr/local/parseloglite 2>/dev/null
    sed -i "s/= ''/= '$rootpw'/g" "$WWW_DIR/html/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/admin/phpconfig/g" "$WWW_DIR/html/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/amp111/php[onfig/g" "$WWW_DIR/html/queue-stats/config.php" >/dev/null 2>&1
    sed -i "s/= ''/= '$rootpw'/g" /usr/local/parseloglite/config.php >/dev/null 2>&1
    (crontab -l ; echo "*/15 * * * * php -q /usr/local/parseloglite/parselog.php convertlocal") | crontab - 2>/dev/null
    cd ..
    issabel-menumerge asternic.xml 2>/dev/null
    cd ..
    echo "**Asternic Call Stats Lite Installed." >> "$LOG_FILE"
}

function bosssecretary() {
    if [ "$issabel_ver" -eq 4 ] && [ ! -d "$WWW_DIR/html/admin/modules/bosssecretary" ]; then
        yes | cp -rf issabelpbxmodules/bosssecretary "$WWW_DIR/html/admin/modules/" 2>/dev/null
        amportal a ma install bosssecretary 2>/dev/null
    fi
    echo "**Boss Secretary Module Added." >> "$LOG_FILE"
}

function superfecta() {
    if [ ! -d "$WWW_DIR/html/admin/modules/superfecta" ]; then
        yes | cp -rf issabelpbxmodules/superfecta "$WWW_DIR/html/admin/modules/" 2>/dev/null
        amportal a ma install superfecta 2>/dev/null
    fi
    echo "**Superfecta Module Added." >> "$LOG_FILE"
}

function featurecodes() {
    cp -rf customdialplan/extensions_voipiran_featurecodes.conf /etc/asterisk/ 2>/dev/null
    sed -i '/\[from\-internal\-custom\]/a include => voipiran-features' /etc/asterisk/extensions_custom.conf 2>/dev/null
    echo "" >> /etc/asterisk/extensions_custom.conf 2>/dev/null
    echo "#include extensions_voipiran_featurecodes.conf" >> /etc/asterisk/extensions_custom.conf 2>/dev/null
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
    cp -rf voipiranagi /var/lib/asterisk/agi-bin 2>/dev/null
    chmod -R 755 /var/lib/asterisk/agi-bin/voipiranagi 2>/dev/null
    chown -R asterisk:asterisk /var/lib/asterisk/agi-bin/voipiranagi 2>/dev/null
    query="REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
    mysql -hlocalhost -uroot -p"$rootpw" asterisk -e "$query" >/dev/null 2>&1
    echo "**Queue Survey Module Added." >> "$LOG_FILE"
}

function vtiger() {
    curl -L -o VOIZ-Vtiger.zip https://github.com/voipiran/VOIZ-Vtiger/archive/master.zip 2>/dev/null || { echo "Failed to download Vtiger."; exit 1; }
    unzip -o VOIZ-Vtiger.zip 2>/dev/null
    cd VOIZ-Vtiger-master 2>/dev/null
    yes | cp -rf * "$WWW_DIR/html/vtiger/" 2>/dev/null
    cd ..
    chmod -R 755 "$WWW_DIR/html/vtiger" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/vtiger" 2>/dev/null
    if ! mysql -uroot -p"$rootpw" -e 'use voipirancrm' >/dev/null 2>&1; then
        mysql -uroot -p"$rootpw" -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;" >/dev/null 2>&1
        mysql -uroot -p"$rootpw" -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';" >/dev/null 2>&1
        [ -f "VOIZ-Vtiger-master/vtiger.sql" ] && mysql -uroot -p"$rootpw" voipirancrm < VOIZ-Vtiger-master/vtiger.sql >/dev/null 2>&1
    fi
    [ -f "$WWW_DIR/html/vtiger/config.inc.php" ] && sed -i "s/123456/$rootpw/g" "$WWW_DIR/html/vtiger/config.inc.php" >/dev/null 2>&1
    [ -f VOIZ-Vtiger-master/crm-menu.xml ] && issabel-menumerge VOIZ-Vtiger-master/crm-menu.xml 2>/dev/null
    rm -rf VOIZ-Vtiger.zip VOIZ-Vtiger-master 2>/dev/null
    echo "**VOIZ Vtiger CRM Installed." >> "$LOG_FILE"
}

function install_queue_panel() {
    if ! [ -d "$WWW_DIR/html/qpanel" ]; then
        rm -rf /var/www/html/qpanel >/dev/null 2>&1
        git clone https://github.com/voipiran/VOIZ-QueuePanel /var/www/html/qpanel >/dev/null 2>&1 || { echo "Failed to clone VOIZ-QueuePanel repository."; exit 1; }
        [ -f "/var/www/html/qpanel/install.sh" ] && bash "/var/www/html/qpanel/install.sh" >/dev/null 2>&1 || { echo "Failed to execute qpanel install.sh."; exit 1; }
    fi
    chmod -R 755 "$WWW_DIR/html/qpanel" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/qpanel" 2>/dev/null
    echo "**VOIZ Queue Panel Installed." >> "$LOG_FILE"
}

function install_web_phone() {
    rm -rf "$WWW_DIR/html/phone" >/dev/null 2>&1
    if ! [ -d "$WWW_DIR/html/phone" ]; then
        git clone https://github.com/voipiran/VOIZ-WebPhone /tmp/VOIZ-WebPhone >/dev/null 2>&1 || { echo "Failed to clone VOIZ-WebPhone repository."; exit 1; }
        mv /tmp/VOIZ-WebPhone/Phone "$WWW_DIR/html/phone" >/dev/null 2>&1 || { echo "Failed to move WebPhone files."; exit 1; }
        [ -f "/tmp/VOIZ-WebPhone/install.sh" ] && bash "/tmp/VOIZ-WebPhone/install.sh" >/dev/null 2>&1 || { echo "Failed to execute WebPhone install.sh."; exit 1; }
        rm -rf /tmp/VOIZ-WebPhone >/dev/null 2>&1
    fi
    chmod -R 755 "$WWW_DIR/html/phone" 2>/dev/null
    chown -R asterisk:asterisk "$WWW_DIR/html/phone" 2>/dev/null
    echo "**VOIZ Web Phone Installed." >> "$LOG_FILE"
}

function install_callerid_formatter() {
    curl -L -o /tmp/AsteriskCalleridFormatter.zip https://github.com/voipiran/AsteriskCalleridFormatter/archive/master.zip 2>/dev/null || { echo "Failed to download Asterisk Callerid Formatter."; exit 1; }
    unzip -o /tmp/AsteriskCalleridFormatter.zip -d /tmp 2>/dev/null || { echo "Failed to unzip AsteriskCalleridFormatter.zip."; exit 1; }
    mv /tmp/AsteriskCalleridFormatter-main /tmp/AsteriskCalleridFormatter 2>/dev/null || { echo "Failed to rename AsteriskCalleridFormatter-main to AsteriskCalleridFormatter."; exit 1; }
    cd /tmp/AsteriskCalleridFormatter 2>/dev/null
    chmod 755 /tmp/AsteriskCalleridFormatter/install.sh 2>/dev/null
    [ -f /tmp/AsteriskCalleridFormatter/install.sh ] && bash /tmp/AsteriskCalleridFormatter/install.sh >/dev/null 2>&1
    cd - 2>/dev/null
    rm -rf /tmp/AsteriskCalleridFormatter.zip /tmp/AsteriskCalleridFormatter 2>/dev/null
    echo "**Asterisk Callerid Formatter Installed." >> "$LOG_FILE"
}

function install_chanspy_pro() {
    curl -L -o voipiran_chanspy.zip https://github.com/voipiran/AsteriskChanSpyPro/archive/main.zip 2>/dev/null || { echo "Failed to download Asterisk ChanSpy Pro."; exit 1; }
    unzip -o voipiran_chanspy.zip 2>/dev/null
    cd AsteriskChanSpyPro-main 2>/dev/null
    [ -f install.sh ] && chmod 755 install.sh 2>/dev/null
    [ -f install.sh ] && ./install.sh -y >/dev/null 2>&1 || echo "No install.sh found, checking for install_voipiran_chansp.sh" >> "$LOG_FILE"
    [ -f install_voipiran_chansp.sh ] && chmod 755 install_voipiran_chansp.sh 2>/dev/null
    [ -f install_voipiran_chansp.sh ] && ./install_voipiran_chansp.sh -y >/dev/null 2>&1
    cd .. 2>/dev/null
    rm -rf voipiran_chanspy.zip AsteriskChanSpyPro-main 2>/dev/null
    echo "**Asterisk ChanSpy Pro Installed." >> "$LOG_FILE"
}

function htop() {
    yum install htop traceroute -y >/dev/null 2>&1
    echo "**HTOP Util Installed." >> "$LOG_FILE"
}

function sngrep() {
    yum install -y ncurses-devel libpcap-devel >/dev/null 2>&1
    curl -L -o sngrep.zip https://github.com/irontec/sngrep/archive/master.zip 2>/dev/null || { echo "Failed to download sngrep."; exit 1; }
    unzip -o sngrep.zip 2>/dev/null
    cd sngrep-master 2>/dev/null
    ./bootstrap.sh >/dev/null 2>&1
    ./configure >/dev/null 2>&1
    make >/dev/null 2>&1
    make install >/dev/null 2>&1
    cd .. 2>/dev/null
    rm -rf sngrep.zip sngrep-master 2>/dev/null
    echo "**SNGREP Util Installed." >> "$LOG_FILE"
}

function voiz_menu() {
    mv "$WWW_DIR/db/menu.db" "$WWW_DIR/db/menu.db.000" 2>/dev/null
    cp -rf voiz-installation/menu.db "$WWW_DIR/db/" 2>/dev/null
    chmod 644 "$WWW_DIR/db/menu.db" 2>/dev/null
    chown asterisk:asterisk "$WWW_DIR/db/menu.db" 2>/dev/null
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
    whiptail --title "VOIZ Installation" --msgbox "Powered by VOIPIRAN.io\nWebsites:\n - https://voipiran.io\n - https://voiz.ir\nProject Manager: Hamed Kouhfallah" 12 78
}

function menu-order() {
    issabel-menumerge callcenter-menu.xml 2>/dev/null
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
    curl -L -o callmonitoring.zip https://github.com/voipiran/IssabelCallMonitoring/archive/master.zip 2>/dev/null || { echo "Failed to download Issabel Call Monitoring."; exit 1; }
    unzip -o callmonitoring.zip 2>/dev/null
    cd IssabelCallMonitoring-main 2>/dev/null
    chmod 755 install.sh 2>/dev/null
    ./install.sh -y >/dev/null 2>&1
    cd .. 2>/dev/null
    issabel-menumerge software/control.xml 2>/dev/null
    rm -rf callmonitoring.zip IssabelCallMonitoring-main 2>/dev/null
    echo "**Issabel Call Monitoring Installed." >> "$LOG_FILE"
}

function finalize() {
    if [ -f /etc/resolv.conf.bak ]; then
        mv /etc/resolv.conf.bak /etc/resolv.conf || echo "Warning: Failed to restore resolv.conf." >> "$LOG_FILE"
    else
        echo "Warning: No resolv.conf backup found to restore." >> "$LOG_FILE"
    fi
    echo "**DNS servers restored." >> "$LOG_FILE"
    clear
    cat voiz-installation/logo.txt
    cat "$LOG_FILE"
    echo "**Installation completed and log displayed." >> "$LOG_FILE"
}

#########START#########
# Colorize output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
MAGENTA='\033[1;35m'
BOLD='\033[1m'
NC='\033[0m' # No color
clear
echo -e "${MAGENTA}###############################################################${NC}"
echo -e "${CYAN}██╗   ██╗ ██████╗ ██╗██████╗ ██╗██████╗  █████╗ ███╗   ██╗${NC}"
echo -e "${CYAN}██║   ██║██╔═══██╗██║██╔══██╗██║██╔══██╗██╔══██╗████╗  ██║${NC}"
echo -e "${CYAN}██║   ██║██║   ██║██║██████╔╝██║██████╔╝███████║██╔██╗ ██║${NC}"
echo -e "${CYAN}╚██╗ ██╔╝██║   ██║██║██╔═══╝ ██║██╔══██╗██╔══██║██║╚██╗██║${NC}"
echo -e "${CYAN} ╚████╔╝ ╚██████╔╝██║██║     ██║██║  ██║██║  ██║██║ ╚████║${NC}"
echo -e "${CYAN}  ╚═══╝   ╚═════╝ ╚═╝╚═╝     ╚═╝╚══╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝${NC}"
echo -e "${MAGENTA}###############################################################${NC}"
echo -e "${MAGENTA}                    https://voipiran.io                    ${NC}"
echo -e "${MAGENTA}###############################################################${NC}"

# اجرای تابع اولیه
initial
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

# شروع نصب با پیام ساده
COUNTER=0
{
    echo "$COUNTER"
    sleep 1

    install_sourcegaurdian
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    FILE="/etc/asterisk/extensions_custom.conf"
    LINE="[from-internal-custom]"
    if grep -qF "$LINE" "$FILE"; then
        echo "The line '$LINE' exists in the file '$FILE'." >> "$LOG_FILE"
    else
        echo "The line '$LINE' does not exist in the file '$FILE'. Adding the line." >> "$LOG_FILE"
        echo "$LINE" | tee -a "$FILE" 2>/dev/null
    fi
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    update_issabel
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    install_webmin
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    add_persian_sounds
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    install_developer
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    asterniccdr
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    add_vitenant_theme
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    edit_issabel_modules
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    asternic-callStats-lite
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    downloadable_files
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    bulkdids
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    if [ "$issabel_ver" -eq 4 ]; then
        bosssecretary
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    superfecta
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    featurecodes
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    survey
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    if [ "$CRMINSTALL" = "true" ]; then
        vtiger
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$QUEUEPANELINSTALL" = "true" ]; then
        install_queue_panel
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$WEBPHONEINSTALL" = "true" ]; then
        install_web_phone
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$CALLERIDFORMATTERINSTALL" = "true" ]; then
        install_callerid_formatter
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$CHANSPYPROINSTALL" = "true" ]; then
        install_chanspy_pro
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$OPTIMIZEDMENUS" = "true" ]; then
        optimize_menus
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$NETUTILINSTALL" = "true" ]; then
        htop
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    if [ "$NETUTILINSTALL" = "true" ]; then
        sngrep
        COUNTER=$((COUNTER + 6))
        echo "$COUNTER"
    fi

    issbel-callmonitoring
    COUNTER=$((COUNTER + 6))
    echo "$COUNTER"

    cd .. 2>/dev/null
    amportal a r >/dev/null 2>&1
    COUNTER=100
    echo "$COUNTER"
} | whiptail --gauge "یک قهوه بنوشید و منتظر بمانید. \"حامد کوه فلاح\"" 6 50 0

systemctl restart httpd >/dev/null 2>&1
finalize