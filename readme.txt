=== Webhooks for CPT ===
Contributors: panoramasdmkt
Tags: webhooks, cpt, jetengine, api, automation
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Professional-grade WordPress plugin to configure individual webhook URLs for each Custom Post Type (CPT).

== Description ==

**Webhooks for CPT** is a professional-grade WordPress plugin developed by **Panoramas Digital Marketing**. It allows you to configure individual webhook URLs for each Custom Post Type (CPT) on your site, providing perfect integration for workflows involving JetEngine or other CPT builders.

Unlike basic webhook plugins, **Webhooks for CPT** offers:

*   **Modular Architecture:** Clean separation between settings and event handling.
*   **Custom Prefixing:** Uses `pdmkt_wfp` to ensure zero conflicts with other plugins.
*   **Per-CPT Webhooks:** Assign different URLs to different CPTs (excluding default posts/pages).
*   **Multi-language Support:** Ready for English, Spanish, Portuguese, French, and German.

== Installation ==

1. Upload the `webhooks-for-cpt` folder to the `/wp-content/plugins/` directory, or upload the .zip file via **Plugins > Add New > Upload Plugin**.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Go to **Settings > Webhooks for CPT** to configure your URLs.

== Frequently Asked Questions ==

= Does it work with JetEngine? =
Yes, it is specifically designed to work with JetEngine CPTs and any other custom post types registered in WordPress.

= Does it send webhooks for default Posts or Pages? =
No, this plugin is focused on Custom Post Types.

== Screenshots ==

1. The settings page where you can configure URLs per CPT.

== Changelog ==

= 1.2.1 =
*   Security: Added output escaping (esc_html_e).
*   Compliance: Added sanitization to settings callback.
*   Compliance: Removed discouraged load_plugin_textdomain call.
*   I18n: Added translators comments for placeholders.
*   Docs: Switched to standard readme.txt.

= 1.2 =
*   Initial release with multi-language support and per-CPT configuration.
