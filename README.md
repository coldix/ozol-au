<!--
    File: README.md
    Author: Colin Dixon BSc, DipEd, Cert IV TAE
    Date: 02 May 2026 09:01 AEST
    Version: v03
-->
# OZ On Line (ozol.au)

This repository contains the configuration and source code for the **ozol.au** platform. It serves a dual purpose as both a historical tech portfolio and a private URL shortener.

## 🚀 Features

1. **Portfolio & Timeline (`index.html`)**
   - Contains the historical timeline for Colin Dixon's 40+ year journey in Australian tech.
   - Built with a scalable, dark/light theme glassmorphism design.

2. **YOURLS URL Shortener**
   - **Core**: Powered by [YOURLS](https://yourls.org/) (Your Own URL Shortener) v1.10.3.
   - **Frontend**: Custom, fully public glassmorphism interface integrated natively into `index.html` via `shorten.php` AJAX calls.
   - **Backend**: Sleeky backend theme installed as a plugin in `/user/plugins/sleeky-backend`.
   - **Database**: Configured to connect to the Hostinger database via `user/config.php`.

## 📁 Project Structure

- `index.html` - Main landing page containing the interactive timeline and the custom URL Shortener form.
- `shorten.php` - Custom backend proxy script handling public URL shortening requests.
- `admin/` - YOURLS admin panel.
- `user/` - YOURLS user data, including config (`config.php`) and plugins (`plugins/sleeky-backend`).
- `css/` & `js/` - Custom styling and scripts for the portfolio UI and AJAX URL shortening.
- `images/` - Contains gallery and hero images.
- `deploy.sh` - Automated deployment script for GitHub Actions.

## ⚙️ Maintenance & Deployment

Deployments are automated through GitHub Actions.

To deploy changes to the live Hostinger environment, simply run:
```bash
./deploy.sh "Your commit message"
```

## Notes
- Portfolio theme states (light/dark) are saved locally.
- Form submissions generate mailto links directly instead of relying on a backend.
- The URL shortener backend can be accessed at `ozol.au/admin/` (requires authentication).
