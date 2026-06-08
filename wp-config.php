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
define( 'DB_NAME', 'listeners_blog' );

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
define( 'AUTH_KEY',         '(pqdHtO>}cE)~}F]eukvQ<rl:-~AjMs{HGasPb:p3Mx4)qb)5EXjog>5(En;K>#^' );
define( 'SECURE_AUTH_KEY',  '=pO>I;B?6{Ol##KK-_D7w_;=[WgPhNCO:l5`EX}BiR,t)b`Q:uA&;zFdd(X{=@wP' );
define( 'LOGGED_IN_KEY',    'htxLuT NN//;=p|L;FQns7S=-:Y)O#lN63:iCT}Vmd;o/1X1`&GzE@nzU`U,`s E' );
define( 'NONCE_KEY',        '8Qx<6KSm)kwYUuU3]ybD|ZV1%)d_,6`x|Hy3ToCt!2g| /[fD[RyIIh3mOp2 `Nc' );
define( 'AUTH_SALT',        '6Ev,KrO2TAJfxXW((gp*$5`>(y!r=t=1p~49y[2SfZmC@(5YeqTTpzTplv.&/4,M' );
define( 'SECURE_AUTH_SALT', '9]iV@k1Q_9lWn6Z[:&:dfev;i$?N5jxC&EInc0A.X?``((Qu=O=fmd~58yl-3/Vn' );
define( 'LOGGED_IN_SALT',   '-*Sr5 pj]-WKq|vH6RJ:J]5+o]:T2f6BIx;=JC5{G96d+]EC!!@x)rDrsg$[:53j' );
define( 'NONCE_SALT',       '*>$8o4=jhL~2ja&SCNld=b.~EXj95{j%(lwpMH%61yJ3P;YScLl=x!E/H.j}|7v}' );

define('WP_HOME','http://192.168.1.54/listeners-blog/');
define('WP_SITEURL','http://192.168.1.54/listeners-blog/');

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
// 