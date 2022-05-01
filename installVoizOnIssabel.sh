#!/bin/bash
version=4.5
echo "Install voipiran VOIZ PBX"
echo "VOIPIRAN.io"
echo "VOIPIRAN VOIZ Version $version"
sleep 1

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

###Fetch DB root PASSWORD
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)

echo "------------START-----------------"
echo "     "
echo "     "
echo "------------Copy SourceGaurdian-----------------"
sleep 1
###Install SourceGaurdian Files
cp sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
cp sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
cp /etc/php.ini /etc/php-old.ini
cp sourceguardian/php.ini /etc
echo "SourceGuardian Files have Moved Sucsessfully"
sleep 1

###Install Webmin - 1.953-1
echo "     "
echo "     "
echo "------------Installing WEBMIN-----------------"
sleep 1
rpm -U rpms/webmin/webmin-1.984-1.noarch.rpm

###Install Webmin - 4.0.0-3
echo "     "
echo "     "
echo "------------Installing Issabel DEVELOPER-----------------"
sleep 1
rpm -U rpms/develop/issabel-developer-4.0.0-3.noarch.rpm

echo "     "
echo "     "
echo "------------Installing Persian Language Sounds-----------------"
sleep 1
###Install Persian Language Sounds - 4.2.0
echo "Add Persian Language"
sed -e "/language=pr/d" /etc/asterisk/sip_custom.conf > /etc/asterisk/sip_custom.conf.000 >/dev/null 2>&1
echo    >> /etc/asterisk/sip_custom.conf.000
echo language=pr >> /etc/asterisk/sip_custom.conf.000
cp -f /etc/asterisk/sip_custom.conf.000 /etc/asterisk/sip_custom.conf

sed -e "/language=pr/d" /etc/asterisk/iax_custom.conf > /etc/asterisk/iax_custom.conf.000 >/dev/null 2>&1
echo    >> /etc/asterisk/iax_custom.conf.000
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


echo "     "
echo "     "
echo "------------Installing VOIPIRAN Theme-----------------"
sleep 1
###Install RTL Theme Sounds - 4.2.0

#Add voiz Favicon
cp -f theme/favicon.ico  /var/www/html
touch -r /var/www/html/*

#Installing  Theme
cp -rf theme/vitenant /var/www/html/themes/
touch -r /var/www/html/themes/*
touch -r /var/www/html/themes/vitenant/*

###Install Modules and Web Languages - 4.2.0

#Add Persian Language TEXT
mv /var/www/html/lang/fa.lang /var/www/html/lang/fa.lang.000
cp -rf issabelmodules/fa.lang  /var/www/html/lang/

#Madules
mkdir /var/www/html/modules000 >/dev/null 2>&1
cp -rf /var/www/html/modules/*  /var/www/html/modules000
#cp -avr issabelmodules/modules /var/www/html
yes | cp -arf issabelmodules/modules /var/www/html
touch -r /var/www/html/modules/*
chown -R asterisk:asterisk /var/www/html/modules/*
chown asterisk:asterisk /var/www/html/modules/
find /var/www/html/modules/ -exec touch {} \;

#Setting  DB (Set default language to Farsi)
#Set Persian Langugae and Theme as Default
sqlite3 /var/www/db/settings.db "update settings set value='fa' where key='language';"
sqlite3 /var/www/db/settings.db "update settings set value='vitenant' where key='theme';"

###Install Downloadable Files - 4.2.0

#copy Download Folder
cp -rf downloadable/download /var/www/html/


###Install Jalali Calendar - 4.2.0

#Calendar Shamsi(Added ver 8.0)
cp -f jalalicalendar/date.php  /var/www/html/libs/
cp -f jalalicalendar/params.php /var/www/html/libs/
cp -rf jalalicalendar/JalaliJSCalendar /var/www/html/libs/


###Install Jalali Date Time Lib - 4.2.0
cp -avr asteriskjalalical/jalalidate/ /etc/asterisk

echo "     "
echo "     "
echo "------------Installing IssabelPBX Modules-----------------"
sleep 1
###Install IssabelPBX Modules - 4.2.0

if [ ! -d "/var/www/html/admin/modules/bulkdids" ]; then
#BULK DIDs Module
yes | cp -rf issabelpbxmodules/bulkdids /var/www/html/admin/modules/
amportal a ma install bulkdids
fi

if [ ! -d "/var/www/html/admin/modules/bosssecretary" ]; then
#bosssecretary Module
yes | cp -rf issabelpbxmodules/bosssecretary /var/www/html/admin/modules/
amportal a ma install bosssecretary
fi

if [ ! -d "/var/www/html/admin/modules/superfecta" ]; then
#superfecta Module
yes | cp -rf issabelpbxmodules/superfecta /var/www/html/admin/modules/
amportal a ma install superfecta
fi

#echo "-------------Adminer Installation----------------"
#sleep 1
#cp -rf www/adminer /var/www/html/
#issabel-menumerge adminer-menu.xml
#echo "Adminer Menu is Created Sucsessfully"

###Install Issabel FEATURES CODES Jalali DateTime - 4.2.0
echo "     "
echo "     "
echo "-------------VOIPIRAN FEATURES CODES----------------"
sleep 1
cp -rf customdialplan/extensions_voipiran_featurecodes.conf /etc/asterisk/
sed -i '/\[from\-internal\-custom\]/a include \=\> voipiran\-features' /etc/asterisk/extensions_custom.conf
echo "" >> /etc/asterisk/extensions_custom.conf
echo "#include extensions_voipiran_featurecodes.conf" >> /etc/asterisk/extensions_custom.conf

query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATETIME-Jalali','VOIZ-بیان تاریخ و زمان شمسی','*200',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*200'"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-DATE-Jalali','VOIZ-بیان تاریخ به شمسی','*201',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*201'"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Say-TIME-Jalali','VOIZ-بیان زمان به فارسی','*202',NULL,'1','1') ON DUPLICATE KEY UPDATE defaultcode = '*202'"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chanspy-Simple','VOIZ-شنود ساده، کد + شماره مقصد','*30',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"
query="insert into featurecodes (modulename,featurename,description,defaultcode,customcode,enabled,providedest) VALUES('core','Chansyp-Whisper','VOIZ-شنود و نجوا، کد + شماره مقصد','*31',NULL,'1','1')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"

echo "     "
echo "     "
echo "-------------Installing EsayVPN Module----------------"
sleep 1
yum install issabel-easyvpn –nogpgcheck -y

echo "     "
echo "-------------Installing VOIPIRAN Survey----------------"
sleep 1
cp -rf voipiranagi /var/lib/asterisk/agi-bin
chmod -R 777 /var/lib/asterisk/agi-bin/voipiranagi

query="REPLACE INTO miscdests (id,description,destdial) VALUES('101','نظرسنجی-ویز','4454')"
mysql -hlocalhost -uroot -p$rootpw asterisk -e "$query"


echo "     "
echo "     "
echo "-------------Installing VTIGER CRM----------------"
sleep 1
#yes | cp -arf vtiger/crm /var/www/html
cat vtiger/crma* > vtiger/crm.tar.gz
yes | tar -zxvf vtiger/crm.tar.gz -C /var/www/html >/dev/null 2>&1
touch -r /var/www/html/crm/*
chmod -R 777 /var/www/html/crm

if ! mysql -uroot -p$rootpw -e 'use voipirancrm'; then
echo "-------------َADDING VTIGER DATABASE1"
mysql -uroot -p$rootpw -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;"
echo "-------------َADDING VTIGER DATABASE2"
mysql -uroot -p$rootpw -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';"
echo "-------------َADDING VTIGER DATABASE3"
mysql -uroot -p$rootpw voipirancrm < vtiger/crm.db
fi

#Config config.inc.php file
sed -i "s/123456/$rootpw/g" /var/www/html/crm/config.inc.php  >/dev/null 2>&1
issabel-menumerge crm-menu.xml

echo "     "
echo "     "
echo "-------------Installing Network Utils----------------"
#Installing htop
yum install htop traceroute -y

#Installing SNGREP
yum install -y git ncurses-devel libpcap-devel
git clone https://github.com/irontec/sngrep.git
cd sngrep
./bootstrap.sh
./configure
make
make install
cd ..


echo "     "
echo "-------------Apache Restart----------------"
sleep 1
service httpd restart
echo "Apache has Restarted Sucsessfully"
sleep 1

echo "     "
echo "-------------Amportal Restart----------------"
amportal a r  2>&1


echo "-----------FINISHED (voipiran.io)-----------"


 