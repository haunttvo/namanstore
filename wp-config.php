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
define('DB_NAME', 'naman');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '@L$/Rhb<-M)V0 bE-ME&Vf)W|]>^T?FX;}R95FxoMR&]<-!0mVC!]_XwzX*sSk43');
define('SECURE_AUTH_KEY',  '(i{H/q-^m$KYLK$zr>G0B2(]|?lam[z1oY4]eWA3[@F5u-aPI(}qJ~CiId?JCWXl');
define('LOGGED_IN_KEY',    'giwsSw ^(X?D91hu8_ZSE$LtR H*:Y f6YU04ERw^L{9OBTWq>*Z(w/?ET#3ayqm');
define('NONCE_KEY',        'SB#}^Gwf&5q|E=> 9G3Y|?=$OoeoRK,|ccKPU;]SIA/9:-O$a6k= poF,i&.Xa<[');
define('AUTH_SALT',        '/PUY!|v%b>p+v.+%3T<e2WTs)6ix[/`|(5)7Rn2^`wFm)y%r`w@otO(H5:-+mbq1');
define('SECURE_AUTH_SALT', '.MEy&?=cuy1ml*LF0`_*3r{395^2O9B^z7wK7JI^@bNZW9QmuR.E=K&Fb<Dewwz=');
define('LOGGED_IN_SALT',   '8!T<F}L1+mMQZ6zb9`G:=O^G;|Fx.e-tucW<#lrC/EW%:.FUPmKiH9svSLa_l7[W');
define('NONCE_SALT',       '(0Pn)uP$Es8{|P_;OM},$}&!f(Z8pfh)Y?GuNQ5u}1/&RqeZ.zn4[ pFHgbn?81h');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
