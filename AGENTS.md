# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A WordPress plugin that embeds the Sleekplan feedback widget into a WordPress site and provides single sign-on (SSO) for logged-in WordPress users. Plain PHP — no Composer, no npm, no build step, no test suite.

## Deployment

Pushing a git tag triggers `.github/workflows/deploy.yml`, which deploys to the WordPress.org plugin SVN (slug: `sleekplan`) via the 10up deploy action. Before tagging a release, bump the version in **both**:
- `sleekplan-wordpress.php` (the `Version:` plugin header)
- `readme.txt` (`Stable tag:` and the `== Changelog ==` section)

`readme.txt` is the WordPress.org listing (description, FAQ, changelog); `README.md` is only the GitHub-facing readme. Files in `.wordpress-org/` are the plugin directory assets (banners, icons, screenshots).

## Architecture

- `sleekplan-wordpress.php` — entry point. Defines all `SLPL_*` constants (API base URL, OAuth client credentials, admin page URLs, JWT secret), registers the admin menu, and the deactivation hook (which removes the WordPress integration remotely and deletes local data).
- `require/api.php` — `slpl_call_api( $method, $endpoint, $data, $add_args )`, the single wrapper around the Sleekplan private API (`https://api.sleekplan.com/private/v1/`) using `wp_remote_request`. The stored OAuth token is appended as `access_token` query param automatically.
- `require/functions.php` — everything else: all `add_action` registrations, `admin_post_*` form handlers (auth/register, settings, website selector, logout), frontend script injection, and data helpers.
- `views/admin.inc.php` — router for the admin UI: shows `admin-auth.inc.php` when no token is stored, otherwise `admin-settings.inc.php` or `admin-dashboard.inc.php` depending on the `page` query param (`sleekplan` vs `sleekplan-settings`).
- `require/jwt/` — vendored copy of the Firebase PHP-JWT library, loaded via `require_once` (no autoloader). It is used both for local data storage and SSO tokens.

### Data storage

All plugin state (OAuth token, user_id, active product id, SSO key) lives in a **single wp_options entry** `sleekplan_data`, stored as a JWT signed with `SLPL_JWT` (md5 of the site URL). Read/write only through `slpl_get_data()` / `slpl_update_data()` in `require/functions.php` — `slpl_update_data` merges into existing data. If signature verification fails on read, the option is deleted (this happens when the site URL changes).

### Frontend integration

- `wp_head` (`slpl_load_script`): injects the Sleekplan JS SDK with `SLEEK_PRODUCT_ID` when a product is configured.
- `wp_footer` (`slpl_load_sso`): for logged-in users, encodes their email/id/name/avatar as a JWT signed with the product's SSO key and passes it to the widget via `$sleek.setUser()`.

### Conventions

- All functions are prefixed `slpl_`, all constants `SLPL_`. No classes or namespaces (except the vendored JWT lib).
- Form submissions go through the `admin_post_{action}` pattern with nonce verification, then `wp_redirect` back with `&notice=success|error&message=...` query params rendered by `views/admin-notice.inc.php`.
- Changing the active product must go through `slpl_set_product()`, which deactivates the WordPress integration on the old product via the API before activating the new one.
