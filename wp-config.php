<?php
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
define('DB_NAME', 'sidetracked');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'f)}r1FZO$Z5gb|OpS)OF(<zzqX$JiqZ9fL^(lmpvD6:;q#R*1qSso:AO0/,I0X-:');
define('SECURE_AUTH_KEY',  '+D{0*C:~X/+Fx}0Nxg1$TlQKM],=jz|]6A<&P(~tA4j82i{fa[l}a>^+snUKf2wU');
define('LOGGED_IN_KEY',    'VhLi@Y0Pwe(luU L0flikn+:jDe~k`~z.yL^H|iHG<R4yp):CbmyS}EH@}3Ay0BE');
define('NONCE_KEY',        'A8gzP[34LZ!lN)>r-&%ls>*0X-!Vrf9b8?&A?wO-O)|o113{[xy+lF;EqYhIUYm~');
define('AUTH_SALT',        'AFEfW]aw4/0a>]SrfmrMlAFx|+,&kw++jRtS4CugXKdY|4u)P}1:s=}$A*S^kz-N');
define('SECURE_AUTH_SALT', '@h#T5m/{/fXV~zKTEEb;Yh69VhA$&+8b4knYpzgkwo6Z0V]:bwmF(dlTgIgT0}`f');
define('LOGGED_IN_SALT',   '&mr%AE-*-u&_47c|xH vk|#JN&+4?.VoU9s=_R8TK~uD&x5[GXf8>1bxc$0gFQds');
define('NONCE_SALT',       'H51|zV2@c#Ol?Hy.{e/=@O5}%7m4nU^$@R@L!22xvUttv%SSM,bz&(k{+HL~+J,Z');

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
?>