# Sistem Booking Hotel - Panduan Setup & Implementasi

## Informasi Proyek

Sistem Booking Hotel berbasis web menggunakan Laravel 13 dengan Breeze authentication, Blade Template, dan Eloquent ORM.

## Fitur Utama

### 1. Modul Tamu
- CRUD Data Tamu
- Pencarian dan pagination
- Validasi data unique (email, nomor identitas)
- Field: nama_lengkap, jenis_kelamin, no_telepon, email, alamat, no_identitas

### 2. Modul Tipe Kamar
- CRUD Tipe Kamar
- Upload foto kamar
- Pencarian tipe kamar
- Tipe default: Standard Room, Deluxe Room, Suite Room

### 3. Modul Kamar
- CRUD Kamar
- Status otomatis (Tersedia, Terisi, Maintenance)
- Relasi dengan Tipe Kamar
- Filter berdasarkan status

### 4. Modul Booking
- Booking kamar hotel
- Pilih tamu dan kamar tersedia
- Check-in/Check-out otomatis
- Validasi bentrok booking
- Status: Pending, Check-in, Selesai, Dibatalkan

### 5. Modul Pembayaran
- Input pembayaran
- Status pembayaran (Lunas, Belum Lunas)
- Metode: Transfer Bank, Cash, E-Wallet
- Cetak invoice PDF
- Riwayat pembayaran

### 6. Dashboard Admin
- Total tamu, kamar, booking, pembayaran
- Status kamar (Tersedia, Terisi, Maintenance)
- Grafik pendapatan 7 hari terakhir

## Tech Stack

- **Framework**: Laravel 13.8 (Latest)
- **Authentication**: Laravel Breeze
- **Template Engine**: Blade
- **ORM**: Eloquent
- **CSS Framework**: Tailwind CSS
- **JavaScript**: Alpine JS, Chart.js
- **UI Library**: SweetAlert2, FontAwesome 6
- **Database**: MySQL
- **PHP**: 8.5+

## Struktur Database

### Relasi Tabel
```
Tamus (1) ←→ (∞) Booking (1) → (1) Pembayaran
TipeKamar (1) ←→ (∞) Kamar (1) ←→ (∞) Booking
```

## Setup Instructions

### Prerequisites
- PHP 8.5+ (terinstall di Laragon)
- MySQL Server
- Composer
- Node.js & npm

### Langkah 1: Environment Configuration
Edit file `.env`:
```
APP_NAME="Sistem Booking Hotel"
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_booking
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 2: Install Dependencies
```bash
composer install
npm install
```

### Langkah 3: Generate Application Key
```bash
php artisan key:generate
```

### Langkah 4: Publish Breeze Assets (Jika belum ter-install)
Jika Breeze belum terinstall, jalankan:
```bash
php artisan breeze:install blade
php artisan migrate
npm install && npm run dev
```

### Langkah 5: Run Migrations & Seeders
```bash
php artisan migrate --seed
```

Ini akan:
- Membuat semua tabel database
- Membuat 3 tipe kamar (Standard, Deluxe, Suite)
- Membuat 25 kamar (10 Standard, 10 Deluxe, 5 Suite)
- Membuat 20 data tamu dummy
- Membuat 15 booking dummy
- Membuat 10 pembayaran dummy
- Membuat user admin (email: admin@hotel.com, password: password)

### Langkah 6: Build Assets
```bash
npm run build
```

### Langkah 7: Jalankan Development Server
```bash
php artisan serve
```

Server akan berjalan di: http://localhost:8000

## Login Credentials

**Default Admin Account:**
- Email: `admin@hotel.com`
- Password: `password`

## File Structure

```
sistem_booking_hotel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── DashboardController.php
│   │       ├── TamusController.php
│   │       ├── TipeKamarController.php
│   │       ├── KamarController.php
│   │       ├── BookingController.php
│   │       └── PembayaranController.php
│   └── Models/
│       ├── Tamus.php
│       ├── TipeKamar.php
│       ├── Kamar.php
│       ├── Booking.php
│       └── Pembayaran.php
├── database/
│   ├── migrations/
│   │   ├── 2026_05_22_000001_create_tamuses_table.php
│   │   ├── 2026_05_22_000002_create_tipe_kamar_table.php
│   │   ├── 2026_05_22_000003_create_kamar_table.php
│   │   ├── 2026_05_22_000004_create_booking_table.php
│   │   └── 2026_05_22_000005_create_pembayaran_table.php
│   ├── factories/
│   │   ├── TamusFactory.php
│   │   ├── TipeKamarFactory.php
│   │   ├── KamarFactory.php
│   │   ├── BookingFactory.php
│   │   └── PembayaranFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css (Tailwind)
│   ├── js/
│   │   └── app.js (Alpine)
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard.blade.php
│       ├── tamus/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── tipe-kamar/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── kamar/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── booking/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       └── pembayaran/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           ├── show.blade.php
│           └── invoice.blade.php
└── routes/
    └── web.php
```

## Routes Overview

```
GET     /                          - Welcome page
GET     /dashboard                 - Dashboard (Protected)
GET     /tamus                     - List tamu
POST    /tamus                     - Store tamu
GET     /tamus/create              - Create form
GET     /tamus/{tamu}              - Show detail
GET     /tamus/{tamu}/edit         - Edit form
PUT     /tamus/{tamu}              - Update
DELETE  /tamus/{tamu}              - Delete

GET     /tipe-kamar                - List tipe kamar
POST    /tipe-kamar                - Store tipe kamar
GET     /tipe-kamar/create         - Create form
GET     /tipe-kamar/{tipeKamar}    - Show detail
GET     /tipe-kamar/{tipeKamar}/edit - Edit form
PUT     /tipe-kamar/{tipeKamar}    - Update
DELETE  /tipe-kamar/{tipeKamar}    - Delete

GET     /kamar                     - List kamar
POST    /kamar                     - Store kamar
GET     /kamar/create              - Create form
GET     /kamar/{kamar}             - Show detail
GET     /kamar/{kamar}/edit        - Edit form
PUT     /kamar/{kamar}             - Update
DELETE  /kamar/{kamar}             - Delete

GET     /booking                   - List booking
POST    /booking                   - Store booking
GET     /booking/create            - Create form
GET     /booking/{booking}         - Show detail
GET     /booking/{booking}/edit    - Edit form
PUT     /booking/{booking}         - Update
DELETE  /booking/{booking}         - Delete
POST    /booking/{booking}/check-in - Check-in
POST    /booking/{booking}/check-out - Check-out

GET     /pembayaran                - List pembayaran
POST    /pembayaran                - Store pembayaran
GET     /pembayaran/create         - Create form
GET     /pembayaran/{pembayaran}   - Show detail
GET     /pembayaran/{pembayaran}/edit - Edit form
PUT     /pembayaran/{pembayaran}   - Update
DELETE  /pembayaran/{pembayaran}   - Delete
GET     /pembayaran/{pembayaran}/invoice - Print invoice
```

## Validasi Form

### Tamu
- Nama Lengkap: required, string, max 255
- Jenis Kelamin: required, in (Laki-laki, Perempuan)
- No. Telepon: required, string, max 20
- Email: required, email, unique
- Alamat: required, string
- No. Identitas: required, string, unique

### Tipe Kamar
- Nama Tipe: required, string, max 255
- Harga Per Malam: required, numeric, min 0
- Kapasitas: required, integer, min 1
- Fasilitas: required, string
- Deskripsi: required, string
- Foto: nullable, image, mimes (jpeg, png, jpg, gif), max 2MB

### Kamar
- Nomor Kamar: required, string, unique
- Tipe Kamar: required, exists in tipe_kamar
- Lantai: required, integer, min 1
- Status: required, in (Tersedia, Terisi, Maintenance)

### Booking
- Tamu: required, exists in tamuses
- Kamar: required, exists in kamar
- Tanggal Check-in: required, date, after_or_equal today
- Tanggal Check-out: required, date, after check-in
- Validasi: Kamar harus Tersedia, Tidak ada bentrok booking

### Pembayaran
- Booking: required, exists in booking
- Tanggal Pembayaran: required, date
- Metode: required, in (Transfer Bank, Cash, E-Wallet)
- Total Bayar: required, numeric, min 0
- Status: required, in (Lunas, Belum Lunas)

## Features

### Authentication
- Register & Login dengan Breeze
- Session management
- Middleware auth untuk protected routes
- Remember me functionality

### Dashboard
- Overview statistics
- Room occupancy status
- Income chart (7 days)
- Quick links to main modules

### Data Management
- Complete CRUD operations
- Search functionality
- Pagination (10 items per page)
- Filter options
- Delete confirmation with SweetAlert2

### Business Logic
- Automatic room status updates on check-in/check-out
- Automatic calculation of stay duration
- Automatic calculation of total price
- Booking conflict validation
- Payment tracking

### UI/UX
- Responsive design (mobile, tablet, desktop)
- Modern sidebar navigation
- Blue gradient color scheme
- Tailwind CSS styling
- FontAwesome icons
- SweetAlert2 notifications
- Chart.js for analytics

### Invoice
- Professional PDF invoice
- Booking details
- Payment information
- Print-friendly design

## Troubleshooting

### Database Connection Error
Pastikan MySQL server sudah berjalan dan konfigurasi `.env` benar.

### Migration Error
Hapus tables yang sudah ada dan jalankan kembali:
```bash
php artisan migrate:refresh --seed
```

### Asset Not Loading
Rebuild assets:
```bash
npm run dev
# atau
npm run build
```

### Session Issues
Clear cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan session:flush
```

## Security Notes

- Semua inputs divalidasi dan di-sanitize
- CSRF protection enabled
- SQL injection prevention dengan Eloquent
- XSS protection dengan Blade escaping
- Authentication & authorization middleware
- Password di-hash dengan bcrypt

## Development Notes

- Menggunakan Blade Template Engine
- Responsive design dengan Tailwind CSS
- JavaScript interactivity dengan Alpine.js
- Data visualization dengan Chart.js
- UI notifications dengan SweetAlert2
- Icons dari FontAwesome 6

## Future Enhancements

1. Email notifications untuk booking & pembayaran
2. SMS gateway integration
3. Payment gateway integration (Stripe, Midtrans)
4. Multi-language support
5. Admin role & permissions
6. Room availability calendar
7. Guest reviews & ratings
8. Discount & promo codes
9. Report generation (PDF/Excel)
10. API integration

## Contact & Support

Untuk pertanyaan atau bantuan, silakan hubungi tim development.

## License

This project is licensed under the MIT License.

---

**Terakhir di-update**: 22 Mei 2026
