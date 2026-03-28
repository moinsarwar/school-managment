# 🏫 School Management System

A full-featured **School Management System** built with **Laravel 12**, designed with **multi-role authentication** and a clean **Bootstrap** UI. The system supports four distinct user roles — Admin, Teacher, Student, and Office Staff — each with their own dashboards, permissions, and workflows.

---

## ✨ Features

### 🔐 Multi-Role Authentication
- **4 Separate Guards**: Admin, Teacher, Student, Office — each with independent login, session, and middleware
- Custom authentication controllers and middleware per role
- Protected dashboards with role-based access control

### 👨‍💼 Admin Panel
- **Classes Management** — Create, edit, delete school classes (Class 1–10)
- **Sections Management** — Assign sections (A, B, etc.) to each class
- **Subjects Management** — Add subjects per class (Math, English, Science, Urdu, Islamiat, CS)
- **Teachers Management** — Full CRUD with class and subject assignment
- **Students Management** — Full CRUD with class, section, roll number, and admission details
- **Exams Management** — Create midterm and final exams per class
- **Attendance Overview** — Read-only view of all attendance records

### 👩‍🏫 Teacher Portal
- **Mark Attendance** — Mark daily attendance (Present / Absent / Late) for assigned class students
- **Enter Grades** — Submit student grades per exam and subject
- **View Records** — Review previously submitted attendance and grades

### 👨‍🎓 Student Portal
- **Dashboard** — Personal overview with class and section info
- **My Attendance** — View personal attendance history
- **My Results** — View grades and exam results

### 🏢 Office Portal
- **Admissions Management** — Create, edit, and manage new student admissions
- **Dashboard** — Overview of admission activities

---

## 🛠️ Tech Stack

| Layer         | Technology              |
|---------------|-------------------------|
| Framework     | Laravel 12              |
| PHP           | 8.2+                    |
| Frontend      | Blade Templates         |
| CSS           | Bootstrap (CDN)         |
| Database      | MySQL / SQLite          |
| Auth          | Custom Multi-Guard      |
| Package Mgr   | Composer + NPM          |

---

## 📁 Project Structure

```
school-managment/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # ClassController, SectionController, SubjectController, etc.
│   │   │   ├── Teacher/        # AttendanceController, GradeController
│   │   │   ├── Office/         # AdmissionController
│   │   │   ├── AdminAuthController.php
│   │   │   ├── TeacherAuthController.php
│   │   │   ├── StudentAuthController.php
│   │   │   └── OfficeAuthController.php
│   │   └── Middleware/         # AdminMiddleware, TeacherMiddleware, etc.
│   └── Models/                 # Admin, Teacher, Student, Office, SchoolClass, Section, Subject, Exam, Grade, Attendance
├── database/
│   ├── migrations/             # 15 migration files
│   └── seeders/                # DatabaseSeeder with sample data
├── resources/views/
│   ├── admin/                  # Dashboard, Classes, Sections, Subjects, Teachers, Students, Exams, Attendance
│   ├── teacher/                # Dashboard, Attendance, Grades
│   ├── student/                # Dashboard, Attendance, Results
│   ├── office/                 # Dashboard, Admissions
│   └── layouts/                # admin, teacher, student, office, app layouts
├── routes/web.php              # All role-based routes
└── config/auth.php             # Multi-guard configuration
```

---

## 📊 Database Schema

```
┌──────────┐    ┌──────────┐    ┌──────────┐
│  classes  │───▶│ sections │    │ subjects │
│           │    │          │    │          │
│  id, name │    │ class_id │    │ class_id │
└─────┬─────┘    └──────────┘    └────┬─────┘
      │                               │
      ▼                               ▼
┌──────────┐    ┌─────────────┐  ┌──────────┐
│ students │───▶│ attendances │  │  grades  │
│          │    │             │  │          │
│ class_id │    │ student_id  │  │student_id│
│section_id│    │ class_id    │  │subject_id│
│roll_number│   │ date,status │  │ exam_id  │
└──────────┘    │ marked_by   │  │  marks   │
                └─────────────┘  └──────────┘
┌──────────┐    ┌──────────┐
│ teachers │    │  exams   │
│          │    │          │
│ class_id │    │ class_id │
│subject_id│    │ name     │
│qualific. │    │ date     │
└──────────┘    └──────────┘
```

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- MySQL or SQLite
- Node.js & NPM

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/moinsarwar/school-managment.git
cd school-managment

# 2. Install PHP dependencies
composer install

# 3. Copy environment file and configure
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure your database in .env
#    DB_CONNECTION=mysql
#    DB_DATABASE=school_management
#    DB_USERNAME=root
#    DB_PASSWORD=your_password

# 6. Run migrations
php artisan migrate

# 7. Seed the database with sample data
php artisan db:seed

# 8. Install frontend dependencies
npm install

# 9. Start the development server
php artisan serve
```

The application will be available at **http://localhost:8000**

---

## 🔑 Default Login Credentials

| Role     | Email               | Password   | Login URL              |
|----------|---------------------|------------|------------------------|
| Admin    | admin@test.com      | password   | `/admin/login`         |
| Teacher  | teacher1@test.com   | password   | `/teacher/login`       |
| Student  | student1@test.com   | password   | `/student/login`       |
| Office   | office@test.com     | password   | `/office/login`        |

> **Note:** The seeder creates 10 teachers (`teacher1@test.com` to `teacher10@test.com`) and 50 students (`student1@test.com` to `student50@test.com`).

---

## 📋 Sample Seeded Data

| Entity    | Count | Details                                |
|-----------|-------|----------------------------------------|
| Classes   | 10    | Class 1 through Class 10              |
| Sections  | 20    | A and B per class                     |
| Subjects  | 60    | 6 subjects per class                  |
| Teachers  | 10    | 1 per class                           |
| Students  | 50    | 5 per class (Section A)               |
| Exams     | 20    | Midterm + Final per class             |

---

## 🛣️ Route Overview

| Prefix       | Middleware   | Resources                                          |
|--------------|--------------|-----------------------------------------------------|
| `/admin`     | `admin`      | dashboard, classes, sections, subjects, teachers, students, exams, attendance |
| `/teacher`   | `teacher`    | dashboard, attendance (mark), grades (enter)        |
| `/student`   | `student`    | dashboard, attendance (view), results (view)        |
| `/office`    | `office`     | dashboard, admissions (CRUD)                        |

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

---

## 👤 Author

**Moin Sarwar** — [@moinsarwar](https://github.com/moinsarwar)
