# Quick Tap Pay

Quick Tap Pay is a streamlined Laravel-based application that allows vendors (e.g. property managers, landlords, or small service providers) to create simple payment links for fixed services like landlord reference letters. Customers can use these links to pay securely via Stripe. Vendors can track all their sales and payouts in one intuitive dashboard.

## Features

- Vendor account creation
- Stripe Connect (Standard) integration
- Payment link generation
- Customer checkout flow
- Admin/vendor sales tracking
- Refund and failure tracking
- Secure and scalable Laravel backend
- Built with Livewire and Tailwind CSS for responsive UI

## Tech Stack

- Laravel 10+
- Livewire
- Tailwind CSS
- Stripe (Connect + Webhooks)
- MySQL / MariaDB
- Alpine.js

## Getting Started

### Prerequisites

- PHP 8.1+
- Composer
- MySQL
- Node.js + NPM
- Stripe account

### Installation

```bash
git clone https://github.com/your-username/quick-tap-pay.git
cd quick-tap-pay
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
npm install && npm run dev
```

### Stripe Setup

- Create a Stripe account
- Enable Stripe Connect (Standard)
- Add your API keys to `.env`:

```
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_CLIENT_ID=ca_...
```

- Set your webhook endpoint to `https://yourdomain.com/stripe/webhook`

### Queue Setup (Recommended)

```bash
php artisan queue:work
```

## Usage

1. Register as a vendor
2. Connect your Stripe account
3. Create a new payment link
4. Share the link with customers
5. Track sales in the dashboard

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you'd like to change.

## License

Not published yet.
