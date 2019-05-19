<?php
define('WP_CACHE', true);
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
define('DB_NAME', 'slowwine_sw');

/** MySQL database username */
define('DB_USER', 'slowwine_sw');

/** MySQL database password */
define('DB_PASSWORD', '9f1qUTeTXn2iSt9T56');

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
define('AUTH_KEY',         'WAT<{5B5>EJ{(|T2EfzM?49f+DQDdp[hDyz)RBS!L_EIf%=6$>5+Y%f5?xRw3BQv');
define('SECURE_AUTH_KEY',  '|-1slj>z|Ofc*ozR0GW5&-W+[tU!@bqRSq} ={kWR)BH m_fz|n;2K4RzZ*$fB<q');
define('LOGGED_IN_KEY',    'eB+D:7ir7:y24t.:39w0bD|#4b%lSWoi<`;np@|X98/nD-L008ag|{8spv_PE+0_');
define('NONCE_KEY',        'hI%h$NbZYaSy2)w(f;|)e^o1[Mb@x(3o%G_>YCC>FCHr}|1jix45jx ?ie}]|Q>B');
define('AUTH_SALT',        's&~[/7#=?/|]LoO`4R{2jw<BHpCj%f`+WP3/lp$x*AGw0oT*-!QcBZ&+_$Ho$9H:');
define('SECURE_AUTH_SALT', 'xMDQ0..z0e&_tfkO~YlOJzD|viB-/jD-]N)$|qbI%KE-#TB06g[Y!o+%~d(2&Y$v');
define('LOGGED_IN_SALT',   'sr-GeF6<Uq.7~0W#)5?Vtgu jvSWtoP7j1Hh{CxLQ[4k>?)Hs}*IPt@SIYs4Q@z}');
define('NONCE_SALT',       'w,tEe!~hMF^<f<Bti1`-s#5ZvDOejKp/4H}u$|^3*#9g+Gi06gK~e+3JT?m7^G4^');

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
