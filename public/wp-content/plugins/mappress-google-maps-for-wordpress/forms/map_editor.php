<div>
	<?php _e('Add POI', 'mappress'); ?>:
	<input size='60' type='text' id='mapp_e_saddr' />
	<button id='mapp_e_search' class='button-primary'><span class='mapp-search-button'></span></button>
	<a href='#' id='mapp_e_myloc'><?php _e('My location', 'mappress'); ?></a>
	<div id='mapp_e_saddr_err' style='display:none'></div>
</div>
							  
<div class='mapp-e-edit-panel'>
	<table class='mapp-e-editor'>
		<tr>
			<td style='width: 25%'>
				<div id='mapp_e_poi_list' class='mapp-e-poi-list'></div>
			</td>
			<td style='width: 75%'>
				<div id='mapp_e_top_toolbar' class='mapp-e-top-toolbar'>
					<a href='#' id='mapp_e_recenter'><?php _e('Center map', 'mappress'); ?></a> |
					<?php _e('Click map for lat/lng: ', 'mappress'); ?><span id='mapp_e_latlng'>0,0</span>
				</div>
				<div id='mapp_edit' class='mapp-e-canvas'></div>
			</td>
		</tr>
	</table>
</div>        
							  
<?php require Mappress::$basedir . "/forms/map_editor_infobox.php"; ?>