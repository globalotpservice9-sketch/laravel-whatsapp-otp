# Laravel WhatsApp API for OTP, Alerts & Bulk messaging - Powered by 5MinutesAPI 🚀



Send WhatsApp OTPs, Invoices, and Reminders from your Laravel/PHP app using the **Official Meta Cloud API**. Zero Markup. Zero Bans.

## 🛑 Important: Get Your API Key First
Do not use unofficial QR bots that get banned. 
Get your **Official Meta API Key** in under 5 minutes at [5minutesapi.com](https://5minutesapi.com). No Meta business verification wait time required!

## Installation
```bash
composer require 5minutesapi/laravel-whatsapp-otp
Quick Start
PHP
require 'vendor/autoload.php';
use FiveMinutesAPI\WhatsApp\WhatsAppClient;

// 1. Initialize with your API Key from 5minutesapi.com
$whatsapp = new WhatsAppClient("5m_live_YOUR_API_KEY");

// 2. Send the OTP
$response =$whatsapp->sendOTP("923001234567", "global_otp_auth", ["123456"]);

print_r($response);
