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
define( 'DB_NAME', 'myportfolio_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'i^HIQpD2<QIy_Y<Iuav,?vDQJ-R$=qUv+q6SKyv+&dQ*Yj0es!LZ`i!PRkZ~(p2<' );
define( 'SECURE_AUTH_KEY',  ',Mb 7|{cp3]4#g!|l~0wpm~) jva]X0o%bm*Z,nIr,zwsc3C)e?6fh~e4%)k-_7M' );
define( 'LOGGED_IN_KEY',    'S=6m-HWdhPy-Wr.{4mr[6iie48`&%{IH(diyM4,;u=/% z=D0GH~|Cgv7^x*1q|G' );
define( 'NONCE_KEY',        'LnY$}@dW?TXoxdOwGs7-Z&ag-HhlWO46`Ed-ML-Ur%h:>._>jC9g7Wf~~Czvt#]H' );
define( 'AUTH_SALT',        '46eIF{Cap>)T/kk@LPb;X#L9yuWy(T+W=h7WNkHO7(BxqiT)b2L,S#1k,V5;x+UQ' );
define( 'SECURE_AUTH_SALT', 'Si!M-Yba0<VH*+Z3*8pIR_t G7{SABn$b #HOb7y@QJ>!^ M?r#FW^Xn HV2@sAZ' );
define( 'LOGGED_IN_SALT',   '1 *o([^,FbQNf?dD$:8i@3B~.%zU.=bilqct<Erw2*6->-Pm9}N1RWq9HKqBY+qu' );
define( 'NONCE_SALT',       'fZiQ#bfO{zb.H,Et&20ge}%N#OX$hG|t=.uV8]E;h1ke$8`yajU4u`p=`iU3Kq<(' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
