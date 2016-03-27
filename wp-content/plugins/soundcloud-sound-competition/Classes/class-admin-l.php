<?php
/*
Plugin Name: SoundCloud Sound Competition
Plugin URI: http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/
Description: Host your own Sound Contest integrated with SoundCloud, users connect easy with SoundCloud to choose track to add to your competition. Everything within your WordPress web site.
Author: Kenneth Berentzen
Author URI: http://lightdigitalmedia.com/
License: Copyright 2012  Kenneth Berentzen  (email : post@lightdigitalmedia.com)
*/


define( 'EDD_SL_STORE_URL', 'http://lightdigitalmedia.com' );
define( 'EDD_SL_ITEM_NAME', 'Soundcloud Sound Competition' );

if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
    // load our custom updater
    include( MYPLUGINNAME_PATH. 'API/EDD_SL_Plugin_Updater.php' );
}

// retrieve our license key from the DB
$license_key = trim( get_option( 'soundcloud_sound_competition_license_key' ) );
// setup the updater
$edd_updater = new EDD_SL_Plugin_Updater( EDD_SL_STORE_URL, MYPLUGINNAME_PATH.'soundcloud-sound-competition.php', array(
		'version' 	=> '1.1.0.0', 			// current version number
		'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
		'item_name' => EDD_SL_ITEM_NAME, 	// name of this plugin
		'author' 	=> 'Kenneth Berentzen'  // author of this plugin
	)
);
