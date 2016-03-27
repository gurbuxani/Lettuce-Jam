<?php
/*
Plugin Name: SoundCloud Sound Competition
Plugin URI: http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/
Description: Host your own Sound Contest integrated with SoundCloud, users connect easy with SoundCloud to choose track to add to your competition. Everything within your WordPress web site.
Author: Kenneth Berentzen
Author URI: http://lightdigitalmedia.com/
License: Copyright 2014  Kenneth Berentzen  (email : post@lightdigitalmedia.com)
*/

if (!class_exists('rmxid_permalink')) {
    class rmxid_permalink {

        function __construct(){
            // permalink hooks:
            add_filter('generate_rewrite_rules', array(&$this,'my_permalink_rewrite_rule'));
            add_filter('query_vars', array(&$this,'my_permalink_query_vars'));
            add_filter('admin_init', array(&$this, 'my_permalink_flush_rewrite_rules'));
            add_action("parse_request", array(&$this,"my_permalink_parse_request"));
        }

        /**************************************************************************
         * Create your URL
         * If the blog has a permalink structure, a permalink is returned. Otherwise
         * a standard URL with param=val.
         *
         * @param sting $val Parameter to custom url
         * @return string URL
         **************************************************************************/
        function my_permalink_url($val) {
            if ( get_option('permalink_structure')) { // check if the blog has a permalink structure
                return sprintf("%s/".get_path_to_competition_after_domain()."/".get_name_permalink_to_a_sound()."/%s",home_url(),$val);
            } else {
                return sprintf("%s/index.php?my_permalink_variable_01=%s",home_url(),$val);
            }
        }

        /**************************************************************************
         * Add your rewrite rule.
         * The rewrite rules array is an associative array with permalink URLs as regular
         * expressions (regex) keys, and the corresponding non-permalink-style URLs as values
         * For the rule to take effect, For the rule to take effect, flush the rewrite cache,
         * either by re-saving permalinks in Settings->Permalinks, or running the
         * my_permalink_flush_rewrite_rules() method below.
         *
         * @see http://codex.wordpress.org/Custom_Queries#Permalinks_for_Custom_Archives
         * @param object $wp_rewrite
         * @return array New permalink structure
         **************************************************************************/
        function my_permalink_rewrite_rule( $wp_rewrite ) {
            $new_rules = array(
                 ''.get_path_to_competition_after_domain().'/'.get_name_permalink_to_a_sound().'/(.*)$' => sprintf("index.php?my_permalink_variable_01=%s",$wp_rewrite->preg_index(1))
                 /*
                 // a more complex permalink:
                 'my-permalink/([^/]+)/([^.]+).html$' => sprintf("index.php?my_permalink_variable_01=%s&my_permalink_variable_02=%s",$wp_rewrite->preg_index(1),$wp_rewrite->preg_index(2))
                 */
            );

            $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
            return $wp_rewrite->rules;
        }

        /**************************************************************************
         * Add your custom query variables.
         * To make sure that our parameter value(s) gets saved,when WordPress parse the URL,
         * we have to add our variable(s) to the list of query variables WordPress
         * understands (query_vars filter)
         *
         * @see http://codex.wordpress.org/Custom_Queries
         * @param array $query_vars
         * @return array $query_vars with custom query variables
         **************************************************************************/
        function my_permalink_query_vars( $query_vars ) {
        	global $wpdb;
            $query_vars[] = 'my_permalink_variable_01';
            /*
            // need more variables?:
            $query_vars[] = 'my_permalink_variable_02';
            $query_vars[] = 'my_permalink_variable_03';
            */
            return $query_vars;
        }

        /**************************************************************************
         * Parses a URL into a query specification
         * This is where you should add your code.
         *
         * @see http://codex.wordpress.org/Query_Overview
         * @param array $atts shortcode parameters
         * @return string URL to demonstrate custom permalink
         **************************************************************************/
        function my_permalink_parse_request($wp_query) {
            if (isset($wp_query->query_vars['my_permalink_variable_01'])) { // same as the first custom variable in my_permalink_query_vars( $query_vars )
                // add your code here, code below is for this demo
                //remixcomp_remixers( $atts, $wp_query->query_vars[my_permalink_variable_01] );
                //_e("VAR: ".$wp_query->query_vars[my_permalink_variable_01]);
                //_e("<br>URL: ".get_name_permalink_to_a_sound());
                //_e("<br>URL: ".get_path_to_competition_after_domain());
                header('Location: '.get_full_url_to_competition().'/?rmxid='.$wp_query->query_vars[my_permalink_variable_01], true, 302);
                //printf("<pre>%s</pre>",print_r($wp_query->query_vars,true));
                exit(0);
            }
        }

        /**************************************************************************
         * Flushes the permalink structure.
         * flush_rules is an extremely costly function in terms of performance, and
         * should only be run when changing the rule.
         *
         * @see http://codex.wordpress.org/Rewrite_API/flush_rules
         **************************************************************************/
        function my_permalink_flush_rewrite_rules() {
            $rules = $GLOBALS['wp_rewrite']->wp_rewrite_rules();
            if ( ! isset( $rules[''.get_path_to_competition_after_domain().'/'.get_name_permalink_to_a_sound().'/(.*)$'] ) ) { // must be the same rule as in my_permalink_rewrite_rule($wp_rewrite)
                global $wp_rewrite;
                $wp_rewrite->flush_rules();
            }
        }
    } //End Class
} //End if class exists statement

if (class_exists('rmxid_permalink')) {
    $my_permalink_var = new rmxid_permalink();
}