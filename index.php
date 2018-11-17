<?php

/**
 * Plugin Name: DEVELOPER MODE: KMW Functions & Shortcodes
 * Plugin URI: https://github.com/kmwalsh/KMW-Functions-Shortcodes
 * Description: <b style="red">WARNING, this plugin is in developer mode.</b> <br/><br/> If you are seeing this "developer mode" warning in your WP admin panel, you have installed too much stuff. The <b>DIST</b> folder should be the only thing copied into your WordPress admin. It won't kill you to use the plugin this way or anything, but you're adding a lot of extra "gunk" into your WordPress admin.
 * Author: KMW
 * Author URI: http://katemwalsh.com
 * Version: 0.0.1
 * 
 * @package KMW-FS
 */


/**
 * This is a loader file for me when I work on developing the plugin. Because there is no WP-friendly plugin loader file in the index and everything is in the dist/ folder, this is easier for me when I clone the repo to work on changes. You don't need this file to run the plugin in production environments.
 */
include('dist/kmw-functions-shortcodes.php');
include('qa/create-page.php');
include('qa/create-template.php');