<div id="ken-remix-comp-r-wrap"> 
    <div style="float:left;padding:0px;margin-right:10px;margin-bottom:5px;">
        <a href="<?php echo($result->rcu_sc_permalink_url); ?>" target="_blank">
            <img src="<?php echo esc_attr($result->rcu_sc_avatar_url); ?>" border="0" width="50" height="50">
        </a>
    </div>
    <div style="float:left;margin:0px;padding:0px;">
        <div style="font-size:24px;margin:0px;padding:0px;"><a href="<?php echo($base_url_remixers); ?>"><?php echo($result->rce_sct_title); ?></a></div>
        <div style="font-size:14px;margin:0px;padding:0px;"><?php _e('Uploaded by','soundcloud-sound-competition'); ?> <a href="<?php echo($result->rcu_sc_permalink_url); ?>" target="_blank"><?php echo($result->rcu_sc_username); ?></a></div>

        <div class="ken-remix-comp-r-vote">

            <?php if( !empty($vote_results_all) ) { /* voted */ ?>

                    <div id="r-vote-<?php echo($result->rce_id); ?>" class="ken-remix-comp-fb-button-voted">
                    <?php if( $kenrmx_voting_type == "Facebook_voting" ) { ?>
                        <span class="ken-remix-comp-fb-button-f">f</span> 
                    <?php } ?>
                    &nbsp;&nbsp;<?php _e('Voted','soundcloud-sound-competition'); ?>&nbsp;&nbsp;&nbsp;</div>
                    <div id="ken-remix-comp-r-votes"><?php echo($result->rce_vote_count); ?> <?php _e('votes','soundcloud-sound-competition'); ?></div>

            <?php } else { /* not voted */ ?>

                    <?php if( $kenrmx_voting_type == "Facebook_voting" && !$fb_session_logged_in ) { /* fb + not logged in */ ?>

                        <div id="r-vote-<?php echo($result->rce_id); ?>">
                            <a href="<?php _e($fb_login_to_vote_url); ?>" id="vote-<?php echo($result->rce_id); ?>" class="ken-remix-comp-fb-button">
                            <span class="ken-remix-comp-fb-button-f">f</span> <?php _e('Login to Vote','soundcloud-sound-competition'); ?></a>
                        </div>
                        <div id="ken-remix-comp-r-votes"><?php echo($result->rce_vote_count); ?> <?php _e('votes','soundcloud-sound-competition'); ?></div>

                    <?php } else { /* fb + logged in + not voted */ ?>

                        <div id="r-vote-<?php echo($result->rce_id); ?>">
                            <a href="?rmxid=<?php echo($result->rce_id); ?>&voting_rmx=<?php echo($result->rce_id); ?>" id="vote-<?php echo($result->rce_id); ?>" class="ken-remix-comp-fb-button">
                                <?php if( $kenrmx_voting_type == "Facebook_voting" ) { ?>
                                    <span class="ken-remix-comp-fb-button-f">f</span> 
                                <?php } ?>
                                <?php _e('Vote now','soundcloud-sound-competition'); ?></a>
                        </div>
                        <div id="ken-remix-comp-r-votes"><?php echo($result->rce_vote_count); ?> <?php _e('votes','soundcloud-sound-competition'); ?></div>

                    <?php } ?>
            <?php } ?>
        </div>

    </div>
    <div id='ken-remix-comp-clear'></div>
    <div id="r_stream">
        <iframe width="100%" height="20" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo($result->rce_sct_secret_uri); ?>&amp;color=ff5500&amp;auto_play=false&amp;buying=false&amp;buying=false&amp;liking=false&amp;download=false&amp;hide_related=false&amp;sharing=false&amp;show_artwork=false&amp;show_playcount=false&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false"></iframe>
    </div>
</div>