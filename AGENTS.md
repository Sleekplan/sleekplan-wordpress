# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

A deliberately minimal WordPress plugin (v1.0.0 rewrite) that embeds the Sleekplan feedback widget and optionally signs logged-in WordPress users in via SSO. Plain PHP 7.0+ — no Composer, no npm, no build step, no test framework. The plugin makes **no remote API calls**; customers paste their Product ID and SSO key manually from the Sleekplan admin.

## Deployment

Pushing a git tag triggers `.github/workflows/deploy.yml`, which deploys to the WordPress.org plugin SVN (slug: `sleekplan`) via the 10up deploy action. Before tagging a release, bump the version in **both**:
- `sleekplan-wordpress.php` (the `Version:` plugin header)
- `readme.txt` (`Stable tag:` and the `== Changelog ==` section)

`readme.txt` is the WordPress.org listing; `README.md` is only the GitHub-facing readme. `.wordpress-org/` holds the listing assets (banners, icons, screenshots). `.distignore` controls what is excluded from the SVN deploy — `docs/`, `AGENTS.md`, and `CLAUDE.md` must stay listed there.

Context: the WP.org listing was closed 2024-10-17 for a security issue; the 1.0.0 rewrite is the fix. Re-review is requested by replying to the closure email from plugins@wordpress.org — do not tag/deploy before the plugin is reopened.

## Architecture

Three procedural files, all functions prefixed `slpl_`, constants `SLPL_`, no classes:

- `sleekplan-wordpress.php` — plugin headers; constants (`SLPL_PLUGIN_PATH`, `SLPL_OPTION` = `sleekplan_settings`, `SLPL_LEGACY_OPTION` = `sleekplan_data`); `slpl_default_settings()` / `slpl_get_settings()` (stored option merged over defaults via `wp_parse_args`); one-time legacy migration `slpl_maybe_migrate()` on `plugins_loaded` (decodes the pre-1.0 JWT option with `slpl_legacy_decode()`, maps `product`→`product_id`, `sso`→`sso_key`, then deletes it — deliberately on `plugins_loaded`, not `admin_init`, so auto-updated sites migrate on frontend requests too).
- `includes/settings.php` — top-level "Sleekplan" admin menu (`manage_options`) rendering one WP Settings API screen (group `sleekplan`, form posts to `options.php`, notices via `settings_errors()` which must be called manually on custom top-level pages). All input flows through `slpl_sanitize_settings()`.
- `includes/widget.php` — prints the embed snippet on `wp_head` (if `show_frontend`) and `admin_head` (if `show_backend`; intentionally NOT capability-gated — every wp-admin user sees it). `slpl_sso_token()` builds the SSO payload (`mail` always; `id`/`name`/`img` per toggles; `name` is `display_name`, never `user_login`); `slpl_jwt_encode()` is a minimal encode-only HS256 JWT (no vendored library).

### Settings

One plain autoloaded option `sleekplan_settings` with exactly 8 keys: `product_id` (int), `show_frontend`/`show_backend` (bool), `sso_enabled` (bool), `sso_key` (string), `sso_send_name`/`sso_send_id`/`sso_send_avatar` (bool). Read only via `slpl_get_settings()` — it guarantees every key exists.

### Conventions & invariants

- Never read `$_GET`/`$_POST`/`$_REQUEST` directly — saves go through `options.php` + the sanitize callback; there are no `admin_post_*` handlers.
- Escape all output (`esc_html__`, `esc_attr`, `checked()`, `wp_json_encode` for JS, `(int)` for numbers). This plugin was closed on WP.org over unescaped output once — keep it airtight.
- No `wp_remote_*`/network calls from PHP.
- Text domain is `sleekplan` (matches the WP.org slug).
- Deactivation keeps all settings (no deactivation hook); `uninstall.php` (standalone — uses literal option names, not constants) deletes `sleekplan_settings` and `sleekplan_data`.
- Design/plan docs live in `docs/superpowers/` and are excluded from the SVN deploy and gitignored.
