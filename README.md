## VOIZ
 Persian Unified Communication 


## Instalation (نصب)

### How to Install on Issabel ISO:
1)-install issabel iso file with Asterisk 16 or 18 (It is highly recommended o install Nightly ISO and choose Asterisk18).

```
Download Issabel Nightly ISO File:
[Issabel ISO](https://sourceforge.net/projects/issabelpbx/files/Issabel%204/issabel4-NIGHTLY-AST18-USB-DVD-x86_64-20211207.iso/download)
```

2)-update issabel: 
```
yum update
```

3)-Run This command on your Linux CLI:
```
yum install git -y && rm -rf voiz && git clone https://github.com/voipiran/voiz.git && cd voiz && chmod 777 install.sh && ./install.sh
```


## Documents (مطالب راهنما و آموزش)

https://forum.voipiran.io/t/voiz-documents


## Features (امکانات)
###Added to Issabel.

* New Queue Stats Report.
* New CDR Reports.
* New ChanSpy Feature Codes (*30,*31).
* New Say Current DateTime in Persian Feature Code (*200,*201,*202).
* Added Persian and RTL Theme.
* New Webphone (Webrtc Phone).
* Added Queue Survey (the reaults shows on CDR Report).
* Added Bult DID Module.
* Added SuperFecta Module.
* Added Development Module.
* Added Asterisk Persian Sounds.
* Added Vtiger CRM with Persian Calendar.
* Added Persian Calendar to Reports.
* Added Webmin Linux Web Manager.
* Added EasyVPN Module (OpenVPN Module).

###Others

* Issabel Registration Popup Removed.
* Added Putty, Winscp, Microsip Runable to Download via Web UI.

## TODO List (امکانات آینده)
- [ ] Add Documentations Menu
- [ ] Transfer Webmin and Download file to Menus
- [ ] Define Default SIP Trunks
- [ ] add Installation GUI
- [ ] VOIZ Installation script on Centos7 minimal
- [ ] Improve English Theme
- [ ] Configure Linux Firewall and set APIBAN
- [ ] Show Faxes by Groups
- [ ] Add Glances System Monitoring Tools
- [ ] Add Webrtc Webphone
