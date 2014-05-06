=== MapPress Easy Google Maps ===
Contributors: chrisvrichardson
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4339298
Tags: google maps,google,map,maps,easy,poi,mapping,mapper,gps,lat,lon,latitude,longitude,geocoder,geocoding,georss,geo rss,geo,v3,marker,mashup,mash,api,v3,buddypress,mashup,geo,wp-geo,geo mashup,simplemap,simple,wpml
Requires at least: 3.5
Tested up to: 3.9
Stable tag: 2.42.1

MapPress is the most popular and easiest way to create great-looking Google Maps and driving directions in your blog.

== Description ==
MapPress adds an interactive map to the wordpress editing screens.  When editing a post or page just enter any addresses you'd like to map.

The plugin will automatically insert a great-looking interactive map into your blog. Your readers can get directions right in your blog and you can even create custom HTML for the map markers (including pictures, links, etc.)!

For even more features, try the [MapPress Pro Version](http://wphostreviews.com/mappress)

= Key Features =
* MapPress is based on the latest Google maps API v3
* WordPress MultiSite compatible
* Custom post types are supported
* Easily create maps right in the standard post edit and page edit screens
* Add markers for any address, place or latitude/longitude location, or drag markers where you want them
* Create custom text and HTML for the markers, including photos, links, etc.
* Street view supported
* Readers can get driving, walking and bicycling directions right in your blog.  Directions can be dragged to change waypoints or route
* Multiple maps can be created in a single post or page
* Real-time traffic
* New shortcodes with many parameters: "mapid" (to specify which map to show), "width" "height", "zoom", etc.
* Programming API to develop your own mapping plugins

= Pro Version Features =
* Get the [MapPress Pro Version](http://wphostreviews.com/mappress) for additional functionality
* Use different marker icons in your maps - over 200 standard icons included
* Use your own custom icons in your maps or download thousands of icons from the web
* Shortcodes and template tags for "mashups": easily create a "mashup" showing all of your map locations on a single map
* Mashups can automatically link to your blog posts and pages and they can display posts by category, date, tags, etc.
* Map widget to show a map or a mashup
* Display a clickable list of mapped icons and locations under the map

[Home Page](http://www.wphostreviews.com/mappress) |
[Documentation](http://www.wphostreviews.com/mappress-documentation) |
[FAQ](http://www.wphostreviews.com/mappress-faq) |
[Support](http://www.wphostreviews.com/mappress-faq)

== Screenshots ==
1. Options screen
2. More options
3. Visual map editor in WordPress post editor
4. Mashup shortcode in a post
5. Mashup in your blog
6. Street view of mashup location

= Localization =
Please [Contact me](http://wphostreviews.com/chris-contact) if you'd like to provide a translation or an update.  Special thanks to all the folks who created and udpated these translations:

* Catalan
* Chinese / Taiwanese
* Croatian
* Dutch
* Finnish
* French
* German
* Hungarian
* Italian
* Russian
* Simplified Chinese
* Spanish
* Swedish

== Installation ==

See full [installation intructions and Documentation](http://www.wphostreviews.com/mappress-documentation)
1. Install and activate the plugin through the 'Plugins' menu in WordPress
1. You should now see a MapPress meta box in in the 'edit posts' screen

[Home Page](http://www.wphostreviews.com/mappress) |
[Documentation](http://www.wphostreviews.com/mappress-documentation) |
[FAQ](http://www.wphostreviews.com/mappress-faq) |
[Support](http://www.wphostreviews.com/forums)

== Upgrade ==

1. Deactivate your old MapPress version
1. Delete your old MapPress version (don't worry, the maps are saved in the database)
1. Follow the installation instructions to install the new version

== Screenshots ==

1. Options screen
2. Visual map editor in posts and pages
3. Edit map markers in the post editor
4. Get directions from any map marker

== Changelog ==

2.42.1
=
* Changed: wider editor infobox for Chrome and WP 3.9
* Fixed: removed warning about border style
* Fixed: removed !important modifier from mapp-iw styles for font weight

2.42
=
* Added: compatibiliy for TinyMCE 4.x in WordPress 3.9+
* Changed: geocoding calls from PHP now use http instead of https to prevent curl errors
* Changed: updated Spanish translation, thanks to Agustin
* Fixed: tinyMCE icons in WordPress 3.8+

2.41.1
=
* Added: polyline and polygon vertices can now be deleted by right-clicking
* Fixed: Mappress_Map::delete is now declared static to prevent warning messages

2.41
=
* Fixed: warning message in save_post action if WordPress is in debug mode and no post ID is provided

2.40.9
=
* Changed: infowindow scrollbar fix is updated and can now be turned off in settings
* Changed: removed $poi->get_post() method
* Changed: CSS for infowindow (.mapp-iw)
* Fixed: use default height for mashups with width but no height

2.40.8
=
* Added: workaround for Google infoWindow sizing bug
* Added: shortcode parameters 'from' and 'to' can be used to set a default for all directions.  Use a string or POI number, for example [mappress from="2"] or [mappress from="Mountain View, CA"]
* Fixed: layout style was incorrect if map layout had rounded corners; this also prevented show="hidden" from working.
* Fixed: filter 'mappress_poi_iconid' was being called as 'mapress_poi_iconid' (with one 'p' instead of two)
* Fixed: Google CSS made copyright appear vertical in IE in some themes
* Fixed: Google bug with sizing infoWindows
* Changed: updated Italian translation, thanks to Reberto
* Changed: when dragging a marker originally entered by address, it will keep the address for directions instead of showing the lat/lng coordinates.
* Changed: no check for an active post for the mashup shortcode, to allow mashups on search results pages
* Changed: directions now appear -above- the poi list in the standard template 'layout.php'
* Changed: if option mashupClick="post", the plugin redirects using 'siteurl/?p=1234' instead of the permalink (which speeds up queries)
* Changed: initialopendirections is now a boolean: set it to 'true' or 'false'.

2.40.7
=
* Fixed: workaround for new output buffering issue in latest NextGen 2.0.11

2.40.6
=
* Fixed: warning message on settings screen
* Changed: custom map sizes are now available in all versions of the plugin

2.40.5
=
* Fixed: directions not working after Nextgen workaround

2.40.4
=
* Added: the POI editor now includes the 'paste' tinyMCE plugin to allow pasting from Microsoft Word
* Changed: if you have set the option to link POIs to posts, featured images will also link to the underlying post
* Changed: map sizes (on the settings screen) can be set to % sizes as well as pixels.  NOTE: existing sizes are reset, so re-enter them on the 'settings' screen if needed.
* Changed: a default size can now be selected and maps without a specific size will default to that size
* Changed: 'language' setting is now set dynamically
* Changed: up to 6 address lines are now supported
* Fixed: workaround for NextGen plugin bug: reverses order of wp_enqueue_script / wp_print_footer scripts.
* Fixed: tabs activation using new jQuery version in WordPress 3.6
* Fixed: workaround for NextGen plugin bug: admin_enqueue_scripts called without a hook name
* Fixed: some mobile devices did not show the map 'close' buttons correctly (mobile browser could not render 'max-width: auto', 'max-width: 99999px' used instead)
* Fixed: shadows were not appearing for custom icons
* Fixed: added missing localization for 'loading' and 'directions from' message strings
* Fixed: notice message for a static function called non-statically
* Fixed: map are now generated from metadata only if the post type is enabled for maps on the settings screen
* Fixed: update of maps from queued metadata was not working when multiple posts were queued at once

2.40.3
=
* Fixed: widget CSS settings
* Fixed: added missing blue iim2 shadow icon

2.40.2
=
* Fixed: PHP notice in widget
* Fixed: added updated Hungarian translation (thanks to Zsolt A.)

2.40.1
=
* Fixed: % width and % height were not working in the editor since 2.40
* Fixed: PHP notice when upgrade available
* Fixed: removed internal errors from language files

2.40
=
* Added: an 'insert into post' link is now available in the map list as well as the map editor
* Changed: fields in the map editor have been rearranged for clarity
* Changed: the 'letter' icons have been removed from the icon picker.  If you need to continue using them, contact me for support.
* Fixed: the icon picker now loads much faster as a single image


2.39.9
=
* Fixed: POI function get_custom($field) was returning all fields, not just the field requested
* Fixed: tinyMCE editor was not saving after editing an existing POI

2.39.8
=
* Changed: MapPress now scans for custom field changes to generate automatic maps, for better compatibility with other plugins.
* Fixed: MapPress will now use .on or .live based on which jQuery is present (some blogs/themes/plugins do not load correct WP version 1.8.3)
* Fixed: if the tinyMCE editor is not available POI editing will revert to a plain textbox, for compatibility for plugins that replace tinyMCE
* Fixed: escaped translated text on buttons for directions, map editor and editor infobox forms

2.39.7
=
* Added: a new setting 'load maps last' can be used to load the maps after the window 'load' event
* Changed: the 'hideEmpty' parameter can now be used to hide any mashup that is empty (previously it only applied to mashups with query='current')
* Changed: the parameter 'tilt' for 45-degree imagery now defaults to 0 (off).  Set it to "45" in your shortcode if you need 45-degreee imagery.
* Changed: the MapPress RSS feed has been removed from the settings screen
* Fixed: the 'language' setting was not correctly setting the language for map controls such as map type and zoom
* Fixed: it is no longer possible to deselect ALL geocoders (the plugin will default to 'google' if nothing is selected)
* Fixed: settings javascript was loading on other pages
* Fixed: busy indicator showing indefinitely in Firefox for satellite maps (use the 'load maps last' setting to prevent this)
* Fixed: invalid map auto-centering for satellite mashups (45-degree imagery was distorting the viewport calculation)

2.39.6
=
* Fixed: featured images not displaying in mashups
* Fixed: array query arguments (such as post__in) not working correctly

2.39.5
=
* Fixed: wrong version number in plugin header (2.39.4 showed as 2.39.3)

2.39.4
=
* Fixed: tinyMCE displaying empty in 2.39.3

2.39.3
=
* Added: setting 'hideEmpty="true"' can be used to suppress a mashup of current posts if it is empty.  Setting is also available on map widget
* Changed: mashup shortcode is now suppressed in the admin screens when do_shortcode is called by indexing plugins
* Fixed: warning about file 'settings.js' on the settings screen
* Fixed: invalid tinyMCE language for non-english sites

2.39.2
=
* Changed: some blogs are loading outdated javascript versions, so changed use of javascript '.on' (deprecated in 1.7) to '.live'
