## VOIZ
 Persian Unified Communication 


## Instalation (نصب)
There are two ways to install VOIZ.

### 1. How to Install on Issabel ISO:
-install issabel iso file with Asterisk 16 or 18

-update issabel
```
yum update
```
-Run This command on your Linux CLI:
```
yum install git -y && rm -rf voiz && git clone https://github.com/voipiran/voiz.git && cd voiz && chmod 777 installVoizOnIssabel.sh && ./installVoizOnIssabel.sh
```

### 2. How to  Netinstall (install on centos7 minimal):
-install Centos7 Minimal:
-Run This command on your Linux CLI:
```
curl https://github.com/voipiran/VOIZ/blob/main/voizNetinstall.sh | bash
```


## Documents (مطالب راهنما و آموزش)

https://forum.voipiran.io/t/voiz-documents


## TODO List (امکانات آینده)
- [ ] Add Documentations Menu
- [ ] Add Vtiger CRM Popup on Incomming Calls
- [ ] Transfer Webmin and Download file to Menus
- [ ] Define Default SIP Trunks
- [ ] add Installation GUI
- [ ] Improve English Theme
- [ ] Configure Linux Firewall and set APIBAN
- [ ] Show Faxes by Groups
- [ ] Add Glances System Monitoring Tools
- [X] Add Webrtc Webphone
- [X] VOIZ Installation script on Centos7 minimal


## Features (امکانات سیستم تلفنی ویز، اضافه شده به ایزابل)

فارسی سازی:

دارای تقویم شمسی برای گزارش گیری بخش های ضبط مکالمات، ریز مکالمات، صنوق صوتی و مشاهده فکس
دارای  پوسته theme راست چین و کاملا مناسب انجام پروژه های داخل ایران
دارای متون فارسی برای تمامی بخش ها و البته به جز بخش تنظیمات تلفنی که به دلیل اصطلاحات تخصصی از همان متون انگلیسی استفاده شده است.
دارای بسته فارسی پیام های صوتی استریسک Asterisk که توسط ویپ ایران ارائه شده است.
اضافه شدن فایل  بیان تاریخ به فارسی که استریسک Asterisk به صورت پینش فرض فاقد آن است، این امکان برای کسانی که برنامه نویسی می کنند الزامی است.
ماژول ها و امکانات تلفنی:

اضافه شدن ماژول ساخت گروهی تماس های ورودی Bulk DID به تنظیمات تلفنی. ** با این ماژول امکان ساخت گروهی Inbound Route را خواهید داشت.
اضافه شدن ماژول مدیر منشی به تنظیمات تلفنی. ** با این ماژول امکان پیاده سازی سناریو معروف مدیر منشی در ایزابل امکان پذیر می شود.
اضافه شدن ماژول Superfecta برای به روز رسانی کالر آی دی تماس گیرنده از منابع مختلف
اضافه شدن ماژول Development که امکان ساخت منو جدید برای ایزابل و یا تغییر متون ایزابل را می دهد.
اضافه شدن سه Feature Code جدید، بیان تاریخ و زمان به شمسی، بیان تاریخ به شمسی و بیان زمان به فارسی
امکان ارسال فکس به یک گزینه بر روی IVR شرکت مقابل
 سایر:

نرم افزار ارتباط با مشتری ویتایگر فارسی
برنامه htop برای نظارت بر استفاده از منابع بر روی لینوکس
حذف پیام پاپ آپ رجیستر کردن ایزابل Issabel که بعد از ورود به محیط وب باز می شود.
نصب برنامه Webmin و دسترسی به دنیایی از امکانات برای اعمال تغییرات در لینوکس
قرار گرفتن نسخه قابل اجرا از برنامه Windcp بر روی سرور VOIZ، ** این امکان کمک بسیاری به راحتی نصب سیستم تلفنی یا پشتیبانی می کند.
قرار گرفتن نسخه قابل اجرا از برنامه سافت فون Microsip بر روی سرور VOIZ، ** این امکان کمک بسیاری به راحتی نصب سیستم تلفنی یا پشتیبانی می کند.
قرار گرفتن نسخه قابل اجرا از برنامه Putty  بر روی سرور VOIZ، ** این امکان کمک بسیاری به راحتی نصب سیستم تلفنی یا پشتیبانی می کند.
نصب برنامه EasyVPN که یک محیط گرافیکی برای راه اندازی Open VPN Server است.

