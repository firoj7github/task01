# 🚀 Laravel + Vue js Project Setup

এই প্রজেক্টে **Laravel 12** এবং **Vue 3** ব্যবহার করা হয়েছে। নিচের ধাপগুলো অনুসরণ করে সহজে লোকাল মেশিনে রান করতে পারবেন।  

---

## ✅ Prerequisites
- PHP 8.2 বা তার উপরে
- Composer
- Node.js (LTS) & npm

---

## ✅ Project Setup

git clone https://github.com/firoj7github/task01.git
cd task01

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate:fresh --seed
composer run dev
