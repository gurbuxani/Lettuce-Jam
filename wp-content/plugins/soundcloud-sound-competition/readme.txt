=== SoundCloud Sound Competition ===
Contributors: canitb
Tags: facebook, api, soundcloud, sound, remix, competition, comp, host, integration, marketing, socialmarketing
Donate link: http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/
Requires at least: 3.0
Tested up to: 4.4
Stable tag: 1.1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Host multiple sound or remix competition all within your wordpress site, integrated with SoundCloud and Facebook voting.

== Description ==
[SoundCloud Sound Competition ](http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/) has been created to let you host your own remix competition without thinking about storage space, it's all integrated with SoundCloud so that all remixes are stored there.

Just make your own app in Soundcloud and add the parameters within your settings and you are good to go. You can chose a database slug when a competition has come to an end and you want to start another one, this creates a new competition. The plugin uses [OAuth2](https://api.soundcloud.com/oauth2/) so your Soundcloud account details are not stored for the
plugin to gain access.

Also supporting Facebook secure voting and multi language.

Checkout the website - http://lightdigitalmedia.com/wordpress-plugins/soundcloud-sound-competition/



= Setup =
Once installed, the authorization process is easy:

1. When you first access the plugin’s options page, you will have to fill in setting of you app.

2. To create an app in Soundcloud go here: http://soundcloud.com/you/apps, after logging in you should get the putton "Create new application"

3. After making a name for your app you will get all the information to fill in there. Copy and past all the information into your plugin settings in wordpress in the appropriate fields matching names.

4. In Wordpress create a page for your Remix SoundCloud registration and put in the wordpress code there.

5. The URL of the page you created in 4. type this in your app http://soundcloud.com/you/apps where it says: Redirect URI, this is where SoundCloud redirects after connecting.

6. Test your app to see everything working.


= Minimum Requirements =
1. PHP 5.4 or higher (with [cURL](http://se2.php.net/curl) support)
2. [A Soundcloud account](https://www.soundcloud.com/)


= Errors and Warnings =
Non at the moment, some known configuration setup issues with windows server, see Issues for more information.


= More Information =
For news and updates please visit - http://lightdigitalmedia.com/


= Issues =
* If your website is on a windows server and you get the following error: "The requested URL responded with HTTP code 0" you might have a problem with cURL with your setup, please see the following link to resolve:
http://richardwarrender.com/2007/05/the-secret-to-curl-in-php-on-windows/

* If you get the error while activating the plugin: "Parse error: syntax error, unexpected T_OBJECT_OPERATOR in /pathtowordpress/wp-content/plugins/soundcloud-sound-competition/API/Facebook/FacebookSession.php on line 93" This is due to a lower PHP version than the requirements PHP 5.4 or higher. Solution is to upgrade your PHP version.

If you notice any bugs or want to request a feature please do so on 
http://lightdigitalmedia.com/contact/

== Installation ==
1. Upload the contents of zip file to the `/wp-content/plugins/` directory or use WordPress' built-in plugin install tool
2. Once installed, you can access the plugins settings page under the new menu
3. The first time you access the settings you will be prompted to authorize it with SoundCloud


== Upgrade Notice ==
Just replace the new plugin files. 


== Frequently Asked Questions ==
1.  Question: What does the star in the admin panel do ?
* Answer: The stars has no specific function other than for the admin to mark the potential winners for a competition. 

2. Question: I get the error "plugin doesn't have a valid header" during installation ?
* Answer: Try to go back to the plugins list and activate the plugin from there itself, that usually works. 
(I´m not sure why this error appears, while it works with this workaround, if anyone tech savy people knows the solution please let me know )


== Screenshots ==
1. SoundCloud Sound Contest New remixers backend
2. SoundCloud Sound Contest Settings backend
3. SoundCloud Sound Contest SoundCloud Connect button
4. SoundCloud Sound Contest List front end
5. SoundCloud Sound Contest Upload and collect email
6. SoundCloud Sound Contest Facebook before connection
7. SoundCloud Sound Contest Facebook after connection voting


== Changelog ==

= 1.1.0.0 =
* Fixed facebook errors.
* Bug fixes.

= 1.0.1.3 =
* Changed Soundcloud player
* Added twitter handler sharing input in settings
* Bug fixes.


= 1.0.1.2 =
* Important Bug fixes, saving issue, Modal window Info.


= 1.0.1.1 =
* Bug fixes in the Modal window Info.


= 1.0.1.0 =
* Added Info showing on the same page function.
* Changed buttons.
* Logic rearrangment in admin.
* General Bug fixes.


= 1.0.0.1 =
* Added license function.
* Added Facebook secure voting.
* Added choice of facebook, ip or session voting.
* New graphic.
* Language support added, with English, Spanish and Russian included.
* Misc bug fixes.


= 0.9.2.5 =
* Added additional viewing option with choice in the admin.


= 0.9.2.4 =
* Added sorting on last uploaded and highest rating on the competition page.


= 0.9.2.3 =
* Updated to new Soundcloud API.


= 0.9.2.1 =
* Usabillity: Better shortcode copyer.

= 0.9.2.0 =
* Added info and upload button


= 0.9.1.0 =
* Added admin delete function for an entry
* Url changes and added screenshots.


= 0.9.0.0 =
* First release.

