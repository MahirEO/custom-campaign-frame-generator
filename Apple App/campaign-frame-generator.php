<?php
/**
 * Plugin Name: Custom Campaign Frame Generator
 * Plugin URI: https://yourwebsite.com/
 * Description: Allow users to overlay custom frames on photos with form data, Google Sheets & Drive integration
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: campaign-frame-generator
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CFG_VERSION', '1.0.0');
define('CFG_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CFG_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CFG_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Activation & Deactivation hooks
register_activation_hook(__FILE__, 'cfg_activate');
register_deactivation_hook(__FILE__, 'cfg_deactivate');

function cfg_activate() {
    require_once CFG_PLUGIN_PATH . 'includes/class-database.php';
    CFG_Database::create_tables();
    
    // Set default options
    add_option('cfg_google_connected', false);
    add_option('cfg_google_drive_folder', '');
    add_option('cfg_google_sheet_id', '');
    
    flush_rewrite_rules();
}

function cfg_deactivate() {
    flush_rewrite_rules();
}

// Load required files
require_once CFG_PLUGIN_PATH . 'includes/class-database.php';
require_once CFG_PLUGIN_PATH . 'includes/class-campaign.php';
require_once CFG_PLUGIN_PATH . 'includes/class-google-integration.php';
require_once CFG_PLUGIN_PATH . 'includes/class-shortcode.php';
require_once CFG_PLUGIN_PATH . 'includes/class-ajax.php';

// Initialize admin area
if (is_admin()) {
    require_once CFG_PLUGIN_PATH . 'admin/class-admin.php';
    new CFG_Admin();
}

// Initialize public area
require_once CFG_PLUGIN_PATH . 'public/class-public.php';
new CFG_Public();

// Initialize shortcode handler
new CFG_Shortcode();

// Initialize AJAX handler
new CFG_Ajax();
