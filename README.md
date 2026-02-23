# Webhooks for CPT

**Webhooks for CPT** is a professional-grade WordPress plugin developed by **Panoramas Digital Marketing**. It allows you to configure individual webhook URLs for each Custom Post Type (CPT) on your site, providing perfect integration for workflows involving JetEngine or other CPT builders.

## Why this plugin?

Unlike basic webhook plugins, **Webhooks for CPT** offers:

- **Modular Architecture:** Clean separation between settings and event handling.
- **Custom Prefixing:** Uses `pdmkt_wfp` to ensure zero conflicts with other plugins.
- **Per-CPT Webhooks:** Assign different URLs to different CPTs (excluding default posts/pages).
- **Multi-language Support:** Ready for English, Spanish, Portuguese, French, and German.

## Files Structure

```text
webhooks-for-cpt/
├── webhooks-for-cpt.php      # Main Loader
├── includes/
│   ├── class-pdmkt-wfp-settings.php  # Admin UI logic
│   └── class-pdmkt-wfp-handler.php   # Webhook trigger logic
├── assets/
│   └── css/admin-style.css           # Custom Admin Styles
└── languages/                        # Translation files (.po)
```

## Installation

1. Zip the `webhooks-for-cpt` folder.
2. Upload via **Plugins > Add New > Upload Plugin**.
3. Activate and go to **Settings > Webhooks for CPT**.

## Usage

1. Go to **Settings > Webhooks for CPT**.
2. Toggle "Enabled" for the desired CPTs.
3. Enter the target Webhook URL.
4. Save Changes.

### Sample Payload

```json
{
  "post_id": 123,
  "post_title": "Hello World",
  "post_type": "my_custom_type",
  "post_status": "publish",
  "post_url": "https://example.com/my-post",
  "is_update": true,
  "timestamp": "2024-02-23 18:00:00"
}
```

## Supported Languages

- English (Default)
- Spanish (es_ES)
- Portuguese (pt_PT)
- French (fr_FR)
- German (de_DE)

## Credits

Developed by [Panoramas Digital Marketing](https://panoramasdmkt.com/plugins).

## License

GPLv2 or later.
