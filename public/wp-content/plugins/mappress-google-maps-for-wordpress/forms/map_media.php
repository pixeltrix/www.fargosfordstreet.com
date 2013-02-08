<div class='mapp-m-panel'>
	<div>
		<a target='_blank' style='vertical-align: middle;text-decoration:none'  href='http://wphostreviews.com/mappress'>
			<img alt='MapPress' title='MapPress' src='<?php echo Mappress::$baseurl . '/images/mappress_logo_small.png'; ?>' />
		</a>
		<?php echo Mappress::get_support_links(); ?>
	</div>
	<hr/>

	<div id='mapp_m_list_panel' style='display:none'>
		<b><?php _e('Maps for This Post', 'mappress')?></b>
		<input class='button' type='button' id='mapp_m_add_map' value='<?php esc_attr_e('New Map', 'mappress')?>' />
		<div id='mapp_m_maplist'>
			<?php echo Mappress_Map::get_map_list(); ?>
		</div>
	</div>

	<div id='mapp_m_edit_panel' style='display:none'>
		<div class='mapp-panel'>
			<table>
				<tr>
					<td><?php _e('Map ID', 'mappress');?>:</td>
					<td><span id='mapp_m_mapid'></span></td>
				</tr>
				
				<tr>
					<td><?php _e('Map Title');?>:</td>
					<td><input id='mapp_m_title' type='text' size='40' /></td>
				</tr>
				
				<tr>
					<td><?php _e('Size', 'mappress');?>:</td>
					<td>
						<?php
							$sizes = array();
							foreach(Mappress::$options->mapSizes as $i => $size) 
								$sizes[] = "<a href='#' class='mapp-m-size' data-width='{$size['width']}' data-height='{$size['height']}'>" . $size['width'] . 'x' . $size['height'] . "</a>";
							echo implode(' | ', $sizes);
						?>
						<input type='text' id='mapp_m_width' size='2' value='' /> x <input type='text' id='mapp_m_height' size='2' value='' />
					</td>
				</tr>
			</table>
		</div>
		<div>
			<input class='button-primary' type='button' id='mapp_m_save' value='<?php esc_attr_e('Save', 'mappress'); ?>' />
			<input class='button' type='button' id='mapp_m_cancel' value='<?php esc_attr_e('Cancel', 'mappress'); ?>' />	
			<input class='button' type='button' id='mapp_m_insert' value='<?php esc_attr_e('Insert into post', 'mappress'); ?>' />
		</div>
		<hr/>
		<div id='mapp_m_editor'>
			<?php require Mappress::$basedir . "/forms/map_editor.php"; ?>
		</div>
	</div>
</div>