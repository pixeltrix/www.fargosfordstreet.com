<div>
	<a target='_blank' style='vertical-align: middle;text-decoration:none'  href='http://wphostreviews.com/mappress'>
		<img alt='MapPress' title='MapPress' src='<?php echo Mappress::$baseurl . '/images/mappress_logo_small.png'; ?>' />
	</a>
	<?php echo Mappress::get_support_links(); ?>
</div>

<div id='mapp_m_list_panel' class='mapp-panel' style='display:none'>
	<b><?php _e('Maps for This Post', 'mappress')?></b>
	<input class='button' type='button' id='mapp_m_add_map' value='<?php _e('New Map', 'mappress')?>' />
	<div id='mapp_m_maplist'>
		<?php echo Mappress_Map::get_map_list(); ?>
	</div>
</div>

<div id='mapp_m_edit_panel' style='display:none'>
	<div>
		<?php _e('Map ID', 'mappress');?>: 
		<span id='mapp_m_mapid'></span>
	</div>

	<div class='mapp-panel'>
		<?php
			echo __('Size', 'mappress') . ': ';
			$sizes = array();
			foreach(Mappress::$options->mapSizes as $i => $size) 
				$sizes[] = "<a href='#' class='mapp-m-size' data-width='{$size['width']}' data-height='{$size['height']}'>" . $size['width'] . 'x' . $size['height'] . "</a>";
			echo implode(' | ', $sizes);
		?>
		<input type='text' id='mapp_m_width' size='2' value='' /> x <input type='text' id='mapp_m_height' size='2' value='' />
		<input class='button' type='button' id='mapp_m_insert' value='<?php _e('Insert into post', 'mappress'); ?>' />
	</div>

	<div class='mapp-panel'>
		<?php _e('Map Title');?>:
		<input id='mapp_m_title' type='text' size='40' />
		<input class='button-primary' type='button' id='mapp_m_save' value='<?php _e('Save', 'mappress'); ?>' />
		<input class='button' type='button' id='mapp_m_cancel' value='<?php _e('Cancel', 'mappress'); ?>' />	
		<div id='mapp_m_editor'>
			<?php require Mappress::$basedir . "/forms/map_editor.php"; ?>
		</div>
	</div>
</div>