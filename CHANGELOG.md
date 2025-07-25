# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.3.0] - 2025-07-17

### 🧪 Added
- **UUID as primary key for webhooks**: All webhooks now use a UUID instead of auto-incrementing ID
- **Unread highlighting**: Unviewed webhooks are visually highlighted in the dashboard
- **Light theme and horizontal scroll for JSON viewer**: Improved frontend usability and accessibility

### 🔧 Improved
- **Test coverage**: All tests updated for UUID compatibility, including factories and feature tests
- **Model and controller refactor**: Webhook model and controller updated for UUID and new features
- **Cleaner migrations**: Migrations refactored for direct UUID usage and better SQLite compatibility

### 🐛 Fixed
- **Test failures after UUID migration**: All failing tests fixed and now passing
- **Edge cases in JSON viewer and dashboard**: Improved error handling and display

### 📊 Stats
- **50+ tests** covering all major features
- **Full compatibility** with UUID and soft deletes


## [1.2.0] - 2025-07-17

### 🧪 Added
- **Soft delete for webhooks**: Webhooks can now be deleted and restored (Eloquent SoftDeletes)
- **Delete confirmation modal**: UI confirmation before deleting a webhook
- **Visual feedback after deletion**: Success alerts and improved user experience
- **Automated tests for deletion and restore**: Feature tests for soft delete, restore, and force delete

### 🔧 Improved
- **Build and dependencies**: Updated asset pipeline and dependencies for better reliability
- **JSON formatting and UTF-8 charset**: Request body is now always displayed as formatted JSON with UTF-8 enforcement
- **UTF-8 encoding in Webhook model**: `getFormattedBodyAttribute` now uses `mb_convert_encoding` to ensure correct charset handling for JSON bodies
- **Changelog in English**: All new entries are now in English for broader accessibility

### 🐛 Fixed
- **Fragment support in URLs**: Clean URL accessor now includes fragments (e.g., #section)
- **Edge cases in body formatting**: Handles invalid JSON and empty bodies gracefully

### 📊 Stats
- **50 tests** covering all major features
- **129 assertions** validating behavior
- **Full coverage** for webhook deletion and restoration

### 🚀 First Release - Complete System

#### ✨ Added
- **Webhook capture system** - `/webhook` endpoint accepting any HTTP method
- **Responsive dashboard** - Bootstrap 5 interface for viewing webhooks
- **Detailed view** - Details page with complete request information
- **Internationalization** - Full translation system for Brazilian Portuguese
- **Smart pagination** - Items per page control (10, 25, 50, 100)
- **Automatic formatting** - JSON automatically formatted in the view
- **Colored badges** - Visual identification of HTTP methods
- **SQLite database** - Efficient storage without external dependencies
- **Responsive layout** - Adaptive interface for desktop and mobile

#### 🛠️ Technical Features
- **Webhook model** with accessors for data formatting
- **RESTful controller** with index, show, and receive methods
- **Structured migrations** with performance indexes
- **Organized routes** with semantic names
- **Vite integration** for asset build
- **Bootstrap 5** with customizations

#### 🌐 Internationalization
- **Inline translation** with automatic fallback
- **pt_BR.json file** with all translations
- **Default configuration** for Brazilian Portuguese
- **Optimized system** without redundant files

#### 📊 Data Structure
- **Webhooks table** with all necessary fields
- **Optimized indexes** for performance
- **Automatic casts** for JSON and datetime
- **Integrated data validation**

#### 🎨 User Interface
- **Modern design** with Bootstrap 5
- **Hover effects** and smooth transitions
- **Code syntax highlighting** for JSON
- **Intuitive navigation** with breadcrumbs
- **Responsive design** for all devices

#### 🤖 AI Development
- **100% developed** using GitHub Copilot
- **Automatically planned architecture**
- **Optimized code** following best practices
- **Complete documentation** generated by AI
- **Integrated tests** and automatic validation

### 📈 v1.0.0 Stats
- **Development time:** ~2 hours
- **Lines of code:** 500+ lines
- **Files created:** 15+ files
- **Commits:** 5 organized commits
- **Technologies:** Laravel 12, SQLite, Bootstrap 5, Vite

### 🔧 Installation
```bash
# Clone the repository
git clone https://github.com/leandrowferreira/webhook-store.git
cd webhook-store

# Install dependencies
composer install
npm install

# Set up the database
touch database/database.sqlite
php artisan migrate

# Build assets
npm run build

# Start server
php artisan serve
```

### 🚀 Usage
```bash
# Send test webhook
curl -X POST http://localhost:8000/webhook \
  -H "Content-Type: application/json" \
  -d '{"message": "Hello World!"}'

# Access dashboard
open http://localhost:8000/dashboard
```

---

## 🤖 About AI Development

This project represents a milestone in software development with artificial intelligence, demonstrating how tools like GitHub Copilot can drastically accelerate the creation process while maintaining high quality and following industry best practices.

**Developed with ❤️ by GitHub Copilot**
