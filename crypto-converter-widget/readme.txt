=== Crypto Converter ⚡ Widget ===
Contributors: falselight
Tags: bitcoin, converter, coin, cryptocurrency, widget
Donate link: https://currencyrate.today/
Tested up to: 7.0
Requires at least: 3.1
Requires PHP: 5.4
Stable tag: 3.3.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Live converter for ≈14k crypto, fiat and commodity symbols: Gutenberg block, shortcode, themes and no API key.

== 📌 Description ==
Crypto Converter Widget adds a lightweight, customizable converter to WordPress. Use it as a Gutenberg block, shortcode, or widget-area embed to show live crypto, fiat, token, blockchain, and commodity conversion on posts, pages, and sidebars.

The plugin is built around a browser-native Web Component, so the public markup stays simple and the interface remains easy to customize from WordPress. Standard usage does not require API keys or server-side setup.

It supports ≈14k crypto symbols plus fiat and commodity entries. You can configure base and quote assets, amount, decimal precision, locale, tax/fee adjustment, fiat symbols, light/dark/auto themes, rounded corners, borders, shadows, custom colors, and gradients.

[DEMO](https://co-w.io/) 👀 
[DEMO](https://bitcoin-pulse.pages.dev/) 👀 

[youtube https://www.youtube.com/watch?v=84HLvReF5VY]

Learn more on the official website: [CO-W.io](https://co-w.io/) | [GitHub](https://github.com/dejurin/crypto-converter-widget)

= ⭐️ Key features =
* 🔑 No API key required for standard usage;
* 📟 Gutenberg block, shortcode, and widget-area support;
* 💵 Crypto, fiat, token, blockchain, and commodity conversion;
* ₿ ≈14k crypto symbols plus fiat and commodity entries;
* 💱 Works as an exchange-rate widget or interactive currency converter;
* ⚙️ Settings for amount, base, quote, locale, decimals, tax/fee, and symbol display;
* 🌗 Light, dark, and auto themes;
* 🌈 Custom colors, CSS backgrounds, and gradients;
* 🧩 Browser-native custom-element markup;
* 🔐 SSL-ready and SEO-friendly;
* 🆓 Free to use.

== Usage ==
= Gutenberg block =
Add the "Crypto Converter ⚡ Widget" block to any post or page, then configure the converter from the block settings sidebar.

= Shortcode =
Use the shortcode anywhere shortcodes are supported:

`[crypto-converter-widget base="BTC" quote="USD" amount="1"]`

= Widget areas =
Use the shortcode in a widget area or site-editor template part when you need the converter in a sidebar, footer, or reusable layout.

== Installation ==

📩 Feel free, write if you will have any questions: [Online support](https://wordpress.org/support/plugin/crypto-converter-widget/)

= From your WordPress dashboard =
1. Visit "Plugins > Add New"
2. Search for "Crypto Converter Widget"
3. Activate "Crypto Converter Widget" from your Plugins page.
4. Add the Gutenberg block, use the shortcode, or place it in a widget area.

= From WordPress.org =
1. Download "Crypto Converter Widget".
2. Upload the "Crypto Converter Widget" directory to your "/wp-content/plugins/" directory, using your favorite method (ftp, sftp, scp, etc...).
3. Activate "Crypto Converter Widget" from your Plugins page.
4. Add the Gutenberg block, use the shortcode, or place it in a widget area.

== Frequently Asked Questions ==
= Do I need an API key? =
No. Standard WordPress usage works without an API key.

= How do I add the converter to a page? =
Use the "Crypto Converter ⚡ Widget" Gutenberg block, or paste the shortcode into any shortcode-enabled area:

`[crypto-converter-widget base="BTC" quote="USD" amount="1"]`

= Can I use it without the Gutenberg block? =
Yes. The shortcode works in posts, pages, classic editor content, widget areas, and site-editor template parts that support shortcodes.

= Which assets can I use? =
Use symbol-based values such as `BTC`, `ETH`, `USD`, `EUR`, or `XAU`. The widget supports ≈14k crypto symbols plus fiat and commodity entries.

= Can I customize the design? =
Yes. You can use light, dark, or auto theme mode, rounded corners, border, shadow, custom background color, and CSS gradients.

= Can I control locale, decimals, and fees? =
Yes. The widget supports locale-aware formatting, decimal precision, fiat symbol display, and an optional tax/fee percentage adjustment.

= How do I make a fixed-width converter? =
Wrap the block or shortcode in a container with a fixed width. Keep the width at least 320px for a usable layout.

= Does the plugin do cryptojacking or mining? =
No. The plugin renders a currency converter widget only.

= Where can I get support? =
Use the official WordPress.org support forum: [Support](https://wordpress.org/support/plugin/crypto-converter-widget/)

== Screenshots ==
1. screenshot-1.gif - Animated converter preview in a compact layout.
2. screenshot-2.jpg - Plugin settings screen in the WordPress admin area.
3. screenshot-3.png - Custom widget style with branded colors and gradient background.
4. screenshot-4.png - Dark theme widget preview.
5. screenshot-5.png - Light theme widget preview.
6. screenshot-6.png - Gutenberg editor integration.
7. screenshot-7.png - Gutenberg block settings sidebar.
8. screenshot-8.jpg - Example website integration.

== Upgrade Notice ==

= 3.3.2 =
Updated the bundled widget to 3.3.2 and switched admin/block suggestions to a compact runtime asset manifest.

= 3.2.2 =
Updated widget assets, Gutenberg block compatibility, attribution styling, metadata, and documentation for the refreshed converter release.

= 3.0.3 =
🚀 Please update the widget as soon as possible to make it work properly;

== Changelog ==
= 3.3.2 =
* Updated the bundled public widget JavaScript to public widget release 3.3.2
* Added local `assets_runtime_V3.json`, `assets_catalog_V3.json` for lightweight WordPress admin and block currency suggestions
* Updated plugin version metadata, asset versions, and generated standalone HTML CDN snippet to 3.3.2

= 3.2.5 =
* Updated the bundled public widget JavaScript to public widget release 3.2.5
* Updated plugin version metadata, asset versions, and generated HTML CDN snippet to 3.2.5
= 3.2.2 =
* Updated the main public widget JavaScript bundle and WordPress metadata to version 3.2.2
* Updated asset copy to ≈14k crypto symbols plus fiat and commodity entries
* Refined the Source attribution into a compact product-style signature
* Updated Gutenberg block registration and editor markup for WordPress 7.0 compatibility
* Fixed Gutenberg block selection and inspector console warnings
* Added compatibility fallbacks for older WordPress installs reported by Plugin Check
* Refreshed readme description, usage, screenshots, FAQ, installation notes, and upgrade notice
= 3.1.2 =
* Security: added capability checks on AJAX handlers
* Compatibility: declared support for WordPress 7.0
* Compatibility: fixed PHP 7.x const visibility
* Added uninstall.php for clean plugin data removal
* Fixed i18n escaping functions for translatable strings
* Fixed admin settings version output escaping
* Removed debug console.log calls from JS assets
* Fixed duplicate PHPDoc comments
* Updated support links to WordPress.org forum
= 3.1.1 =
* Minor fixed
= 3.1.0 =
* Major fixed
* Fixed compatibility JS (thank you @homu9).
= 3.0.7 =
* Minor fixed
* Windows scroll fixed (thank you @toludavid1)
= 3.0.6 =
* Minor fixed  
= 3.0.5 =
* Minor fixed  
= 3.0.4 =
* Minor fixed  
= 3.0.3 =
* Implement four‑layer API provider architecture  
* Redesign user interface  
* Revamp core engine  
* Improve performance and stability  
* Enhance flexibility with configurable options  
* Introduce advanced feature set  
* Resolve major bugs  
= 2.2.2 =
* ✅ Plugin Check: 🎉 No errors found.
* Update POT file
* Minor fixed
= 2.2.1 =
* Fixed some WP Error
= 2.2.0 =
* Fixed notice
* Minor fixed
= 2.1.4 =
* Minor fixed
= 2.1.3 =
* Minor fixed
= 2.1.2 =
* Minor fixed
= 2.1.1 =
* Minor fixed
* languages fixed
= 2.1.0 =
* Minor fixed
* Gutenberg fixed
= 2.0.1 =
* Minor fixed
= 2.0.0 =
* Gutenberg block supported
* Update languages
* Minor fixed
= 1.9.3 =
* Add async strategy load script
* Minor fixed
= 1.9.0 =
* Security fixed
* Minor fixed
= 1.8.4 =
* Minor fixed
= 1.8.3 =
* Security fixed: https://www.cve.org/CVERecord?id=CVE-2023-49150
* Minor fixed
= 1.8.2 =
* Security fixed: https://www.cve.org/CVERecord?id=CVE-2023-49150
= 1.8.1 =
* Minor fixed
= 1.8.0 =
* Minor fixed
* Corrected languages
= 1.7.0 =
* Changing the version of the main script
* Minor fixed
= 1.6.1 =
* Important fixed
* Minor fixed
= 1.5.2 =
* Add languages
= 1.5.1 =
* Minor fixed
= 1.5.0 =
* Stable release

== 🍩 Donations ==
ℹ️ Official website: [CO-W.io](https://co-w.io/) | [Github](https://github.com/dejurin/crypto-converter-widget)
❓ Feel free, write if you will have any questions: [Support](https://wordpress.org/support/plugin/crypto-converter-widget/)
💰 Your might like it: [Cryptocurrency Price Widget](https://wordpress.org/plugins/cryptocurrency-price-widget/)
💹 Source: [CurrencyRate.Today](https://currencyrate.today/)
