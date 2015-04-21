<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'support');

/** MySQL database username */
define('DB_USER', 'inslab');

/** MySQL database password */
define('DB_PASSWORD', '1234');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'p1Ep!P]14w>yFp>C=|?.gz9SoQ<$~;%~ RNwz9<DB|yp .m<aRK}wQ.X!E_n@FQU');
define('SECURE_AUTH_KEY',  'r#<V+->iDiq25qY6*cV^ Mtt+49lvBAc|jR5;wz++-qSr:HT46G<v>$Wd;@y+(fn');
define('LOGGED_IN_KEY',    'Rl;~}-(B;>}SgrExl7bqQ/`b?ygSOU!i-+oO]]UP!D#=3n|!&`w);@l(~*Dd$-:&');
define('NONCE_KEY',        'bx@Bkn`597d:BBrZ|S{4BB/rn):8x63mgcN-6^J=ODBJ-U}:WaVKH#%bJ~P3d3&5');
define('AUTH_SALT',        '[_ CS#uAc3,mVR2i7ZT.1N|+)<CDzswYGe9^O&quF8;;ACU+Ant>O#}VR_SkS#{Y');
define('SECURE_AUTH_SALT', '$f;d*S(t@5([b<8~p{?9{;+LlY-3u._9}<N)-r,2GR`-4v(ny8=oh5xx*, v ]&N');
define('LOGGED_IN_SALT',   's.N94@g}x-[-mca-aTCXKd35U8wIa}> N#ru&ZP4%fO^q{:?@1ve5j;h~jGG #)/');
define('NONCE_SALT',       ':K7/+92(gY|Is]3,G3tJd_9MxPx_Sw*Y6EI7`ZZ<y-%_J&W?K8U-lXgj2e@mK|CE');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
