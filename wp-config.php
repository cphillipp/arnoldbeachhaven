<?php
define('WP_MEMORY_LIMIT', '128M');
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'arnoldbeachhaven');

/** MySQL database username */
define('DB_USER', 'arnoldbeachhaven');

/** MySQL database password */
define('DB_PASSWORD', 'Beach36!');

/** MySQL hostname */
define('DB_HOST', 'arnoldbeachhaven.db.7452065.hostedresource.com');

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
define('AUTH_KEY',         'od~wS?#R9a9,Tk)Cq4=rjg(!q7C1;]00.D7F[9LF|5u`DQ[6LX(,qFq{`x0|V]>G');
define('SECURE_AUTH_KEY',  '$B|a@=#J2T<k1E^BU-_``h[A99+rR>]}NO>?Gp]VzFlc<ueEOOSY2_Ha$vcbMD=A');
define('LOGGED_IN_KEY',    'G1=9Od)4G7[k.Xg7(s>s79%v>rBpKWkCgkbeYR#|+eT`$dL9Vr-#:}j*xVo!Ah9-');
define('NONCE_KEY',        '&Zf%1Ays9pFWS]>sa=JJ1Pg_~LxzX]V5]r@lY%Lb!2+7%EmQ}7rZ-nCz]U{J|*kf');
define('AUTH_SALT',        'Vh{[.D)b|_#qX~aTs}-a`j<L%/pX}| c*RYE}`WE5`[NeiLF`wkI 6,=ZZ;S>,MS');
define('SECURE_AUTH_SALT', 'K2$?gDEFr*iaIy]Msm4-.hSRzfqT`ZB?nK<FNhN}?`Lm3W{8gERtmMR/?+U?t7jU');
define('LOGGED_IN_SALT',   '?Hg|rhb1zIG1D]lI1 %OH)?j6h5KPm#-1/>,:%ijnW:M8~k/+-0;:KYM`6;,Ey{#');
define('NONCE_SALT',       'V+{YAN_&Z+$J+nb#MZ2z<@[J!?n?a2566G#36ZC|`9VPH]y>&TL_<Mo/v<u.;=y!');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
