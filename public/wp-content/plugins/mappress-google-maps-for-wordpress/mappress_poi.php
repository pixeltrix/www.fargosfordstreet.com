<?php
class Mappress_Poi extends Mappress_Obj {
	var $address,
		$body = '',
		$correctedAddress,
		$iconid,
		$point = array('lat' => 0, 'lng' => 0),
		$poly,
		$kml,
		$title = '',
		$type,
		$viewport;              // array('sw' => array('lat' => 0, 'lng' => 0), 'ne' => array('lat' => 0, 'lng' => 0))

	// Not saved
	var $postid,
		$url;


	function __sleep() {
		return array('address', 'body', 'correctedAddress', 'iconid', 'point', 'poly', 'kml', 'title', 'type', 'viewport');
	}

	function __construct($atts = '') {
		parent::__construct($atts);
	}

	// Work-around for PHP issues with circular references (serialize, print_r, json_encode, etc.)
	function map($map = null) {
		static $_map;
		if ($map)
			$_map = $map;
		else
			return $_map;
	}

	/**
	* Geocode an address using http
	*
	* @param mixed $auto true = automatically update the poi, false = return raw geocoding results
	* @return true if auto=true and success | WP_Error on failure
	*/
	function geocode($auto=true) {
		if (!class_exists('Mappress_Pro'))
			return new WP_Error('geocode', 'MapPress Pro required for geocoding', 'mappress');

		// If point has a lat/lng then no geocoding
		if (!empty($this->point['lat']) && !empty($this->point['lng'])) {
			if ($this->address)
				$this->correctedAddress = $this->address;
			$this->viewport = null;
		} else {
			$location = Mappress::$geocoders->geocode($this->address);

			if (is_wp_error($location))
				return $location;

			$this->point = array('lat' => $location->lat, 'lng' => $location->lng);
			$this->correctedAddress = $location->corrected_address;
			$this->viewport = $location->viewport;
		}

		// Guess a default title / body - use address if available or lat, lng if not
		if (empty($this->title) && empty($this->body)) {
			if ($this->correctedAddress) {
				$parsed = Mappress::$geocoders->parse_address($this->correctedAddress);
				$this->title = $parsed[0];
				$this->body = (isset($parsed[1])) ? $parsed[1] : "";
			} else {
				$this->title = $this->point['lat'] . ',' . $this->point['lng'];
			}
		}
	}

	function set_html() {
		global $mappress, $post;

		if (class_exists('Mappress_Pro')) {
			$html = $mappress->get_template($this->map()->options->templatePoi, array('poi' => $this));
			$html = apply_filters('mappress_poi_html', $html, $this);
		} else {
			$html = "<div class='mapp-iw'>"
			. "<div class='mapp-title'>" . $this->title . "</div>"
			. "<div class='mapp-body'>" . $this->body . "</div>"
			. "<div class='mapp-links'>" . $this->get_links() . "</div>"
			. "</div>";
		}
		$this->html = $html;
	}

	function set_iconid() {
		$this->iconid = apply_filters('mappress_poi_iconid', $this->iconid, $this);
	}

	/**
	* Sets the poi title and url
	* - may replace title with post title (used in sorting)
	* - sets poi url if mashupClick=true,
	*
	*/
	function set_title() {
		$map = $this->map();

		$style = ($this->postid) ? $map->options->mashupTitle : 'poi';

		if ($style == 'post') {
			$post = get_post($this->postid);
			$this->title = $post->post_title;
		}
	}

	/**
	* Sets the poi body based on style settings; replaces original body
	*
	*/
	function set_body() {
		$map = $this->map();

		// If a filter exists, use it instead of this function
		if (has_filter('mappress_poi_body')) {
			$this->body = apply_filters('mappress_poi_body', $this->body, $this);
			return;
		}

		$style = ($this->postid) ? $map->options->mashupBody : 'poi';

		// Get the post excerpt
		if ($style == 'post')
			$this->body = $this->get_post_excerpt();

		if ($style == 'address')
			$this->body = $this->get_address();
	}

	/**
	* Get the poi title
	*
	*/
	function get_title() {
		return $this->title;
	}

	/**
	* Based on style settings, gets either the poi title or a link to the underlying post with poi title as text
	*
	*/
	function get_title_link() {
		$map = $this->map();
		$link = ($this->postid) ? $map->options->mashupLink : false;
		return ($link) ? "<a href='" . get_permalink($this->postid) . "'>$this->title</a>" : $this->title;
	}

	/**
	* Get the poi body
	*
	*/
	function get_body() {
		return $this->body;
	}

	/**
	* Get a post excerpt for a poi
	* Uses the WP get_the_excerpt(), which requires postdata to be set up.
	*
	* @param mixed $postid
	*/
	function get_post_excerpt() {
		global $post;

		$post = get_post($this->postid);
		if (empty($this->postid) || empty($post))
			return "";

		$old_post = ($post) ? clone($post) : null;
		setup_postdata($post);
		$html = get_the_excerpt();

		// wp_reset_postdata() may not work with other plugins so use the cloned copy instead
		if ($old_post) {
			$post = $old_post;
			setup_postdata($post);
		}

		return $html;
	}

	/**
	* Get the formatted address as HTML
	* A <br> tag is inserted between the first line and subsequent lines
	*
	*/
	function get_address() {
		$parsed = Mappress::$geocoders->parse_address($this->correctedAddress);
		if (!$parsed)
			return "";

		return isset($parsed[1]) ? $parsed[0] . "<br/>" . $parsed[1] : $parsed[0];
	}

	/**
	* Get links for poi in infowindow or poi list
	*
	* @param mixed $context - blank or 'poi' | 'poi_list'
	*/
	function get_links($context = '') {
		$map = $this->map();

		$links = apply_filters('mappress_poi_links', $map->options->poiLinks, $context, $this);

		$a = array();

		// Directions (not available for shapes, kml)
		if (empty($this->type)) {
			if (in_array('directions_to', $links) && $map->options->directions != 'none')
				$a[] = $this->get_directions_link(array('to' => $this, 'text' => __('Directions to', 'mappress')));
			if (in_array('directions_from', $links) && $map->options->directions != 'none')
				$a[] = $this->get_directions_link(array('from' => $this, 'to' => '', 'text' => __('Directions from', 'mappress')));
		}

		// Zoom isn't available in poi list by default
		if (in_array('zoom', $links) && $context != 'poi_list')
			$a[] = $this->get_zoom_link();

		if (empty($a))
			return "";

		$html = implode('&nbsp;&nbsp;', $a);
		return apply_filters('mappress_poi_links_html', $html, $context, $this);
	}

	function get_icon() {
		$map = $this->map();
		return Mappress_Icons::get_icon($this->iconid, $map->options->defaultIcon);
	}

	/**
	* Get a directions link
	*
	* @param bool $from - 'from' poi object or a string address
	* @param bool $to - 'to' poi object or a string address
	* @param mixed $text
	*/
	function get_directions_link($args = '') {
		$map = $this->map();

		extract(wp_parse_args($args, array(
			'from' => $map->options->from,
			'to' => $map->options->to,
			'focus' => true,
			'text' => __('Directions', 'mappress')
		)));

		// Convert objects to indexes, quote strings
		if (is_object($from)) {
			$i = array_search($from, $map->pois);
			$from = "{$map->name}.getPoi($i)";
		} else {
			$from = "\"$from\"";
		}

		if (is_object($to)) {
			$i = array_search($to, $map->pois);
			$to = "{$map->name}.getPoi($i)";
		} else {
			$to = "\"$to\"";
		}

		$link = "<a href='#' onclick = '{$map->name}.openDirections(%s, %s, $focus); return false;'>$text</a>";

		return sprintf($link, $from, $to);
	}

	/**
	* Get a link to open a poi and optionally zoom in on it
	*
	* $args:
	*   text - text to print for the link, default is poi title
	*   zoom - false (default) = no zoom | true = zoom in to viewport (ignored for lat/lng pois with no viewport) | number = set zoom (0-15)
	*
	* @param mixed $map - map on which the poi should be opened
	* @param mixed $args
	* @return mixed
	*/
	function get_open_link ($args = '') {
		$map = $this->map();
		extract(wp_parse_args($args, array(
			'title' => $this->get_title(),
			'zoom' => null
		)));

		$i = array_search($this, $map->pois);
		$zoom = Mappress::boolean_to_string($zoom);
		return "<a href='#' onclick='{$map->name}.getPoi($i).open($zoom); return false;' >$title</a>";
	}

	function get_zoom_link ($args = '') {
		$map = $this->map();
		extract(wp_parse_args($args, array(
			'text' => __('Zoom', 'mappress'),
		)));

		$i = array_search($this, $map->pois);
		$click = "{$map->name}.getPoi($i).zoomIn(); return false;";
		return "<a href='#' onclick='$click'>$text</a>";
	}

	/**
	* Get poi thumbnail
	*
	* @param mixed $map
	* @param mixed $args - arguments to pass to WP get_the_post_thumbnail() function
	*/
	function get_thumbnail( $args = '' ) {
		$map = $this->map();

		if (!$this->postid || !$map->options->thumbs)
			return '';

		if (isset($args['size']))
			$size = $args['size'];
		else
			$size = ($map->options->thumbSize) ? $map->options->thumbSize : array($map->options->thumbWidth, $map->options->thumbHeight);

		$html = get_the_post_thumbnail($this->postid, $size, $args);

		// If linking poi to underlying post, then link the featured image
		if ($map->options->mashupLink)
			$html = "<a href='" . get_permalink($this->postid) . "'>$html</a>";

		return $html;
	}
}
?>