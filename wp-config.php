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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'admin_furiani4' );

/** MySQL database username */
define( 'DB_USER', 'admin_furiani4' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Braxton0314!' );

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
define( 'AUTH_KEY',         'gIP~TJ{lokQ4=a!(o[~5W,2TV>olA{NMFSlM#MTkBmd]ORUC(hnR:xfYftcRi*s{' );
define( 'SECURE_AUTH_KEY',  '0<4Y%dib=iq}80:Q$(tOF6Szz[,c7nX[@A*g7)J#ssw=_|G)WOt( -a9t@81|~,-' );
define( 'LOGGED_IN_KEY',    'V}{bS4Ms M FN*1:|h&w/c{>{)v7h0Hwmp`R4(3=cdx(`Hx^?cQ3kIwL[Ca-sWQ.' );
define( 'NONCE_KEY',        '%5%jJk$I:_=HfZi!3MTk,l0^#~3~% J/02zAxnjz^8e`n_Rl%YF-^7GWei=TDrY_' );
define( 'AUTH_SALT',        'q}Wy[& B)R;C7#+e{53P=&&n`^HrEIpgcOW*By-m[EnM20TyJ@q%a^^<Q][-@iS;' );
define( 'SECURE_AUTH_SALT', 'c(J%:iR-)-n_p<Q<s ?$aW;pHs>ju{LcTa[IgsT &!m5(1;cjDlBvWxcu/1W0=bV' );
define( 'LOGGED_IN_SALT',   '#E^KB8Xy$iAZD Elw.x0y$?/*%MX1ujiRLrflmhtWIpvYKQdx@Ug9|&%o)9(}BpF' );
define( 'NONCE_SALT',       '!G[8(#_e$?mklFzkau,f@dXa+y`F{e;2U8Lyzw#8y-]Gogb{2(Yp4z^]:&)zL~D:' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
