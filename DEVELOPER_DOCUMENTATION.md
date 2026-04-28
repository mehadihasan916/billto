# BillTo Developer Documentation

## 1. Project Overview

**BillTo** is a Laravel-based invoicing and subscription management web application. It supports:
- Invoice creation, editing, downloading, previewing, and sending via email
- Product line items per invoice
- Subscription plans and Stripe payment processing
- Document uploads and management
- Multi-language support and social login
- Admin panel for package, template, user, invoice, and traffic management

### Tech stack
- PHP 8.3+
- Laravel 10
- MySQL / MariaDB (or another supported SQL database)
- Blade templates for the frontend
- Laravel Sanctum for API auth
- Stripe for payments
- DomPDF / mPDF / Browsershot for PDF generation
- Laravel Cashier for subscription billing helper integration
- npm / Laravel Mix for frontend asset compilation

### System requirements
- PHP 8.3 or later
- Composer
- Node.js + npm
- A web server or `php artisan serve`
- Database server (MySQL, MariaDB, PostgreSQL, etc.)
- Writable `storage/` and `bootstrap/cache/`

---

## 2. Architecture Overview

### MVC pattern
BillTo follows Laravel's MVC architecture:
- `app/Models` contains Eloquent models and relationships
- `app/Http/Controllers` contains business logic and request handling
- `resources/views` contains Blade templates and presentation logic
- `routes/*.php` defines application routes and middleware

### Folder structure
- `app/` - core application code
  - `Http/Controllers/` - controllers
  - `Models/` - Eloquent models
  - `Http/Middleware/` - route middleware
  - `Http/Requests/` - form request validation classes
  - `Services/` - external service integration logic
  - `Mail/` - mailable classes
  - `View/Components/` - Blade component classes
- `config/` - application configuration files
- `database/` - migrations, seeders, factories
- `public/` - public web assets and entry point
- `resources/` - CSS, JS, views, language files
- `routes/` - route definitions
- `storage/` - logs, cache, compiled views
- `tests/` - PHPUnit tests

### Key design patterns used
- **Eloquent ORM** models for database access
- **Laravel middleware** for auth, admin access, language selection
- **Laravel FormRequest** validation in several request classes
- **Service class** for Gemini API integration
- **Repository-style logic** in controllers for invoice and payment workflows
- **Blade templating** for structured HTML output and PDF generation

---

## 3. Installation & Setup

### Prerequisites
- PHP 8.3+
- Composer
- Node.js + npm
- Database server
- Stripe account and API keys
- Mail provider credentials

### Step-by-step installation
```bash
cd billto_app
composer install
npm install
```

Copy environment config:
- Linux/macOS: `cp .env.example .env`
- Windows PowerShell: `copy .env.example .env`

Generate app key:
```bash
php artisan key:generate
```

### Environment configuration
Edit `.env` and set:
```env
APP_NAME=BillTo
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=billto
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="BillTo"

STRIPE_SECRET=
GEMINI_API_KEY=
```

### Database setup and migrations
```bash
php artisan migrate
php artisan db:seed
```
If you need to reset migrations while developing:
```bash
php artisan migrate:fresh --seed
```

### Running the application
- Build frontend assets:
```bash
npm run dev
```
- Start the app:
```bash
php artisan serve
```
- Access the app at `http://127.0.0.1:8000`

---

## 4. Database Schema

### Core tables

#### `users`
- `id`
- `name`
- `email`
- `email_verified_at`
- `password`
- `remember_token`
- `is_admin`
- `address`
- `phone`
- `profileImage`
- `picture__input`
- `signature`
- `terms`
- `provider`
- `provider_id`
- `invoice_logo`
- timestamps

#### `invoices`
- `id`
- `user_id` → `users.id`
- `session_id`
- `invoice_logo`
- `invoice_form`
- `invoice_to`
- `invoice_id`
- `invoice_date`
- `invoice_payment_term`
- `invoice_dou_date`
- `invoice_po_number`
- `invoice_notes`
- `invoice_terms`
- `invoice_tax_percent`
- `invoice_tax_amounts`
- `requesting_advance_amount_percent`
- `receive_advance_amount`
- `total`
- `final_total`
- `currency`
- `template_name`
- `subtotal_no_vat`
- `discount_percent`
- `discount_amounts`
- `balanceDue_amounts`
- `invoice_signature`
- `invoice_status` (`complete`, `incomlete`)
- `status_due_paid` (`due`, `paid`, `draft`)
- timestamps

#### `products`
- `id`
- `invoice_id` → `invoices.id`
- `product_name`
- `product_quantity`
- `product_rate`
- `product_amount`
- timestamps

#### `payment_getways`
- `id`
- `user_id`
- `amount`
- `stripe_id`
- `subscription_package_id`
- `organization_package_id`
- timestamps

#### `subscriptions`
- `id`
- `user_id`
- `package_id`
- `payment_record_id`
- `name`
- `price`
- `invoice_template`
- `invoice_generate`
- `duration`
- `status`
- `starts_at`
- `ends_at`
- `notified`
- timestamps

#### `subscription_packages`
- `id`
- `packageName`
- `packageDuration`
- `price`
- `templateQuantity`
- `limitInvoiceGenerate`
- `templateQuantitybn`
- `limitInvoiceGeneratebn`
- `packageDurationbn`
- `pricebn`
- timestamps

#### `subscription_package_templates`
- `id`
- `subscriptionPackageId`
- `template`
- `company`
- timestamps

#### `invoice_templates`
- `id`
- `templateName`
- `templateDesignHtml`
- `templateImage`
- `company`
- timestamps

#### `complate_invoice_counts`
- `id`
- `user_id`
- `count_invoice_id`
- `invoice_count_total`
- `current_invoice_total`
- timestamps

#### `send_mail_infos`
- `id`
- `user_id`
- `send_mail_to`
- `mail_subject`
- `mail_body`
- `invoice_tamplate_id`
- timestamps

#### `invc_pymnt_transctions`
- `id`
- `invoice_id`
- `user_id`
- `new_payment`
- `payment_date`
- timestamps

#### `documents`
- `id`
- `document_image`
- `document_type_id`
- `user_id`
- timestamps

#### `document_types`
- `id`
- `document_type`
- timestamps

#### `invoice_templates`
- `id`
- `templateName`
- `templateDesignHtml`
- `templateImage`
- `company`
- timestamps

#### `organization_packages`
- `id`
- `organizationPackageName`
- `organizationPackageDuration`
- `organizationPackageQuantity`
- `limitBillGenerate`
- `price`
- `organizationEmployeeLimitation`
- timestamps

#### `organization_package_templates`
- `id`
- `organizationPackageId`
- `template`
- timestamps

#### `payment_records`
- `id`
- `user_id`
- `order_id`
- `stripe_id`
- `package_id`
- `package_price`
- `package_name`
- timestamps

#### `traffic`
- `id`
- `ip_address`
- `country_code`
- `country_name`
- `region_name`
- `city_name`
- `zip_code`
- `latitude`
- `longitude`
- `timezone`
- `isp`
- `org`
- `as_name`
- `browser`
- `device_type`
- `platform`
- `request_uri`
- `referer`
- `user_agent`
- `created_at`
- `updated_at`

#### `templates`
- `id`
- `templateName`
- `templateDesignHtml`
- `templateImage`
- timestamps

#### Default Laravel tables
- `password_resets`
- `failed_jobs`
- `personal_access_tokens`

### ER Diagram (text)
```
users
  ├─< invoices
  │      └─< products
  ├─< payment_getways
  │      └─ subscription_packages
  ├─< subscriptions
  │      └─ payment_records
  ├─< documents
  │      └─ document_types
  └─< complate_invoice_counts

subscription_packages
  └─< subscription_package_templates

organization_packages
  └─< organization_package_templates

invoice_templates

traffic
```

### Key indexes and constraints
- `invoices.user_id` has foreign key to `users.id`
- `products.invoice_id` has foreign key to `invoices.id`
- Most references are stored as integer IDs without explicit Laravel foreign keys (`payment_getways`, `subscriptions`, `documents`)
- `complate_invoice_counts.user_id` is used for monthly invoice limits

---

## 5. Routes Documentation

### `routes/web.php`

| Method | URI | Controller@Method | Middleware | Purpose |
|---|---|---|---|---|
| GET | `/lang/{lang}` | `LanguageController@switchLang` | web | Switch application locale |
| GET | `/` | `PagesController@index` | web | Landing page with packages and templates |
| POST | `/load-data` | `PagesController@loadData` | web | AJAX load templates |
| GET | `/privacy-policy` | `PagesController@privacyPolicy` | web | Privacy policy page |
| POST | `/create/bill` | `PagesController@createbill` | web | Bill creation entry point |
| GET | `/payment-gateway/{package_id}` | `SubscriptionPackContoller@payment_gateway` | web | Payment gateway page |
| GET | `/packages` | `SubscriptionPackContoller@showAllPackages` | web | Display all subscription packages |
| POST | `/products/create` | `ProductController@index` | web | AJAX create product line item |
| POST | `/product/store` | `ProductController@store` | web | Save product item |
| DELETE | `/products/delete/{id}` | `ProductController@destroy` | web | Delete product item |
| PUT | `/products/update` | `ProductController@update` | web | Update product item |
| GET | `/create/invoice` | `InvoiceController@index` | web | Show invoice creation form |
| POST | `/invoices/store` | `InvoiceController@store` | auth, verified | Save invoice data |
| GET | `/invoice/complate/page/{id}` | `InvoiceController@complate_invoice` | auth, verified | Mark invoice complete |
| GET | `/home/invoice/page/{id}` | `InvoiceController@index_home` | auth, verified | Load invoice creation by template ID |
| POST | `/invoices/complete/{id}` | `InvoiceController@complete` | auth, verified | Draft or complete invoice action |
| GET | `/invoice/download/{id}` | `InvoiceController@invoice_download` | auth, verified | Download invoice PDF |
| POST | `/create/invoice/send` | `InvoiceController@send_invoice` | auth, verified | Email invoice PDF |
| POST | `/payment/store` | `SubscriptionPackContoller@payment_gateway_store` | auth, verified | Persist payment gateway data |
| GET | `/preview/image/{id}` | `InvoiceController@previewImage` | auth, verified | Render invoice preview HTML |
| GET | `/show-invoice` | `InvoiceController@show_invoice` | auth, verified | Demo invoice view and PDF send code |
| POST | `/create-payment-intent` | `StripeController@createIntent` | auth, verified | Stripe PaymentIntent creation |
| POST | `/process-payment` | `StripeController@processPayment` | auth, verified | Finalize Stripe payment and save records |
| GET | `/payment/success` | `StripeController@success` | auth, verified | Show success page |
| GET | `/test/bill` | `DashboardController@test_bill` | web | Test route to set admin flag |
| GET | `/optimize-clear` | closure | web | Clear application caches |
| GET | `/clear-cache` | closure | web | Clear and optimize cache |
| GET | `/notice/div/hidden` | closure | web | Set UI session flag |
| GET | `/chat` | closure | web | Show Gemini chat page |

### `routes/dashboard.php`

All routes in this file use `auth` and `verified` middleware.

| Method | URI | Controller@Method | Purpose |
|---|---|---|---|
| GET | `/all/invoices` | `DashboardController@allInvoice` | User invoice dashboard |
| DELETE | `/delete/invoices/{id}` | `DashboardController@destroy` | Remove invoice |
| GET | `/edit/invoices/{id}` | `DashboardController@edit` | Edit invoice |
| GET | `/settigns` | `SettignsController@Settign` | User settings page |
| GET | `/default-setting` | `SettignsController@DefaultSetting` | Default settings page |
| GET | `/my-all-invoice` | `SettignsController@Myallinvoice` | Show all user invoices |
| GET | `/my-trash-invoice` | `SettignsController@MyTrashinvoice` | Show draft invoices |
| GET | `/all/invoices/user-setting` | `DashboardController@userSettingEdit` | Edit profile form |
| PUT | `/all/invoices/user-setting{id}` | `DashboardController@userUpdate` | Update user profile |
| POST | `/all/invoices/change-password` | `DashboardController@changePassword` | Change password |
| GET | `/unpaid/invoice/list` | `DashboardController@unpaid_invoice` | Show unpaid invoices |
| GET | `/pertialy/payment/list` | `DashboardController@pertialy_payment` | Show partially paid invoices |
| GET | `/over/due/payment/list/` | `DashboardController@over_due_payment` | Show overdue invoices |
| GET | `/all/invoices/send-by-Mail` | `DashboardController@SendByMail` | Sent email history |
| GET | `/create/invoice/view/{id}` | `DashboardController@user_view_tamplate` | Invoice preview |
| GET | `/create/invoice/payment/{id}` | `DashboardController@user_view_payment` | Invoice payment page |
| POST | `/create/invoice/payment/save` | `DashboardController@user_payment_save` | Save invoice payment |
| POST | `/search-result` | `DashboardController@search_result` | Search invoices by date/status |
| GET | `/all/invoices/documents` | `DashboardController@user_documents` | Document index |
| POST | `/user-document/store` | `DashboardController@user_documents_store` | Upload document |
| GET | `/document/view/{id}` | `DashboardController@user_documents_view` | View document details |
| GET | `/document/edit/{id}` | `DashboardController@user_documents_edit` | Edit document |
| POST | `/user-document/update` | `DashboardController@user_documents_update` | Update document |
| GET | `/document/delete/{id}` | `DashboardController@user_documents_delete` | Delete document |

### `routes/auth.php`

These are standard Laravel auth routes with guest and auth guard middleware.

| Method | URI | Controller@Method | Middleware | Purpose |
|---|---|---|---|---|
| GET | `/register` | `RegisteredUserController@create` | guest | Show registration|
| POST | `/register` | `RegisteredUserController@store` | guest | Create user|
| GET | `/login` | `AuthenticatedSessionController@create` | guest | Show login|
| POST | `/login` | `AuthenticatedSessionController@store` | guest | Authenticate|
| GET | `/forgot-password` | `PasswordResetLinkController@create` | guest | Show reset request|
| POST | `/forgot-password` | `PasswordResetLinkController@store` | guest | Send password reset|
| GET | `/reset-password/{token}` | `NewPasswordController@create` | guest | Show reset form|
| POST | `/reset-password` | `NewPasswordController@store` | guest | Reset password|
| GET | `/verify-email` | `EmailVerificationPromptController` | auth | Email verification notice|
| GET | `/verify-email/{id}/{hash}` | `VerifyEmailController` | signed, throttle | Verify email|
| POST | `/email/verification-notification` | `EmailVerificationNotificationController@store` | auth, throttle | Resend verification|
| GET | `/confirm-password` | `ConfirmablePasswordController@show` | auth | Confirm password|
| POST | `/confirm-password` | `ConfirmablePasswordController@store` | auth | Confirm password submit|
| POST | `/logout` | `AuthenticatedSessionController@destroy` | auth | Logout|

### `routes/socialite.php`

| Method | URI | Action | Purpose |
|---|---|---|---|
| GET | `/auth/{provider}/redirect` | Closure | Redirect to social provider |
| GET | `/auth/{provider}/callback` | Closure | Handle provider callback and local login |

### `routes/api.php`

| Method | URI | Controller@Method | Middleware | Purpose |
|---|---|---|---|---|
| POST | `/api/generate-text` | `GeminiController@generateText` | api | Generate AI text via Gemini |
| GET | `/api/user` | closure | auth:sanctum | Return authenticated user info |

### `routes/admin.php`

Admin routes are grouped under `/admin` and require `auth` + `admin` middleware.

| Method | URI | Controller@Method | Purpose |
|---|---|---|---|
| GET | `/admin/dashboard` | `PageController@index` | Admin dashboard |
| GET | `/admin/package/page` | `SubscriptionPackageController@create` | Add package form |
| POST | `/admin/package/store` | `SubscriptionPackageController@store` | Create subscription package |
| GET | `/admin/package/{id}/edit` | `SubscriptionPackageController@edit` | Edit package |
| PUT | `/admin/package/{id}` | `SubscriptionPackageController@update` | Update package |
| GET | `/admin/package/{id}/delete` | `SubscriptionPackageController@destroy` | Delete package |
| GET | `/admin/package/list` | `SubscriptionPackageController@index` | Package list |
| POST | `/admin/package/updates` | `SubscriptionPackageController@packageUpdate` | Batch package updates |
| GET | `/admin/package/{id}/addRow` | `SubscriptionPackageController@addRow` | Add package row |
| POST | `/admin/package/addRow` | `SubscriptionPackageController@addRowStore` | Save package row |
| GET | `/admin/organization/package/page` | `OrganizationPackageController@create` | Org package form |
| POST | `/admin/organization/package/store` | `OrganizationPackageController@store` | Create org package |
| GET | `/admin/organization/package/{id}/edit` | `OrganizationPackageController@edit` | Edit org package |
| PUT | `/admin/organization/package/{id}` | `OrganizationPackageController@update` | Update org package |
| GET | `/admin/organization/package/{id}/delete` | `OrganizationPackageController@destroy` | Delete org package |
| GET | `/admin/organization/package/list` | `OrganizationPackageController@index` | Org package list |
| GET | `/admin/manage/template/page` | `InvoiceTemplateController@create` | Add invoice template |
| POST | `/admin/manage/template/store` | `InvoiceTemplateController@store` | Save invoice template |
| GET | `/admin/manage/template/{id}/edit` | `InvoiceTemplateController@edit` | Edit invoice template |
| PUT | `/admin/manage/template/{id}` | `InvoiceTemplateController@update` | Update invoice template |
| GET | `/admin/manage/template/{id}/delete` | `InvoiceTemplateController@destroy` | Remove invoice template |
| GET | `/admin/docoment/create` | `DoumentController@document_create` | Admin add document |
| POST | `/admin/store/document` | `DoumentController@document_store` | Save admin document |
| GET | `/admin/users` | `UserController@index` | List users |
| DELETE | `/admin/users/{user}` | `UserController@destroy` | Delete user |
| GET | `/admin/user-edit/{id}` | `UserController@edit` | Edit user |
| PUT | `/admin/user-update/{id}` | `UserController@update` | Update user |
| GET | `/admin/send-expired-notification/{id}` | `UserController@sendExpiredMail` | Send expiry email |
| GET | `/admin/invoice` | `InvoiceController@index` | Admin invoice list |
| DELETE | `/admin/invoice/{id}` | `InvoiceController@destroy` | Delete invoice |
| GET | `/admin/profile/{id}` | `InvoiceController@userInvoices` | View user invoices |
| GET | `/admin/traffic` | `TrafficController@index` | Traffic analytics |

---

## 6. Models Documentation

### `App\Models\User`
- Table: `users`
- Fillable: `name`, `address`, `email`, `password`, `phone`, `profileImage`, `picture__input`, `signature`, `terms`, `email_verified_at`, `provider`, `provider_id`, `invoice_logo`
- Hidden: `password`, `remember_token`
- Casts: `email_verified_at` => `datetime`, `is_admin` => `integer`
- Relationships:
  - `invoice()` → `hasMany(Invoice::class)`
  - `paymentGetway()` → `hasOne(PaymentGetway::class)`
  - `subscription()` → `hasOne(Subscription::class)->latestOfMany()`
  - `used_invoices()` → `hasOne(ComplateInvoiceCount::class)`
  - `latestSubscription()` → `hasOne(Subscription::class)->latestOfMany('created_at')`
- Key behavior: cascading delete of related invoices, payment gateway record, subscription, and invoice counts

### `App\Models\Invoice`
- Table: `invoices`
- Guarded: `[]`
- Relationships:
  - `products()` → `hasMany(Product::class)`
- Used for invoice generation, PDF downloads, email sending, status updates, and due payments

### `App\Models\Product`
- Table: `products`
- Guarded: `[]`
- Relationships:
  - `invoice()` → `hasOne(Invoice::class)`

### `App\Models\SubscriptionPackage`
- Table: `subscription_packages`
- Fillable: `packageDuration`, `packageDurationbn`, `price`, `pricebn`, `templateQuantity`, `limitInvoiceGenerate`, `templateQuantitybn`, `limitInvoiceGeneratebn`
- Relationships:
  - `templates()` → `belongsToMany(InvoiceTemplate::class, 'subscription_package_templates', 'subscriptionPackageId', 'template')`

### `App\Models\Subscription`
- Table: `subscriptions`
- Fillable: `user_id`, `package_id`, `payment_record_id`, `name`, `price`, `invoice_template`, `invoice_generate`, `duration`, `status`, `starts_at`, `ends_at`, `notified`

### `App\Models\PaymentGetway`
- Table: `payment_getways`
- Guarded: `[]`
- Stores user payment gateway state and selected plan

### `App\Models\PaymentRecord`
- Table: `payment_records`
- Guarded: `[]`
- Stores Stripe order IDs and package details

### `App\Models\SendMail_info`
- Table: `send_mail_infos`
- Guarded: `[]`
- Logs invoice email sends

### `App\Models\InvcPymntTransction`
- Table: `invc_pymnt_transctions`
- Guarded: `[]`
- Stores invoice payment transactions

### `App\Models\Document`
- Table: `documents`
- Fillable: `document_image`, `document_type_id`, `user_id`

### `App\Models\DocumentType`
- Table: `document_types`
- Fillable: `document_type`

### `App\Models\InvoiceTemplate`
- Table: `invoice_templates`
- Fillable: `templateName`, `templateDesignHtml`, `templateImage`, `company`

### `App\Models\ComplateInvoiceCount`
- Table: `complate_invoice_counts`
- Guarded: `[]`
- Tracks invoice usage counts per user

### `App\Models\Template`
- Table: `templates`
- Basic Eloquent model without fillable or relationships

### `App\Models\SubscriptionPackege`
- Table: `subscription_packs`
- Plain model used for historic or legacy package records

### `App\Models\OrganizationPackage`
- Table: `organization_packages`
- Fillable not set explicitly

### `App\Models\OrganizationPackageTemplate`
- Table: `organization_package_templates`
- Fillable not set explicitly

---

## 7. Controllers Documentation

### Invoice and billing

#### `App\Http\Controllers\InvoiceController`
- Purpose: invoice creation, storage, PDF download, email sending, preview, and related invoice workflows
- Key methods:
  - `index()` → show invoice creation page for authenticated or guest users
  - `index_home($id)` → load invoice page for a selected template
  - `store(Request $request)` → validate invoice payload, enforce package/template access, store invoice, update usage counters, handle logo uploads
  - `invoice_download($id)` → generate invoice PDF using mPDF and return inline PDF
  - `send_invoice(Request $request)` → generate invoice PDF and email it to a recipient
  - `previewImage($id)` → render invoice preview HTML
  - `complate_invoice($id)` → mark invoice status complete
- Validation rules in `store()` include required currency, invoice_form, invoice_to, invoice_id, invoice_date, and max length settings

#### `App\Http\Controllers\Payment\StripeController`
- Purpose: Stripe payment integration
- Key methods:
  - `createIntent(Request $request)` → create Stripe PaymentIntent and return `clientSecret`
  - `processPayment(Request $request)` → validate package data, create/update `PaymentGetway`, `PaymentRecord`, `Subscription`, initialize invoice count, set session data
  - `success(Request $request)` → show Stripe success page
- Validation: `package_price` and `package_id` required
- Note: no Stripe webhook is implemented in the current codebase

### Frontend pages and package browsing

#### `App\Http\Controllers\Frontend\PagesController`
- Purpose: render homepage, templates partial loading, privacy policy, and public invoice creation actions
- Key methods:
  - `index(Request $request)` → home page with package categories and traffic capture
  - `loadData(Request $request)` → load additional invoice templates via AJAX
  - `privacyPolicy()` → privacy page view
  - `createbill(Request $request)` → current bill creation entry point

#### `App\Http\Controllers\Frontend\SubscriptionPackContoller`
- Purpose: show package list and payment gateway page
- Key methods:
  - `payment_gateway($package_id)` → load payment page by package
  - `showAllPackages()` → display public package listing
  - `payment_gateway_store(Request $request)` → persist payment gateway data for authenticated users

### Dashboard and user management

#### `App\Http\Controllers\Frontend\DashboardController`
- Purpose: user dashboard, invoices, payment history, documents, search, billing, and account settings
- Key methods:
  - `allInvoice()` → dashboard invoice overview and financial summary
  - `edit($id)` → edit existing invoice
  - `destroy($id)` → delete invoice
  - `userSettingEdit()` → show profile edit form
  - `userUpdate(UpdateUserRequest $request, $id)` → update user fields and file uploads
  - `changePassword(Request $request)` → password update
  - `SendByMail()` → invoice email history
  - `user_view_tamplate($id)` → invoice preview render
  - `user_view_payment($id)` → render due payment form
  - `user_payment_save(Request $request)` → record invoice partial/full payment
  - `search_result(Request $request)` → invoice search by date/status
  - `unpaid_invoice()`, `pertialy_payment()`, `over_due_payment()` → invoice filters
  - `user_documents()`, `user_documents_store()`, `user_documents_view()`, `user_documents_edit()`, `user_documents_update()`, `user_documents_delete()` → document CRUD
- Key validation rules:
  - Profile update accepts nullable user fields and files
  - Payment save requires amount, date, invoice id, invoice user id
  - Search result requires `from_date`, `to_date`, and `invoice_status`

#### `App\Http\Controllers\Frontend\SettignsController`
- Purpose: settings pages and invoice overview views
- Key methods: `Settign()`, `DefaultSetting()`, `Myallinvoice()`, `MyTrashinvoice()`

### Admin controllers

- `App\Http\Controllers\Admin\UserController`
- `App\Http\Controllers\Admin\InvoiceController`
- `App\Http\Controllers\Admin\PageController`
- `App\Http\Controllers\Admin\TrafficController`
- `App\Http\Controllers\Admin\DoumentController`
- `App\Http\Controllers\SubscriptionPackageController`
- `App\Http\Controllers\OrganizationPackageController`
- `App\Http\Controllers\InvoiceTemplateController`

These handle admin CRUD for users, invoices, packages, templates, documents, and analytics.

### AI / Gemini integration

#### `App\Http\Controllers\GeminiController`
- Purpose: generate AI text via GeminiService
- Method: `generateText(Request $request)`
- Request payload: `{ "prompt": "..." }`
- Response: JSON with generated content or error

---

## 8. API Endpoints

### `POST /api/generate-text`
- Auth: none
- Payload: `{ "prompt": "Your text prompt" }`
- Response example:
```json
{
  "prompt": "Your text prompt",
  "generated_content": "..."
}
```
- Errors:
  - 400 if prompt is missing
  - 500 if Gemini fails

### `GET /api/user`
- Auth: `auth:sanctum`
- Response: authenticated user JSON

---

## 9. Payment Integration

### Stripe integration details
- Uses `Stripe\PaymentIntent` to create client secrets
- Uses `Stripe::setApiKey(env('STRIPE_SECRET'))`
- Stores payment results in `payment_getways`, `payment_records`, and `subscriptions`

### Payment flow (text diagram)
```
User selects package -> POST /create-payment-intent -> Stripe PaymentIntent created ->
Client confirms payment -> POST /process-payment -> save gateway/payment record/subscription ->
redirect to /payment/success
```

### Webhook handling
- No Stripe webhook handler is implemented in the current codebase
- `processPayment()` is used instead of event-based webhook processing

### Testing payment flows
- Set `STRIPE_SECRET` in `.env`
- Use Stripe test cards on the frontend
- Confirm `clientSecret` is returned from `/create-payment-intent`
- Confirm `/process-payment` saves a payment record and subscription

---

## 10. Features Documentation

### Invoice management
- Create invoices with line items
- Store and update invoice totals, tax, discounts, and payment status
- Mark invoices complete, draft, paid, due, or partially paid
- Download invoice PDF and send invoices by email

### PDF generation process
- `InvoiceController@invoice_download()` uses mPDF
- User plan controls PDF templates and rendering
- `InvoiceController@show_invoice()` also supports Browsershot PDF generation
- PDF view templates are located in `resources/views/invoices/`

### Email functionality
- `InvoiceController@send_invoice()` builds PDF and emails it using Laravel Mail
- Sent email records are stored in `send_mail_infos`

### Subscription management
- `SubscriptionPackContoller` displays packages and payment options
- `StripeController` handles package purchase and subscription creation
- User `PaymentGetway` records store current plan state
- `ComplateInvoiceCount` tracks invoice usage limits per user

### Document handling
- Users can upload documents in the dashboard
- Documents are stored in `uploads/document/`
- Supported actions: create, edit, view, delete

### Multi-language support
- `Language` middleware sets locale from session `applocale`
- `GET /lang/{lang}` updates the current language route
- Language config is read from `config/languages.php`

---

## 11. Middleware & Guards

### Custom middleware
- `EnsureAdminIsValid` (`admin`) checks `Auth::user()->is_admin === 1`
- `Language` sets locale from session and fallback locale

### Built-in middleware in use
- `auth`
- `guest`
- `verified`
- `signed`
- `throttle`
- `auth:sanctum`

### Authorization policies
- No Laravel policy classes are present in the inspected codebase
- Access control is primarily handled through middleware

---

## 12. Services & Helpers

### Custom services
- `App\Services\GeminiService`
  - Uses Guzzle to call Google Gemini API
  - Expects `GEMINI_API_KEY` in `.env`
  - Returns generated text or logs errors

### Helper functions
- `app/helpers.php`
  - `tax($amount, $tax)` → returns calculated tax amount

### Utility classes
- `App\View\Components\AppLayout`, `GuestLayout`, and `Input` are Blade components for UI composition

---

## 13. Frontend Assets

### Asset compilation process
- Uses Laravel Mix in `webpack.mix.js`
- Compiles:
  - `resources/js/app.js` → `public/js/app.js`
  - `resources/sass/app.scss` → `public/css/app.css`
- Run `npm run dev` for development and `npm run production` for optimized production assets

### CSS/JS structure
- `resources/sass/` contains SCSS styles
- `resources/js/` contains JavaScript entry point
- Public assets appear under `public/css`, `public/js`, and `public/assets`

### Blade components/layouts
- `resources/views/layouts/` likely contains base layout files
- `app/View/Components/` contains reusable Blade component logic

---

## 14. Deployment

### Production setup checklist
- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Configure database credentials
- Configure mail transport
- Configure Stripe `STRIPE_SECRET`
- Configure Gemini `GEMINI_API_KEY` if using AI text features
- Run `composer install --optimize-autoloader --no-dev`
- Run `npm run production`
- Run `php artisan migrate --force`
- Set correct permissions for `storage/` and `bootstrap/cache/`

### Required environment variables
- `APP_NAME`
- `APP_ENV`
- `APP_KEY`
- `APP_DEBUG`
- `APP_URL`
- `DB_*`
- `MAIL_*`
- `STRIPE_SECRET`
- `GEMINI_API_KEY`

### Performance optimization tips
- Use `php artisan route:cache`
- Use `php artisan config:cache`
- Use `php artisan view:cache`
- Use `npm run production`
- Keep `APP_DEBUG=false` in production
- Use a dedicated cache driver for sessions and config

---

## 15. Common Tasks

### Add a new route
1. Add the route to the appropriate `routes/*.php` file
2. Assign middleware and name it if needed
3. Implement the controller action
4. Add view or API response

### Create a new model
1. Create model in `app/Models`
2. Add migration in `database/migrations`
3. Define fillable/guarded fields
4. Add relationships
5. Use `php artisan make:model ModelName -m`

### Add payment methods
1. Add route and controller methods for the new payment flow
2. Add new service or SDK integration in `app/Services`
3. Update frontend to collect payment details
4. Store transaction records and update `subscriptions` or `payment_getways`

### Customize invoice templates
1. Update or add records in `invoice_templates`
2. Modify Blade views in `resources/views/invoices/`
3. Adjust PDF generation logic in `InvoiceController`
4. Update package template permissions in `subscription_package_templates`

---

## 16. Troubleshooting

### Common issues and solutions
- `500` errors after install: verify `.env`, run `php artisan key:generate`, and check database credentials
- `Stripe` issues: verify `STRIPE_SECRET` and ensure client-side payment intent flow uses valid amounts
- `Mail` issues: verify `MAIL_*` settings and use a working SMTP provider
- Missing view or CSS: run `npm run dev` or `npm run production`
- Permission errors: ensure `storage/` and `bootstrap/cache/` are writable

### Debug mode setup
- Set `APP_DEBUG=true` in `.env`
- Check `storage/logs/laravel.log`

### Log locations
- `storage/logs/laravel.log`
- `storage/framework/views/`
- `storage/framework/cache/`

---

## Notes & Known Gaps
- Stripe webhook support is not implemented; payment status is handled directly by `processPayment()`
- Some models use legacy or inconsistent table names (`subscription_packs`, `payment_getways`)
- `UpdateSubscriptionPackageRequest` and `UpdateOrganizationPackageRequest` are stubbed with `authorize()` returning false
- `GeminiService` requires a valid `GEMINI_API_KEY`

---

## Useful Commands
```bash
composer install
npm install
npm run dev
php artisan migrate
php artisan db:seed
php artisan serve
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
