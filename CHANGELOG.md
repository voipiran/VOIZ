# Changelog

تمام تغییرات مهم VOIZ در این فایل ثبت می‌شوند. قالب این فایل بر اساس [Keep a Changelog](https://keepachangelog.com/en/1.1.0/) و نسخه‌گذاری پروژه بر اساس [Semantic Versioning](https://semver.org/) تنظیم شده است.

## [6.0.5] - 2026-11-07

### Changed

- Added timeouts to Asternic repository and installer operations to prevent indefinite installation waits.
- Improved ChanSpy installation status handling when the Asterisk configuration is present despite a non-zero installer exit code.
- Added an NVM archive fallback for ContactCenter installation when `raw.githubusercontent.com` is unavailable.
- Removed direct `menu.db` backup, replacement, and cleanup logic from the VOIZ installation flow while preserving module-specific menu merge commands.

## [6.0.4] - 2026-11-04

### Changed

- به‌روزرسانی دستور نصب VOIZ ContactCenter برای استفاده از repository جدید `voiz-console`.

## [6.0.3] - 2026-11-03

### Changed

- به‌روزرسانی نسخه VOIZ به 6.0.3 در بسته نصب و فایل‌های پیکربندی.
- مخفی‌سازی گزینه Custom Menu از گزینه‌های نصب و جلوگیری از اجرای آن، با حفظ کدهای مربوطه برای اصلاحات بعدی.

## [6.0.0] - 2026-10-21

### Added

- انتشار نسخه پایدار VOIZ 6.0.0 برای Issabel 4 و Issabel 5.
- تکمیل و یکپارچه‌سازی قابلیت‌های فارسی‌سازی، تقویم شمسی و پیام‌های صوتی فارسی.
- ارائه امکانات مرکز تماس شامل Webphone، پایش صف و تماس، گزارش CDR و ابزارهای مدیریت تماس.
- پشتیبانی از Bulk DID، Boss Secretary، Superfecta و Feature Codeهای تاریخ و زمان فارسی.
- بهبود بسته نصب و ثبت نسخه VOIZ در تنظیمات سیستم.
- مستندسازی نصب، ساختار پروژه، سازگاری و مسیرهای اصلی.

### Supported

- Asterisk 16 و Asterisk 18
- Issabel 4 و Issabel 5
- پوسته‌های فارسی و انگلیسی
- CRM فارسی Vtiger، Webmin، EasyVPN و ابزارهای پشتیبانی همراه

### Planned

- یکپارچه‌سازی احتمالی با [AVA AI Voice Agent for Asterisk](https://github.com/hkjarral/AVA-AI-Voice-Agent-for-Asterisk)
- اتصال عمیق‌تر به Voiz Contact Center
- بهبود Firewall، APIBAN، Glances و رابط گرافیکی نصب

## [Unreleased]

تغییرات آماده انتشار نسخه بعدی در این بخش ثبت می‌شوند.

[6.0.3]: https://github.com/voipiran/VOIZ/releases/tag/v6.0.3
[6.0.4]: https://github.com/voipiran/VOIZ/releases/tag/v6.0.4
[6.0.5]: https://github.com/voipiran/VOIZ/releases/tag/v6.0.5
[6.0.0]: https://github.com/voipiran/VOIZ/releases/tag/v6.0.0
