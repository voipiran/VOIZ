<div align="center">

# VOIZ

### Persian Unified Communication for Issabel

[![Version](https://img.shields.io/badge/version-6.0.0-0f766e?style=for-the-badge)](CHANGELOG.md)
[![Platform](https://img.shields.io/badge/platform-Issabel%20%7C%20Asterisk-2563eb?style=for-the-badge)](https://www.issabel.org/)
[![License](https://img.shields.io/github/license/voipiran/VOIZ?style=for-the-badge)](LICENSE)
[![Latest Commit](https://img.shields.io/github/last-commit/voipiran/VOIZ?style=for-the-badge)](https://github.com/voipiran/VOIZ/commits/main)

</div>

## معرفی

**ویز (VOIZ)** یک بسته بومی و توسعه‌یافته برای فارسی‌سازی، تکمیل و عملیاتی‌کردن سیستم تلفنی **Issabel / Asterisk** است. این پروژه توسط **ویپ ایران** و با توسعه و راهبری **حامد کوه‌فلاح** شکل گرفته و به‌صورت متن‌باز منتشر می‌شود.

VOIZ امکانات ارزشمند و کاربردی متعددی را به ایزابل اضافه می‌کند؛ از رابط کاربری فارسی و تقویم شمسی تا ابزارهای مرکز تماس، گزارش‌گیری، تلفن تحت وب، مدیریت تماس و امکانات مورد نیاز تیم‌های فروش و پشتیبانی. هدف پروژه این است که یک زیرساخت تلفنی قدرتمند، قابل توسعه و متناسب با نیاز کاربران فارسی‌زبان فراهم کند.

**Voiz Contact Center** نیز یک مرکز تماس متن‌باز است که برای استفاده در کنار Asterisk / Issabel توسعه داده می‌شود و می‌تواند امکانات مدیریتی، پایش زنده، صف، گزارش و ارتباط با کارشناسان را در اختیار سازمان‌ها قرار دهد.

- وب‌سایت ویپ ایران: <https://voipiran.io>
- مستندات و آموزش‌ها: <https://voiz.ir>
- مخزن مرکز تماس: <https://github.com/voipiran/voiz-contact-center>

## نصب سریع

### پیش‌نیاز

- نصب Issabel 4 یا Issabel 5 با Asterisk 16 یا 18
- دسترسی `root`
- اتصال اینترنت روی سرور
- اجرای دستورها روی سیستم‌عامل خود Issabel

### نصب VOIZ روی Issabel

ابتدا سیستم را به‌روزرسانی کنید:

```bash
yum update -y
```

سپس آخرین نسخه VOIZ را دریافت و نصب کنید:

```bash
rm -rf voiz && \
curl -fL https://github.com/voipiran/VOIZ/archive/refs/heads/main.tar.gz -o voiz.tar.gz && \
tar -xzf voiz.tar.gz && \
mv VOIZ-main voiz && \
cd voiz && \
chmod +x install.sh && \
./install.sh
```

> نصب‌کننده باید با کاربر `root` اجرا شود. پیش از اجرا از فایل‌های تنظیمات و دیتابیس Issabel نسخه پشتیبان تهیه کنید.

### نصب Voiz Contact Center

مرکز تماس یک پروژه مستقل است و نصب آن از مخزن اختصاصی انجام می‌شود:

```bash
cd /opt && \
rm -rf voiz-contact-center voiz-contact-center.tar.gz && \
curl -fL https://github.com/voipiran/voiz-contact-center/archive/refs/heads/main.tar.gz \
  -o voiz-contact-center.tar.gz && \
tar -xzf voiz-contact-center.tar.gz && \
mv voiz-contact-center-main voiz-contact-center && \
cd voiz-contact-center && \
sudo bash install.sh
```

همین دستور از داخل گزینه `VOIZ ContactCenter` در منوی نصب تعاملی VOIZ نیز اجرا می‌شود. در صورت شکست نصب یا ایجادنشدن فایل‌های اصلی `/opt/OpDesk`، نتیجه ناموفق گزارش خواهد شد.

جزئیات پیش‌نیازهای مرکز تماس، تنظیم AMI، HTTPS، پورت‌ها و سرویس `opdesk` در مستندات همان مخزن قرار دارد.

### نصب Issabel Call Center 5

برای نصب مرکز تماس کلاسیک Issabel 5 از پروژه [callcenter-issabel5](https://github.com/voipiran/callcenter-issabel5)، فقط این دستور را روی سرور Issabel و با کاربر `root` اجرا کنید:

```bash
bash <(curl -fsSL "https://raw.githubusercontent.com/voipiran/callcenter-issabel5/master/install-voipiran.sh?nocache=$(date +%s)")
```

این نصب‌کننده مخزن رسمی را دریافت می‌کند، نسخه سازگار با Issabel 5 را نصب می‌کند، سرویس `issabeldialer` را فعال می‌کند و وضعیت سرویس را بررسی می‌کند. نصب آن از گزینه `Issabel Callcenter CE` در منوی نصب VOIZ نیز قابل انتخاب است. لاگ این بخش در مسیر زیر ذخیره می‌شود:

```text
/var/log/voipiran-issabel-callcenter-install.log
```

> `Voiz Contact Center` و `Issabel Call Center 5` دو پروژه جدا هستند. اولی پنل مدرن Voiz/OpDesk است و دومی ماژول کلاسیک Call Center برای Issabel 5.

### نصب Asternic Call Stats Lite

گزینه `Asternic Call Stats Lite` در نصب‌کننده VOIZ، مخزن
[voipiran/asternic-stats-lite](https://github.com/voipiran/asternic-stats-lite) را
در مسیر `/usr/src/asternic-stats-lite` دریافت کرده و `install.sh` همان مخزن را
اجرا می‌کند. نصب‌کننده رمز ریشه MySQL را از `/etc/issabel.conf` می‌خواند و
موارد زیر را تنظیم می‌کند:

- دیتابیس و کاربر `qstatslite`
- فایل‌های گزارش در `/var/www/html/queue-stats`
- parser در `/usr/local/parseloglite`
- کاربر AMI با نام `phpconfig`
- منوی `Queue Stats` در بخش Reports
- cron پنج‌دقیقه‌ای برای پردازش `queue_log`

گزارش نصب در مسیر `/var/log/asternic-stats-lite-install.log` ذخیره می‌شود و
آدرس گزارش پس از نصب این است:

```text
https://<issabel-host>/queue-stats/
```

### بررسی عیب‌یابی VOIZ ContactCenter

وقتی گزینه `VOIZ ContactCenter` انتخاب شود، VOIZ دقیقاً همان دستور رسمی نصب پروژه را اجرا می‌کند:

```bash
cd /opt && \
rm -rf voiz-contact-center voiz-contact-center.tar.gz && \
curl -fL https://github.com/voipiran/voiz-contact-center/archive/refs/heads/main.tar.gz \
  -o voiz-contact-center.tar.gz && \
tar -xzf voiz-contact-center.tar.gz && \
mv voiz-contact-center-main voiz-contact-center && \
cd voiz-contact-center && \
bash install.sh
```

خروجی کامل هر دو دستور در فایل زیر ذخیره می‌شود:

```text
/var/log/voiz-contact-center-install.log
```

برای بررسی نتیجه واقعی نصب روی سرور:

```bash
tail -n 120 /var/log/voiz-contact-center-install.log
test -d /opt/OpDesk/backend && test -d /opt/OpDesk/frontend && test -x /opt/OpDesk/start.sh
systemctl is-enabled --quiet opdesk.service && systemctl is-active --quiet opdesk.service
ss -lntp | grep ':9001'
curl -kfsS https://127.0.0.1:9001/dashboard >/dev/null
echo $?
```

کد خروجی `0` و وجود هر سه مسیر، فعال‌بودن سرویس و پاسخ‌گویی داشبورد روی پورت 9001 برای اعلام موفقیت لازم است؛ صرفاً نمایش پیام پایان اسکریپت upstream به‌تنهایی کافی نیست.

در Issabel/Rocky Linux ممکن است `python3` سیستم نسخه 3.6 باشد، درحالی‌که OpDesk به Python جدیدتر نیاز دارد. Installer به‌صورت خودکار مفسری را انتخاب می‌کند که `contextlib.asynccontextmanager` را پشتیبانی کند و آن را برای `opdesk.service` تنظیم می‌کند. برای بررسی دستی:

```bash
systemctl cat opdesk.service
journalctl -u opdesk.service -n 80 --no-pager
```

## امکانات آماده و پشتیبانی‌شده

### رابط کاربری و بومی‌سازی

- [x] فارسی‌سازی بخش‌های اصلی Issabel
- [x] پوسته راست‌چین و مناسب کاربران فارسی‌زبان
- [x] تقویم شمسی برای گزارش ضبط مکالمات، CDR، صندوق صوتی و فکس
- [x] پیام‌های صوتی فارسی Asterisk
- [x] اعلام تاریخ و زمان به زبان فارسی
- [x] پوسته انگلیسی برای محیط‌هایی که رابط فارسی لازم نیست

### مرکز تماس و مدیریت مکالمات

- [x] پنل تلفن تحت وب برای کارشناسان
- [x] پنل پایش صف
- [x] پنل پایش تماس
- [x] گزارش‌گیری صف
- [x] گزارش‌گیری CDR
- [x] ساخت گروهی تماس‌های ورودی با Bulk DID
- [x] سناریوی مدیر منشی با Boss Secretary
- [x] به‌روزرسانی Caller ID با Superfecta
- [x] ارسال فکس به مقصد از طریق IVR
- [x] WebRTC Webphone

### ماژول‌ها و ابزارهای عملیاتی

- [x] ماژول Development برای ساخت منو و تغییر متون Issabel
- [x] سه Feature Code برای اعلام تاریخ شمسی، زمان فارسی و تاریخ و زمان
- [x] CRM فارسی Vtiger
- [x] ابزار `htop` برای پایش منابع
- [x] Webmin برای مدیریت سرویس‌ها و تنظیمات لینوکس
- [x] Windcp، MicroSIP و PuTTY برای پشتیبانی و مدیریت سرور
- [x] EasyVPN برای راه‌اندازی OpenVPN Server
- [x] اسکریپت نصب VOIZ روی Issabel / CentOS 7

## برنامه آینده

این موارد در نقشه راه قرار دارند و هنوز بخشی از امکانات تضمین‌شده نسخه 6.0 نیستند:

- [ ] افزودن منوی مستندات کامل داخل پنل
- [ ] نمایش Popup مخاطب Vtiger هنگام تماس ورودی
- [ ] انتقال Webmin و فایل‌های دانلودی به منوهای داخلی VOIZ
- [ ] تعریف SIP Trunkهای پیش‌فرض
- [ ] ارائه رابط گرافیکی برای نصب
- [ ] تکمیل و بهبود پوسته انگلیسی
- [ ] پیکربندی Firewall لینوکس و APIBAN
- [ ] نمایش فکس‌ها به تفکیک گروه
- [ ] افزودن Glances برای پایش پیشرفته منابع
- [ ] بررسی و امکان یکپارچه‌سازی با [AVA AI Voice Agent for Asterisk](https://github.com/hkjarral/AVA-AI-Voice-Agent-for-Asterisk)
- [ ] اتصال عمیق‌تر VOIZ و Voiz Contact Center برای مدیریت یکپارچه مرکز تماس

## نسخه فعلی

### VOIZ 6.0.0

نسخه 6.0.0 یک نسخه پایدار برای انتشار امکانات موجود VOIZ است و تمرکز آن بر یکپارچگی نصب، قابلیت‌های مرکز تماس، بومی‌سازی فارسی و آماده‌بودن ابزارهای عملیاتی برای Issabel است.

برای جزئیات تغییرات این نسخه و نسخه‌های بعدی به [CHANGELOG.md](CHANGELOG.md) مراجعه کنید.

## جزئیات فنی

### سازگاری

- Issabel 4 و Issabel 5
- Asterisk 16 و Asterisk 18
- PHP نسخه متناسب با Issabel نصب‌شده
- سیستم‌عامل‌های مبتنی بر CentOS مورد استفاده Issabel

### ساختار نصب

اسکریپت `install.sh` نسخه VOIZ را در `/etc/voiz.conf` ثبت می‌کند، فایل‌های پوسته و ماژول‌ها را در مسیرهای Issabel قرار می‌دهد، پیام‌های صوتی فارسی را نصب می‌کند و تنظیمات مرتبط با Asterisk را اعمال می‌کند.

### فایل‌ها و بخش‌های اصلی

| مسیر | کاربرد |
|---|---|
| `install.sh` | نصب اصلی VOIZ |
| `voiz-installation/` | تنظیمات نصب و فایل نسخه |
| `issabelmodules/` | کتابخانه‌ها و تغییرات رابط Issabel |
| `issabelpbxmodules/` | ماژول‌های تلفنی و مدیریتی |
| `persiansounds/` | صداها و تنظیمات صوتی فارسی |
| `theme/` | پوسته‌ها، فونت‌ها و ظاهر فارسی / انگلیسی |
| `webphone/` | تلفن تحت وب |
| `customdialplan/` | تنظیمات سفارشی Dialplan |

### پشتیبان‌گیری و به‌روزرسانی

قبل از نصب یا به‌روزرسانی از این موارد نسخه پشتیبان تهیه کنید:

- دیتابیس‌های Issabel و Asterisk
- `/etc/asterisk/`
- `/etc/issabel.conf`
- `/etc/voiz.conf`
- فایل‌های ضبط مکالمات

برای به‌روزرسانی، نسخه جدید را در یک مسیر جداگانه دریافت و پس از بررسی تغییرات، `install.sh` را با دسترسی `root` اجرا کنید.

## مستندات و گزارش خطا

برای آموزش‌ها و راهنماهای فارسی به <https://voiz.ir> مراجعه کنید. برای گزارش خطا، نسخه Issabel، نسخه Asterisk، روش نصب و لاگ مرتبط را در [GitHub Issues](https://github.com/voipiran/VOIZ/issues) ارسال کنید. رمزها، کلیدهای API و اطلاعات شخصی تماس‌ها را در Issue قرار ندهید.

## مجوز

VOIZ تحت مجوز [GNU GPL v3](LICENSE) منتشر می‌شود. هنگام استفاده، تغییر یا توزیع مجدد پروژه، شرایط مجوز و اعلان‌های حق‌نشر وابستگی‌ها را رعایت کنید.

## حمایت از پروژه

اگر VOIZ برای شما مفید است، با دادن ستاره به مخزن و گزارش دقیق خطاها به توسعه پایدار پروژه کمک کنید.
