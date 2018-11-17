<?php

/**
 * Plugin Name: DEVELOPER MODE: KMW Functions & Shortcodes
 * Plugin URI: http://katemwalsh.com
 * Description: Please note, if you are seeing this "developer mode" warning in your WP admin panel, you have installed too much stuff. Use only what is in the <b>DIST</b> folder in your WordPress admin.
 * Author: KMW
 * Author URI: http://katemwalsh.com
 * Version: 0.1.0
 * 
 * @package KMW-FS
 */


/**
 * This is basically a loader file for me when I work on developing the plugin. Because there is no WP-friendly plugin loader file in the index and everything is in the dist/ folder, this is easier for me when I clone the repo to work on changes. You don't need this file to run the plugin in production environments.
 */
include('dist/kmw-functions-shortcodes.php');