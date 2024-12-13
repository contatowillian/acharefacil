<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_achar_facil' );

/** Database username */
define( 'DB_USER', 'shprime' );

/** Database password */
define( 'DB_PASSWORD', 'Mkt538065@' );

/** Database hostname */
define( 'DB_HOST', '35.247.215.49' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'j#7^mBh%PNLuIQ2=`/Is-at]xux=8K%M+b)Iy|@Glvl}+h2N.`rRSj/rkCx7i*df' );
define( 'SECURE_AUTH_KEY',  'Z^4auX04g~<3)5pKhAB@4zDgs*?t[3ELs7]Ra7B$gK`a}]@@CH(e7+2>64gjWBF0' );
define( 'LOGGED_IN_KEY',    '|CH7tG_}p!iPFNoveZKV#kM`nz7KpvuKgxK)]_(De6~B){!hKZrQgcrhaI:_gzm0' );
define( 'NONCE_KEY',        'WU?wtP~Lc<OQAjdg|8~eB4L* X@rExsB#U$FX<pCg5[XXbFIK/Dxyh}/TfK~WrEO' );
define( 'AUTH_SALT',        '^&k#ZI&fvH}%Gfp6is~)OKgP-`U%X!k1?2KTIM##VK8paznL$hYv}E{&N@7RTmz%' );
define( 'SECURE_AUTH_SALT', '!F~s]Sf@Uo0:N;^c,(qp92aF|&Q&YbL#H06V/[.h}IDA=$[ii+,7YY)v6LkY9FEJ' );
define( 'LOGGED_IN_SALT',   '=?Sk8}=2g3IU1o=j@f_ sb-_:Ka`Kb}1R6rTN7D/vlZIy{+E|t:eaFRmrU;PBy$v' );
define( 'NONCE_SALT',       ';3yFBI})|s{5l{FPxGX/8tc7B5 5MC:G#ppzUN!X@1S45/<&oVJ o%XJ-{uf,/12' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
