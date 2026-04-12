<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package Crypto_Converter_Widget
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_metadata( 'user', 0, 'CCW_admin_hide_notice', '', true );
