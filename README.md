# E-Banci Sistem MRPZ2

Sistem Pengurusan Data Ahli dan Keluarga untuk Masjid Raja Perempuan Zainab 2 (MRPZ2).

## 📋 Tentang Projek

E-Banci MRPZ2 adalah sistem pengurusan maklumat ahli masjid yang membolehkan pentadbir mencatat dan menguruskan:
- Maklumat peribadi ahli (nama, IC, alamat, pekerjaan, dll)
- Struktur keluarga dan isi rumah
- Pembahagian zon kawasan
- Laporan dan statistik ahli

## 🛠️ Teknologi Yang Digunakan

- **Framework:** Laravel 11
- **PHP:** 8.3+
- **Database:** MySQL 8.0
- **Frontend:** Blade Templates + Tailwind CSS + Alpine.js
- **Authentication:** Laravel Breeze
- **Development:** Laravel Herd + Docker

## 📦 Keperluan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL 8.0
- Docker (untuk database)

## 🚀 Cara Setup

### 1. Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/mrpz2-ebanci.git
cd mrpz2-ebanci
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database

**Menggunakan Docker:**

```bash
# Start MySQL dan phpMyAdmin
docker-compose up -d

# Verify containers running
docker-compose ps
```

**Update .env file:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=mrpz2_ebanci
DB_USERNAME=root
DB_PASSWORD=root
```

### 5. Run Migrations & Seeders

```bash
# Create tables and seed sample data
php artisan migrate:fresh --seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Access Application

- **Application:** http://mrpz2-ebanci.test
- **phpMyAdmin:** http://localhost:8081
- **Login:** admin@mrpz2.com / password

## 📊 Database Structure

### Tables

- **zones** - Kawasan zon (Zon 1, 2, 3)
- **households** - Maklumat keluarga/isi rumah
- **members** - Maklumat ahli individu
- **household_members** - Hubungan antara ahli dan keluarga
- **users** - Admin pengguna sistem

## 🎯 Fitur

### Phase 1 (Completed)
- ✅ Database schema dan migrations
- ✅ Models dan relationships
- ✅ Sample data seeders
- ✅ Authentication system

### Phase 2 (In Progress)
- ⏳ Admin dashboard
- ⏳ Member CRUD operations
- ⏳ Household management
- ⏳ Search and filter

### Phase 3 (Planned)
- 📋 Reports and statistics
- 📋 Data export (PDF/Excel)
- 📋 Print membership cards
- 📋 Advanced filtering

## 🔧 Development Commands

```bash
# Run development server
php artisan serve

# Run Vite dev server (for hot reload)
npm run dev

# Run tests
php artisan test

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Database commands
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:wipe
```

## 🐳 Docker Commands

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View logs
docker-compose logs

# Restart containers
docker-compose restart
```

## 👥 Team

- **Developer:** 4im4y (Aiman Mazlan)
- **Organization:** Masjid Raja Perempuan Zainab 2

## 📝 License

This project is private and proprietary to MRPZ2.

## 📞 Support

For issues or questions, please contact the development team.

---

**Developed with ❤️ for MRPZ2 Community**