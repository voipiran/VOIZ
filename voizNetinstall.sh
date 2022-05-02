#!/bin/bash
# Based on SAM's Elastix 4 on CentOS 7 Installation and Build Script

function generate_files
{
cat > /tmp/inst1.txt <<EOF
acl
apr
apr-util
audit
audit-libs
authconfig
autogen-libopts
basesystem
bash
bind-libs-lite
bind-license
binutils
biosdevname
btrfs-progs
bzip2-libs
ca-certificates
centos-logos
centos-release
chkconfig
chrony
compat-libtiff3
coreutils
cpio
cracklib
cracklib-dicts
cronie
cronie-noanacron
crontabs
cryptsetup-libs
cups-libs
curl
cyrus-imapd
cyrus-imapd-utils
cyrus-sasl
cyrus-sasl-lib
cyrus-sasl-plain
dbus
dbus-glib
dbus-libs
dbus-python
dhclient
dhcp
dhcp-common
dhcp-libs
dialog
diffutils
dmidecode
dnsmasq
dracut
dracut-config-rescue
dracut-network
e2fsprogs
e2fsprogs-libs
ebtables
elfutils-libelf
elfutils-libs
epel-release
ethtool
expat
festival
festival-lib
festival-speechtools-libs
festvox-slt-arctic-hts
file
file-libs
filesystem
findutils
fipscheck
fipscheck-lib
firewalld
flac-libs
fprintd-pam
fontconfig
fontpackages-filesystem
freetype
fxload
gawk
gdbm
gdbm-devel
gettext
gettext-libs
ghostscript
ghostscript-fonts
glib2
glibc
glibc-common
glibc-devel
glibc-headers
glib-networking
gmp
gnupg2
gnutls
gobject-introspection
gpgme
gpm-libs
grep
groff-base
grub2
grub2-efi
grub2-tools
grubby
gsettings-desktop-schemas
gsm
gzip
hardlink
hdparm
hostname
httpd
httpd-tools
hwdata
info
initscripts
iproute
iprutils
iptables
iptables-services
iptables-devel
iputils
irqbalance
jansson
jbigkit-libs
json-c
kbd
kbd-misc
kernel
kernel-devel
kernel-headers
kernel-tools
kernel-tools-libs
kexec-tools
keyutils-libs
kpartx
krb5-libs
lcms2
less
libacl
libaio
libao
libassuan
libasyncns
libattr
libblkid
libcap
libcap-ng
libcom_err
libcroco
libcurl
libdaemon
libdb
libdb-devel
libdb-utils
libdrm
libedit
libestr
libffi
libfontenc
libgcc
libgcrypt
libgomp
libgpg-error
libgudev1
libICE
libidn
libjpeg-turbo
libmnl
libmodman
libmount
libndp
libnetfilter_conntrack
libnfnetlink
libnl3
libnl3-cli
libogg
libpcap
libpciaccess
libpipeline
libpng
libproxy
libpwquality
libreport-filesystem
libselinux
libselinux-python
libselinux-utils
libsemanage
libsepol
libSM
libsndfile
libsoup
libss
libssh2
libstdc++
libsysfs
libtasn1
libteam
libtiff
libtiff-devel
libtiff-tools
libtool-ltdl
libunistring
libusb
libusbx
libuser
libutempter
libuuid
libverto
libvorbis
libX11
libX11-common
libXau
libxcb
libXext
libXfont
libXi
libxml2
libXpm
libxslt
libXt
libXtst
libzip
linux-firmware
lm_sensors-libs
lockdev
logrotate
lua
lvm2
lvm2-libs
lzo
mailcap
mailman
mailx
make
man-db
mariadb
mariadb-libs
mariadb-server
mdadm
memtest86+
mgetty
microcode_ctl
ModemManager-glib
mod_ssl
mokutil
mozjs17
mtools
MySQL-python
ncurses
ncurses-base
ncurses-libs
net-snmp-agent-libs
net-snmp-libs
nettle
net-tools
newt
newt-python
nmap
nmap-ncat
nspr
nss
nss-softokn
nss-softokn-freebl
nss-sysinit
nss-tools
nss-util
ntp
ntpdate
numactl-libs
openldap
openssh
openssh-clients
openssh-server
openssl
openssl-libs
opus
os-prober
p11-kit
p11-kit-trust
pam
parted
passwd
pciutils
pciutils-libs
pcre
perl
perl-Archive-Tar
perl-Business-ISBN
perl-Business-ISBN-Data
perl-Carp
perl-CGI
perl-Compress-Raw-Bzip2
perl-Compress-Raw-Zlib
perl-constant
perl-Crypt-OpenSSL-Bignum
perl-Crypt-OpenSSL-Random
perl-Crypt-OpenSSL-RSA
perl-Data-Dumper
perl-Date-Manip
perl-DBD-MySQL
perl-DB_File
perl-DBI
perl-devel
perl-Digest
perl-Digest-HMAC
perl-Digest-MD5
perl-Digest-SHA
perl-Encode
perl-Encode-Detect
perl-Encode-Locale
perl-Error
perl-Exporter
perl-ExtUtils-Install
perl-ExtUtils-MakeMaker
perl-ExtUtils-Manifest
perl-ExtUtils-ParseXS
perl-FCGI
perl-File-Listing
perl-File-Path
perl-File-Temp
perl-Filter
perl-Getopt-Long
perl-HTML-Parser
perl-HTML-Tagset
perl-HTTP-Cookies
perl-HTTP-Daemon
perl-HTTP-Date
perl-HTTP-Message
perl-HTTP-Negotiate
perl-HTTP-Tiny
perl-IO-Compress
perl-IO-HTML
perl-IO-Socket-INET6
perl-IO-Socket-IP
perl-IO-Socket-SSL
perl-IO-Zlib
perl-libs
perl-libwww-perl
perl-LWP-MediaTypes
perl-macros
perl-Mail-DKIM
perl-Mail-IMAPClient
perl-Mail-SPF
perl-MailTools
perl-NetAddr-IP
perl-Net-Daemon
perl-Net-DNS
perl-Net-HTTP
perl-Net-LibIDN
perl-Net-SMTP-SSL
perl-Net-SSLeay
perl-Package-Constants
perl-parent
perl-Parse-RecDescent
perl-PathTools
perl-PlRPC
perl-Pod-Escapes
perl-podlators
perl-Pod-Perldoc
perl-Pod-Simple
perl-Pod-Usage
perl-Scalar-List-Utils
perl-Socket
perl-Socket6
perl-Storable
perl-Sys-Syslog
perl-Test-Harness
perl-Text-ParseWords
perl-threads
perl-threads-shared
perl-TimeDate
perl-Time-HiRes
perl-Time-Local
perl-URI
perl-version
perl-WWW-RobotRules
php
php-bcmath
php-cli
php-common
php-gd
php-imap
php-mbstring
php-mcrypt
php-mysql
php-pdo
php-pear
php-process
php-soap
php-tcpdf
php-tidy
php-xml
pinentry
pkgconfig
plymouth
plymouth-core-libs
plymouth-scripts
policycoreutils
polkit
polkit-pkla-compat
poppler-data
popt
portreserve
postfix
postgresql-libs
ppp
procmail
procps-ng
psmisc
pth
pulseaudio-libs
pygobject3-base
pygpgme
pyliblzma
pyOpenSSL
python
python-backports
python-backports-ssl_match_hostname
python-configobj
python-crypto
python-decorator
python-ecdsa
python-iniparse
python-libs
python-lockfile
python-pycurl
python-pyudev
python-setuptools
python-six
python-slip
python-slip-dbus
python-sqlalchemy
python-tempita
python-urlgrabber
pytz
pyxattr
qrencode-libs
readline
rootfiles
rpm
rpm-build-libs
rpm-libs
rpm-python
rsyslog
sed
selinux-policy
selinux-policy-targeted
setup
shadow-utils
shared-mime-info
sharutils
shim
shim-unsigned
slang
snappy
sox
spamassassin
spandsp
spandsp-devel
speex
sqlite
sudo
syslinux
systemd
systemd-libs
systemd-sysv
systemtap-sdt-devel
sysvinit-tools
t1lib
tar
tcp_wrappers-libs
teamd
tftp-server
tuned
tzdata
unixODBC
urw-fonts
ustr
util-linux
uuid
uuid-perl
vim-common
vim-enhanced
vim-filesystem
vim-minimal
virt-what
vsftpd
wavpack
which
wpa_supplicant
xfsprogs
xinetd
xorg-x11-font-utils
xz
xz-libs
yum
yum-metadata-parser
yum-plugin-fastestmirror
zlib
pv
unzip
certbot
python2-certbot
python2-certbot-apache
EOF

cat > /tmp/inst2.txt <<EOF
acl
aic94xx-firmware
alsa-firmware
alsa-lib
alsa-tools-firmware
apr
apr-util
asterisk$ASTVER
asterisk$ASTVER-devel
asterisk-codec-g729
asterisk-perl
asterisk-es-sounds
asterisk-fr-sounds
asterisk-sounds-en-gsm
asterisk-pt_BR-sounds
audit
audit-libs
authconfig
autogen-libopts
avahi
avahi-autoipd
avahi-libs
basesystem
bash
bind-libs-lite
bind-license
binutils
biosdevname
btrfs-progs
bzip2-libs
ca-certificates
centos-logos
centos-release
chkconfig
chrony
compat-libtiff3
coreutils
cpio
cracklib
cracklib-dicts
cronie
cronie-noanacron
crontabs
cryptsetup-libs
cups-libs
curl
cyrus-imapd
cyrus-imapd-utils
cyrus-sasl
cyrus-sasl-lib
cyrus-sasl-plain
dahdi
dahdi-linux
dbus
dbus-glib
dbus-libs
dbus-python
device-mapper
device-mapper-event
device-mapper-event-libs
device-mapper-libs
device-mapper-persistent-data
dhclient
dhcp
dhcp-common
dhcp-libs
dialog
diffutils
dmidecode
dnsmasq
dracut
dracut-config-rescue
dracut-network
e2fsprogs
e2fsprogs-libs
ebtables
issabel-system
issabel-framework
issabel-framework-themes-extra
issabel-addons
issabel-agenda
issabel-asterisk-sounds
issabel-email_admin
issabel-endpointconfig2
issabel-extras
issabel-fax
issabel-firstboot
issabel-license
issabel-my_extension
issabel-pbx
issabel-portknock
issabel-reports
issabel-security
issabel-prosody-auth
elfutils-libelf
elfutils-libs
epel-release
ethtool
expat
festival
festival-lib
festival-speechtools-libs
festvox-slt-arctic-hts
file
file-libs
filesystem
findutils
fipscheck
fipscheck-lib
firewalld
flac-libs
fontconfig
fontpackages-filesystem
freetype
fxload
gawk
gdbm
gdbm-devel
gettext
gettext-libs
ghostscript
ghostscript-fonts
glib2
glibc
glibc-common
glibc-devel
glibc-headers
glib-networking
gmp
gnupg2
gnutls
gobject-introspection
gpgme
gpm-libs
grep
groff-base
grub2
grub2-efi
grub2-tools
grubby
gsettings-desktop-schemas
gsm
gzip
hardlink
hdparm
hostname
httpd
httpd-tools
hwdata
hylafax
iaxmodem
iksemel
info
initscripts
iproute
iprutils
iptables
iptables-services
iptables-devel
iputils
irqbalance
ivtv-firmware
iwl1000-firmware
iwl100-firmware
iwl105-firmware
iwl135-firmware
iwl2000-firmware
iwl2030-firmware
iwl3160-firmware
iwl3945-firmware
iwl4965-firmware
iwl5000-firmware
iwl5150-firmware
iwl6000-firmware
iwl6000g2a-firmware
iwl6000g2b-firmware
iwl6050-firmware
iwl7260-firmware
jansson
jbigkit-libs
json-c
kbd
kbd-misc
kernel
kernel-devel
kernel-headers
kernel-tools
kernel-tools-libs
kexec-tools
keyutils-libs
kpartx
krb5-libs
lcdissabel
lcdproc
lcms2
less
libacl
libaio
liballogsmat
libao
libassuan
libasyncns
libattr
libblkid
libcap
libcap-ng
libc-client
libcom_err
libcroco
libcurl
libdaemon
libdb
libdb-devel
libdb-utils
libdrm
libedit
libertas-sd8686-firmware
libertas-sd8787-firmware
libertas-usb8388-firmware
libestr
libffi
libfontenc
libgcc
libgcrypt
libgomp
libgpg-error
libgsmat
libgudev1
libICE
libidn
libjpeg-turbo
libmcrypt
libmnl
libmodman
libmount
libndp
libnetfilter_conntrack
libnfnetlink
libnl3
libnl3-cli
libogg
libopenr2
libpcap
libpciaccess
libpipeline
libpng
libpri
libproxy
libpwquality
libreport-filesystem
libselinux
libselinux-python
libselinux-utils
libsemanage
libsepol
libSM
libsndfile
libsoup
libsrtp
libss
libss7
libssh2
libstdc++
libsysfs
libtasn1
libteam
libtidy
libtiff
libtiff-devel
libtiff-tools
libtool-ltdl
libunistring
libusb
libusbx
libuser
libutempter
libuuid
libverto
libvorbis
libwat
libX11
libX11-common
libXau
libxcb
libXext
libXfont
libXi
libxml2
libXpm
libxslt
libXt
libXtst
libzip
linux-firmware
lm_sensors-libs
lockdev
logrotate
lua
lvm2
lvm2-libs
lzo
mailcap
mailman
make
man-db
mariadb
mariadb-libs
mariadb-server
mdadm
memtest86+
mgetty
microcode_ctl
ModemManager-glib
mod_ssl
mokutil
mozjs17
mtools
MySQL-python
mysql-to-mariadb-server
ncurses
ncurses-base
ncurses-libs
net-snmp-agent-libs
net-snmp-libs
nettle
net-tools
newt
newt-python
nmap
nmap-ncat
nspr
nss
nss-softokn
nss-softokn-freebl
nss-sysinit
nss-tools
nss-util
ntp
ntpdate
numactl-libs
openldap
openssh
openssh-clients
openssh-server
openssl
openssl-libs
opus
os-prober
p11-kit
p11-kit-trust
pam
parted
passwd
pciutils
pciutils-libs
pcre
perl
perl-Archive-Tar
perl-Business-ISBN
perl-Business-ISBN-Data
perl-Carp
perl-CGI
perl-Compress-Raw-Bzip2
perl-Compress-Raw-Zlib
perl-constant
perl-Convert-BinHex
perl-Crypt-OpenSSL-Bignum
perl-Crypt-OpenSSL-Random
perl-Crypt-OpenSSL-RSA
perl-Data-Dumper
perl-Date-Manip
perl-DBD-MySQL
perl-DB_File
perl-DBI
perl-devel
perl-Digest
perl-Digest-HMAC
perl-Digest-MD5
perl-Digest-SHA
perl-Encode
perl-Encode-Detect
perl-Encode-Locale
perl-Error
perl-Exporter
perl-ExtUtils-Install
perl-ExtUtils-MakeMaker
perl-ExtUtils-Manifest
perl-ExtUtils-ParseXS
perl-FCGI
perl-File-Listing
perl-File-Path
perl-File-Temp
perl-Filter
perl-Getopt-Long
perl-HTML-Parser
perl-HTML-Tagset
perl-HTTP-Cookies
perl-HTTP-Daemon
perl-HTTP-Date
perl-HTTP-Message
perl-HTTP-Negotiate
perl-HTTP-Tiny
perl-IO-Compress
perl-IO-HTML
perl-IO-Socket-INET6
perl-IO-Socket-IP
perl-IO-Socket-SSL
perl-IO-Zlib
perl-libs
perl-libwww-perl
perl-LWP-MediaTypes
perl-macros
perl-Mail-DKIM
perl-Mail-IMAPClient
perl-Mail-SPF
perl-MailTools
perl-MIME-tools
perl-NetAddr-IP
perl-Net-Daemon
perl-Net-DNS
perl-Net-HTTP
perl-Net-LibIDN
perl-Net-SMTP-SSL
perl-Net-SSLeay
perl-Package-Constants
perl-parent
perl-Parse-RecDescent
perl-PathTools
perl-PlRPC
perl-Pod-Escapes
perl-podlators
perl-Pod-Perldoc
perl-Pod-Simple
perl-Pod-Usage
perl-Scalar-List-Utils
perl-Socket
perl-Socket6
perl-Storable
perl-Sys-Syslog
perl-Test-Harness
perl-Text-ParseWords
perl-threads
perl-threads-shared
perl-TimeDate
perl-Time-HiRes
perl-Time-Local
perl-URI
perl-version
perl-WWW-RobotRules
php
php-bcmath
php-cli
php-common
php-gd
php-IDNA_Convert
php-imap
php-jpgraph
php-magpierss
php-mbstring
php-mcrypt
php-mysql
php-pdo
php-pear
php-pear-DB
php-PHPMailer
php-process
php-simplepie
php-Smarty
php-soap
php-tcpdf
php-tidy
php-xml
pinentry
pkgconfig
plymouth
plymouth-core-libs
plymouth-scripts
policycoreutils
polkit
polkit-pkla-compat
poppler-data
popt
portreserve
postfix
postgresql-libs
ppp
procmail
procps-ng
psmisc
pth
pulseaudio-libs
py-Asterisk
pygobject3-base
pygpgme
pyliblzma
pyOpenSSL
python
python-backports
python-backports-ssl_match_hostname
python-cjson
python-configobj
python-crypto
python-daemon
python-decorator
python-ecdsa
python-eventlet
python-greenlet
python-iniparse
python-libs
python-lockfile
python-paramiko
python-pycurl
python-pyudev
python-setuptools
python-six
python-slip
python-slip-dbus
python-sqlalchemy
python-tempita
python-urlgrabber
pytz
pyxattr
qrencode-libs
readline
rhino
rootfiles
RoundCubeMail
rpm
rpm-build-libs
rpm-libs
rpm-python
rsyslog
sed
selinux-policy
selinux-policy-targeted
setup
shadow-utils
shared-mime-info
sharutils
shim
shim-unsigned
slang
snappy
sox
spamassassin
spandsp
spandsp-devel
speex
sqlite
sudo
syslinux
systemd
systemd-libs
systemd-sysv
systemtap-sdt-devel
sysvinit-tools
t1lib
tar
tcp_wrappers-libs
teamd
tftp-server
tuned
tzdata
unixODBC
urw-fonts
ustr
util-linux
uuid
uuid-perl
vim-common
vim-enhanced
vim-filesystem
vim-minimal
virt-what
vsftpd
wavpack
which
wpa_supplicant
xfsprogs
xinetd
xorg-x11-font-utils
xz
xz-libs
yum
yum-metadata-parser
yum-plugin-fastestmirror
zlib
gcc
gcc-c++
automake
unzip
pv
zip
wget
iptables-devel
perl-Text-CSV_XS
certbot
python2-certbot
python2-certbot-apache
xtables-addons
EOF
}

function settings
{
  if [ ! "$TERM" = "xterm-256color" ]
  then 
    export NCURSES_NO_UTF8_ACS=1
  fi
  BACKTITLE="Issabel 4 netinstall"
  #Shut off SElinux & Disable firewall if running.
  setenforce 0
  sed -i 's/\(^SELINUX=\).*/\SELINUX=disabled/' /etc/selinux/config

  # Some distros may already ship with an existing asterisk group. Create it here
  # if the group does not yet exist (with the -f flag).
  /usr/sbin/groupadd -f -r asterisk

  # At this point the asterisk group must already exist
  if ! grep -q asterisk: /etc/passwd ; then
      echo -e "Adding new user asterisk..."
      /usr/sbin/useradd -r -g asterisk -c "Asterisk PBX" -s /bin/bash -d /var/lib/asterisk asterisk
  fi
}

function welcome
{
  dialog --stdout --sleep 2 --backtitle "$BACKTITLE" \
         --infobox " O @ @\n @ @ O\n @ O O\n   O\nIssabel" \
        7 11
}

function sel_astver
{
  ASTVER=$(dialog --no-items --backtitle "$BACKTITLE" \
           --radiolist "Select Asterisk version:" 10 40 3 \
           11  off \
           13  off \
           16  on \
           3>&1 1>&2 2>&3)
  if [ $? -ne 0 ]
  then
    dialog --stdout --sleep 3 --backtitle "$BACKTITLE" \
           --infobox "Install cancelled by user\n\n:(" \
          7 31
    clear
    cleanup
    exit
  fi
}

function add_repos
{
cat > /etc/yum.repos.d/Issabel.repo <<EOF
[issabel-base]
name=Base RPM Repository for Issabel
mirrorlist=http://mirror.issabel.org/?release=4&arch=\$basearch&repo=base
#baseurl=http://repo.issabel.org/issabel/4/base/\$basearch/
gpgcheck=0
enabled=1
gpgkey=http://repo.issabel.org/issabel/RPM-GPG-KEY-Issabel

[issabel-updates]
name=Updates RPM Repository for Issabel
mirrorlist=http://mirror.issabel.org/?release=4&arch=\$basearch&repo=updates
#baseurl=http://repo.issabel.org/issabel/4/updates/\$basearch/
gpgcheck=0
enabled=1
gpgkey=http://repo.issabel.org/issabel/RPM-GPG-KEY-Issabel

[issabel-updates-sources]
name=Updates RPM Repository for Issabel
mirrorlist=http://mirror.issabel.org/?release=4&arch=\$basearch&repo=updates
#baseurl=http://repo.issabel.org/issabel/4/updates/SRPMS/
gpgcheck=0
enabled=1
gpgkey=http://repo.issabel.org/issabel/RPM-GPG-KEY-Issabel

[issabel-beta]
name=Beta RPM Repository for Issabel
mirrorlist=http://mirror.issabel.org/?release=4&arch=\$basearch&repo=beta
baseurl=http://repo.issabel.org/issabel/4/beta/\$basearch/
#gpgcheck=1
enabled=0
#gpgkey=http://repo.issabel.org/issabel/RPM-GPG-KEY-Issabel

[issabel-extras]
name=Extras RPM Repository for Issabel
mirrorlist=http://mirror.issabel.org/?release=4&arch=\$basearch&repo=extras
#baseurl=http://repo.issabel.org/issabel/4/extras/\$basearch/
gpgcheck=1
enabled=1
gpgkey=http://repo.issabel.org/issabel/RPM-GPG-KEY-Issabel

EOF

cat > /etc/yum.repos.d/commercial-addons.repo <<EOF

[commercial-addons]
name=Commercial-Addons RPM Repository for Issabel
mirrorlist=http://mirror.issabel.org/?release=4&arch=$basearch&repo=commercial_addons
gpgcheck=1
enabled=1
gpgkey=http://repo.issabel.org/issabel/RPM-GPG-KEY-Issabel

EOF

}

function additional_packages
{
  ADDPKGS=""
  OPTS=$(dialog --backtitle "$BACKTITLE" --no-tags \
        --checklist "Choose additional package(s) to install:" 0 0 0 \
        1 "Issabel Network Licensed modules(http://issabel.guru)" off \
        2 "Community Realtime Block List(block SIP attacks from known offenders)" off \
        3 "Sangoma wanpipe drivers" off \
        3>&1 1>&2 2>&3)
  if [ $? -ne 0 ]
  then
    dialog --stdout --sleep 3 --backtitle "$BACKTITLE" \
           --infobox "Install cancelled by user\n\n:(" \
          7 31
    clear
    cleanup
    exit
  fi
  for i in $OPTS
  do
    case $i in
      1)
      ADDPKGS="$ADDPKGS issabel-license webconsole issabel-wizard issabel-packet_capture issabel-upnpc \
      issabel-two_factor_auth issabel-theme_designer issabel-network-agent"
      ;;
      2)
      ADDPKGS="$ADDPKGS issabel-packetbl"
      ;;
      3)
      ADDPKGS="$ADDPKGS wanpipe-utils wanpipe"
      ;;
    esac
  done
}

function yum_gauge
{
  PACKAGES=$1 #Space separated list of packages.
  TITLE=$2 #Window title
  YUMCMD=$3 #install / update
  dialog --backtitle "$BACKTITLE" --title "$TITLE" --gauge "Installing..." 10 75 < <(
   # Get total number of packages
  n=$(echo $PACKAGES | wc -w); 

   # set counter - it will increase every-time a rpm install
   i=0

   #
   # Start the for loop 
   #
   # read each package from $PACKAGES array 
   # $f has filename 
   for p in $PACKAGES
   do
      # calculate progress
      PCT=$(( 100*(++i)/n ))

      # update dialog box 
cat <<EOF
XXX
$PCT
Installing "$p"...
XXX
EOF
    rpm --quiet -q $p
    if [ $? -ne 0 ] || [ "$YUMCMD" = "update" ]
    then
      if ! yum $BETAREPO --nogpg -y $YUMCMD $p &>/dev/null
      then
         echo "$p: ERROR installing package" >> /tmp/netinstall_errors.txt
      fi
    fi
  done
)
}

function update_os
{
  PACKAGES=$(yum -d 0 list updates | tail -n +2 | cut -d' ' -f1) &> /dev/null
  yum_gauge "$PACKAGES" "Yum update" update
}

function install_packages
{
  yum clean all &> /dev/null
  PACKAGES=$(cat /tmp/inst1.txt)
  yum_gauge "$PACKAGES" "(1/2) Please wait..." install
  PACKAGES=$(cat /tmp/inst2.txt)
  yum_gauge "$PACKAGES $ADDPKGS" "(2/2) Please wait..." install
}

function post_install
{
  (
  systemctl enable mariadb.service
  systemctl start mariadb
  mysql -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('iSsAbEl.2o17')"
  #Shut off SElinux and Firewall. Be sure to configure it in Issabel!
  setenforce 0
  sed -i 's/\(^SELINUX=\).*/\SELINUX=disabled/' /etc/selinux/config
  cp -a /etc/sysconfig/iptables /etc/sysconfig/iptables.org-issabel-"$(/bin/date "+%Y-%m-%d-%H-%M-%S")"
  systemctl enable httpd
  systemctl disable firewalld
  systemctl stop firewalld
  firewall-cmd --zone=public --add-port=443/tcp --permanent
  firewall-cmd --reload
  rm -f /etc/issabel.conf
  mysql -piSsAbEl.2o17 -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('')"

  #patch config files
  echo "noload => cdr_mysql.so" >> /mnt/sysimage/etc/asterisk/modules_additional.conf
  mkdir -p /var/log/asterisk
  mkdir -p /var/log/asterisk/cdr-csv
  mv /etc/asterisk/extensions_custom.conf.sample /etc/asterisk/extensions_custom.conf
  /usr/sbin/amportal chown
  ) &> /dev/null
}

function check_dialog
{
  echo -e "Looking for dialog...\n\n"
  if ! dialog  &> /dev/null
  then
    echo -e "Not found\n"
    echo -e "Installing dialog...\n\n"
    yum -y install dialog
    if [ $? -ne 0 ]
    then
      echo -e "\n***yum install dialog FAILED***\n\n"
    fi
    if ! dialog > /dev/null
    then
      echo -e "Dialog is requiered\n"
      exit
    fi
  fi
}

function enable_beta()
{
  dialog --title "Are you feeling brave?" --defaultno \
  --backtitle "$BACKTITLE" \
  --yesno "Enable Beta repository?(not recommended for production)" 7 60
  if [ $? -eq 0 ]
  then
      return 0
  fi
  return 1
}

function set_passwords()
{
  /usr/bin/issabel-admin-passwords --init
}

function cleanup()
{
(
  rm -f /tmp/inst1.txt
  rm -f /tmp/inst2.txt
  /usr/sbin/amportal chown
) &> /dev/null
}

function bye()
{
  dialog --stdout --sleep 2 --backtitle "$BACKTITLE" --infobox \
"             O @ @\n             @ @ O\n             @ O O\n               O\n            Issabel \n\nRebooting server, log back in in a minute..." \
  10 35
}

function install_voiz()
{

  echo -e "Installing VOIZ...\n\n"
  yum install git -y && rm -rf voiz && git clone https://github.com/voipiran/voiz.git && cd voiz && chmod 777 installVoizOnIssabel.sh && ./installVoizOnIssabel.sh
  echo -e "Installing VOIZ...\n\n"

}

check_dialog
settings
welcome
sel_astver
additional_packages
generate_files
add_repos
if enable_beta
then
    BETAREPO="--enablerepo=issabel-beta"
fi
welcome
update_os
install_packages
post_install
set_passwords
cleanup
install_voiz
bye
reboot
