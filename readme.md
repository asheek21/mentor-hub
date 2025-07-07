# SkillBridge (WIP)

**SkillBridge** is a mentorship platform built with Laravel 12 where mentors and mentees can connect, book sessions, and collaborate effectively.  
This project is currently in **active development**.

---

## 🚧 Status

> This project is a **Work In Progress** and not yet ready for production.  
> Contributions, feedback, and design suggestions are welcome!

---

## 🔧 Tech Stack

- **Laravel 12** + Vite
- **Tailwind CSS** (custom frontend)
- **Livewire** (for interactive UI)
- **Laravel Filament** (admin panel)
- **PostgreSQL** (primary database)
- **Laravel Pest** (unit & feature testing)
- **Laravel Pint** (code formatting)
- **Larastan** (static analysis)
- **Husky** (pre-commit hook enforcement)

---

## 📦 Installation

```bash
git clone https://github.com/your-username/skillbridge.git
cd skillbridge

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure PostgreSQL database in .env
# Then run:
php artisan migrate
```

---

## 🧪 Code Quality & Testing

This project uses:

- ✅ **Pint** for automatic code formatting
- ✅ **Larastan** for static code analysis
- ✅ **Pest** for feature and unit testing
- ✅ **Husky** to block commits on issues

Run manually:

```bash
# Format code
vendor/bin/pint

# Static analysis
vendor/bin/phpstan analyse

# Run tests
vendor/bin/pest
```

---

## 🗂️ Directory Structure (WIP)

```
resources/views/
│
├── components/
│   └── landing/
│       ├── header.blade.php
│       ├── hero.blade.php
│       ├── features.blade.php
│       └── pricing.blade.php
│
├── auth/
│   └── login-modal.blade.php
│   └── register-modal.blade.php
```

---

## 📍 Roadmap

- [x] Setup Laravel 12 + Tailwind + Vite
- [x] Create landing page components
- [x] Implement mentor & mentee dashboards
- [ ] Add Livewire booking flow
- [ ] Integrate messaging between users
- [ ] Admin panel using Filament
- [ ] Test coverage using Pest


---

## 📃 License

This project is licensed under the [MIT License](LICENSE).

---

## 🙌 Contributions

Pull requests and suggestions are welcome. If you spot a bug or have an idea, open an issue or start a discussion!

---

## ✨ Author

Made with ❤️ by [Your Name](https://github.com/your-username)
