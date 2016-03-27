<?php
/*
 Plugin Name: SoundCloud Sound Competition
 Plugin URI: http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition
 Description: Host your own Sound Contest integrated with SoundCloud and Facebook voting.
 Version: 1.1.0.0
 Author: Kenneth Berentzen
 Author URI: http://lightdigitalmedia.com
 License: GPL2 or later
 */

global $wpdb;

//Set plugin local path
define( 'MYPLUGINNAME_PATH', plugin_dir_path(__FILE__) );

//Add class functions
require_once('Classes/class-admin-permalink.php');
require_once('Classes/class-admin-l.php');
require_once('Classes/class-admin-lic.php');
require_once('Classes/class-helper-functions.php');
require_once('Classes/class-installation.php');
require_once('Classes/class-sc-connect.php');
require_once('Classes/class-remixers.php');
require_once('Classes/class-admin-remixers.php');
require_once('Classes/class-admin-settings.php');

//Add actions
add_action('activate_soundcloud-sound-competition/soundcloud-sound-competition.php', 'remixcomp_install');
add_action('admin_menu', 'remixcomp_admin_actions');
add_action('init', 'init_sessions');
add_action('init', 'scsc_lang_ap_action_init');

//Add shortcodes
add_shortcode( 'soundcomp-add', 'remixcomp_sc_connect' );
add_shortcode( 'soundcomp-entrees', 'remixcomp_remixers' );
