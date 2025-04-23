<?php

/**
 * @version 3.1.1
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


if (!class_exists('CCW_Admin_Notices')) {

    class CCW_Admin_Notices
    {
        private static $_instance;
        private $admin_notices;
        public const TYPES = 'error,warning,info,success';

        private function __construct()
        {
            $this->admin_notices = new stdClass();
            foreach (explode(',', self::TYPES) as $type) {
                $this->admin_notices->{$type} = [];
            }

            add_action('admin_notices', [$this, 'CCW_admin_notice']);
            add_action('wp_ajax_CCW_admin_hide_notice', [$this, 'CCW_admin_hide_notice']);
        }

        public static function get_instance()
        {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function CCW_admin_hide_notice()
        {
            check_ajax_referer(
                CCW_PLUGIN_SLUG . '-notify-nonce',
                'security'
            );
            $user_id = get_current_user_id();

            update_user_meta($user_id, 'CCW_admin_hide_notice', time());
            wp_send_json_success();
        }

        public function CCW_admin_notice()
        {
            $user_id = get_current_user_id();
            $hide_notice = get_user_meta($user_id, 'CCW_admin_hide_notice', true);

            if ($hide_notice && (time() - $hide_notice < WEEK_IN_SECONDS)) {
                return;
            }

            echo '<div class="notice notice-info is-dismissible" id="crypto-converter-widget-notice">
                <div style="display:flex;padding:10px 0;">
                    <div style="margin-right:15px;">
                        <span class="ccw-icon" role="img" aria-label="'.esc_html(CCW_NAME).'"></span>
                    </div>
                    <div>
                        <h2>🥰 '.esc_html('Please rate our free', 'crypto-converter-widget').' &laquo;'.esc_html(CCW_NAME).'&raquo;</h2>
                        <hr>
                        <p>'.esc_html('Your valuable feedback will help us improve.', 'crypto-converter-widget').'<br>'.esc_html('It will only take a few minutes', 'crypto-converter-widget').': <a href="https://wordpress.org/support/plugin/crypto-converter-widget/reviews/#new-post" rel="noopener" target="_blank">'.esc_html('Rate it now', 'crypto-converter-widget').'</a> 👍</p>
                        <p class="ccw-admin-notice">
                            <a href="'.esc_url('https://wordpress.org/support/plugin/crypto-converter-widget/reviews/#new-post').'"
                                target="_blank" rel="noopener">
                                <span class="ccw-stars" role="img" aria-label="'.esc_attr__('Rating', 'crypto-converter-widget').'"></span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>';
        }

        public function info($message, $dismiss_option = false)
        {
            $this->notice('info', $message, $dismiss_option);
        }

        private function notice($type, $message, $dismiss_option)
        {
            $notice = new stdClass();
            $notice->message = $message;
            $notice->dismiss_option = $dismiss_option;

            $this->admin_notices->{$type}[] = $notice;
        }
    }
}
