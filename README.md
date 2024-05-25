## Aplikasi Web Catatan / Jadwal Makan

Aplikasi Website dengan laravel & mongodb database

### Cara Menjalankan Aplikasi
`
1. Clone repo ini
2. Buka terminal lalu jalankan 'composer install'
3. Pada terminal jalankan 'cp .env.example .env'
4. Jalankan 'php artisan key:generate'
5. Pada file .env sesuaikan properti 'MONGODB_URI' sesuai dengan uri mongodb yang ingin digunakan
6. Pada mongodb buat database baru dengan nama 'smartfits'
7. Pada terminal jalankan 'php artisan migrate --seed'
8. Jalankan 'php artisan serve' lalu 'npm run dev'
9. Buka url 'localhost:8000' atau '127.0.0.1:8000' dan selamat mencoba
`

## Log In User Admin
### email = admin@gmail.com
### password = admin

## List Halaman
<ul>
    <li>Landing Page</li>
    <li>Login Page</li>
    <li>Register Page</li>
    <li>Dashboard Page</li>
    <li>Admin CRUD (User dan Feedback)</li>
    <li>Client CRUD (User</li>
</ul>

### Fitur Admin
<ul>
    <li>CRUD User</li>
    <li>RUD Feedback</li>
    <li>Edit Profile</li>
</ul>

### Fitur Client
<ul>
    <li>CRUD Catatan Makanan</li>
    <li>Create Feedback</li>
    <li>Edit Profile</li>
</ul>
