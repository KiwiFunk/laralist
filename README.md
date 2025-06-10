# LaraList - Laravel based task manager

> A sleek, responsive task manager built with Laravel, featuring real-time updates, optimistic UI, and modern web technologies.

**Live Site:** [https://laralist.vercel.app](https://laralist.vercel.app)

![LaraList Preview](https://img.shields.io/badge/Status-Live-brightgreen) ![Laravel](https://img.shields.io/badge/Laravel-12-red) ![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-blue) ![Tailwind](https://img.shields.io/badge/Tailwind-4.x-cyan)

<br>

## Features

### **Core Functionality**
- **User Authentication** - Secure registration, login & logout
- **Task Management** - Create, edit, complete, and delete tasks
- **Real-time Stats** - Live task counters (total, completed, pending)
- **Responsive Design** - Perfect on desktop, tablet, and mobile
- **Dark Theme** - Modern dark UI with orange accent colors

### **UX Considerations**
- **Optimistic Updates** - Instant UI feedback before server confirmation
- **Automatic Rollbacks** - Smart error handling with state restoration
- **Mobile-First Design** - Touch-friendly interface
- **Smooth Animations** - Tailwind CSS transitions and custom keyframes
- **Animated Background** - Dynamic wave patterns for visual appeal

### **Cool Technical Stuff!**
- **Security Headers** - XSS protection, CSRF tokens, content security policy
- **Rate Limiting** - Prevents brute force attacks on auth endpoints
- **Input Validation** - Server-side validation with user-friendly error messages
- **User Authorization** - Tasks are scoped to authenticated users only
- **Production Ready** - Optimized for Vercel deployment with PostgreSQL

<br>

## Tech Stack

### **Backend**
- **Laravel 12** - Modern PHP framework with excellent security
- **PostgreSQL** - Robust relational database (Supabase in production)
- **Laravel Sanctum** - API authentication
- **Form Requests** - Structured input validation

### **Frontend**
- **Alpine.js** - Lightweight reactive framework for interactivity
- **Tailwind CSS v4** - Utility-first CSS with custom design system
- **Vite** - Lightning-fast build tool and HMR
- **Blade Components** - Reusable UI components and partials

### **DevOps & Deployment**
- **Vercel** - Serverless hosting with global CDN
- **GitHub Actions** - Automated deployments
- **Composer** - PHP dependency management
- **npm** - Node.js package management

<br>

## Architecture Highlights

### **MVC Pattern**
```
├── Models/          # Eloquent models with relationships
├── Controllers/     # RESTful controllers with validation
├── Views/           # Blade templates with components
├── Middleware/      # Security headers, auth, rate limiting
└── Routes/          # Protected route groups
```

### **Frontend Architecture**
```
├── Alpine Store     # Centralized state management
├── Components/      # Reusable Alpine.js components
├── Optimistic UI    # Instant feedback with rollback
└── AJAX Integration # Seamless server communication
```

### **Security Implementation**
- **CSRF Protection** on all forms
- **SQL Injection Prevention** via Eloquent ORM
- **XSS Protection** with input sanitization
- **User Authorization** checks on all operations
- **Secure Headers** (CSP, HSTS, X-Frame-Options)

<br>

## Getting Started

### **Prerequisites**
- PHP 8.2+
- Composer
- Node.js 18+
- PostgreSQL (for production)

### **Local Development**
```bash
# Clone repository
git clone https://github.com/KiwiFunk/laralist.git
cd laralist

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
touch database/database.sqlite
php artisan migrate

# Build assets and serve
npm run dev
php artisan serve
```

### **Production Deployment**
This app is optimized for **Vercel** deployment:

1. **Database**: Configure PostgreSQL (Supabase recommended)
2. **Environment**: Set production variables in Vercel dashboard
3. **Deploy**: Connect GitHub repo to Vercel
4. **Migrate**: Run `php artisan migrate --force` in production

<br>

## Key Features Showcase

### **Optimistic Updates**
```javascript
// Example: Task completion with instant UI feedback
async toggleTaskStatus() {
    // Update UI immediately
    this.$store.taskManager.toggleTask(this.taskId);
    
    try {
        await fetch(`/tasks/${this.taskId}/toggle`, { /* ... */ });
    } catch (error) {
        // Rollback on failure
        this.$store.taskManager.toggleTask(this.taskId);
    }
}
```

### **Security Middleware**
```php
// Custom security headers middleware
class SecurityHeaders {
    public function handle(Request $request, Closure $next): Response {
        $response = $next($request);
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        // ... additional security headers
    }
}
```

### **User-Scoped Data**
```php
// Automatic user scoping in controllers
public function index() {
    $tasks = Auth::user()->tasks()
        ->orderBy('created_at', 'desc')
        ->get();
    return view('tasks.index', compact('tasks'));
}
```
<br>

## Future Enhancements

- **Drag & Drop** - Reorder tasks with ease
- **Categories/Tags** - Organize tasks by project or priority
- **Due Dates** - Calendar integration with reminders
- **Team Collaboration** - Share tasks with other users
- **Dark/Light Mode** - Theme switching capability


<div align="center">

<br>
<br>

*Built with ❤️ using Laravel, Alpine.js, and Tailwind CSS*

</div>