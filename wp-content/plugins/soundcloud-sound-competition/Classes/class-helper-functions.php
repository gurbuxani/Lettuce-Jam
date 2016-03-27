<?php
/*
Plugin Name: SoundCloud Sound Competition
Plugin URI: http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/
Description: Host your own Sound Contest integrated with SoundCloud, users connect easy with SoundCloud to choose track to add to your competition. Everything within your WordPress web site.
Author: Kenneth Berentzen
Author URI: http://lightdigitalmedia.com/
License: Copyright 2014  Kenneth Berentzen  (email : post@lightdigitalmedia.com)
*/

// retrieves the attachment ID from the file URL
function helper_get_page_id($url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE `post_type`='page' AND '%s' LIKE CONCAT('%s', post_name, '%s') ORDER BY ID DESC;", $url, '%', '%' )); 
    return $attachment[0]; 
}

function set_visitor_voted($voting_rmx, $remix_db_slug, $session_ip, $session, $session_user_agent) {
    global $wpdb;

    //Check for strange double insert error from fb.
    if( substr($session_user_agent, 0, 19) != "facebookexternalhit" ){

        //Insert session vote
        $return = $wpdb->insert( 
                $wpdb->prefix."ken_remixcomp_voting" , 
                array( 
                    'rcv_rce_id' => $voting_rmx, 
                    'rcv_remix' => $remix_db_slug, 
                    'rcv_rate' => 1, 
                    'rcv_ip' => $session_ip, 
                    'rcv_session' => $session, 
                    'rcv_user_agent' => $session_user_agent, 
                    'rcv_created_date' => date("Y-m-d H:i:s"), 
                    'rcv_created_by' => 'Web'
                )
        );
        //Update count
        $return2 = $wpdb->query( 
                $wpdb->prepare( 
                        "
                        UPDATE ".$wpdb->prefix."ken_remixcomp_entrees 
                        SET rce_vote_count = rce_vote_count + 1
                        WHERE rce_id = %d
                        ",
                        $voting_rmx
                )
        );
    }
    
    if( $return > 0 && $return2 > 0 ) { 
        return $return;
    }
    else {
        return 0;
    }      
}

function set_visitor_voted_fb($voting_rmx, $remix_db_slug, $session_ip, $session, $session_user_agent, $fb_userid) {
    global $wpdb;

    //Check for strange double insert error from fb.
    if( substr($session_user_agent, 0, 19) != "facebookexternalhit" ){

        //Insert session vote
        $return = $wpdb->insert( 
                $wpdb->prefix."ken_remixcomp_voting" , 
                array( 
                    'rcv_rce_id' => $voting_rmx, 
                    'rcv_remix' => $remix_db_slug, 
                    'rcv_rate' => 1, 
                    'rcv_fb_userid' => $fb_userid, 
                    'rcv_ip' => $session_ip, 
                    'rcv_session' => $session, 
                    'rcv_user_agent' => $session_user_agent, 
                    'rcv_created_date' => date("Y-m-d H:i:s"), 
                    'rcv_created_by' => 'Web'
                )
        );
        //Update count
        $return2 = $wpdb->query( 
                $wpdb->prepare( 
                        "
                        UPDATE ".$wpdb->prefix."ken_remixcomp_entrees 
                        SET rce_vote_count = rce_vote_count + 1
                        WHERE rce_id = %d
                        ",
                        $voting_rmx
                )
        );
    }
    
    if( $return > 0 && $return2 > 0 ) { 
        return $return;
    }
    else {
        return 0;
    }      
}

function set_fb_voters_add($id, $email, $first_name, $gender, $last_name, $link, $locale, $name, $timezone, $updated_time, $verified) {
    global $wpdb;

    $fb_sql_sjekk = "SELECT *                                                       
        FROM ".$wpdb->prefix."ken_remixcomp_fb_voters 
        WHERE rcfv_fb_userid='".$id."' 
        LIMIT 1
    "; 
    $results = $wpdb->get_results($fb_sql_sjekk);

    //Check results is either 0, empty, or not set at all
    if( empty($results) ){

        //Insert session vote
        $return = $wpdb->insert( 
                $wpdb->prefix."ken_remixcomp_fb_voters" , 
                array( 
                    'rcfv_fb_userid' => $id, 
                    'rcfv_email' => $email, 
                    'rcfv_first_name' => $first_name, 
                    'rcfv_gender' => $gender, 
                    'rcfv_last_name' => $last_name, 
                    'rcfv_link' => $link, 
                    'rcfv_locale' => $locale, 
                    'rcfv_name' => $name, 
                    'rcfv_timezone' => $timezone, 
                    'rcfv_updated_time' => date("Y-m-d H:i:s"), 
                    'rcfv_verified' => $verified, 
                    'rcfv_created_date' => date("Y-m-d H:i:s"), 
                    'rcfv_created_by' => 'Web'
                )
        );
    }
    
    if( $return > 0 ) { 
        return $return;
    }
    else {
        return 0;
    }      
}

function check_has_visitor_voted_by_ip($voting_rmx,$remix_db_slug,$ip) {
    global $wpdb;
    $vote_sql_sjekk = "SELECT *                                                       
        FROM ".$wpdb->prefix."ken_remixcomp_voting 
        WHERE rcv_remix='".$remix_db_slug."'
        AND rcv_rce_id='".$voting_rmx."' 
        AND rcv_ip='".$ip."'
        LIMIT 1
    "; 
    $vote_sjekk_results = $wpdb->get_results($vote_sql_sjekk);
    
    if( preg_match('/^\d\d*$/', $voting_rmx) && empty($vote_sjekk_results) ) { 
        return true;
    }
    else {
        return false;
    }      
}

function check_has_visitor_voted_by_session($voting_rmx,$remix_db_slug,$session) {
    global $wpdb;
    $vote_sql_sjekk = "SELECT *                                                       
        FROM ".$wpdb->prefix."ken_remixcomp_voting 
        WHERE rcv_remix='".$remix_db_slug."'
        AND rcv_rce_id='".$voting_rmx."' 
        AND rcv_session='".$session."'
        LIMIT 1
    "; 
    $vote_sjekk_results = $wpdb->get_results($vote_sql_sjekk);
    
    if( preg_match('/^\d\d*$/', $voting_rmx) && empty($vote_sjekk_results) ) { 
        return true;
    }
    else {
        return false;
    }      
}

//Special get ip funksjon
function get_real_IP_address() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet 
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_remixcomp_admin_header() {
    $return_string =   '<link rel="stylesheet" href="'.plugins_url('soundcloud-sound-competition/css/style_admin.css').'" />'.
                        '<div class="logoheader">'.
                        '<img src="'. plugins_url("soundcloud-sound-competition/images/sc_white_48x24.png").'" border="0" /> '.
                        '<span style="position: relative; bottom:4px;">SOUNDCLOUD SOUND COMPETITION</span></div>'.
                        ''; 
    if( !soundcloud_sound_competition_ch_l() ) {
        $return_string =  $return_string.
                        '<a href="http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/" target="new">'.
                        '<div class="headerbutton"><span style="position: relative; bottom:-4px;">' . 
                        __('Get Pro', 'soundcloud-sound-competition') . '</span></div></a>'.
                        ''; 
    }
    else {
        $return_string =  $return_string.
                        '<a href="http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/" target="new">'.
                        '<div class="headerbutton"><span style="position: relative; bottom:-4px;">' . 
                        __('Support', 'soundcloud-sound-competition') . '</span></div></a>'.
                        ''; 
    }
    $return_string =  $return_string.
                        '<div id="ken-remix-comp-clear"></div>'.
                        ''; 
    return "{$return_string}";
} 

function get_remixcomp_admin_kjop_l_m() {
     $return_string =   '' . __('You need to buy a license to activate this function', 'soundcloud-sound-competition') . '.<br>'.
                        '<a href="http://lightdigitalmedia.com/download/soundcloud-sound-competition/" target="new">'.
                        '<div class="scc_largebutton"><span style="position: relative; bottom:-4px;">' . 
                        __('Get License', 'soundcloud-sound-competition') . '</span></div></a>'.
                        '<div id="ken-remix-comp-clear"></div>'.
                        '';       
     return "{$return_string}";
} 

function get_name_permalink_to_a_sound() {
    //Returning sound to append in url http://kenrecords.com/remix/banana-disco-remix-competition/sound
    $name = "sound";
    return $name;
}

function get_full_url_to_competition() {
    //Returning http://kenrecords.com/remix/banana-disco-remix-competition
    !is_array(get_option('ken_remixcomp_settings')) ? "" : extract(get_option('ken_remixcomp_settings')); 
    return $kenrmx_wpsc_entrees_page_url;
}

function get_path_to_competition_after_domain() {
    //Stripping http://kenrecords.com from http://kenrecords.com/remix/banana-disco-remix-competition
    //Resulting in remix/banana-disco-remix-competition and adding prefix for sound
    !is_array(get_option('ken_remixcomp_settings')) ? "" : extract(get_option('ken_remixcomp_settings')); 
    $site_url = get_site_url()."/";
    $str = preg_replace('/^' . preg_quote($site_url, '/') . '/', '', $kenrmx_wpsc_entrees_page_url);
    return $str;
}

//Enable sessions
function init_sessions() {
    if (!session_id()) {
        session_start();
    }
}

//Admin meny hirarkiet setter opp
function remixcomp_admin_actions() {
	add_menu_page('RemixComp', 'Sound Contest', 10, 'soundcloud-sound-competition', 'remixcomp_list_partisipants');
    add_submenu_page( 'soundcloud-sound-competition', 'Settings', 'Settings', 10, 'remixcomp-settings','remixcomp_settings'); 
    add_submenu_page( 'soundcloud-sound-competition', 'License', 'License', 10, 'remixcomp-license','ssc_remixcomp_license_page'); 
}

function get_remixcomp_st() {
        //base64_encode base64_decode
        $return_string = 'PGRpdiBzdHlsZT0iZm9udC1zaXplOjEwcHg7bWFyZ2luOjBweDtwYWRkaW5nOjBweDsiPlBvd2VyZWQgYnkgPGEgaHJlZj0iaHR0cDovL2tlbnJlY29yZHMuY29tIiB0YXJnZXQ9Im5ldyI+S2VuIFJlY29yZHM8L2E+IOKGkiBHZXQgeW91ciA8YSBocmVmPSJodHRwOi8vbGlnaHRkaWdpdGFsbWVkaWEuY29tL3dvcmRwcmVzcy1wbHVnaW5zL3NvdW5kY2xvdWQtc291bmQtY29tcGV0aXRpb24vIiB0YXJnZXQ9Im5ldyI+U291bmRDbG91ZCBTb3VuZCBDb250ZXN0IFBsdWdpbiBmb3IgV29yZFByZXNzPC9hPiA8L2Rpdj4='; 
        $return_string = base64_decode($return_string);
        return "{$return_string}";
} 

function get_id_by_sc_user_id($sc_id) {
    global $wpdb;
    //Is digit
    if( preg_match('/^\d\d*$/', $sc_id) ) {
        
        $id=$wpdb->get_col( $wpdb->prepare( 
            "
            SELECT      rcu_id
            FROM        ".$wpdb->prefix."ken_remixcomp_users
            WHERE       rcu_sc_id = %d 
            LIMIT 1 ",
            $sc_id 
        ) ); 
        
        if ($id){
            return $id[0];
        }
        else {
            return 0;
        }
    }        
}

// Localization
function scsc_lang_ap_action_init() { 
    load_plugin_textdomain('soundcloud-sound-competition', false, basename( dirname( __FILE__ ) ) . '/lang' );
}

