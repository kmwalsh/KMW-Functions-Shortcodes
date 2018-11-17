<?php

/**
 * Content formatting filters such as trademark and registration mark.
 * 
 * @package KMW-FS\Content Formatting
 */

if ( ! function_exists( 'kmw_format_the_content' ) ) {

    // WORDPRESS CORE
    add_filter('the_content', 'kmw_format_the_content');
    add_filter('the_title', 'kmw_format_the_content');
    add_filter('the_excerpt', 'kmw_format_the_content');

    // PLUGINS
    // advanced custom fields
    add_filter('acf/format_value', 'kmw_format_the_content', 10, 3);

	/**
	 * Standardize trademark and registration marks.
	 * Please remember that people are generally very varied. There will be a myriad different way people can enter different content different ways on a site. These were useful in one specific instance for me, but maybe your client decided to wrap every registration mark with a span and custom inline styling (sorry for ya). These content formatting filters can (and *should*) only go so far. If you wind up with many dozens of lines in this file, something is going wrong in the content pipeline, and you may want to attempt to address that through your organization, client, whoever you're working for. 
	 * 
	 */ 
    function kmw_format_the_content($content)
    {

        // (some) possible variations of the registration mark
        $content = str_replace("&reg;", "<sup>&reg;</sup>", $content);
        $content = str_replace("®", "<sup>&reg;</sup>", $content);
        $content = str_replace("\u00AE", "<sup>&reg;</sup>", $content);

        // (some) possible variations of trade mark
        $content = str_replace("&trade;", "<sup>&trade;</sup>", $content);
        $content = str_replace("™", "<sup>&trade;</sup>", $content);
        $content = str_replace("\u2122", "<sup>&trade;</sup>", $content);

        return $content;
    }
    
}