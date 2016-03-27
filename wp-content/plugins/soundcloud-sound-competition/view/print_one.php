<div id="ken-remix-comp-r-wrap"> 
    <div style="float:left;padding:0px;margin-right:10px;margin-bottom:5px;">
        <a href="<?php echo($result2->rcu_sc_permalink_url); ?>" target="_blank">
            <img src="<?php echo esc_attr($result2->rcu_sc_avatar_url); ?>" border="0" width="50" height="50">
        </a>
    </div>
    <div style="float:left;margin:0px;padding:0px;">
        <div style="font-size:24px;margin:0px;padding:0px;"><?php echo($result2->rce_sct_title); ?></div>
        <div style="font-size:14px;margin:0px;padding:0px;"><?php _e('Uploaded by','soundcloud-sound-competition'); ?> <a href="<?php echo($result2->rcu_sc_permalink_url); ?>" target="_blank"><?php echo($result2->rcu_sc_username); ?></a></div>

        <div class="ken-remix-comp-r-vote">

            <?php if( !empty($vote_results) ) { /* voted */ ?>

                    <div id="r-vote-<?php echo($result2->rce_id); ?>"class="ken-remix-comp-fb-button-voted">
                    <?php if( $kenrmx_voting_type == "Facebook_voting" ) { ?>
                        <span class="ken-remix-comp-fb-button-f">f</span> 
                    <?php } ?>
                    &nbsp;&nbsp;<?php _e('Voted','soundcloud-sound-competition'); ?>&nbsp;&nbsp;&nbsp;</div>
                    <div id="ken-remix-comp-r-votes"><?php echo($result2->rce_vote_count); ?> <?php _e('votes','soundcloud-sound-competition'); ?></div>

            <?php } else { /* not voted */ ?>

                    <?php if( $kenrmx_voting_type == "Facebook_voting" && !$fb_session_logged_in ) { /* fb + not logged in */ ?>

                        <div id="r-vote-<?php echo($result2->rce_id); ?>">
                            <a href="<?php _e($fb_login_to_vote_url); ?>" id="vote-<?php echo($result2->rce_id); ?>" class="ken-remix-comp-fb-button">
                            <span class="ken-remix-comp-fb-button-f">f</span> <?php _e('Login to Vote','soundcloud-sound-competition'); ?></a>
                        </div>
                        <div id="ken-remix-comp-r-votes"><?php echo($result2->rce_vote_count); ?> <?php _e('votes','soundcloud-sound-competition'); ?></div>

                    <?php } else { /* fb + logged in + not voted */ ?>

                        <div id="r-vote-<?php echo($result2->rce_id); ?>">
                            <a href="?rmxid=<?php echo($result2->rce_id); ?>&voting_rmx=<?php echo($result2->rce_id); ?>" id="vote-<?php echo($result2->rce_id); ?>" class="ken-remix-comp-fb-button">
                                <?php if( $kenrmx_voting_type == "Facebook_voting" ) { ?>
                                    <span class="ken-remix-comp-fb-button-f">f</span> 
                                <?php } ?>
                                <?php _e('Vote now','soundcloud-sound-competition'); ?></a>
                        </div>
                        <div id="ken-remix-comp-r-votes"><?php echo($result2->rce_vote_count); ?> <?php _e('votes','soundcloud-sound-competition'); ?></div>

                    <?php } ?>
            <?php } ?>
        </div>

    </div>
    <div id='ken-remix-comp-clear'></div>
            <div id="ken-remix-comp-facebook-p">
                    <div class="fb-like" data-title="Test" data-href="<?php echo($social_url_sound); ?>" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>
            </div>
            <div id="ken-remix-comp-twitter-p">
                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo($social_url_sound); ?>" data-text="Sound contest, listen to <?php echo $record['rce_sct_title']; ?>" data-via="<?php echo($kenrmx_twitter_via_user); ?>">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            </div>
            <div id="ken-remix-comp-google-p">
                    <g:plusone size="medium" href="<?php echo($social_url_sound); ?>"></g:plusone>
            </div>
    <div id="r_stream">
        <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo($result2->rce_sct_secret_uri); ?>&amp;color=ff5500&amp;auto_play=false&amp;buying=false&amp;buying=false&amp;liking=false&amp;download=false&amp;hide_related=false&amp;sharing=false&amp;show_artwork=false&amp;show_playcount=false&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false"></iframe>
    </div>

    <div class="fb-comments" data-href="<?php echo($social_url_sound); ?>" data-num-posts="<?php echo($kenrmx_facebook_comments); ?>" data-width="<?php echo($kenrmx_facebook_width); ?>"></div>
</div>
