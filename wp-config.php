<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_HOST', 'codealley-home.cloudapp.net');

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
define('AUTH_KEY',         '4q0Zba=N~+Qz@uE!xNUHJ9v)4Wo-t(*_!CD!ZDhTDC|*&JYFS+]nX-4fl$?7> ?>');
define('SECURE_AUTH_KEY',  'y-_1j{ntb>H*>7$X-,5nHM&y:pEc`)xA]uf- amZ&~^/u>MCRr~M4@%;?l9neiG`');
define('LOGGED_IN_KEY',    't`Ofwex /}_v2q3;Uz*2(}h_YDUDkB041+mh%dCb_dD{52Edw|cjF%bvxOJ~Q>HC');
define('NONCE_KEY',        '3U$+gm^cti,M-j]gQmEy[vENuXv8-E  z,agT|+EUR^scX%:1E;sQLI,sKaweXMI');
define('AUTH_SALT',        'w7W[i}_8?uhC%VKH5?6)2iCC2l0(;,xO8O):F[es/ HBrXAc+a=1yc5HoEiTTPrF');
define('SECURE_AUTH_SALT', 'A3BqEU95[B*EcVk1._]u`<n|_c @N1k5hoA-+0#7B[-5sm8-gYc8^>EDs~,c+@|u');
define('LOGGED_IN_SALT',   '$=|DT2)!y)Ws`tmm):O>E%P!L@Etw.B)>,EIa@jR{+C-zT2y)}e34[OJ.-%l_u[@');
define('NONCE_SALT',       'HNDOA~`xRGV<83L R5)(BJj$~(Ya[J~zt#`4o&3<0i^OyMfe~`XU+Eo1p3|vS]zh');

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
