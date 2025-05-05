# Curotec Laravel Assessment

This project is a technical assessment developed using **Laravel 10**, **Vue 3**, **Inertia.js**, **Pinia**, and **PostgreSQL**. It demonstrates a full-stack task management system with authentication, task categorization, and reactive state management.

## Scope of Work Completed

The following items were implemented within the timeframe:

- Laravel + Vue + Inertia full-stack setup with Breeze
- User authentication (login/register)
- Task CRUD (create, read, update, delete)
- Categories and subcategories (up to 2 levels)
- Tasks linked to categories
- Form validation (frontend + backend)
- Frontend fully reactive with Composition API + Pinia
- Modular component structure (form, list, composables)
- Task filtering by category (basic level)
- Feature and relationship unit tests (100% passing)
- Initial seeders for categories, tasks, and default user
- Documentation for project setup and testing

## Installation Instructions

1. Clone the repository and install backend and frontend dependencies:

```bash
composer install
npm install
```

2. Configure the `.env` file (PostgreSQL by default):

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=curotec
DB_USERNAME=your_pg_user
DB_PASSWORD=your_pg_password
```

3. Run the migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

4. Start development servers:

```bash
php artisan serve
npm run dev
```

## Default User

You can log in using the pre-created user:

```text
Email: me@joseiguti.com
Password: aneasywaytolivebetter
```

## Testing

All feature tests are located in `tests/Feature/TaskTest.php`.

To run the tests:

```bash
php artisan optimize:clear
./vendor/bin/phpunit
```

Expected output: 100% passing with no errors or failures.

---

The project is structured to be extendable, with clearly separated logic (API routes, Vue composables, modular components, centralized state). Advanced filters, sorting, and infinite scrolling were outlined but deprioritized due to time constraints.

## Notes and Limitations

Due to time constraints, the following items are either partially implemented or planned:

- Nested category selection in the UI (currently one level deep)
- Advanced filtering (by status, priority, date) is pending
- Priority and due date fields are ready in schema but not yet active in the UI
- Infinite scroll and query optimization not yet applied

The project is structured with clean separation and scalability in mind to easily support these features.

