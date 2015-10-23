=== Plugin Name ===
Contributors: elemind
Donate link: http://elemind.com
Tags: wpml,wp-rest-api,json-api,multilanguage
Requires at least: 4.3.0
Tested up to: 4.3.1
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to request a language with your WP-API and WPML site.

== Description ==

Plugin will allow you to fetch the WP REST API call with a "lang" variable.
It will retrieve the right content from WPML.

Tested with the latest version of:

* WPML 3.2.7
* WP REST API 2.0-beta4

== Installation ==

Install the plugin in your wp-content/plugins/ directory.
Then:

1. Activate the plugin through the 'Plugins' menu in WordPress
2. Make a call to "http://yoursite/wp-json/posts/?lang=it"

== Screenshots ==

1. No screenshots since this works in the background.

== Frequently Asked Questions ==

=  How I can fetch my custom post type in current language? =

Add 'suppress_filters' => false on get_posts/WP_Query call

get_posts([
    'post_type' => 'custom_post',
    'suppress_filters' => false
]);

== Changelog ==

= 0.1 =
* Initial release

== Upgrade Notice ==

No upgrades at the moment.
