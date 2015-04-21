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
define('DB_NAME', 'raxtrax');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '}R_U1CpmJ)Ul=B}Q}Qlg>DD(_KEa:=atZ=-k+z]2G8^gnU4E>;E|soJ!w?phd+C?');
define('SECURE_AUTH_KEY',  'b9l8R8h]],nC.2`9{VXy|*zW96f-|yD%>~: PPv_7Hts_I@xs#z &Yr;QD wg5AO');
define('LOGGED_IN_KEY',    '=xu!FGzKr}i}8$Cq|K{ZBpV*lN<0ooh%zG{C`TK8/;IbJp@E~-FZE9An0@H.Hn(|');
define('NONCE_KEY',        '6~.>.r_h8f[h,]*{^f;m4wSnlo;v14-6>I]aClXo@U=ljaRW59.V`DOqY!q,#<Yn');
define('AUTH_SALT',        'V~ew)G[aDPomB0zoyAuaHiu;helN4dF/~7JvF?t7lX4}+gLU{:rmxNj1zhKO:X/!');
define('SECURE_AUTH_SALT', '+rgAe~e|_KY%,Hyg W;>v|7}F|,%CUiqwgdaQjU|Gr}<l8OzvOZBYbsxYUj`-^HY');
define('LOGGED_IN_SALT',   '|uZHCPkZ|Z?4tcnhoU^mlWK9$`LYUy#]XRKCO~2vJX~%];:_LDdu||$Zxa^%B+{F');
define('NONCE_SALT',       '(BWl^j>4r|Sd[:>rrW510Hx9?TH#u8^ndphuBU1`Lbjp^.X<+irJtLh]`B!bbbq&');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
