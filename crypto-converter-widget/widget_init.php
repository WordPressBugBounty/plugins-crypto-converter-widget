<?php

/**
 * @version 3.2.2
 */

/*
Plugin Name: Crypto Converter ⚡ Widget
Plugin URI: https://co-w.io/
Description: The Crypto Converter Widget for WordPress is a secure, fast, and intuitive plugin that instantly turns your website into a real-time cryptocurrency and fiat currency converter. Offering seamless integration without API keys or complicated setup, this powerful tool supports ≈14k crypto symbols plus fiat and commodity entries—all with elegant styling, dark-theme compatibility, and built-in caching to keep your site lightning-fast.
Version: 3.2.2
Author: CurrencyRate.today
Author URI: https://currencyrate.today/
License: GPLv2 or later
Text Domain: crypto-converter-widget
Domain Path: /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

define('CCW_NAME', 'Crypto Converter ⚡ Widget');
define('CCW_VERSION', '3.2.2');
define('CCW_PLUGIN_SLUG', 'crypto-converter-widget');

class CCW_Crypto_Converter_Widget
{
    protected static $_instance = null;

    protected $handler = 'crypto-converter-widget';
    protected $gradients;
    protected $assets;
    protected $locales;
    protected $allowed_attr = [
        'base', 'quote', 'amount', 'decimal', 'theme',
        'locale', 'tax', 'background', 'background-color',
        'rounded', 'shadow', 'symbol', 'stat', 'border'
    ];

    public static function get_instance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __construct()
    {
        $this->gradients = $this->CCW_load_json_file(plugin_dir_path(__FILE__).'assets/public/gradient.json');
        $this->assets    = $this->CCW_load_json_file(plugin_dir_path(__FILE__).'assets/public/assets.json');

        $this->locales = [
            'en-US' => 'English (US)',
            'en-GB' => 'English (UK)',
            'en-CA' => 'English (Canada)',
            'en-AU' => 'English (Australia)',
            'fr-FR' => 'Français (France)',
            'de-DE' => 'Deutsch (Deutschland)',
            'es-ES' => 'Español (España)',
            'it-IT' => 'Italiano (Italia)',
            'ja-JP' => '日本語 (日本)',
            'zh-CN' => '简体中文 (中国)',
            'pl-PL' => 'Polski (Polska)',
            'uk-UA' => 'Українська (Україна)',
            'ru-RU' => 'Русский (Россия)',
            'pt-BR' => 'Português (Brasil)',
            'he-IL' => 'עברית (ישראל)',
            'fa-IR' => 'فارسی (ایران)',
            'ar-SA' => 'العربية (السعودية)',
            'ar-EG' => 'العربية (مصر)',
            'hi-IN' => 'हिन्दी (भारत)',
            'ko-KR' => '한국어 (대한민국)',
            'nl-NL' => 'Nederlands (Nederland)',
            'sv-SE' => 'Svenska (Sverige)',
            'da-DK' => 'Dansk (Danmark)',
            'fi-FI' => 'Suomi (Suomi)',
            'ro-RO' => 'Română (România)',
            'bg-BG' => 'Български (България)',
            'th-TH' => 'ไทย (ประเทศไทย)',
            'cs-CZ' => 'čeština (Česká republika)',
            'tr-TR' => 'Türkçe (Türkiye)',
            'es-MX' => 'Español (México)',
        ];

        // Common
        add_action('plugins_loaded', [$this, 'CCW_load_textdomain'], 5);
        add_action('init', [$this, 'CCW_register_public_script'], 5);
        add_action('init', [$this, 'CCW_register_block'], 10);
        add_action('wp_enqueue_scripts', [$this, 'CCW_enqueue_frontend_style']);

        // Shortcode
        add_shortcode(CCW_PLUGIN_SLUG, [$this, 'CCW_shortcode']);

        // Admin
        add_action('admin_init', [$this, 'CCW_admin_notice_show'], 5);
        add_action('admin_menu', [$this, 'CCW_add_plugin_page']);
        add_action('admin_enqueue_scripts', [$this, 'CCW_admin_notify_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'CCW_enqueue_admin_assets']);
        add_action('admin_enqueue_scripts', [$this, 'CCW_enqueue_admin_public_script']);

        add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'CCW_plugin_action_links'], 10, 1);
    }

    /**
     * Load the translation data.
     *
     * @return void
     */
    public function CCW_load_textdomain()
    {
        load_plugin_textdomain(
            'crypto-converter-widget',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages'
        );
    }

    /**
     * Registers the public JavaScript file for the plugin.
     *
     * @return void
     */
    public function CCW_register_public_script()
    {
        // Register the script for later enqueue
        wp_register_script(
            $this->handler,
            plugins_url('assets/public/crypto-converter-widget.js', __FILE__),
            [],
            CCW_VERSION,
            [
                'strategy' => 'async',
                'in_footer' => true,
            ]
        );

        wp_register_style(
            $this->handler . '-frontend',
            plugins_url('assets/public/frontend.css', __FILE__),
            [],
            CCW_VERSION,
            'all'
        );
    }

    /**
     * Registers the block type for the plugin.
     *
     * @return void
     */
    public function CCW_register_block()
    {
        wp_register_script(
            $this->handler . '-block-editor',
            plugins_url('block.js', __FILE__),
            ['wp-blocks', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-i18n'],
            CCW_VERSION,
            true
        );

        wp_localize_script($this->handler . '-block-editor', 'blockData', [
            'locale' => get_locale(),
            'handler' => $this->handler,
            'gradients' => $this->gradients,
            'assets'    => $this->assets,
            'locales'   => $this->locales,
            'i18n' => [
                'amount' => esc_html__('Amount', 'crypto-converter-widget'),
                'title' => esc_html__('Crypto Converter ⚡ Widget', 'crypto-converter-widget'),
                'description' => esc_html__('A simple block for displaying Crypto Converter ⚡ Widget.', 'crypto-converter-widget'),
                'container' => esc_html__('Container', 'crypto-converter-widget'),
                'shadow' => esc_html__('Shadow', 'crypto-converter-widget'),
                'decimalPlaces' => esc_html__('Decimal Places', 'crypto-converter-widget'),
                'backgroundColor' => esc_html__('Background Color', 'crypto-converter-widget'),
                'style' => esc_html__('Style', 'crypto-converter-widget'),
                'color' => esc_html__('Color', 'crypto-converter-widget'),
                'border' => esc_html__('Border', 'crypto-converter-widget'),
                'options' => esc_html__('Options', 'crypto-converter-widget'),
                'display' => esc_html__('Display', 'crypto-converter-widget'),
                'fiat' => esc_html__('Fiat money', 'crypto-converter-widget'),
                'symbol' => esc_html__('Fiat symbol', 'crypto-converter-widget'),
                'fontFamily' => esc_html__('Font Family', 'crypto-converter-widget'),
                'about' => esc_html__('About', 'crypto-converter-widget'),
                'ratePlugin' => esc_html__('❤️ Rate plugin ★★★★★', 'crypto-converter-widget'),
                'widget' => esc_html__('Widget', 'crypto-converter-widget'),
                'demoPlugin' => esc_html__('DEMO 👀', 'crypto-converter-widget'),
                'none' => esc_html__('None', 'crypto-converter-widget'),
                'converter' => esc_html__('Converter', 'crypto-converter-widget'),
                'crypto' => esc_html__('Crypto', 'crypto-converter-widget'),
                'live' => esc_html__('Live', 'crypto-converter-widget'),
                'clearColors' => esc_html__('Clear Colors', 'crypto-converter-widget'),
                'locale' => esc_html__('Locale', 'crypto-converter-widget'),
                'rounded' => esc_html__('Rounded', 'crypto-converter-widget'),
                'stat' => esc_html__('Stats', 'crypto-converter-widget'),
                'base' => esc_html__('Base', 'crypto-converter-widget'),
                'quote' => esc_html__('Quote', 'crypto-converter-widget'),
                'tax' => esc_html__('Tax/Fee', 'crypto-converter-widget'),
                'theme' => esc_html__('Theme', 'crypto-converter-widget'),
                'gradient' => esc_html__('Gradient', 'crypto-converter-widget'),
                'degrees' => esc_html__('Degrees', 'crypto-converter-widget'),
                'source' => esc_html__('Source:', 'crypto-converter-widget'),
            ],
        ]);

        if (function_exists('register_block_type')) {
            call_user_func('register_block_type', 'crypto-converter-widget/widget-block', [
                'editor_script' => $this->handler . '-block-editor',
                'script' => $this->handler,
                'style' => $this->handler . '-frontend',
            ]);
        }
    }

    /**
     * Enqueue the small front-end attribution stylesheet.
     *
     * @return void
     */
    public function CCW_enqueue_frontend_style()
    {
        wp_enqueue_style($this->handler . '-frontend');
    }

    /**
     * Enqueue public script on admin pages.
     *
     * @param string $hook_suffix The current admin page.
     */
    public function CCW_enqueue_admin_public_script($hook_suffix)
    {
        if (! current_user_can('manage_options')) {
            return;
        }

        $allowed = [
            'settings_page_' . CCW_PLUGIN_SLUG,
            'widgets.php',
        ];

        if (in_array($hook_suffix, $allowed, true)) {
            wp_enqueue_script($this->handler);
            wp_enqueue_style($this->handler . '-frontend');
        }
    }

    /**
     * Enqueue public script on admin pages.
     *
     * @param string $hook_suffix The current admin page.
     */
    public function CCW_enqueue_admin_assets($hook_suffix)
    {
        if (! current_user_can('manage_options') || $hook_suffix !== 'settings_page_' . CCW_PLUGIN_SLUG) {
            return;
        }

        wp_register_style($this->handler.'-settings', plugins_url('assets/admin/css/style.css', __FILE__), null, CCW_VERSION, 'all');
        wp_register_style($this->handler.'-select2', plugins_url('assets/select2/css/select2.min.css', __FILE__), null, '4.0.13', 'all');
        wp_register_script($this->handler.'-select2', plugins_url('assets/select2/js/select2.min.js', __FILE__), ['jquery'], '4.0.13', true);

        wp_enqueue_style($this->handler.'-select2');
        wp_enqueue_style($this->handler.'-settings');
        wp_enqueue_style('wp-color-picker');

        wp_enqueue_script($this->handler.'-select2');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script(
            $this->handler.'-settings',
            plugins_url('assets/admin/js/ccw-settings.js', __FILE__),
            ['jquery', $this->handler.'-select2'],
            CCW_VERSION,
            true
        );

        wp_localize_script($this->handler.'-settings', 'ccwData', [
            'gradients'     => $this->gradients,
            'assets'        => $this->assets,
            'locales'       => $this->locales,
            'allowed_attr'  => $this->allowed_attr,
            'ajaxUrl'       => admin_url('admin-ajax.php'),
            'nonce'         => wp_create_nonce($this->handler.'-settings-nonce'),
        ]);
    }

    /**
     * Show admin notice if not dismissed.
     *
     * @return void
     */
    public function CCW_admin_notice_show()
    {
        if (! current_user_can('manage_options')) {
            return;
        }

        if (file_exists(plugin_dir_path(__FILE__).'includes/ccw-admin-notices.php')) {
            require_once(plugin_dir_path(__FILE__).'includes/ccw-admin-notices.php');
            CCW_Admin_Notices::get_instance()->info(__('Rate', 'crypto-converter-widget'), 'rate');
        }
    }

    /**
     * Enqueue admin notification dismiss script.
     *
     * @return void
     */
    public function CCW_admin_notify_scripts()
    {
        if (! current_user_can('manage_options')) {
            return;
        }
        wp_enqueue_script($this->handler . '-notify', plugins_url('assets/admin/js/ccw-notify.js', __FILE__), ['jquery'], CCW_VERSION, true);
        wp_localize_script($this->handler . '-notify', 'cryptoConverterWidgetAjax', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce($this->handler.'-notify-nonce')
        ]);
    }

    /**
     * Settings page.
     *
     * @return void
     */
    public function CCW_admin_settings_page()
    {
        if (! current_user_can('manage_options')) {
            return;
        }

        if (file_exists(plugin_dir_path(__FILE__).'includes/ccw-admin-settings.php')) {
            require_once plugin_dir_path(__FILE__).'includes/ccw-admin-settings.php';
        }
    }


    /**
     * Shortcode.
     *
     * @param array $attr The attributes.
     *
     * @return string
     */
    public function CCW_shortcode($attr)
    {
        // Do not modify or it will not work correctly.
        wp_enqueue_script($this->handler);
        wp_enqueue_style($this->handler . '-frontend');

        $output = '<!-- Crypto Converter ⚡ Widget -->';
        $output .= '<crypto-converter-widget ';
        if (is_array($attr)) {
            foreach ($attr as $key => $value) {
                if (in_array($key, $this->allowed_attr, true)) {
                    // sanitize & escape each value
                    $sanitized = sanitize_text_field($value);
                    $escaped   = esc_attr($sanitized);
                    $output   .= sprintf('%s="%s" ', $key, $escaped);
                }
            }
        }
        $output = rtrim($output) . '></crypto-converter-widget>';

        $allowed = [
            'crypto-converter-widget' => array_fill_keys($this->allowed_attr, []),
            'div' => [
                'style' => [],
                'class' => [],
            ],
            'span' => [
                'class' => [],
            ],
            'a' => [
                'href' => [],
                'target' => [],
                'rel' => [],
                'class' => [],
            ],
        ];

        return wp_kses($output . $this->CCW_attribution_markup(), $allowed);
    }

    /**
     * Product attribution shown below the widget.
     *
     * @return string
     */
    private function CCW_attribution_markup()
    {
        return sprintf(
            '<div class="ccw-attribution"><span class="ccw-attribution__label">%1$s</span> <a class="ccw-attribution__link" href="%2$s" target="_blank" rel="noopener noreferrer">%3$s</a></div>',
            esc_html__('Source:', 'crypto-converter-widget'),
            esc_url('https://currencyrate.today/'),
            esc_html('CurrencyRate')
        );
    }

    /**
     * Plugin action links.
     *
     * @param array $links The links.
     *
     * @return array
     */
    public function CCW_plugin_action_links($links)
    {
        $settings_url = admin_url('admin.php?page=' . CCW_PLUGIN_SLUG);
        $settings_link = '<a href="' . esc_url($settings_url) . '">⚙️ '
                       . esc_html__('Settings', 'crypto-converter-widget')
                       . '</a>';

        array_unshift($links, $settings_link);

        return $links;
    }

    /**
     * Add plugin page.
     *
     * @return void
     */
    public function CCW_add_plugin_page()
    {
        add_options_page(
            esc_html__('Crypto Converter Settings', 'crypto-converter-widget'),
            '⚡ Crypto Converter',
            'manage_options',
            CCW_PLUGIN_SLUG,
            [$this, 'CCW_admin_settings_page']
        );
    }

    /**
     * Load JSON file.
     *
     * @param string $file The file path.
     *
     * @return array
     */
    private function CCW_load_json_file($file)
    {
        if (! file_exists($file)) {
            return [];
        }

        $raw = file_get_contents($file);
        if (false === $raw) {
            return [];
        }

        $data = json_decode($raw, true);
        if (JSON_ERROR_NONE !== json_last_error() || ! is_array($data)) {
            return [];
        }

        return $data;
    }
}

add_action('plugins_loaded', ['CCW_Crypto_Converter_Widget', 'get_instance']);
