#!/bin/bash

function setversion(){
version=5.2
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

function install_sourecgaurdian(){
###Install SourceGaurdian Files
cp sourceguardian/ixed.5.4.lin /usr/lib64/php/modules
cp sourceguardian/ixed.5.4ts.lin /usr/lib64/php/modules
cp /etc/php.ini /etc/php-old.ini
cp sourceguardian/php.ini /etc

}



function install_webmin(){
###Install Webmin - 1.953-1
echo "------------Installing WEBMIN-----------------"
rpm -U rpms/webmin/webmin-1.984-1.noarch.rpm >/dev/null 2>&1
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
echo "**Persian Sounds Added." >> voiz-installation.log
}

function add_vitenant_theme(){
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
#Setting  DB (Set default language to Farsi)
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

}

function edit_issabel_modules(){
###Install ISSABEL Modules - 4.2.0
#Madules
mkdir /var/www/html/modules000 >/dev/null 2>&1
cp -rf /var/www/html/modules/*  /var/www/html/modules000
#cp -avr issabelmodules/modules /var/www/html
yes | cp -arf issabelmodules/modules /var/www/html
touch -r /var/www/html/modules/*
chown -R asterisk:asterisk /var/www/html/modules/*
chown asterisk:asterisk /var/www/html/modules/
find /var/www/html/modules/ -exec touch {} \;
###Install Jalali Calendar - 4.2.0
#Calendar Shamsi(Added ver 8.0)
yes | cp -f jalalicalendar/date.php  /var/www/html/libs/
yes | cp -f jalalicalendar/params.php /var/www/html/libs/
yes | cp -rf jalalicalendar/JalaliJSCalendar /var/www/html/libs/
#Shamsi Library Makooei
yes | cp -r issabelmodules/mylib  /var/www/html/libs/
chown -R asterisk:asterisk /var/www/html/libs/mylib
mv /var/www/html/libs/paloSantoForm.class.php /var/www/html/libs/paloSantoForm.class.php.000
yes | cp -rf issabelmodules/paloSantoForm.class.php  /var/www/html/libs/

#DropDown Problem
sed -i "s/\$('.componentSelect'/\/\/\$('\.componentSelect/g" /var/www/html/admin/assets/js/pbxlib.js  >/dev/null 2>&1


###Install Jalali Date Time Lib - 4.2.0
cp -avr asteriskjalalical/jalalidate/ /etc/asterisk
#Add Persian Language TEXT
mv /var/www/html/lang/fa.lang /var/www/html/lang/fa.lang.000
cp -rf issabelmodules/fa.lang  /var/www/html/lang/
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
mysqladmin -u root -p$rootpw create qstatslite
mysql -u root -p$rootpw qstatslite < sql/qstats.sql

mysql -u root -p$rootpw -e "CREATE USER 'qstatsliteuser'@'localhost' IDENTIFIED by '$rootpw'"
mysql -u root -p$rootpw -e "GRANT select,insert,update,delete ON qstatslite.* TO qstatsliteuser"
mysql -u root -p$rootpw -e "ALTER DATABASE qstatslite CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.queue_stats CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.qname CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.qevent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;"
mysql -u root -p$rootpw -e "ALTER TABLE qstatslite.qagent CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;"

mv html /var/www/html/queue-stats
mv parselog /usr/local/parseloglite

sed -i "s/= ''/\= \'$rootpw\'/g" /var/www/html/queue-stats/config.php  >/dev/null 2>&1
sed -i "s/admin/phpconfig/g" /var/www/html/queue-stats/config.php  >/dev/null 2>&1
sed -i "s/amp111/php[onfig/g" /var/www/html/queue-stats/config.php  >/dev/null 2>&1
sed -i "s/= ''/\= \'$rootpw\'/g" /usr/local/parseloglite/config.php  >/dev/null 2>&1
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

echo "**VOIZ Feature Codes Added." >> voiz-installation.log
}

function easyvpn(){
yum install issabel-easyvpn –nogpgcheck -y  >/dev/null 2>&1

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
cat vtiger/crma* > vtiger/crm.tar.gz
yes | tar -zxvf vtiger/crm.tar.gz -C /var/www/html >/dev/null 2>&1
touch -r /var/www/html/crm/*
chmod -R 777 /var/www/html/crm

if ! mysql -uroot -p$rootpw -e 'use voipirancrm'; then
echo "-------------َADDING VTIGER DATABASE1"
mysql -uroot -p$rootpw -e "CREATE DATABASE IF NOT EXISTS voipirancrm DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;"  >/dev/null 2>&1
echo "-------------َADDING VTIGER DATABASE2"
mysql -uroot -p$rootpw -e "GRANT ALL PRIVILEGES ON voipirancrm.* TO 'root'@'localhost';"  >/dev/null 2>&1
echo "-------------َADDING VTIGER DATABASE3"
mysql -uroot -p$rootpw voipirancrm < vtiger/crm.db  >/dev/null 2>&1
fi

#Config config.inc.php file
sed -i "s/123456/$rootpw/g" /var/www/html/crm/config.inc.php  >/dev/null 2>&1
issabel-menumerge crm-menu.xml
echo "**Vtiger CRM Installed." >> voiz-installation.log
}

function webphone(){
cp -rf webphone /var/www/html
chown -R asterisk:asterisk /var/www/html/webphone/*
chown asterisk:asterisk /var/www/html/webphone/
echo "**WebPhone Module Added." >> voiz-installation.log
}

function htop(){
#Installing htop
yum install htop traceroute -y  >/dev/null 2>&1
echo "**HTOP Util Installed." >> voiz-installation.log
}

function sngrep(){
#Installing SNGREP
yum install -y git ncurses-devel libpcap-devel  >/dev/null 2>&1
git clone https://github.com/irontec/sngrep.git  >/dev/null 2>&1
cd sngrep
./bootstrap.sh
./configure
make
make install
cd ..
echo "**SNGREP Util Installed." >> voiz-installation.log
}

function voiz_menu(){
issabel-menumerge voiz-guide-menu.xml
echo "**VOIZ Guide Menu Added." >> voiz-installation.log
}

function welcome(){
whiptail --title "VOIZ Installtion" --msgbox "Powered by VOIPIRAN.io..." 8 78
}

function menu-order(){
###َAdd Callcenter Menu
issabel-menumerge callcenter-menu.xml
}



#######################
#######################
#########START#########
###Fetch DB root PASSWORD
rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf)
> voiz-installation.log
echo "VOIZ Installation Log:" >> voiz-installation.log

welcome
###SELECT FEATURES GUI
SELECTED=$(
whiptail --title "SELECT Features TO INSTALL" --checklist \
"List of Features to install" 20 100 10 \
"CRM" "ویتایگر با تقویم شمسی" ON \
"Webphone" "تلفن تحت وب" ON \
"NetworkUtilities" "SNGREP, HTOP" ON 3>&1 1>&2 2>&3
)
echo ${SELECTED[@]}


  for CHOICE in $SELECTED; do
 
  if [[ "$CHOICE" == *"CRM"* ]]
	then 
    CRMINSTALL=true
	fi
	
  if [[ "$CHOICE" == *"NetworkUtilities"* ]]
	then 
    NETUTILINSTALL=true
	fi
	
  if [[ "$CHOICE" == *"Webphone"* ]]
	then 
    WEBPHONEINSTALL=true
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

##Set Version of VOIZ
setversion
##Install Source Gaurdian Module
install_sourecgaurdian

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
bosssecretary
##Install Superfecta Module
superfecta
##Install VOIZ FeatueCodes
featurecodes

  COUNTER=$(($COUNTER+10))
  echo ${COUNTER} 

##Install Openvpn Module
easyvpn
##Install Survey
survey

  COUNTER=$(($COUNTER+10))
    echo ${COUNTER} 

echo *****************
echo $CRMINSTALL

##Install Vtiger CRM
if [ "$CRMINSTALL" = "true" ]
then 
vtiger
fi
##Install Webphone
if [ "$WEBPHONEINSTALL" = "true" ]
then 
webphone
fi

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


##Install VOIZ Guide Menu
voiz_menu


##service httpd restart  >/dev/null 2>&1
amportal a r  2>&1

COUNTER=$(($COUNTER+10))
done | whiptail --gauge "Sit back, enjoy coffee, VOIPIRAN." 6 50 ${COUNTER}



##FINISHED
clear  
cat voiz-installation/logo.txt
cat voiz-installation.log

#echo "-------------Adminer Installation----------------"
#sleep 1
#cp -rf www/adminer /var/www/html/
#issabel-menumerge adminer-menu.xml
#echo "Adminer Menu is Created Sucsessfully"

