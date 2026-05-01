<?php
/* This is a sample config file.
 * Edit this file with your own settings and save it as "config.php"
 *
 * IMPORTANT: edit and save this file as plain ASCII text, using a text editor, for instance TextEdit on Mac OS or
 * Notepad on Windows. Make sure there is no character before the opening <?php at the beginning of this file.
 */

/*
 ** MySQL settings - You can get this info from your web host
 */

/** MySQL database username */

define('YOURLS_DB_USER', 'u566466219_yurls');
define('YOURLS_DB_PASS', 'q7M!4vN2#tL8pR6x');
define('YOURLS_DB_HOST', 'localhost');
define('YOURLS_DB_NAME', 'u566466219_yurls');

/** MySQL tables prefix
 ** YOURLS will create tables using this prefix (eg `yourls_url`, `yourls_options`, ...)
 ** Use lower case letters [a-z], digits [0-9] and underscores [_] only */
define( 'YOURLS_DB_PREFIX', 'yourls_' );

/*
 ** Site options
 */

/** YOURLS installation URL
 ** All lowercase, no trailing slash at the end.
 ** If you define it to "https://sho.rt", don't use "https://www.sho.rt" in your browser (and vice-versa)
 ** To use an IDN domain (eg https://héhé.com), write its ascii form here (eg https://xn--hh-bjab.com) */
define( 'YOURLS_SITE', 'https://ozol.au' );

/** YOURLS language
 ** Change this setting to use a translation file for your language, instead of the default English.
 ** That translation file (a .mo file) must be installed in the user/language directory.
 ** See https://yourls.org/translations for more information */
define( 'YOURLS_LANG', '' );

/** Allow multiple short URLs for a same long URL
 ** Set to true to have only one pair of shortURL/longURL (default YOURLS behavior)
 ** Set to false to allow multiple short URLs pointing to the same long URL (bit.ly behavior) */
define( 'YOURLS_UNIQUE_URLS', true );

/** Private means the Admin area will be protected with login/pass as defined below.
 ** Set to false for public usage (eg on a restricted intranet or for test setups)
 ** Read https://yourls.org/privatepublic for more details if you're unsure */
define( 'YOURLS_PRIVATE', true );

/** A random secret hash used to encrypt cookies. You don't have to remember it, make it long and complicated
 ** Hint: copy from https://yourls.org/cookie */
define( 'YOURLS_COOKIEKEY', 'ozol_random_cookie_hash_8f9g2a1c0b3d4e5f6g7h8i9j0' );

/** Username(s) and password(s) allowed to access the site. Passwords either in plain text or as encrypted hashes
 ** YOURLS will auto encrypt plain text passwords in this file
 ** Read https://yourls.org/userpassword for more information */
$yourls_user_passwords = [
    'username' => 'phpass:!2y!10!1OGvnD6MD4o7QDPATmyd6.G0ONlnLi9a8igfgZQrjuwOxS4cJYPwu' /* Password encrypted by YOURLS */ ,
    'colin' => 'Coota#$9026',
    // 'username2' => 'password2',
    // You can have one or more 'login'=>'password' lines
];

/** URL shortening method: either 36 or 62
 ** 36: generates all lowercase keywords (ie: 13jkm)
 ** 62: generates mixed case keywords (ie: 13jKm or 13JKm) 
 ** For more information, see https://yourls.org/urlconvert */
define( 'YOURLS_URL_CONVERT', 36 );

/** Debug mode to output some internal information
 ** Default is false for live site. Enable when coding or before submitting a new issue */
define( 'YOURLS_DEBUG', false );

/**
* Reserved keywords (so that generated URLs won't match them)
* Define here negative, unwanted or potentially misleading keywords.
*/
$yourls_reserved_URL = [
    'porn',
    'faggot',
    'sex',
    'nigger',
    'fuck',
    'cunt',
    'dick',
];

/*
 ** Personal settings would go after here.
 */
