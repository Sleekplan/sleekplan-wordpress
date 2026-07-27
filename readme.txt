=== Sleekplan - User Feedback, Roadmap & Changelog ===

Contributors: sleekplan
Donate link: https://sleekplan.com
Tags: feedback, roadmap, changelog, customer feedback, user feedback
Requires at least: 5.0
Tested up to: 7.0
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Embed the Sleekplan feedback widget on your WordPress site, with optional single sign-on for logged-in users.

== Description ==

[Sleekplan](https://sleekplan.com/?ref=wordpress) is an all-in-one customer feedback tool: collect and manage feedback, let users vote and discuss ideas, share a roadmap, keep a changelog, and measure satisfaction (CSAT/NPS) — all inside one widget that lives on your site.

This plugin is the easiest way to add the Sleekplan widget to WordPress. It is intentionally small and does exactly two things:

* **Load the widget** — on your website, in your WP admin, or both. You choose.
* **Single sign-on (optional)** — automatically sign logged-in WordPress users in to the widget, so they can post and vote without a separate Sleekplan login. You control which profile data is shared: the email address is always included as the identifier; display name, user ID, and avatar are each optional.

**Privacy by design:** the plugin stores its settings locally and makes no server-side connection to Sleekplan. Your WordPress installation and your Sleekplan account stay separate — the only resource loaded from Sleekplan is the widget script itself (client.sleekplan.com), in the visitor's browser. With SSO enabled, a signed token containing the selected user data is handed to the widget.

Setup takes about a minute:

1. Create a product on [Sleekplan](https://sleekplan.com/?ref=wordpress) — a free plan is available
2. Copy your Product ID from the Sleekplan admin and paste it under WP Admin → Sleekplan
3. Optional: enable SSO and paste your SSO key (Sleekplan admin → Settings → Single Sign-On)

The widget itself (appearance, texts, modules, anonymous feedback, …) is configured in your [Sleekplan admin](https://app.sleekplan.com/?ref=wordpress). Here you can find our [terms of use](https://sleekplan.com/terms/?ref=wordpress) and [privacy policies](https://sleekplan.com/privacy/?ref=wordpress).

== Installation ==

= Install via WordPress Plugins =

1. Search for the `sleekplan` plugin in your WordPress admin
1. Select 'Install Now' from the list
1. Activate the plugin through the 'Plugins' menu in WordPress

= Download the ZIP via WordPress.org =

1. Download the plugin via [wordpress.org/plugins/sleekplan/](https://wordpress.org/plugins/sleekplan/)
1. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
1. Activate the plugin through the 'Plugins' menu in WordPress

= Configure =

1. Open WP Admin → Sleekplan
1. Enter your Product ID and choose where the widget should show (website and/or WP admin)
1. Optional: enable single sign-on and paste your SSO key

== Frequently Asked Questions ==

= Where do I find my Product ID? =

In your [Sleekplan admin](https://app.sleekplan.com/?ref=wordpress) under Settings. It is the numeric ID of your product.

= Where do I find my SSO key? =

In your Sleekplan admin under Settings → Single Sign-On.

= Does the plugin connect my site to my Sleekplan account? =

No. Unlike earlier versions, the plugin has no Sleekplan login and makes no API calls. You paste two values (Product ID and, optionally, the SSO key) and the plugin stores them locally.

= Which user data is shared via SSO? =

Only for logged-in WordPress users, and only when you enable SSO: the email address (always, as the identifier), plus — each optional — display name, user ID, and avatar URL. The data is passed as a signed token directly to the widget in the user's browser.

= Do I need a paid subscription? =

No, there is a free plan. You just need a Sleekplan account. Find all available plans at [Sleekplan](https://sleekplan.com/pricing/?ref=wordpress).

= Where can I find the documentation? =

See our [documentation here](https://sleekplan.com/docs/?ref=wordpress).

== Screenshots ==

1. The Sleekplan widget, fully integrated in a website
2. The plugin settings page in WordPress

== Upgrade Notice ==

= 1.0.0 =
Complete rewrite with a minimal footprint. Your Product ID and SSO key are migrated automatically — the widget keeps working without any action.

== Changelog ==

= 1.0.0 =
* 2026-07-27
* Complete rewrite with a minimal, security-hardened footprint
* The plugin now only loads the widget and (optionally) signs users in via SSO — the Sleekplan account login, dashboard, and API connection were removed
* New: choose where the widget loads (website and/or WP admin)
* New: choose which user data the SSO token includes (email always; display name, user ID, avatar optional)
* Existing settings (Product ID, SSO key) are migrated automatically

= 0.2.0 =
* 2021-06-05
* Fix deinstallation issue

= 0.1.9 =
* 2021-06-05
* Fix single sign-on issue
* Fix minor issues

= 0.1.2 =
* 2021-06-05
* Fix single sign-on issue

= 0.1.1 =
* 2020-14-06
* Initial release

= 0.1.0 =
* 2020-14-06
* Initial release
