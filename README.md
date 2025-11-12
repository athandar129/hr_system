<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Employee Chatbot Documentation on 12 Nov 25

### **Project Overview**
This Laravel project includes:
1. **Employee CRUD** functionality.
2. **Rule-based AI chatbot** for employee queries.
3. Collapsible chat widget to prevent UI overlap.

The chatbot can:
- Count employees
- List employees (with optional limits)
- Search employees by name prefix
- Filter employees by department/position
- Lookup employee by ID/email
- Provide help commands if unrecognized input

---

### **Step-by-Step Implementation by Date**

#### **Day 1: Employee CRUD**
- Set up `Employee` model, controller, migration.
- Created routes and Blade views for CRUD operations.
- Tested database operations for employees.

#### **Day 2: Chat Widget UI**
- Added chat box in `admin.blade.php`.
- Implemented input field, send button, and chat log.
- Widget positioned at bottom-right using **fixed CSS**.
- JavaScript captures user messages and sends AJAX requests to Laravel.

#### **Day 3: ChatbotController**
- Created `ChatbotController.php` with `handle(Request $request)` method.
- Validates and normalizes input.
- Matches input against predefined **rules/keywords** using regex:
  - Count employees
  - List employees
  - Names starting with prefix
  - Filter by department/position
  - Lookup by ID/email
- Queries the `Employee` database.
- Returns JSON reply to frontend.

#### **Day 4: JavaScript Integration**
- JS captures user input and sends POST request to `/chatbot`.
- Receives JSON response and appends reply to chat log.
- Added **Enter key press** support for sending messages.
- Added **auto-scroll** to show latest messages.

#### **Day 5: Collapsible Feature**
- Added toggle button 💬 to open/close chat box.
- Prevents overlap with employee forms.
- Chat box hidden by default (`display:none`), shown on toggle.

#### **Day 6: Documentation & Git**
- Wrote README.md and included:
  - Setup instructions
  - Routes
  - Controller logic
  - Chat UI/JS
  - Example commands
  - Collapsible widget description
- Pushed project to GitHub.

---

### **Installation Instructions**
```bash
git clone https://github.com/yourusername/laravel-employee-chatbot.git
cd laravel-employee-chatbot
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate

Update .env with database credentials, then run migrations:
php artisan migrate

Routes
Route::middleware('auth')->post('/chatbot', [ChatbotController::class, 'handle'])->name('chatbot.handle');

Example Commands
User Input	Response
How many employees?	There are 50 employees.
List employees	Returns first 10 employees with ID, name, position

Chatbot Flow Diagram
User types message
        |
        v
JavaScript captures input
        |
        v
AJAX POST request to /chatbot
        |
        v
ChatbotController:
  - Validate & normalize
  - Match rules (count/list/search/filter)
  - Query Employee DB
  - Return JSON {"reply": "..."}
        |
        v
JavaScript appends reply to chat log
        |
        v
User sees bot reply

Future Enhancements

Replace rule-based logic with AI API.

Log chat history in database.

Add colored chat bubbles and animations.

Improve help commands and quick-action buttons.

License

This project is open-sourced under the MIT License"https://opensource.org/license/MIT"
.
