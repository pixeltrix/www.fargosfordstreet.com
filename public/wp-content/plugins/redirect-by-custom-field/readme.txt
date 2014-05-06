=== Redirect by Custom Field ===
Contributors: mitchoyoshitaka
Author: mitcho (Michael 芳貴 Erlewine)
Author URI: http://mitcho.com/code/
Donate link: http://tinyurl.com/donatetomitcho
Tags: redirect, alias, custom field, URL
Requires at least: 3.1
Tested up to: 3.8
Stable tag: 1.0

Changes the URLs pointing to pages and posts which have a "redirect" custom field, using that entry as the URL instead.

== Description ==

Sometimes you have a need for having links to external URLs show up interspersed among your own pages or posts. This plugin lets you easily create such "redirecting" posts or pages by simply setting a custom field.

**Usage**: Add the custom field with label "redirect" to any post or page. Enter the redirect target URL as the value of that custom field. Now all links on your site to that post or page will be replaced with that redirect URL! If you try to visit the permalink URL for that page, it will redirect the user to that redirect URL too.

This plugin actually also works fine to redirect a URL to another URL on the same site as well.

**Placeholders**: New in version 0.9: the strings `%home%` and `%site%` in URLs are replaced by the WordPress home URL and site URLs, respectively.

Development of this plugin was supported by the [Arts at MIT](http://arts.mit.edu/).

== Frequently Asked Questions ==

If your question isn't here, ask your own question at [the WordPress.org forums](http://wordpress.org/tags/redirect-by-custom-field?forum_id=10#postform). *Please do not email or tweet with questions.*

== Changelog ==

= 1.0 =
* Added new "hide redirects" filter in the list of posts/pages.

= 0.9 =
* New placeholder function:
	* `%home%` and `%site%` in URLs are replaced by the WordPress home URL and site URLs, respectively.
	* New filter `redirect_by_custom_field_placeholders` to add or modify placeholders.

= 0.8 =
* Removed inappropriate `esc_url` which was messing up some redirects.
* New user-definable constant `REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS`.

= 0.7 =
* Rewritten to use the `template_redirect` action instead, which catches some edge cases.

= 0.6 =
* WordPress's own permalinks in the WordPress admin now are actually displayed, together with the redirect URL.

= 0.5 =
* Fixed a potential PHP warning
* Fixed an error in the query filter

= 0.4 =
* Fixed redirect in some direct URL access cases
* Properly sanitizes redirect URLs

= 0.3 =
* First public release
