<?php
	// Polygon values
	$weights = array();
	for ($i = 1; $i <= 20; $i++)
		$weights[$i] = $i . "px";

	$opacities = array();
	for ($i = 100; $i >= 0; $i-= 10)
		$opacities[$i] = $i . "%";
?>

<div id='mapp_e_infobox' class='mapp-e-infobox'>
	<div id='mapp_e_poi_fields'>
		<div>
			<input id='mapp_e_poi_title' type='text' />
			<input id='mapp_e_poi_iconid' type='hidden' />
			<img id='mapp_e_poi_icon' class='mapp-icon' src='<?php echo Mappress::$baseurl . '/images/cleardot.gif';?>' />
		</div>

		<div>
			<span id='mapp_e_poi_polyline_fields' style='display: none;'>
				<?php _e("Line: ", 'mappress'); ?>
				<input type='text' size='7' id='mapp_stroke_color' class='color'/>
				<?php echo Mappress_Settings::dropdown($weights, '', '', array('id' => 'mapp_stroke_weight', 'title' => __('Weight', 'mappress')) ); ?>
				<?php echo Mappress_Settings::dropdown($opacities, '', '', array('id' => 'mapp_stroke_opacity', 'title' => __('Opacity', 'mappress')) ); ?>
			</span>

			<span id='mapp_e_poi_polygon_fields' style='display: none;'>
				<?php _e("Fill: ", 'mappress'); ?>
				<input type='text' size='7' id='mapp_fill_color' />
				<?php echo Mappress_Settings::dropdown($opacities, '', '', array('id' => 'mapp_fill_opacity', 'title' => __('Opacity', 'mappress')) ); ?>
			</span>
		</div>

		<div id='mapp_e_poi_kml_fields' style='display: none'>
			<input id='mapp_e_poi_kml_url' type='text' readonly='readonly'/>
		</div>

		<div>
			<a id="mapp_e_visual"><?php _e('Visual', 'mappress'); ?></a> | <a id="mapp_e_html"><?php _e('HTML', 'mappress');?></a>
			<textarea id='mapp_e_poi_body' class='mapp-e-poi-body' rows='10'></textarea>
		</div>

		<div>
			<input id='mapp_e_save_poi' class='button-primary' type='button' value='<?php esc_attr_e('Save', 'mappress'); ?>' />
			<input id='mapp_e_cancel_poi' class='button' type='button' value='<?php esc_attr_e('Cancel', 'mappress'); ?>' />
		</div>
	</div>

	<div id='mapp_e_poi_icon_picker'></div>
</div>

<?php if (class_exists('Mappress_Pro')) : echo Mappress_Icons::get_icon_picker(); endif; ?>