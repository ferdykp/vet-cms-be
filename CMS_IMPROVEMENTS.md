# Veterinary CMS — Backend & UI/UX Improvement Pass

This package is the revised Laravel CMS backend based on the supplied backend project and Sage Studio/Stitch reference.

## Fixed functional issues

- Fixed `MediaController::destroy()` accidental assignment in a return statement.
- Fixed article editor settings toggle hiding the whole editor canvas.
- Fixed Alpine `x-show` panels that also had a permanent Tailwind `hidden` class.
- Removed invalid nested `<form>` from article settings.
- Replaced fake autosave wording with accurate **saved / unsaved changes** state.
- Added browser warning when leaving an edited post with unsaved changes.
- Added functional draft preview modal for article blocks.
- Added block move up/down controls and safer block deletion behavior.
- Article reading time is recalculated server-side from article content on save.
- Scheduled posts now require a future schedule date.
- Website Settings now preserves `is_public` instead of silently resetting it.
- Settings render appropriate controls for boolean/text/value types.
- Profile interest serialization now attaches to the real profile form.
- Media inspector metadata fields update correctly when selecting different assets.
- Improved mobile navigation with overlay and close behavior.

## UI/UX improvements

- Cleaner editorial hierarchy based on the supplied Sage Studio reference.
- More consistent cards, borders, spacing, typography, sticky actions, and form states.
- Improved Media Library grid and metadata inspector.
- Improved Categories and Tags with inline editing.
- Improved Navigation with inline editing, visibility and order controls.
- Rebuilt Profile page with image selection, clearer grouped fields, and credential add/remove flows.
- Improved responsive behavior for mobile/tablet CMS use.
- Kept Blade views utility-first with Tailwind CSS v4 and Alpine.js for interaction.

## New seeder

`WebsiteSettingSeeder` provides useful starter settings so Website Settings is not empty after installation.

Run:

```bash
php artisan db:seed --class=WebsiteSettingSeeder
```

or run all seeders:

```bash
php artisan db:seed
```

## Recommended local setup

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run dev
php artisan serve
```

For local HTTP, keep:

```env
SESSION_SECURE_COOKIE=false
```

For production HTTPS, set it to `true`.

## Verification performed

- PHP syntax lint passed for application, routes, config, migrations, and seeders.
- `node --check resources/js/app.js` passed.
- `php artisan route:list --path=admin` succeeded (69 admin routes).
- Suspicious patterns from the previous build were scanned and removed.

Full PHPUnit/View compilation could not run in the verification container because its PHP runtime is missing DOM/mbstring/xmlwriter extensions. Vite build could not be re-run there because the uploaded `node_modules` contained platform-specific native bindings; run `npm install && npm run build` on the target machine to regenerate them correctly.
