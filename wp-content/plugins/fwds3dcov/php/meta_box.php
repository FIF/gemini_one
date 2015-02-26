<style>
    div .fwd-meta-box { font-size: 10px !important; }
    table .fwd-meta-box { border-spacing:0 !important; }
    tr .fwd-meta-box { height:30px !important;}
    td .fwd-meta-box { padding:0 !important; width:100px !important; }
</style>

<script>
	var fwds3dcovPresetsObj = <?php echo json_encode($presetsNames); ?>;
	var fwds3dcovPlaylistsObj = <?php echo json_encode($playlistsNames); ?>;
</script>

<div class="fwd-meta-box ui-widget">
	<table>
    	<tr>
			<td>
				<label for="fwds3dcov_presets_list">Select preset:</label>
			</td>
			<td>
				<select id="fwds3dcov_presets_list" class="ui-widget ui-corner-all" style="max-width:160px;"></select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="fwds3dcov_playlists_list">Select playlist:</label>
			</td>
			<td>
				<select id="fwds3dcov_playlists_list" class="ui-widget ui-corner-all" style="max-width:160px;"></select>
			</td>
		</tr>
	</table>
	
	<p style="font-size:11px">Add the coverflow shortcode to the editor:</p>
	
	<button id="fwds3dcov_shortcode_btn" style="cursor:pointer">Add shortcode</button>
	
	<div id="fwds3dcov_div" class="fwd-updated" style="background-color:#F2F2F2;"><p id="fwds3dcov_msg" style="padding:8px;font-size:11px;"></p></div>
</div>
