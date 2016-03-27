<?php
/*
Plugin Name: SoundCloud Sound Competition
Plugin URI: http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/
Description: Host your own Sound Contest integrated with SoundCloud, users connect easy with SoundCloud to choose track to add to your competition. Everything within your WordPress web site.
Author: Kenneth Berentzen
Author URI: http://lightdigitalmedia.com/
License: Copyright 2012  Kenneth Berentzen  (email : post@lightdigitalmedia.com)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Admin Settings
function remixcomp_settings() {
	if (!current_user_can(10))  { //Admin users
		wp_die( __('You do not have sufficient permissions to access this page.', 'soundcloud-sound-competition') );
	}
    global $wpdb;

    echo(get_remixcomp_admin_header()); 
    
    echo('<h2>');
    _e('Settings','soundcloud-sound-competition');
    echo('</h2>');

    if($_POST['check_post'] == "true") {
        //Setting variables
        $ken_settings = array(
            'kenrmx_sc_client_id' => $_POST['kenrmx_sc_client_id'], 
            'kenrmx_sc_client_secret' => $_POST['kenrmx_sc_client_secret'], 
            'kenrmx_sc_remix_type' => $_POST['kenrmx_sc_remix_type'], 
            'kenrmx_wpsc_connect_page_url' => $_POST['kenrmx_wpsc_connect_page_url'], 
            'kenrmx_wpsc_entrees_page_url' => $_POST['kenrmx_wpsc_entrees_page_url'], 
            'kenrmx_wpsc_more_info_url' => $_POST['kenrmx_wpsc_more_info_url'], 
            'kenrmx_wpsc_preview_type' => $_POST['kenrmx_wpsc_preview_type'], 
            'kenrmx_facebook_width' => $_POST['kenrmx_facebook_width'], 
            'kenrmx_facebook_comments' => $_POST['kenrmx_facebook_comments'], 
            'kenrmx_facebook_app_id' => $_POST['kenrmx_facebook_app_id'], 
            'kenrmx_facebook_app_secret' => $_POST['kenrmx_facebook_app_secret'], 
            'kenrmx_voting_type' => $_POST['kenrmx_voting_type'],
            'kenrmx_twitter_via_user' => $_POST['kenrmx_twitter_via_user']
        );
        update_option('ken_remixcomp_settings', $ken_settings);

    }

    !is_array(get_option('ken_remixcomp_settings')) ? "" : extract(get_option('ken_remixcomp_settings'));

    //Start html
    //echo("<link rel='stylesheet' href='".plugins_url('soundcloud-sound-competition/css/admin.css')."' />");
    //echo("<script src='".plugins_url('soundcloud-sound-competition/js/jquery-1.9.1.js')."'></script>");
    ?>
    <form action="?page=<?php echo $_GET['page']; ?>" method="POST">

    <div class="tabs">

        <div class="tab">
           <input type="radio" id="tab-1" name="tab-group-1" checked>
           <label for="tab-1"><strong><?php _e('Contest','soundcloud-sound-competition'); ?></strong></label>
         
           <div class="content">
                <p>
                <h3><?php _e('Current Contest Page','soundcloud-sound-competition'); ?></h3>
                
                <input type="hidden" name="check_post" value="true"/>

                <div style="color:#999;"><?php _e('Unique current contest name','soundcloud-sound-competition'); ?>: <!--img src="icon-questionmark-small.gif"--></div>
                <input title="If you wanto make a new remix competition you would make a new name here. Only for internal purposes in the admin contest list. Example -> mycomp1" type="text" size="60" name="kenrmx_sc_remix_type" value="<?php echo $kenrmx_sc_remix_type; ?>"/><br><br>
                
                <div style="color:#999;"><?php _e('WordPress List Entrees Page URL','soundcloud-sound-competition'); ?>:</div>
                <input type="text" size="60" name="kenrmx_wpsc_entrees_page_url" value="<?php echo $kenrmx_wpsc_entrees_page_url; ?>"/><br>
                <input type="text" title="Place this shortcode on the page/url just above this text" size="40" onclick="this.focus();this.select()" readonly="readonly" value="[soundcomp-entrees type='<?php echo $kenrmx_sc_remix_type; ?>']"/><br><br>
                
                <div style="color:#999;"><?php _e('More information Page/Post URL','soundcloud-sound-competition'); ?>:</div>
                <input type="text" size="60" name="kenrmx_wpsc_more_info_url" value="<?php echo $kenrmx_wpsc_more_info_url; ?>"/><br><br>
                
                <div style="color:#999;"><?php _e('Entries preview type','soundcloud-sound-competition'); ?>:</div>
                <select name="kenrmx_wpsc_preview_type">
                    <option value="<?php echo $kenrmx_wpsc_preview_type; ?>"><?php echo $kenrmx_wpsc_preview_type; ?></option>
                    <option value="Image_list"><?php _e('Image list (profile pictures from entrees side by side)','soundcloud-sound-competition'); ?></option>
                    <option value="Sound_list"><?php _e('Sound list (more detail and preview in the list)','soundcloud-sound-competition'); ?></option>
                </select><br><br>
                <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit"></input>
                </p>
           </div> 
       </div>

       <div class="tab">
           <input type="radio" id="tab-2" name="tab-group-1">
           <label for="tab-2"><strong><?php _e('SoundCloud','soundcloud-sound-competition'); ?></strong></label>
           
           <div class="content">
                <p>
                <h3><?php _e('Soundcloud Account Details','soundcloud-sound-competition'); ?></h3>
                
                <div style="color:#999;"><?php _e('WordPress SoundCloud Connect Page URL','soundcloud-sound-competition'); ?>:</div>
                <input type="text" size="60" name="kenrmx_wpsc_connect_page_url" value="<?php echo $kenrmx_wpsc_connect_page_url; ?>"/><br>
                <input type="text" title="Place this shortcode on the page/url just above this text" size="40" onclick="this.focus();this.select()" readonly="readonly" value="[soundcomp-add]"/><br><br>
                
                <div style="color:#999;"><?php _e('Soundcloud Client ID','soundcloud-sound-competition'); ?>:</div>
                <input type="text" size="60" name="kenrmx_sc_client_id" value="<?php echo $kenrmx_sc_client_id; ?>"/><br><br>
                <div style="color:#999;"><?php _e('Soundcloud Client Secret','soundcloud-sound-competition'); ?>:</div>
                <input type="text" size="60" name="kenrmx_sc_client_secret" value="<?php echo $kenrmx_sc_client_secret; ?>"/><br><br>

                <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit"></input>
                </p>
           </div> 
       </div>
        
       <div class="tab">
           <input type="radio" id="tab-3" name="tab-group-1">
           <label for="tab-3"><strong><?php _e('Facebook','soundcloud-sound-competition'); ?></strong></label>
           
           <div class="content">
                <p>
                <h3><?php _e('Voting system, Facebook application','soundcloud-sound-competition'); ?></h3>
                <?php if( soundcloud_sound_competition_ch_l() ): ?>
                  <div style="color:#999;"><?php _e('Voting type','soundcloud-sound-competition'); ?>:</div>
                  <select name="kenrmx_voting_type">
                      <option value="<?php echo $kenrmx_voting_type; ?>"><?php echo $kenrmx_voting_type; ?></option>
                      <option value="Session_voting"><?php _e('Session voting (Uses php session, less secure)','soundcloud-sound-competition'); ?></option>
                      <option value="Facebook_voting"><?php _e('Facebook voting (Uses facebook app, very secure)','soundcloud-sound-competition'); ?></option>
                  </select><br><br>
                  <div style="color:#999;"><?php _e('Facebook App ID','soundcloud-sound-competition'); ?>:</div>
                  <input type="text" size="60" name="kenrmx_facebook_app_id" value="<?php echo $kenrmx_facebook_app_id; ?>"/><br><br>
                  <div style="color:#999;"><?php _e('Facebook App Secret','soundcloud-sound-competition'); ?>:</div>
                  <input type="text" size="60" name="kenrmx_facebook_app_secret" value="<?php echo $kenrmx_facebook_app_secret; ?>"/><br><br>
                  <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit"></input>
                <?php else:  _e(get_remixcomp_admin_kjop_l_m()); endif; ?>
                </p>
           </div> 
       </div>

        <div class="tab">
           <input type="radio" id="tab-4" name="tab-group-1">
           <label for="tab-4"><strong><?php _e('Misc','soundcloud-sound-competition'); ?></strong></label>
         
           <div class="content">
            <p>    
            <h3><?php _e('Contest List Entrees','soundcloud-sound-competition'); ?></h3>
            <div style="color:#999;"><?php _e('Facebook comments box width','soundcloud-sound-competition'); ?>:</div>
            <input type="text" size="60" name="kenrmx_facebook_width" value="<?php echo $kenrmx_facebook_width; ?>"/><br><br>
            <div style="color:#999;"><?php _e('Facebook comments amount','soundcloud-sound-competition'); ?>:</div>
            <input type="text" title="How many comments to show" size="60" name="kenrmx_facebook_comments" value="<?php echo $kenrmx_facebook_comments; ?>"/><br><br>
            <div style="color:#999;"><?php _e('Twitter via user @','soundcloud-sound-competition'); ?>:</div>
            <input type="text" title="Twitter via user @" size="60" name="kenrmx_twitter_via_user" value="<?php echo $kenrmx_twitter_via_user; ?>"/><br><br>
            <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit"></input>
            </p>
           </div> 
       </div>
        
    </div>

    </form>    
    <?php
    
}

