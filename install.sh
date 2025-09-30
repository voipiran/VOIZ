#!/bin/bash
issabel_ver=$(php -r 'echo PHP_MAJOR_VERSION;')
##FUNCTIONS
function setversion(){
version=5.6
#Set VOIZ tag
file="/etc/voiz.conf"
if [ -f "$file" ]
then
    #find version and replace
sed -i -e "s/.*version.*/version=$version/g" /etc/voiz.conf
else
cp voiz-installation/voiz.conf /etc
    sed -i -e "s/.*version.*/version=$version/g" /etc/voiz.conf
fi
}
function install_sourcegaurdian() {
    issabel_ver=$(php -r 'echo PHP_MAJOR_VERSION;') # Assuming issabel_ver holds PHP major version (e.g., 5 or 7)
    if [ "$issabel_ver" -eq 5 ]; then
        echo "PHP 5 detected. Performing action A."
        echo "Install SourceGuardian Files"
        echo "------------Copy SourceGuard-----------------"
        yes | cp -rf sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
        yes | cp -rf sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
        yes | cp -rf /etc/php.ini /etc/php-old.ini
        yes | cp -rf sourceguardian/php5.ini /etc/php.ini
        echo "SourceGuardian Files have moved successfully"
        sleep 1
    else
        echo "PHP 7 (or newer) detected. Performing action B."
        echo "Install SourceGuardian Files"
        echo "------------Copy SourceGuard-----------------"
        yes | cp -rf sourceguardian/ixed.7.4.lin /usr/lib64/php/modules
        yes | cp -rf /etc/php.ini /etc/php-old.ini
        yes | cp -rf sourceguardian/php7.ini /etc/php.ini
        echo "SourceGuardian Files have moved successfully"
        systemctl reload php-fpm > /dev/null
    fi
}
function install_webmin(){
###Install Webmin - 1.953-1
echo "------------Installing WEBMIN-----------------"
rpm -U rpms/webmin/webmin-2.111-1.noarch.rpm >/dev/null 2>&1
echo "**WEBMIN Util Installed." >> voiz-installation.log
}
function install_developer(){
echo "------------Installing Issabel DEVELOPER-----------------"
rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm >/dev/null 2>&1
echo "**Developer Module Installed." >> voiz-installation.log
}
function add_persian_sounds(){
###Install Persian Language Sounds - 4.2.0
echo "Add Persian Language"
sed -e "/language=pr/d" /etc/asterisk/sip_custom.conf > /etc/asterisk/sip_custom.conf.000 >/dev/null 2>&1
echo >> /etc/asterisk/sip_custom.conf.000
echo language=pr >> /etc/asterisk/sip_custom.conf.000
cp -f /etc/asterisk/sip_custom.conf.000 /etc/asterisk/sip_custom.conf
sed -e "/language=pr/d" /etc/asterisk/iax_custom.conf > /etc/asterisk/iax_custom.conf.000 >/dev/null 2>&1
echo >> /etc/asterisk/iax_custom.conf.000
echo language=pr >> /etc/asterisk/iax_custom.conf.000
cp -f /etc/asterisk/iax_custom.conf.000 /etc/asterisk/iax_custom.conf
#Add Say.conf
cp -rf persiansounds/say.conf /etc/asterisk
chmod 777 /etc/asterisk/say.conf
chown asterisk:asterisk /etc/asterisk/say.conf
#Add Perisan Sounds Folder
FILE=/var/lib/asterisk/sounds/pr
#if [ ! -d "$FILE" ]; then
yes | cp -ar persiansounds/pr/ /var/lib/asterisk/sounds
chmod -R 777 /var/lib/asterisk/sounds/pr
chown -R asterisk:asterisk /var/lib/asterisk/sounds/pr
#fi
if [ "$issabel_ver" -eq 5 ]; then
sed -e "/language=pr/d" /etc/asterisk/pjsip_custom.conf > /etc/asterisk/pjsip_custom.conf.000 >/dev/null 2>&1
echo >> /etc/asterisk/pjsip_custom.conf.000
echo language=pr >> /etc/asterisk/pjsip_custom.conf.000
cp -f /etc/asterisk/pjsip_custom.conf.000 /etc/asterisk/pjsip_custom.conf
fi
echo "**Persian Sounds Added." >> voiz-installation.log
}
function add_vitenant_theme(){
echo "------------Installing VOIPIRAN Theme-----------------"
sleep 1
###Install RTL Theme Sounds - 4.2.0
#Add voiz Favicon
cp -f theme/favicon.ico /var/www/html
touch -r /var/www/html/*
#Installing Theme
cp -rf theme/vitenant /var/www/html/themes/
touch -r /var/www/html/themes/*
touch -r /var/www/html/themes/vitenant/*
#Setting DB (Set default language to Farsi)
#Set Persian Langugae and Theme as Default
  if [ "$Lang" = "Persian" ]
  then
    sqlite3 /var/www/db/settings.db "update settings set value='fa' where key='language';"
    sqlite3 /var/www/db/settings.db "update settings set value='vitenant' where key='theme';"
    echo "**Persian Theme Added." >> voiz-installation.log
  fi
  if [ "$Lang" = "English" ]
  then
    sqlite3 /var/www/db/settings.db "update settings set value='en' where key='language';"
    sqlite3 /var/www/db/settings.db "update settings set value='tenant' where key='theme';"
    echo "**English Theme Added." >> voiz-installation.log
  fi
###Apply changes to PBX Configuration
# Path to the CSS file
CSS_FILE="/var/www/html/admin/assets/css/mainstyle.css"
CSS_FILE_2="/var/www/html/admin/assets/css/bulma.min.css"
# Search and replace color codes using sed
#sed -i 's/#562d7b/#6AB04C/g' "$CSS_FILE"
#sed -i 's/#4B0884/#218c74/g' "$CSS_FILE"
#sed -i 's/#A992DC/#badc58/g' "$CSS_FILE"
#sed -i 's/#485fc7/#2d3436/g' "$CSS_FILE_2"
yes | cp -rf theme/pbxconfig/css /var/www/html/admin/assets >/dev/null 2>&1
chmod -R 777 /var/www/html/admin/assets/css
chown -R asterisk:asterisk /var/www/html/admin/assets/css
yes | cp -rf theme/pbxconfig/images/issabelpbx_small.png /var/www/html/admin/images/
chmod -R 777 /var/www/html/admin/images/issabelpbx_small.png
yes | cp -rf theme/pbxconfig/images/tango.png /var/www/html/admin/images/
chmod -R 777 /var/www/html/admin/images/tango.png
yes | cp -rf theme/pbxconfig/footer_content.php /var/www/html/admin/views
chmod -R 777 /var/www/html/admin/views/footer_content.php
chown -R asterisk:asterisk /var/www/html/admin/views/footer_content.php
}
function edit_issabel_modules(){
###Install ISSABEL Modules - 4.2.0
#Madules
mkdir /var/www/html/modules000 >/dev/null 2>&1
cp -rf /var/www/html/modules/* /var/www/html/modules000
#cp -avr issabelmodules/modules /var/www/html
yes | cp -arf issabelmodules/modules /var/www/html
touch -r /var/www/html/modules/*
chown -R asterisk:asterisk /var/www/html/modules/*
chown asterisk:asterisk /var/www/html/modules/
find /var/www/html/modules/ -exec touch {} \;
###Install Jalali Calendar - 4.2.0
#Calendar Shamsi(Added ver 8.0)
yes | cp -f jalalicalendar/date.php /var/www/html/libs/
yes | cp -f jalalicalendar/params.php /var/www/html/libs/
yes | cp -rf jalalicalendar/JalaliJSCalendar /var/www/html/libs/
#Shamsi Library Makooei
yes | cp -r issabelmodules/mylib /var/www/html/libs/
chown -R asterisk:asterisk /var/www/html/libs/mylib
mv /var/www/html/libs/paloSantoForm.class.php /var/www/html/libs/paloSantoForm.class.php.000
yes | cp -rf issabelmodules/paloSantoForm.class.php /var/www/html/libs/
#DropDown Problem
sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" /var/www/html/admin/assets/js/pbxlib.js >/dev/null 2>&1
###Install Jalali Date Time Lib - 4.2.0
cp -avr asteriskjalalical/jalalidate/ /etc/asterisk
#Add Persian Language TEXT
mv /var/www/html/lang/fa.lang /var/www/html/lang/fa.lang.000
cp -rf issabelmodules/fa.lang /var/www/html/lang/
}
function downloadable_files(){
###Install Downloadable Files - 4.2.0
#copy Download Folder
cp -rf downloadable/download /var/www/html/
    echo "**Downloadable Files Added." >> voiz-installation.log
}
function bulkdids(){
if [ ! -d "/var/www/html/admin/modules/bulkdids" ]; then
#BULK DIDs Module
yes | cp -rf issabelpbxmodules/bulkdids /var/www/html/admin/modules/
amportal a ma install bulkdids
fi
    echo "**Bulk DIDs Module Added." >> voiz-installation.log
}
function asterniccdr(){
  if [ ! -d "/var/www/html/admin/modules/asternic_cdr" ]; then
#BULK DIDs Module
yes | cp -rf issabelpbxmodules/asternic_cdr /var/www/html/admin/modules/
amportal a ma install asternic_cdr
fi
    echo "**asternic_cdr Module Added." >> voiz-installation.log
}
function asternic-callStats-lite(){
cd software
tar zvxf asternic-stats-1.8.tgz
cd asternic-stats
mysqladmin -u root -p$rootpw create qstatslite 2>/dev/null
mysql -u root -p$rootpw qstatslite < sql/qstats.sql 2>/dev/null
mysql -u root -p$rootpw -e "CREATE USER 'qstatsliteuser'@'localhost' IDENTIFIED by '$rootpw'" 2>/dev/null
mysql -u root -p$rootpw -e "GRANT select,insert,update,delete ON qstatslite.* TO qstatsliteuser" 2>/dev/null
mysql -u root -p$rootpw -e "ALTER DATABASE qstatslite CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.queue_stats CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.qname CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.qevent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.qagent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;" 2>/dev/null
yes | cp -rf html /var/www/html/queue-stats
yes | cp -rf parselog /usr/local/parseloglite
sed -i "s/= ''/\= \'$rootpw\'/g" /var/www/html/queue-stats/config.php >/dev/null 2>&1
sed -i "s/admin/phpconfig/g" /var/www/html/queue-stats/config.php >/dev/null 2>&1
sed -i "s/amp111/php[onfig/g" /var/www/html/queue-stats/config.php >/dev/null 2>&1
sed -i "s/= ''/\= \'$rootpw\'/g" /usr/local/parseloglite/config.php >/dev/null 2>&1
(crontab -l ; echo "*/15 * * * * php -q /usr/local/parseloglite/parselog.php convertlocal") | crontab -
cd ..
issabel-menumerge asternic.xml
cd ..
}
function bosssecretary(){
if [ ! -d "/var/www/html/admin/modules/bosssecretary" ]; then
#bosssecretary Module
yes | cp -rf issabelpbxmodules/bosssecretary /var/www/html/admin/modules/
amportal a ma install bosssecretary
fi
    echo "**Boss Secretary Module Added." >> voiz-installation.log
}
function superfecta(){
if [ ! -d "/var/www/html/admin/modules/superfecta" ]; then
#superfecta Module
yes | cp -rf issabelpbxmodules/superfecta /var/www/html/admin/modules/
amportal a ma install superfecta
fi
echo "**Supper Fecta Module Added." >> voiz-installation.log
}
function featurecodes(){
cp -rf customdialplan/extensions_voipiran_featurecodes.conf /etc/asterisk/
sed -i '/\[from\-internal\-custom\]/a include \=\> voipiran\-features' /etc/asterisk/extensions_custom.conf
echo "" >> /etc/asterisk/extensions_custom.conf
echo "#include extensions_voipiran_featurecodes.conf" >> /etc/asterisk/extensions_custom.conf
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATETIME-Jalali','VOIZ-بیان تاریخ و زمان شمسی','*200',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*200'"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATE-Jalali','VOIZ-بیان تاریخ به شمسی','*201',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*201'"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-TIME-Jalali','VOIZ-بیان زمان به فارسی','*202',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*202'"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chanspy-Simple','VOIZ-شنود ساده، کد + شماره مقصد','*30',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Whisper','VOIZ-شنود و نجوا، کد + شماره مقصد','*31',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Only-Listen','VOIZ-شنود صدای کارشناس، کد + شماره مقصد','*32',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Private-Whisper','VOIZ-صحبت با کارشناس بدون شنود، کد + شماره مقصد','*33',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Barge','VOIZ-شنود و مکالمه با هر دو طرف، کد + شماره مقصد','*34',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-DTMF','VOIZ-شنود و تغییر حالت شنود حین مکالمه با 4 و 5 و 6، کد + شماره مقصد','*35',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query" >/dev/null 2>&1
echo "**VOIZ Feature Codes Added." >> voiz-installation.log
}
function easyvpn(){
yum install issabel-easyvpn –nogpgcheck -y >/dev/null 2>&1
echo "**OpenVPN Module Added." >> voiz-installation.log
}
function survey(){
cp -rf voipiranagi /var/lib/asterisk/agi-bin
chmod -R 777 /var/lib/asterisk/agi-bin/voipiranagi
query="REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"
echo "**Queue Survey Module Added." >> voiz-installation.log
}
function vtiger(){
#yes | cp -arf vtiger/crm /var/www/html
#cat vtiger/crma* > vtiger/crm.tar.gz
#yes | tar -zxvf vtiger/crm.tar.gz -C /var/www/html >/dev/null 2>&1
cat vtiger/crm.zip* > vtiger/crm.zip
yes | unzip -o vtiger/crm.zip -d vtiger >/dev/null 2>&1
yes | unzip -o vtiger/crm.zip -d /var/www/html >/dev/null 2>&1
touch -r /var/www/html/crm/*
chmod -R 777 /var/www/html/crm
if ! mysql -uroot -p$rootpw -e 'use voipirancrm' >/dev/null 2>&1; then
    echo "-------------َADDING VTIGER DATABASE1"
    mysql -uroot -p$rootpw -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;" >/dev/null 2>&1
    echo "-------------َADDING VTIGER DATABASE2"
    mysql -uroot -p$rootpw -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';" >/dev/null 2>&1
    echo "-------------َADDING VTIGER DATABASE3"
    mysql -uroot -p$rootpw voipirancrm < vtiger/crm.db >/dev/null 2>&1
fi
#Config config.inc.php file
sed -i "s/123456/$rootpw/g" /var/www/html/crm/config.inc.php >/dev/null 2>&1
issabel-menumerge crm-menu.xml
echo "**Vtiger CRM Installed." >> voiz-installation.log
}
function install_web_phone_panel(){
git clone https://github.com/voipiran/webphone.git /tmp/webphone
cp -r /tmp/webphone/* /var/www/html/
rm -rf /tmp/webphone
chown -R asterisk:asterisk /var/www/html/webphone
chmod -R 755 /var/www/html/webphone
echo "**Web Phone Panel installed." >> voiz-installation.log
}
function install_callerid_formatter(){
git clone https://github.com/voipiran/callerid-formatter.git /tmp/callerid-formatter
cp -r /tmp/callerid-formatter/* /var/www/html/
rm -rf /tmp/callerid-formatter
chown -R asterisk:asterisk /var/www/html/callerid-formatter
chmod -R 755 /var/www/html/callerid-formatter
echo "**CallerID Formatter installed." >> voiz-installation.log
}
function install_queue_dashboard(){
git clone https://github.com/voipiran/queue-dashboard.git /tmp/queue-dashboard
cp -r /tmp/queue-dashboard/* /var/www/html/
rm -rf /tmp/queue-dashboard
chown -R asterisk:asterisk /var/www/html/queue-dashboard
chmod -R 755 /var/www/html/queue-dashboard
echo "**Queue Dashboard installed." >> voiz-installation.log
}
function htop(){
#Installing htop
yum install htop traceroute -y >/dev/null 2>&1
echo "**HTOP Util Installed." >> voiz-installation.log
}
function sngrep(){
#Installing SNGREP
yum install -y git ncurses-devel libpcap-devel >/dev/null 2>&1
git clone https://github.com/irontec/sngrep.git >/dev/null 2>&1
cd sngrep
./bootstrap.sh
./configure
make
make install
cd ..
echo "**SNGREP Util Installed." >> voiz-installation.log
}
function voiz_menu(){
#issabel-menumerge voiz-guide-menu.xml
mv /var/www/db/menu.db /var/www/db/menu.db.000
cp -rf voiz-installation/menu.db /var/www/db/
chown asterisk:asterisk /var/www/db/menu.db
echo "**VOIZ Guide Menu Added." >> voiz-installation.log
}
function set_cid(){
####Install Source Gaurdian Files
echo "------------START-----------------"
# Get PHP version
php_version=$(php -r "echo PHP_MAJOR_VERSION;")
# Perform actions based on PHP version
if [ "$php_version" -eq 5 ]; then
    echo "PHP 5 detected. Performing action A."
sleep 1
else
    echo "PHP 7 (or newer) detected. Performing action B."
####Add from-internal-custom
# File to check
FILE="/etc/asterisk/extensions_custom.conf"
# Line to search for
LINE="[from-internal-custom]"
    # Check if the line exists in the file
    if grep -qF "$LINE" "$FILE"; then
       echo "The line '$LINE' exists in the file '$FILE'."
    else
        echo "The line '$LINE' does not exist in the file '$FILE'. Adding the line."
       echo "$LINE" | sudo tee -a "$FILE"
    fi
sleep 1
fi
sleep 1
#NumberFormater
echo "" >> /etc/asterisk/extensions_custom.conf
echo ";;VOIPIRAN.io" >> /etc/asterisk/extensions_custom.conf
echo "#include extensions_voipiran_numberformatter.conf" >> /etc/asterisk/extensions_custom.conf
yes | cp -rf software/extensions_voipiran_numberformatter.conf /etc/asterisk
chown -R asterisk:asterisk /etc/asterisk/extensions_voipiran_numberformatter.conf
chmod 777 /etc/asterisk/extensions_voipiran_numberformatter.conf
### Add from-pstn Context
echo "" >> /etc/asterisk/extensions_custom.conf
echo ";;VOIPIRAN.io" >> /etc/asterisk/extensions_custom.conf
echo "[to-cidformatter]" >> /etc/asterisk/extensions_custom.conf
echo "exten => _.,1,Set(IS_PSTN_CALL=1)" >> /etc/asterisk/extensions_custom.conf
echo "exten => _.,n,NoOp(start-from-pstn)" >> /etc/asterisk/extensions_custom.conf
echo "exten => _.,n,Gosub(numberformatter,s,1)" >> /etc/asterisk/extensions_custom.conf
echo "exten => _.,n,NoOp(end-from-pstn)" >> /etc/asterisk/extensions_custom.conf
echo "exten => _.,n,Goto(from-pstn,s,1)" >> /etc/asterisk/extensions_custom.conf
echo "**Set CID Module Added." >> voiz-installation.log
}
function welcome(){
whiptail --title "VOIZ Installtion" --msgbox "Powered by VOIPIRAN.io..." 8 78
}
function menu-order(){
###َAdd Callcenter Menu
issabel-menumerge callcenter-menu.xml
}
function install-on-issabel(){
echo "**install-on-issabel" >> voiz-installation.log
yum --enablerepo=issabel-beta update -y
}
function install-on-centos(){
echo "**install-on-centos" >> voiz-installation.log
}
function install-on-nightly(){
echo "**install-on-rocky" >> voiz-installation.log
yum update -y
}
function update_issabel(){
echo "**install-on-issabel" >> voiz-installation.log
yum update -y 2>/dev/null
}
function issbel-callmonitoring(){
curl -L -o callmonitoring.zip https://github.com/voipiran/IssabelCallMonitoring/archive/master.zip && \
unzip -o callmonitoring.zip && \
cd IssabelCallMonitoring-main && \
chmod 755 install.sh && \
yes | ./install.sh
issabel-menumerge software/control.xml
}
#########START#########
issabel_ver=5
###Fetch DB root PASSWORD
echo "185.51.200.2 mirrors.fedoraproject.org" | sudo tee -a /etc/hosts
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)
> voiz-installation.log
echo "VOIZ Installation Log:" >> voiz-installation.log
# Get PHP version
php_version=$(php -r "echo PHP_MAJOR_VERSION;")
# Perform actions based on PHP version
if [ "$php_version" -eq 5 ]; then
issabel_ver=5
else
issabel_ver=4
fi
###Welcome
welcome
###SELECT FEATURES GUI
SELECTED=$(whiptail --title "SELECT Features TO INSTALL" --checklist \
"List of Features to install" 20 100 10 \
"NetworkUtilities" "SNGREP, HTOP" ON \
"WebPhone" "Web Phone Panel" ON \
"CallerIDFormatter" "CallerID Formatter" ON \
"QueueDashboard" "Queue Dashboard" ON \
"Vtiger CRM" "ویتایگر با تقویم شمسی" OFF 3>&1 1>&2 2>&3)
# تبدیل به آرایه واقعی با eval
eval "ARRAY=($SELECTED)"
# دیباگ
echo "Selected: ${ARRAY[@]}"
# بررسی انتخاب‌ها
for CHOICE in "${ARRAY[@]}"; do
  if [[ "$CHOICE" == *"CRM"* ]]; then
    CRMINSTALL=true
  fi
  if [[ "$CHOICE" == *"NetworkUtilities"* ]]; then
    NETUTILINSTALL=true
  fi
  if [[ "$CHOICE" == *"WebPhone"* ]]; then
    WEBPHONEINSTALL=true
  fi
  if [[ "$CHOICE" == *"CallerIDFormatter"* ]]; then
    CALLERIDFORMATTERINSTALL=true
  fi
  if [[ "$CHOICE" == *"QueueDashboard"* ]]; then
    QUEUEDASHBOARDINSTALL=true
  fi
done
###SELECT LNGUAGE GUI
Lang=$(whiptail --title "Choose VOIZ Theme Style:" --menu "Choose a Language" 25 78 5 \
"Persian" "پوسته و محیط فارسی به همراه تقویم شمسی" \
"English" "پوسته و محیط انگلیسی به همراه تقویم شمسی" 3>&1 1>&2 2>&3)
 COUNTER=0
 while [[ ${COUNTER} -le 100 ]]; do
   sleep 1
   COUNTER=$(($COUNTER+10))
   echo ${COUNTER}
# #YUM UPDATE ISSABEL to BETA
# if [ "$INSTALLONISSABEL" = "true" ]
# then
# install-on-issabel
# fi
##Set Version of VOIZ
setversion
##Install Source Gaurdian Module
install_sourcegaurdian
##Edit Extension_custom.conf
# File to check
FILE="/etc/asterisk/extensions_custom.conf"
# Line to search for
LINE="[from-internal-custom]"
    # Check if the line exists in the file
    if grep -qF "$LINE" "$FILE"; then
       echo "The line '$LINE' exists in the file '$FILE'."
    else
        echo "The line '$LINE' does not exist in the file '$FILE'. Adding the line."
       echo "$LINE" | sudo tee -a "$FILE"
    fi
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install Webmin
install_webmin
##Copy Persian Sounds
add_persian_sounds
##Install Developer Module
install_developer
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install Asternic CDR
asterniccdr
##Install Persian Theme
add_vitenant_theme
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Copy Issabel Edited Modules
edit_issabel_modules
#asternic-callStats-lite
asternic-callStats-lite
##Coppy Downloadable Files
downloadable_files
##Install Bulk DIDs Module
bulkdids
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install BossSecretory Module
if [ "$issabel_ver" -eq 4 ]; then
bosssecretary
fi
##Install Superfecta Module
superfecta
##Install VOIZ FeatueCodes
featurecodes
  COUNTER=$(($COUNTER+10))
  echo ${COUNTER}
##Install Openvpn Module
#easyvpn
##Install Survey
survey
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install Vtiger CRM
if [ "$CRMINSTALL" = "true" ]; then
  vtiger
fi
##Install Web Phone Panel
if [ "$WEBPHONEINSTALL" = "true" ]; then
  install_web_phone_panel
fi
##Install CallerID Formatter
if [ "$CALLERIDFORMATTERINSTALL" = "true" ]; then
  install_callerid_formatter
fi
##Install Queue Dashboard
if [ "$QUEUEDASHBOARDINSTALL" = "true" ]; then
  install_queue_dashboard
fi
set_cid
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install Htop
if [ "$NETUTILINSTALL" = "true" ]
then
htop
fi
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install SNGREP
if [ "$NETUTILINSTALL" = "true" ]
then
sngrep
fi
  COUNTER=$(($COUNTER+10))
    echo ${COUNTER}
##Install IssabelCallMonitoring
issbel-callmonitoring
cd ..
##Install VOIZ Guide Menu
#voiz_menu
##service httpd restart >/dev/null 2>&1
amportal a r 2>&1
COUNTER=$(($COUNTER+10))
done | whiptail --gauge "Sit back, enjoy coffee, VOIPIRAN." 6 50 ${COUNTER}
##FINISHED
systemctl restart httpd >/dev/null 2>&1
clear
cat voiz-installation/logo.txt
cat voiz-installation.log
#echo "-------------Adminer Installation----------------"
#sleep 1
#cp -rf www/adminer /var/www/html/
#issabel-menumerge adminer-menu.xml
#echo "Adminer Menu is Created Sucsessfully"