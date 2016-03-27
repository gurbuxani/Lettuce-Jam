<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'b5_17750738_wp220');

/** MySQL database username */
define('DB_USER', '17750738_1');

/** MySQL database password */
define('DB_PASSWORD', 'P5(331G[SQ');

/** MySQL hostname */
define('DB_HOST', 'sql204.byetcluster.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't5rjdihvf0ww5kgw6bnlp6kq6mum1fmdzshxxjnpdt6kdpz8ayoxdiasrtmwuvwe');
define('SECURE_AUTH_KEY',  '1seh9lgttmifighoe0dcskolvpgx2gda9j6yhlcbglqwtb2ywsmqiuuotthboksi');
define('LOGGED_IN_KEY',    'utahn1ml0e1gcxt6uqlpmnhxq88g7zboj9smrs0kqddm1oxkk1voigjlkdqfc4h0');
define('NONCE_KEY',        'blos5vekjacwsnileshuzaqxudbsxwhlcjsi8peebt6wc3v5c010k5barbyq01ab');
define('AUTH_SALT',        'ykwfh7bwothja4arvu8qqt8vkkhvgfrf4roybfdrowf97eetgiaydtgi2rf13b2q');
define('SECURE_AUTH_SALT', 'zxxywjg4uhirnaavqacqseklexxpftcoj4zfsglpzss1t1ohjlptaqiiuzlcpmon');
define('LOGGED_IN_SALT',   '3tlwh5jspalqm3r76svpztcmfxsh0weqtolb6zwcjiyo50lblooehgwod8urhpxs');
define('NONCE_SALT',       'gwhvgs4mpnburaasv7taexnfauw00zkcwu72xrsgbestpuj7vonjl2wamqrwqxh4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpdm_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
