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
define( 'DB_NAME', 'staff_list' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

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
define( 'AUTH_KEY',         'Ro0?%YEwHNl|(zL]6>7Gj/~k;H6e|KLr$n#p@^]th{}nwrdtOv).ZR[z5?lMI<Ws' );
define( 'SECURE_AUTH_KEY',  'Kryo~wJ;W` y#J8X>ySZFZ;ygbw@T=E5_V>>`nrPWRP<[O~-5^}xt?Sdw1Q,[{hY' );
define( 'LOGGED_IN_KEY',    ':#S=[TYyDD:@<QAc4oEWQbIV8lBf}7-:asM75qtWAg@9F[Td3/<_3Wk?{%KcQw@0' );
define( 'NONCE_KEY',        's17>9$g|<CpUW,$IF@z?7_Zp!USS$$o5|{).2]E-KMFemBF8k?K1l6/ciE-vEK[d' );
define( 'AUTH_SALT',        '[y-3K0mog.n0y2a8j)Ue:7l%X:G&!)(Ky2[L?|ILdakJwyp4:<?M,(xSCd&qEbk|' );
define( 'SECURE_AUTH_SALT', 'k.5An`AvEMt=/r),/]`e/a*UE!7}/MDsAgUI{5={1C8^H.[g/Q%)n&,d`OsGcRl_' );
define( 'LOGGED_IN_SALT',   'Z**2yrcp7ZU]8=O3]Krc>4wUIzBnvfzx4vI:w3oHkVPg5)*7oDQ6GYywCMmu6?o&' );
define( 'NONCE_SALT',       '4)OMmIKEA*sI<2u<}Uk:`xA#6kiN1SIc3IppU-^]9Hbx_MKNM#bO}s`!a3icKC#:' );

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
