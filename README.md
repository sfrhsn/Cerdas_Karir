Cara Menjalankan
1. Clone & Install Dependencies
bashgit clone <url-repo> cerdas-karir
cd cerdas-karir

composer install
npm install

2. Konfigurasi Environment
bashcp .env.example .env
php artisan key:generate
php artisan jwt:secret
Buka file .env lalu sesuaikan:
envAPP_NAME="Cerdas Karir"
APP_URL=http://localhost:8000

# Database (pilih salah satu)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cerdas_karir
DB_USERNAME=root
DB_PASSWORD=

# DB_CONNECTION=sqlite
# (kosongkan DB_DATABASE, DB_HOST, dll)

# Groq AI (opsional, untuk fitur generate artikel & analisis karir)
GROQ_API_KEY=gsk_xxxxxxxxxxxxxxxxxxxx

Untuk mendapatkan GROQ API Key gratis: https://console.groq.com

3. Setup Database
bash# Buat database MySQL terlebih dahulu (jika pakai MySQL):
# CREATE DATABASE cerdas_karir;

php artisan migrate
php artisan db:seed
Seeder akan membuat:

Admin: admin@cerdaskarir.id / admin123456
User: budi@example.com / password123
2 Quiz (Teknologi & Industri Kreatif) dengan 10 soal masing-masing
5 Artikel sample

4. Build Assets & Storage Link
bashnpm run build
php artisan storage:link
5. Jalankan Server
bashphp artisan serve
Buka browser: http://localhost:8000

🌐 Halaman Utama
URLKeteranganhttp://localhost:8000Homepagehttp://localhost:8000/quizDaftar quiz karirhttp://localhost:8000/articlesArtikel karirhttp://localhost:8000/loginLogin userhttp://localhost:8000/registerDaftar akun baruhttp://localhost:8000/admin/dashboardPanel adminhttp://localhost:8000/api/documentationSwagger API Docs

👤 Akun Default
RoleEmailPasswordAdminadmin@cerdaskarir.idadmin123456Userbudi@example.compassword123
