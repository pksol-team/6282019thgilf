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
define( 'DB_NAME', 'flight' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ewEa-5+g?.C^T+3|^8?{}-X--ltw%#ayaCl(@JYj*&D0V4[#*UEH<fhEAbj}?kH%' );
define( 'SECURE_AUTH_KEY',  'H;#bCry}!dVQ,rL{EmHbt-I[O72>PF]@4I:j4->yviZQev2>>38NBSpC]f*FqjMI' );
define( 'LOGGED_IN_KEY',    'Ge=J9W>YD01PW){$qQ:Hpz10l+LbbClsD_ml[2YQwMci`NuZ:BC5gz#hn9sVke/@' );
define( 'NONCE_KEY',        'lh9*LM: *4`kK5:v0uv-!D!>%F*`OEDi#a0++@|2;~2qlKoxQRs^LJZqWj`||{7O' );
define( 'AUTH_SALT',        '!MzoxHp4C*uzNUh`tnZ`o(WV|Sb++E.=^dLV)xc|;~]wKZpJ(d^r*7-I`#MsKN/4' );
define( 'SECURE_AUTH_SALT', 'Z3Z#xuqgP.UkVI@m%?*UZIa;fh(T5 R*9kEFhmgzvEPphEB8$*#dt%$TY<AG/1I(' );
define( 'LOGGED_IN_SALT',   'I+mT^axOQiJH-<;]NO9*poc()v).D,_TF}()98>~rm-qbpu.:0>&]$1n81lMS[IN' );
define( 'NONCE_SALT',       '~[85^Eb8rTwP`J+8&Pp-Dk4?M@=UzwcY(lTSXZ;|U0&?RcRo[&#IU0<|KSIwZM/z' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
