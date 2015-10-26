# KMW Helpers and Functions

Helpers, functions, and shortcodes I typically use in my WordPress installations. 

## Installation

You should download this and use it as a mu-plugin, and modify it to suit your needs. It's not the kind of plugin that should require continuous updates, and these helpers and shortcodes are most useful if you modify them for your site.

## Other Included
* 2 code (JS, CSS) files total
** JavaScript contains script that forces all external links to open in a new window.
** CSS contains Social Icons CSS, fancy buttons CSS, and click-to-call phone number CSS
* 4 font files total

## Table of Contents
Anything marked with * needs to be customized for your site.
	
### SECTION I: Helpers & Functions
Located in ```kmw-fs/helpers-functions.php```

* HF1. Truncate
* HF2. *404 & Error Text
* HF3. WP E-Mail Name
* HF4. Strip WP Script Versions
* HF5. Strip WP Version
* HF6. Boot Non-Admin from WP Admin (disabled by default)
* HF7. Google Analytics
* HF8. Post Revisions
* HF9. Dropdown Sorting
* HF10. Related Posts by Author

### SECTION II: Shortcodes
Located in ```kmw-fs/shortcodes.php```

* SC1. Logged In & Logged Out Content
* SC2. Fancy Buttons
* SC3. *Social Media Icons
* SC4. *Google Maps
* SC5. *Phone Number
* SC6. *HTML Sitemap
* SC7. Site Info
* SC8. Current Year

## Helpers and Functions
### HF1. Truncate
Shortens a longer text (for example: the excerpt, the content, a custom meta value) to a number of characters you specify.  The number is optional and defaults to 25, but you can change it to whatever you'd like. [More Information](http://stackoverflow.com/questions/9219795/truncating-text-in-php)

Use: ```<?php echo kmw__truncate($content, 175); ?>```

### HF2. 404 & Error Text
Useful error pages are great! I usually use this in the 404 template and sometimes the "none" template, depending on the site type. 

* Note: Pay attention to the URLs -- e.g., sitemap, contact. They might be different for you and I can't guess what your page names/permalinks are.

Use: ```<?php echo kmw_none_404_help_text(); ?>```

### HF3--HF6. Cleaner Functions
* **HF3, WordPress E-Mail Name**: Makes the WP e-mails (e.g., new user, lost PW, etc.) come from the site name instead of "WordPress." It uses ```get_bloginfo()``` to fetch the site name.
* **HF4, Strip WordPress Script/Style Versioning**: Removes WordPress script & style versions.
* **HF5, Strip WordPress Version**: Removes WordPress version from header.
* **HF6, Strip Admin Bar for Non-Admin** (Default: disabled, commented out): Removes the WP admin bar for everyone but administrator-level users. Useful for building a site with users who have no admin access.

### HF6. Boot Non-Admin from WP Admin
Redirects any URL with wp-admin for everyone but administrator-level users. Useful for building a site with users who should have no admin access.

* Note: Defaults to disabled. This **requires** a front-end login solution (e.g., Theme My Login). Otherwise you'll be locked out of your WordPress admin until you edit out the boot again. 
* Note: Edits for editor, contributor, author, and custom user roles. add: ! current_user_can( 'editor' ) and similar if you need Editors/Contributors/Authors to see WP Admin.

### HF7. Google Analytics
"Safer" than anything theme-based and even plugin-based. Because you're loading this file as a mu-plugin, it will *always* run even if you change the theme and even if you deactivate your other SEO plugins. Helps you avoid losing your precious GA data!

* Note: This requires you to get your tracking code from Google Analytics and insert it into the plugin.

### HF8. Post Revisions
They can really clog your database and get unruly rather quickly, so why not define it? Set to 10 revisions.

### HF9. Dropdown Sorting
Display a handy ul/li based drop-down menu that forwards the visitor to their selection. You can subtitute your custom taxonomy for 'category.'

Use: ```<?php echo kmw__sort_category_header('category'); ?>```

### HF10. Related Posts by Author
Simple list of related posts by author.

Use: ```<?php echo kmw__get_author_related(); ?>```

## Shortcodes
### SC1. Logged In & Logged Out Content
Something special you only want to show to logged out users? Or vice versa? 

Use: ```[logged_out]stuff only logged out users see[/logged_out]``` or ```[logged_in]stuff only logged in users see[/logged_in]```

* Note: This is only for small tidbits like a login form on the sidebar etc. There are much better ways to protect content with much more granular permissions than this offers, this is basically just for "calls to action" and other very simple stuff.

## SC2. Fancy Buttons
Buttons with a fancy title & subtitle. Use CSS to make the span smaller & block.

Use: ```[button link="#!" target="_self, _blank" subtitle=""]Primary[/button]```

* Note: Sample CSS included.

### SC3. Social Media Icons
Uses [Font Awesome](https://fortawesome.github.io/Font-Awesome/cheatsheet/).

Use: ```[kmw_social]```

* Note: Sample CSS for *all* FontAwesome included.
* Default social media networks: Twitter, Facebook, GitHub, Codepen, Instagram, Pinterest, Reddit, LinkedIn, SoundCloud, YouTube, Google+, RSS, E-Mail

### SC4. Google Maps
Useful so you don't have to change the Google map twenty times if the code changes, etc.. Height/width can accept pixel, percentage, or whatever else you'd like.

Use:```[kmw_googlemap height="" width=""]```

### SC5. Phone Number
Desktop or [click-to-call for mobile](http://katemwalsh.com/fixed-position-click-to-call-mobile-phone-number-code/). Again, useful so you don't have to change it twenty times if the phone number changes (which it can -- call forwarding/tracking services are a great reason to make use of this code).

Use: ```[kmw_get_phone mobile="true or false"]```

* Note: You should *only* include the mobile number *once*.

### SC6. HTML Sitemap
HTML sitemap pages are useful for human visitors. This is a two-part shortcode because I usually use two separate shortcodes, each in one column. It's also useful to sometimes display just the pages or just the categories (outside of widgets etc.).

```[kmw_categories]```  simply fetches a list of your blog categories. ```[kmw_pages]``` duplicates the primary menu since you might have "off-menu" pages you don't want to display. If you want a straight list of all pages regardless of the menu, you'll want [wp_list_pages()](http://codex.wordpress.org/Function_Reference/wp_list_pages).

Use: ```[kmw_categories]``` or ```[kmw_pages]```

* Note: you need to change the code to use the ID of your primary menu.

### SC7. Site Info
Uses ```get_bloginfo()``` to return data about the website. See [get_bloginfo() on the Codex](https://codex.wordpress.org/Function_Reference/get_bloginfo) for a full list of what can be returned with the key. Useful for placing the site's name in content. If your site rebrands later, you won't need to change the name in a million places *or* mess with MySQL replacements.

Use: ```[site_info key="name"]```

### SC8. Current Year
Just uses PHP to fetch the current year. Possibly useful for copyright notices, freshening content, etc.

Use: ```[kmw_year]```