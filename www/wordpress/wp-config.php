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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define( 'AUTH_KEY',         '<y]iPO0jMFo,Pw~% wvnS<p|E*xw#R1PyXU9O!4*qQ|s)A%)Eh|+@]LZ(3r N[<k' );
define( 'SECURE_AUTH_KEY',  'qkcp3&+*aDUZeL.lRiH`<,O^1D,e%+$:yOHL[Pm7G2df@sdqKTPvH0}ZumgmT,:<' );
define( 'LOGGED_IN_KEY',    '*BXZ[;:v3)5&fpb@PuQ;)B%)4fY-#)w&%ZCtCFV(*n1!.Ei!u1$HH@ECW[P{vC^d' );
define( 'NONCE_KEY',        'eE?eG) Ic#P_kgl(R_v4ETvHCrE9-BI$UoY5p!fsc(h92URWCoXj+7Zdau#F(WeS' );
define( 'AUTH_SALT',        'Z*A,iX:_]!9;pto`4~8E#jWo4VYP7_<DO[vPM2C9kk&92}1~mVnL1<l1DR2,@E|5' );
define( 'SECURE_AUTH_SALT', '/B3EUE2z_ixud5[F,Nw@Mtt^{.Xpp?p*2rA!S|*<V>yw8TN},yl895AT./W}Gdo3' );
define( 'LOGGED_IN_SALT',   'C7)vj$YD_!],jVoy Yol9/6^=hUnE/+f+Mr<hJpq|iqmQ78xk$/84^@8u#c)SR[$' );
define( 'NONCE_SALT',       '8o]-5%Fk2w;%QNr=_Cjj>U:h -x_aC-J!~v0]QE<g7Mhl3O{N^nQAG}Y<qhoY~aP' );

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
