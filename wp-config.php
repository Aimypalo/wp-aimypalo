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
define('DB_NAME', 'aimypalo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '2f>>.M~)HlZxmF}w^+UWH+15J2nb~X+reICw3OFQAmY _.>X$.Z`Uj~!|M5_HOJ`');
define('SECURE_AUTH_KEY',  ')cfq_s3{GLOl6niVMZr(fXvWHS_}#|Ke?T?MGfeKoCpyi-F-9<[8!dzG}jv;MvhZ');
define('LOGGED_IN_KEY',    'f(MWuq]XHL<+vJ:qy:-$GeaZX)J7ss$`X%Yx!LOF2eQP>Q)f!/K.0b(iP2|Ua}dM');
define('NONCE_KEY',        '7v[*eb<)Lo}B8QHfN`Y57GRz?G &=Q.Dp1gi!zl**O-$!5I)+pUc/CZSNZ*Axe+L');
define('AUTH_SALT',        '$zQxz?RnHrQ!_C>,Jpzd/xifbNGkFYp>|C)s}.Mb~S,?4>&<U3vVEI3/{P&-D2e2');
define('SECURE_AUTH_SALT', '.GrDMvw.QUUba>1YU4K]-RNJ^N89m+?y=~p5r%f[Z.l!OoiR&IjVc=]1ax?tHRqU');
define('LOGGED_IN_SALT',   '1apIofHWMTe_;)o@j~ycetw~@e~AQU()oTy9U)QH4NF[I`(6a%#>$|Zqfeo3jY])');
define('NONCE_SALT',       '5V46,9&{hc4iUGvF&Ro=$ Qg!kYO5)1|HJ .{Kv2BmvLG}gV,F+{;MjLI|D11F+I');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
