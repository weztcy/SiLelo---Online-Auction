# SiLelo — Online Auction Platform

[![PHP](https://img.shields.io/badge/PHP-7.4%20%7C%208.x-777BB4?style=flat&logo=php&logoColor=white)](#)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.1.6-EE4623?style=flat&logo=codeigniter&logoColor=white)](#)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B%20%7C%208.x-4479A1?style=flat&logo=mysql&logoColor=white)](#)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4.x%20%2F%203.3.7-7952B3?style=flat&logo=bootstrap&logoColor=white)](#)
[![jQuery](https://img.shields.io/badge/jQuery-3.3.1-0769AD?style=flat&logo=jquery&logoColor=white)](#)
[![AdminLTE](https://img.shields.io/badge/AdminLTE-2.x-1E282C?style=flat)](#)
[![Google OAuth](https://img.shields.io/badge/Google_OAuth-2.0-4285F4?style=flat&logo=google&logoColor=white)](#)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](./LICENSE)

![SiLelo - Premier Online Auction Platform Banner](./screenshots/banner.png)

SiLelo is a full-stack online auction and curated marketplace web application built with PHP and CodeIgniter 3. Designed to elevate Indonesian online auctions into a transparent, secure, and bot-free ecosystem, SiLelo connects collectors, enthusiasts, and verified merchants (*Mitra Pelelang*) across luxury timepieces, flagship electronics, vintage rarities, sports memorabilia, and collectible automotive accessories.

Traditional e-commerce platforms and informal social media bidding groups frequently suffer from fraudulent bids (*bid palsu*), unverified sellers, runaway default risks, and fragmented post-auction settlement. SiLelo resolves these vulnerabilities by implementing an integrated multi-tier platform serving three specialized roles: **Public Bidders**, **Verified Auctioneers (Sellers)**, and **Super Administrators**. The system pairs an intuitive bidding engine with a security deposit escrow model (*deposit jaminan*)—ensuring every active participant holds validated collateral before submitting offers—accompanied by automated winning bid adjudication, unique invoice generation, and real-time interest-based recommendation tracking.

---

## Features

- **Multi-Role RBAC Ecosystem**: Segregated authorization portals and workflows for Super Administrators, verified Sellers (*Mitra Pelelang*), and Public Bidders (*Peserta Lelang*).
- **Deposit Escrow & Anti-Fake Bid Protection**: Mandatory security deposit verification system where bidders submit collateral proof through automated bank transfers before placing bids, eliminating bot bidding and phantom bids.
- **Dynamic Real-Time Bidding Engine**: Interactive product bidding with validated minimum bid increments, live competitor bid feeds, remaining auction countdown timers, and comprehensive bid audit logs.
- **Automated Winner Adjudication & Invoice Generation**: Automated auction resolution workflow allowing sellers and administrators to finalize the winning hammer price, trigger outbid notices to competing bidders, and generate formal invoices (`#INV/YYYY/MM/XXX`) with unique 3-digit verification codes and 10% tax calculations.
- **Deposit-Deducted Settlement**: Integrated invoice settlement allowing winners to offset winning totals directly against their active escrow deposits or execute dedicated bank transfer settlements.
- **Personalized Auction Recommendation Engine**: Behavioral interest telemetry tracking bidder category interactions (`abe_kategori_klik`) and bidder category preferences (`abe_rekomendasi`) to surface targeted auction lots.
- **Multi-Photo Lot Showcase & Asset Management**: Rich media upload pipeline enabling sellers to attach multiple high-resolution photos per auction item, complete with gallery thumbnails and deletion controls.
- **Seller Verification & Public Storefront**: Dedicated seller profile directories detailing business identity, physical gallery addresses, official contact information, and active vs. completed auction lots.
- **Super Administrator Control Room**: Comprehensive administrative oversight featuring pending lot moderation, seller onboarding verification, deposit receipt audit, account status toggles (active/blocked), and community satisfaction review moderation.
- **Dual Authentication Gateway**: Flexible user access supporting both native credential sign-in with MD5 hashing and seamless single sign-on via Google OAuth 2.0.

---

## Preview & Demo

The application user interface is organized across distinct portals tailored to each participant role:

![SiLelo Public Marketplace, Bidding Workflow & Lot Detail](./screenshots/SiLelo%20-%20Online%20Auction%201.png)
*Public Marketplace & Lot Showcase: Editorial homepage hero highlighting platform transaction telemetry and featured weekly lot (top-left); four-step onboarding guide detailing account registration, deposit funding, live bidding, and escrow shipping (top-right); category browsing directory with status indicators for upcoming, live, and closed lots (bottom-left); and comprehensive lot auction terminal featuring high-resolution image gallery, seller verification badge, countdown timer, and live bid placement (bottom-right).*

![SiLelo Multi-Portal Authentication Gateways](./screenshots/SiLelo%20-%20Online%20Auction%202.png)
*Authentication Architecture & Onboarding: Dedicated Mitra Pelelang sign-in terminal for inventory management (left); verified seller business registration form (middle); and high-security administrative authentication portal with specialized dark mode interface (right).*

![SiLelo Mitra Pelelang Command Center & Lot Management](./screenshots/SiLelo%20-%20Online%20Auction%203.png)
*Seller Command Dashboard: Verified seller public storefront with legal verification status and business gallery details (top-left); seller operational control center with KPI metric widgets (total lots, live lots, completed sales, incoming bids) and inventory table (top-right); multi-photo lot submission form with category assignment and reserve pricing (bottom-left); and bid transaction manager with real-time bidder lookup and winner selection actions (bottom-right).*

![SiLelo Bidder Portal, Escrow Wallet & Invoice Settlement](./screenshots/SiLelo%20-%20Online%20Auction%204.png)
*Bidder Self-Service & Financial Operations: Bidder profile and shipping address management with active deposit escrow balance card (top-left); live bid tracking feed displaying all active and past lot bids with status chips (top-right); auction invoice directory with payment verification tags (bottom-left); and granular invoice settlement sheet detailing hammer price, 3-digit verification code, PPN 10%, escrow deposit deduction, and net payable amount (bottom-right).*

![SiLelo Super Administrator Command Room & Moderation](./screenshots/SiLelo%20-%20Online%20Auction%205.png)
*Super Administrator Moderation Desk: Pre-auction lot curation and approval queue (top-left); deposit transfer audit terminal verifying incoming bank slips against destination bank accounts (top-right); centralized bidder user management with account status toggles (bottom-left); and bidder post-auction review and rating moderation panel (bottom-right).*

---

## Tech Stack

### Core Architecture
- **Language**: PHP 7.4+ / 8.x
- **Framework**: CodeIgniter 3.1.6 (Model-View-Controller Architecture)
- **Database**: MySQL 5.7+ / MariaDB 10.4+ (InnoDB Engine, `utf8_general_ci`)
- **Frontend Template Engine**: CodeIgniter Modular View Partials (`template_front` & `template_back`)
- **Public UI Framework**: Bootstrap 4.x, jQuery 3.3.1, Bootstrap Select, Owl Carousel
- **Admin & Seller UI**: AdminLTE 2.x, Bootstrap 3.3.7, DataTables, Bootstrap Datepicker
- **Typography & Icons**: Plus Jakarta Sans, Space Grotesk, Cinzel (Google Fonts), Font Awesome 4.7

### Tooling & Integrations
- **Authentication**: Native session-based auth with MD5 password hashing & Google OAuth 2.0 API Client
- **Email Service**: CodeIgniter Email Library with SMTP protocol support
- **Development Server**: PHP Built-in CLI Server routed via `router.php`
- **Database Scripts**: Native Windows MariaDB service automation (`start_db.bat`, `stop_db.bat`)

---

## Prerequisites

Before running the application locally, ensure the following tools are installed:

- **PHP**: Version 7.4 or higher (supports PHP 8.x with `#[\AllowDynamicProperties]` compatibility)
  - Required PHP extensions: `mysqli`, `curl`, `mbstring`, `fileinfo`, `openssl`, `gd`
- **Database Server**: MySQL 5.7+ or MariaDB 10.4+
- **Git**: For version control and cloning the repository
- **Optional**: Apache Web Server (XAMPP / Laragon / WampServer) if not using PHP's built-in CLI server

---

## Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/weztcy/SiLelo---Online-Auction.git
cd SiLelo---Online-Auction
```

### 2. Database Initialization

1. Start your local MySQL or MariaDB server.
2. Create a new database named `lelang`:

```sql
CREATE DATABASE lelang CHARACTER SET utf8 COLLATE utf8_general_ci;
```

3. Import the pre-configured database schema and seed data from `lelang.sql`:

```bash
mysql -u root -p lelang < lelang.sql
```

*(Alternatively, use phpMyAdmin or any database GUI client to import `lelang.sql` directly).*

### 3. Database Configuration

Open `application/config/database.php` and verify your local database credentials:

```php
$db['default'] = array(
    'dsn'      => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',          // Set your database password if applicable
    'database' => 'lelang',
    'dbdriver' => 'mysqli',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
);
```

### 4. Application Base URL

The application automatically resolves base URLs dynamically in `application/config/config.php`:

```php
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost:8080') . '/';
```

If hosting under a subfolder on Apache/XAMPP (e.g., `http://localhost/silelo/`), adjust `$config['base_url']` to point to the correct subfolder path.

---

## Configuration & Credentials

### Google OAuth 2.0 (Optional)

To enable Google Single Sign-On for bidders, update `application/config/google.php` with your Google Cloud Console credentials:

```php
$config['google']['application_name'] = 'SiLelo Online Auction';
$config['google']['client_id']        = 'your-client-id.apps.googleusercontent.com';
$config['google']['client_secret']    = 'your-client-secret';
$config['google']['redirect_uri']     = 'http://localhost:8080/home/register/';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();
```

---

## Usage / Running the Project

### Starting the Database

If using the included portable MariaDB runner:

```cmd
start_db.bat
```

*(To terminate the background MariaDB process later, execute `stop_db.bat`).*

### Starting the Development Server

Run PHP's built-in web server with the included routing script `router.php`:

```bash
php -S localhost:8080 router.php
```

Once running, access the respective portals in your web browser:

| Portal | URL Route | Description |
|---|---|---|
| **Public Auction Marketplace** | `http://localhost:8080/` | Public catalog, lot discovery, live bidding, and bidder account |
| **Mitra Pelelang Portal** | `http://localhost:8080/dashboard` | Seller console for inventory upload, active lot tracking, and bid adjudication |
| **Super Administrator Portal** | `http://localhost:8080/dashboard/admin` | Administrative control room for moderation, deposit audit, and user control |

### Default Seed Accounts

The seeded database comes equipped with pre-configured accounts across all three user roles:

| Role | Email | Password | Scope & Responsibilities |
|---|---|---|---|
| **Super Administrator** | `admin@gmail.com` | `admin` | Lot moderation, deposit verification, invoice auditing, user blocking |
| **Mitra Pelelang (Seller)** | `pelelang@gmail.com` | `pelelang` | Uploading auction items, closing auctions, choosing winners, invoices |
| **Public Bidder** | `bidder@gmail.com` | `bidder` | Browsing lots, bidding, deposit top-ups, invoice settlement |

*Additional specialized seller accounts for specific categories (`hendra.gadget@silelo.id`, `vintage.vault@silelo.id`, `maya.luxury@silelo.id`) and bidder profiles are documented in [`login.md`](./login.md).*

---

## Available Scripts & Commands

| Command / Script | Environment | Description |
|---|---|---|
| `php -S localhost:8080 router.php` | CLI | Launches the built-in development web server on port 8080 with asset passthrough routing |
| `start_db.bat` | Windows Batch | Launches the local MariaDB background process on default port 3306 |
| `stop_db.bat` | Windows Batch | Stops and terminates active local MariaDB database background processes |

---

## Database Architecture

The system database (`lelang`) is organized around the following key functional tables:

- **`abe_produk`**: Auction lots and catalog listings, storing starting prices, bid increments, open/close dates, auction statuses (`ready`, `lelang`, `sold out`), seller relations, and description markup.
- **`abe_lelang_bidder`**: Comprehensive bid submission logs linking bidders to lots, with bid pricing, timestamps, and outcome statuses (`pending`, `pemenang`, `kalah`).
- **`abe_deposit`**: Financial escrow ledger recording bidder deposit top-ups, transfer receipts, sender bank details, and admin approval statuses (`transfer`, `oke`).
- **`abe_invoice`**: Post-auction billing records tracking generated invoice numbers, winning hammer amounts, unique verification numbers, payment statuses (`belum bayar`, `bayar`, `lunas`), and winning bidder IDs.
- **`abe_foto_produk`**: Multi-asset media storage associating additional product gallery images with each auction item.
- **`abe_pelelang`**: Merchant business profiles, legal verification metadata, bank account coordinates, and store descriptions.
- **`abe_kategori` & `abe_kategori_klik`**: Taxonomy classifications and bidder behavioral telemetry tracking category engagement to power personalized recommendations.
- **`abe_review`**: Post-transaction satisfaction ratings and feedback left by winning bidders for verified sellers.
- **`users` & `abe_admin`**: Core authentication and credential tables for bidders, sellers, and system administrators.

---

## Contributing

Contributions, bug reports, and suggestions are welcome. To contribute:

1. Fork the repository on GitHub.
2. Create a dedicated feature or bugfix branch (`git checkout -b feature/auction-timer-enhancement`).
3. Maintain clean code structure and existing CodeIgniter MVC conventions.
4. Test all database transactions and route endpoints thoroughly.
5. Commit your changes with clear, descriptive commit messages.
6. Push your branch to GitHub and submit a Pull Request targeting the `main` branch.

---

## License

Please see the [LICENSE](./LICENSE) file for the terms and conditions governing the use, modification, and distribution of this project.

## Author & Contact

**Yohanes Dimas Pratama**

- GitHub: [github.com/weztcy](https://github.com/weztcy)
- Portfolio: [dimaspratama.vercel.app](https://dimaspratama.vercel.app)
- LinkedIn: [linkedin.com/in/yohanes-dimas](https://www.linkedin.com/in/yohanes-dimas)

