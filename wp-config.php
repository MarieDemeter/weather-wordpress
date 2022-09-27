<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'invite' );

/** Database password */
define( 'DB_PASSWORD', 'boolean' );

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
define( 'AUTH_KEY',         'm?dkkA}^Cw5 3]9sJCN4%O!-[bJ`$SeXBK#8sXMRT;Vja;KNaWI`X{-@t!r [u]A' );
define( 'SECURE_AUTH_KEY',  '{$AGL_S5{l)rGcaL@.4&[`3ZP*_)uG$+6rUIAdc_zdI6m-f)FjajU7g9Ptz4vD^9' );
define( 'LOGGED_IN_KEY',    '_Yvri1*P?#^otVwC]S5NBlPZ|>!W9;^:kcg;u>k>xMPqil**E-)LxBle3zSBCQ/U' );
define( 'NONCE_KEY',        'jDA0k_m2BUAi/ a8ogVa^uBv&|+c0775JzeFUTa{]`~4c201*hXxO[o8!| nf|@t' );
define( 'AUTH_SALT',        '9Sr*S+<v6sUgx_EbTe[Yh87)G(KZE2}r#917$4gf$SuMUX7#/#9Qy}:*S9A!E#wv' );
define( 'SECURE_AUTH_SALT', 'T$`@b$Z:{fS+e%^H!|2JjevQ)@nWm[nugdd&H~6`jn%<dePutCh3T9GY|bNlY![1' );
define( 'LOGGED_IN_SALT',   'JXI#WLG3(kfVn]9cW?B PtU}< VBta1nWC@(g.z*}6-{A}D6%:6!iHl J*c%+78h' );
define( 'NONCE_SALT',       'L(}jbjf?pd*ccR.Yp!}-op-pMxl[ghOLn%gxK6RZN7(X5&MTyO$pk }zScW8qwfR' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_0107';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
