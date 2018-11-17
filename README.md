# KMW Helpers and Functions

Helpers, functions, and shortcodes I typically use in my WordPress installations. 

## Included
* A bunch of WordPress tweaks bundled as a mu-plugin.
* JS tweaks I sometimes use on WordPress (and other stuff too): force-opening all external links in a new window, and a JS method of handling sticky header stuff.
* Sass/CSS, some of it for generic WordPress things (I always wind up needing this stuff) and some of it for stuff found in the mu-plugin
* FontAwesome

# Installation & Use

If you want to use this, you should download this and use it as a mu-plugin. It's not the kind of plugin that should require continuous updates, and these helpers and shortcodes are most useful if you modify them for your site. Additionally, some stuff *needs* to be changed.

* **Drop-In**: You can use it (almost) exactly as-is by copying the `dist` folder into your WordPress `wp-content/mu-plugins` folder.
* **Build**: If you want to use the Sass, Gulp, etc. stuff (probably best if you wanted to make greater modifications): `npm install` and then `gulp` or `gulp watch` to recompile the assets.
* **Documentation:** Read the docs by opening the `docs/index.html` file in your browser.

## :warning: Things You MUST Modify :warning:

These things are specific to your site. I cannot possibly guess your site's social media links, client phone numbers, etc. They're always different for me, too! So these are the items you **need** to modify before you use this plugin on your site:

* 404 & Error Text
* Social Media Icons Shortcode
* Google Maps Shortcode
* Phone Number Shortcode
* HTML Sitemap Shortcode

# Development
* Clone the whole repository into a WordPress installation.
* `gulp` to rebuild everything in `dist`. If you'll be using the Gulp task rather than taking the `dist` folder, edit in `src` -- don't make any edits in `dist`. `dist` is totally overwritten by the Gulp stuff (PHP and everything).
* Quality assurance and testing. There's a `qa` folder that runs automatically. It contains a template and page, they use all of the functions and shortcodes found within the plugin.
* Detailed documentation built with [phpDoc](https://www.phpdoc.org/) on Composer. You can also modify/rebuild the documentation if you really want. `phpdoc` should run everything correctly because there is a `phpdoc.xml` configuration file.