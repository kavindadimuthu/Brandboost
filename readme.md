## Installation

1. Download the archive or clone the project using git
2. Create database schema as `brandboost`
3. Create `.env` file from `.env.example` file and adjust database parameters
4. Run `composer install`
5. Go to the `public` folder
6. Start php server by running command `php -S 127.0.0.1:8000`
7. Open in browser http://127.0.0.1:8000

---

# BrandBoost

![Build](https://img.shields.io/badge/build-passing-brightgreen)
![License](https://img.shields.io/github/license/kavindadimuthu/Brandboost)
![Issues](https://img.shields.io/github/issues/kavindadimuthu/Brandboost)

BrandBoost is a marketplace platform that connects **businessmen (buyers)** with **influencers and designers (sellers)** who offer various creative services. The platform manages the entire transaction lifecycle from service discovery to delivery, handling orders, payments, communications, and dispute resolution.

This document provides a high-level overview of the BrandBoost system, its key user roles, core architecture, and primary functionalities.

For detailed information about specific subsystems, refer to:

- [System Architecture](https://deepwiki.com/kavindadimuthu/Brandboost/1.1-system-architecture)
- [Order Management System](https://deepwiki.com/kavindadimuthu/Brandboost/2-order-management-system)
- [Payment and Transaction System](https://deepwiki.com/kavindadimuthu/Brandboost/3-payment-and-transaction-system)
- [User Management and Authentication](https://deepwiki.com/kavindadimuthu/Brandboost/4-user-management-and-authentication)

---

## 🧩 System Architecture

BrandBoost follows an **MVC (Model-View-Controller)** architectural pattern with a clear separation of concerns:

**Layers:**
- **Database**
- **Models** (e.g., User, Order, Transaction, Service, Wallet)
- **Controllers**  
  - `AuthController`  
  - `OrderController`  
  - `PaymentController`  
  - `ServiceController`  
  - `BusinessmanController`  
  - `InfluencerController`  
  - `DesignerController`  
  - `AdminController`
- **Routing Layer** (via `public/index.php`)
- **User Interfaces:**  
  - Businessman UI  
  - Influencer UI  
  - Designer UI  
  - Admin UI  
  - Guest UI

📁 Related Code:
- [`controllers/OrderController.php` (lines 5–20)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/OrderController.php#L5-L20)
- [`controllers/PaymentController.php` (lines 5–11)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/PaymentController.php#L5-L11)
- [`public/index.php` (lines 1–17)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/public/index.php#L1-L17)
- [`core/Database/Database.php` (lines 11–45)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/core/Database/Database.php#L11-L45)

---

## 👥 User Roles and Capabilities

BrandBoost supports **four primary user roles**, each with distinct permissions and capabilities:

| Role         | Description                       | Key Capabilities                                                                 |
|--------------|-----------------------------------|----------------------------------------------------------------------------------|
| Businessman  | Buyers who purchase creative services | Browse services, place orders, request revisions, submit reviews, file complaints |
| Influencer   | Sellers who offer promotion services | Create promotions, fulfill orders, manage earnings, withdraw funds               |
| Designer     | Sellers who offer design services   | Create gigs, fulfill orders, manage earnings, withdraw funds                     |
| Admin        | Platform administrators             | Manage users, verify accounts, resolve disputes, monitor transactions            |

**Access Control:**  
Role-based access is enforced through the `AuthHelper` class to ensure users can only access authorized functionality.

📁 Related Code:
- [`controllers/AuthController.php` (lines 10–90)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/AuthController.php#L10-L90)
- [`public/index.php` (lines 38–83)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/public/index.php#L38-L83)
- [`controllers/BusinessmanController.php` (lines 8–14)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/BusinessmanController.php#L8-L14)
- [`controllers/InfluencerController.php` (lines 8–14)](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/InfluencerController.php#L8-L14)

---

## 🔄 Order Lifecycle

One of the core components of BrandBoost is the **order management system**. The lifecycle typically follows these stages:

1. **Order Creation**  
   - Method: `createOrder()` – [`OrderController`](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/OrderController.php)
   - Triggers `createTransaction()` in [`PaymentController`](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/PaymentController.php) to hold funds

2. **Delivery by Seller**  
   - Method: `createDelivery()` – [`OrderController`](https://github.com/kavindadimuthu/Brandboost/blob/a681a4e4/controllers/OrderController.php)

3. **Review by Buyer**  
   - Method: `createReview()`

4. **Optional Actions:**  
   - **Request Revision** – `requestRevision()`  
   - **Submit Complaint** – `submitComplaint()`  
   - **Admin Resolution**:  
     - Resolve for Buyer → Refund  
     - Resolve for Seller → Continue process

5. **Funds Release**  
   - Method: `releaseFunds()` – `PaymentController`  
   - Funds credited to seller's wallet  
   - Sellers can withdraw using `withdrawFunds()`

---

## 🔗 Repository

Explore the full codebase here:  
👉 [https://github.com/kavindadimuthu/Brandboost](https://github.com/kavindadimuthu/Brandboost)

---

## 📢 Contributors

- @kavindadimuthu
- @isurunvn
- @NadunD14
- @nethsilumarasinghe
