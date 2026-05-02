# OZOL Workflow Notes

## Project
OZ On Line / ozol.au

Stack:
- YOURLS v1.10.3
- custom public frontend in index.html
- public AJAX shortener proxy in shorten.php
- frontend logic in js/script.js
- styling in css/style.css
- Hostinger hosting
- GitHub Actions deployment

## Roles
- Colin: owner / product direction
- Antigravity: builder / deployer
- ChatGPT: QC / audit / mission drafting

## Deployment
Deployments are triggered from main through GitHub Actions.

After deployment, always verify the live site, not just the GitHub Action:
- https://ozol.au/ loads
- public “Shorten a URL” card is visible
- css/style.css loads
- js/script.js loads
- background image /images/hero/background2-3.webp loads
- shortener workflow works live

## Current accepted baseline
Mission 2C accepted on 02/05/2026.

Accepted commit:
3e41ebb

Accepted behaviour:
- no custom keyword generates exactly 3 lowercase alpha-numeric characters
- custom 3-character keyword works when available
- invalid custom keywords fail cleanly
- duplicate custom keywords fail cleanly
- QR appears after successful creation
- QR scans to the correct short URL
- QR download filename is QR-<keyword>.png
- QR plugin is not auto-activated from the public endpoint
- glassmorphism layout preserved
- background2-3.webp used
- no README or layout churn required

## Important implementation notes

shorten.php:
- must initialise YOURLS with includes/load-yourls.php
- must not auto-activate plugins from public requests
- must validate custom keywords before creating links
- must explicitly reject collisions using yourls_keyword_is_taken()
- default random keyword must be /^[a-z0-9]{3}$/

js/script.js:
- QR URL is shorturl + ".qr"
- QR download filename should be built safely from data.url.keyword, with fallback URL parsing
- copy button should continue to work after changes

user/plugins/seans-qrcode:
- plugin must be active in YOURLS admin
- .qr URLs return PNG QR images
- avoid vendor/plugin churn unless there is a confirmed dependency problem

css/style.css:
- background image is /images/hero/background2-3.webp
- keep white text readable over the background
- preserve glassmorphism card layout

## QC checklist before accepting future changes
- php -l shorten.php
- verify live deployment after GitHub Action
- create one no-custom test link
- create one disposable custom test link
- test invalid keyword
- test duplicate keyword
- scan QR
- download QR and confirm filename
- check desktop and mobile layout
- check copy button
- confirm no unnecessary README/layout/vendor churn

## Naming conventions
- QR downloads: QR-<keyword>.png
- default short links: 3-character lowercase alpha-numeric codes, e.g. ozol.au/az9
