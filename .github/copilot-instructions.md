# Copilot Instructions for Mqlprotection2 (IIS PHP App)

## Overview
This project is a PHP web application for managing MT4/MT5 account IDs, licenses, and user authentication. It is structured as a classic server-rendered PHP app with minimal JavaScript, using MySQL for data storage. The main UI is in the `iis/` directory.

## Architecture & Key Components
- **Authentication**: Handled in `index.php` (login) and `session.php` (session management, with session expiry logic).
- **Main Dashboard**: `index2.php` displays/searches customer accounts, with pagination and inline editing.
- **Settings/Admin**: `settings.php` provides admin controls for accounts and other settings.
- **Database Connection**: Centralized in `connection.php` (credentials and `$conn` object).
- **Account Management**: CRUD operations for accounts are in `set_customer.php`, `set_import_customers.php`, `set_export_customers.php`, etc.
- **Session Handling**: `session.php` manages session start and expiry (600s default, resets on activity).
- **Front-end**: Uses Bootstrap CSS (`include/bootstrap.min.css`), custom styles (`css/style.css`), and jQuery plugins for validation and date/time picking (`validation/`).

## Developer Workflows
- **No build step**: PHP files are interpreted directly. No transpilation or asset build required.
- **Testing**: No automated test suite present. Manual testing via browser is standard.
- **Debugging**: Use browser dev tools and PHP error logs (`error_log` in `iis/`).
- **Database**: MySQL is required. Connection details are in `connection.php`.
- **Session expiry**: Sessions auto-expire after 10 minutes of inactivity (see `session.php`).

## Project-Specific Conventions
- **Obfuscated/decoded code**: Some files were previously obfuscated; variable names may be non-descriptive.
- **Direct SQL**: SQL queries are written inline, with minimal abstraction. Use `mysqli_*` functions.
- **CAPTCHA**: Simple 4-character CAPTCHA is generated in `index.php` for login.
- **Redirects**: Use `header("Location: ...")` for navigation after actions.
- **Validation**: Input is validated with both PHP (server-side) and jQuery Validation Engine (client-side).
- **Error/Success messages**: Passed via query parameters and displayed inline in forms.

## Integration Points
- **External Libraries**: Bootstrap, jQuery, jQuery Validation Engine, jQuery DateTimePicker (all in `include/` or `validation/`).
- **No external API calls**: All logic is server-side and local.

## Examples & Patterns
- **Add customer**: POST to `set_customer.php` with `account_id`, `status`, `licenses`, `acc_type`, `expiry_date`.
- **Export customers**: Triggers CSV download via `set_export_customers.php`.
- **Session check**: Most pages include `session.php` and redirect to `index.php` if not logged in.

## Key Files/Directories
- `iis/index.php` – Login page
- `iis/index2.php` – Main dashboard
- `iis/settings.php` – Admin/settings panel
- `iis/connection.php` – DB connection
- `iis/session.php` – Session logic
- `iis/include/` – Front-end libraries
- `iis/validation/` – jQuery validation/date plugins
- `iis/css/style.css` – Custom styles

---

For questions about project structure or conventions, review the above files for concrete examples. When adding new features, follow the direct PHP+MySQL style and keep UI consistent with Bootstrap and existing forms.
