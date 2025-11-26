🍽️ Merry Meals — Meals on Wheels Web Application

A Laravel-based platform for partners, caregivers, volunteers, and meal distribution.

This project is a Laravel web application developed as part of a Meals on Wheels initiative. It includes user roles, meal listings, orders, volunteer delivery routing, and Google Maps integration using several Maps APIs.

GitHub Repository:
👉 https://github.com/khan-glitch/mealsonwheels

📦 Tech Stack

Laravel (PHP Framework)

MySQL for database

Blade & Tailwind for UI

Google Maps Platform

Directions API

Distance Matrix API

Geocoding API

Geolocation API

Maps JavaScript API

🗂️ Project Setup
1. Clone the Repository
git clone https://github.com/khan-glitch/mealsonwheels.git
cd mealsonwheels

🔧 Installation
2. Install Dependencies
PHP packages:
composer install

Node modules:
npm install
npm run build

⚙️ Environment Configuration
3. Create & Configure .env

Copy the example environment file:

cp .env.example .env


Then edit .env and configure:

App name
APP_NAME="Merry Meals"

Database
DB_DATABASE=test1
DB_USERNAME=your_username
DB_PASSWORD=your_password

Google Maps API Key

⚠️ Do NOT commit your real key.

GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here

🔑 Generate App Key
php artisan key:generate

📁 Storage Symlink (Important)

If you face issues with storage not linking:

Windows:
Remove-Item -Path public\storage -Recurse -Force
php artisan storage:link

Linux/macOS:
rm -rf public/storage
php artisan storage:link

🗄️ Database Setup
Option A — Run Laravel Migrations (Preferred)
php artisan migrate


If migrations run successfully, you’re done.

Option B — Manual SQL Import (If migrations fail)

On some machines migrations may not run due to version differences (Laravel/MySQL).

You can manually create the database by importing the SQL script:

Open MySQL Workbench

Create the schema: test1

Run the SQL script located in the project (e.g., database/test1.sql)

This script creates tables such as:

users

meals

orders

donations

jobs, job_batches, failed_jobs

sessions

cache & cache_locks

password_reset_tokens

and others

▶️ Running the Application
php artisan serve


Visit in browser:
👉 http://127.0.0.1:8000

🧪 APIs Used

The application uses several Google Maps & Cloud APIs:

Directions API

Distance Matrix API

Geocoding API

Geolocation API

Maps JavaScript API

Additional Google Cloud services (as required)

📁 .gitignore (Important)

The following files/folders must NOT be committed:

/node_modules
/vendor
.env
/storage/*.key
/storage/logs/*.log


Laravel’s default .gitignore already covers these.

📎 Additional Notes

Ensure Google Maps API key has the correct APIs enabled.

Restrict your API key for security (domain/IP restrictions).

After updating .env, run:

php artisan config:clear
php artisan cache:clear


For Windows users, PowerShell may require Set-ExecutionPolicy if scripts won't run.
