# Class Schedule Management

A Laravel-based class schedule management system with timetable view, conflict detection, and filtering capabilities.

Repository: https://github.com/0xyz-exe/class-schedule-app-laravel

## Screenshots

### Visual Timetable Grid
![Timetable grid](docs/screenshots/01_timetable_grid.png)

### Schedule List & Filtering
![Schedule list](docs/screenshots/02_schedule_list.png)

### Add & Edit Schedule
![Schedule form](docs/screenshots/03_schedule_form.png)

### Authentication
![Authentication](docs/screenshots/04_login.png)

## Features

- ✅ User authentication (Laravel Breeze)
- ✅ Complete schedule CRUD
- ✅ Time conflict detection
- ✅ Visual timetable grid view
- ✅ Filter by day and semester
- ✅ Responsive table layout
- ✅ Form validation

## Tech Stack

- Laravel 13.38.0
- Laravel Breeze 2.4
- SQLite
- Tailwind CSS

## Installation

```bash
# Clone repository
git clone https://github.com/0xyz-exe/class-schedule-app-laravel.git
cd class-schedule-app-laravel

# Install dependencies
composer install
npm install && npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database
touch database/database.sqlite

# Run migrations with demo data
php artisan migrate --seed

# Start server
php artisan serve
```

Visit `http://localhost:8000`

## Demo Account

- Email: `test@example.com`
- Password: `password`

## Database Schema

**schedules**
- id
- course_code
- course_name
- instructor
- room
- day (Monday-Saturday)
- start_time
- end_time
- semester
- credits (1-6)
- timestamps

## Usage

1. **Login** with demo account
2. **Manage Schedules** - Create, edit, delete course schedules
3. **Timetable View** - Visual grid showing all classes by day/time
4. **Filter** - Filter by specific day or semester
5. **Conflict Detection** - Automatic detection of time conflicts

## Conflict Detection

Prevents overlapping schedules on the same day:
- Checks start/end time overlaps
- Validates during create and update
- Excludes current schedule when editing

## Features Detail

### List View
- Tabular display with all schedule details
- Filter by day or semester
- Pagination support

### Timetable View
- Grid layout (days × time slots)
- Color-coded course blocks
- Semester filtering
- Shows course code, name, instructor, room

## Security

- User authentication required
- CSRF protection
- Input validation
- SQL injection prevention
- XSS protection

## License

MIT
