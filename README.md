# OZ On Line (ozol.au)

This repository contains the configuration and source code for the **ozol.au** platform. It serves a dual purpose as both a historical tech portfolio and a private URL shortener.

## 🚀 Features

1. **Portfolio & Timeline (`index.html`)**
   - Contains the historical timeline for Colin Dixon's 40+ year journey in Australian tech.
   - Built with a scalable, dark/light theme glassmorphism design.

2. **YOURLS URL Shortener**
   - **Core**: Powered by [YOURLS](https://yourls.org/) (Your Own URL Shortener) v1.10.3.
   - **Frontend**: Custom public-facing interface using the [Sleeky](https://github.com/Flynntes/Sleeky) theme (`index.php` and `frontend/` directory).
   - **Backend**: Sleeky backend theme installed as a plugin in `/user/plugins/sleeky-backend`.
   - **Database**: Configured to connect to the Hostinger database via `user/config.php`.

## 📁 Project Structure

- `index.html` - Main landing page containing the interactive timeline.
- `index.php` & `frontend/` - Sleeky frontend interface for the URL shortener.
- `admin/` - YOURLS admin panel.
- `user/` - YOURLS user data, including config (`config.php`) and plugins (`plugins/sleeky-backend`).
- `css/` & `js/` - Custom styling and scripts for the portfolio UI.
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
