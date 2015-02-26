<style>
   	body { font-size: 10px; }
    p { font-size: 12px; }
    input.text { width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    table { border-spacing:0;float:left;margin-right:40px; }
    tr { height:50px;}
    td { padding:0; width:230px;}
    .fwd-error { color:#FF0000; }
</style>

<script>
	var settingsAr = <?php echo json_encode($this->_data->settings_ar); ?>;
	
	var sid = <?php echo $set_id; ?>;
	var cur_order_id = <?php echo $set_order_id; ?>;
	var tab_init_id = <?php echo $tab_init_id; ?>;
</script>

<fieldset class="ui-widget">
	<label for="skins">Select your preset:</label>
	
    <select id="skins" class="ui-widget ui-corner-all" style="max-width:200px;"></select>
    <label id="preset_id" for="skins"></label>
    
    <p id="tips" style="width:600px;">All form fields are required.</p>
</fieldset>

<form action="" method="post" style="margin-top:20px;margin-right:20px;">
	<div id="tabs" style="height:600px;overflow:auto;">
	  	<ul>
			<?php $iconsPath = plugin_dir_url(dirname(__FILE__)) . "load/icons/" ?>
		    <li><a href="#tab1"><img src=<?php echo $iconsPath . "tab1-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Main settings</span></a></li>
		    <li><a href="#tab2"><img src=<?php echo $iconsPath . "tab2-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Thumbnails settings</span></a></li>
		    <li><a href="#tab3"><img src=<?php echo $iconsPath . "tab3-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Controls settings</span></a></li>
		    <li><a href="#tab4"><img src=<?php echo $iconsPath . "tab4-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Categories menu settings</span></a></li>
		    <li><a href="#tab5"><img src=<?php echo $iconsPath . "tab5-icon.png" ?> style="vertical-align:middle;"><span style="vertical-align:middle;margin-left:4px;">Lightbox settings</span></a></li>
	  	</ul>
	 
	  	<div id="tab1">
			<table>
    			<tr>
		    		<td>
		    			<label for="name">Preset name:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="name" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="display_type">Display type:</label>
		    		</td>
		    		<td>
		    			<select id="display_type" class="ui-corner-all">
							<option value="fluidwidth">fluid-width</option>
							<option value="responsive">responsive</option>
							<option value="fixed">fixed</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
						title="If 'fluid-width' the coverflow will always fill the browser width and its height will be the below value.
							If 'responsive' the coverflow will fill its container width and its height will be the below value.
							If 'fixed' the coverflow width and height will be the below values.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="autoscale">Autoscale:</label>
		    		</td>
		    		<td>
		    			<select id="autoscale" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="If 'yes' and the layout width is less than the specified coverflow width, then it will keep a correct scale ratio.
								If 'no' the coverflow size and scale ratio will not be modified.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_width">Coverflow width:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="cov_width" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_height">Coverflow height:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="cov_height" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="skin_path">Skin path:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="skin_path" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_bg_color">Background color:</label>
		    		</td>
		    		<td>
		    			<input id="cov_bg_color" />
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_bg_image_url">Background image path:</label>
		    		</td>
		    		<td>
		    			<div id="cov_bg_image_div">
				    		<table>
				    			<tr>
						    		<td>
						    			<input id="cov_bg_image_url" type="text" style="width:200px;" class="text ui-widget-content ui-corner-all">
						    		 	<button id="cov_bg_image_btn" style="cursor:pointer;">Add Image</button>
						    		</td>
						    		<td>
						    			<img src="" id="cov_bg_upload_img" style="width:50px;height:50px;margin-left:20px;">
						    		</td>
						    	</tr>
						    </table>
						</div>
		    		</td>
		    	</tr>
    			<tr>
		    		<td>
		    			<label for="bg_repeat">Background repeat:</label>
		    		</td>
		    		<td>
		    			<select id="bg_repeat" class="ui-corner-all">
							<option value="repeat">repeat</option>
							<option value="repeat-x">repeat-x</option>
							<option value="repeat-y">repeat-y</option>
							<option value="no-repeat">no-repeat</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the CSS background-repeat property for all the 3 background images. It has the standard CSS values.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_2d_display">Always show 2D display:</label>
		    		</td>
		    		<td>
		    			<select id="show_2d_display" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This sets the coverflow to be always displayed in the 2D layout even on browsers that support 3D, not just for fallback.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_start_pos">Coverflow start position:</label>
		    		</td>
		    		<td>
		    			<select id="cov_start_pos" class="ui-corner-all">
		    				<option value="left">left</option>
							<option value="center">center</option>
							<option value="right">right</option>
							<option value="random">random</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the start position of the thumbnails of the coverflow, the one that will be selected in front.">
		    		</td>
		    	</tr>
		    </table>
		    
		    <table>
		    	<tr>
		    		<td>
		    			<label for="cov_topology">Coverflow topology:</label>
		    		</td>
		    		<td>
		    			<select id="cov_topology" class="ui-corner-all">
							<option value="dualsided">dual-sided</option>
							<option value="onesided">one-sided</option>
							<option value="crosssided">cross-sided</option>
							<option value="frontonesided">front-one-sided</option>
							<option value="accordion">accordion</option>
							<option value="flipping">flipping</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the geometry topology of the coverflow. It has 6 options and it changes how the side thumbnails appear relative to the center one.
								Each topology can be most easily understood by looking at the presets configurations.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_x_rot">Coverflow X rotation:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="cov_x_rot" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the value of the rotation of the whole coverflow on the X axis.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_y_rot">Coverflow Y rotation:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="cov_y_rot" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the value of the rotation of the whole coverflow on the Y axis.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="nr_side_thumbs">Number of thumbnails to display <br> left and right:</label>
		    		</td>
		    		<td>
		    			<select id="nr_side_thumbs" class="ui-corner-all">
		    				<option value="0">all</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This represents the number of thumbnails to be displayed on the left and right of the center thumbnail of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="infinite_loop">Infinite loop:</label>
		    		</td>
		    		<td>
		    			<select id="infinite_loop" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This enables the coverflow movement to flow continuously in an infinite loop in any direction.
							Please note that in this case you can't display all the thumbnails in the setting above, you must set a specific number.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_autoplay">Coverflow autoplay:</label>
		    		</td>
		    		<td>
		    			<select id="cov_autoplay" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_slideshow_delay">Coverflow slideshow delay (milliseconds):</label>
		    		</td>
		    		<td>
		    			<input type="text" id="cov_slideshow_delay" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="right_click_context_menu">Right-click context menu:</label>
		    		</td>
		    		<td>
		    			<select id="right_click_context_menu" class="ui-corner-all">
							<option value="developer">developer</option>
							<option value="disabled">disabled</option>
							<option value="default">default</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="If 'developer' the context menu will be the developer link 'made by FWD'.
							If 'disabled' the context menu will be disabled completely.
							If 'default' the context menu will be the browser default.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="cov_keyboard_support">Add keyboard navigation support:</label>
		    		</td>
		    		<td>
		    			<select id="cov_keyboard_support" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
				<tr>
		    		<td>
		    			<label for="fluid_width_z_index">Fluid-width z-index:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="fluid_width_z_index" style="width:200px;" class="text ui-widget-content ui-corner-all">
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a z-index used for the 'fluid-width' version of the coverflow so that you can remove conflicts with overlapping menus etc.">
		    		</td>
		    	</tr>
		    </table>
		</div>
	  
		<div id="tab2">
		  	<table>
		    	<tr>
		    		<td>
		    			<label for="thumb_x_offset_3d">Thumbnail X offset 3D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_x_offset_3d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is an offset used for the X axis space between the central thumbnail and the side ones on the 3D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_x_space_3d">Thumbnail X space 3D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_x_space_3d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a value used for the X axis space between the side thumbnails on the 3D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_z_offset_3d">Thumbnail Z offset 3D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_z_offset_3d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is an offset used for the Z axis space between the central thumbnail and the side ones on the 3D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_z_space_3d">Thumbnail Z space 3D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_z_space_3d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a value used for the Z axis space between the side thumbnails on the 3D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_y_angle_3d">Thumbnail Y angle 3D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_y_angle_3d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a value used for the Y angle of the side thumbnails on the 3D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_x_offset_2d">Thumbnail X offset 2D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_x_offset_2d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is an offset used for the X axis space between the central thumbnail and the side ones on the 2D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_x_space_2d">Thumbnail X space 2D:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_x_space_2d" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a value used for the X axis space between the side thumbnails on the 2D version of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_hover_offset">Thumbnail hover offset:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_hover_offset" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a value used for the mouse hover offset effect on the Z axis for the side thumbnails of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_border_size">Thumbnail border size:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="thumb_border_size" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_bg_color">Thumbnail background color:</label>
		    		</td>
		    		<td>
		    			<input id="thumb_bg_color" />
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_border_color1">Thumbnail border color 1:</label>
		    		</td>
		    		<td>
		    			<input id="thumb_border_color1" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the upper color of the thumbnails border. If these two border color values are different then they create a gradient effect,
								if they are the same then there is a single color.">
		    		</td>
		    	</tr>
		    </table>
		    
		    <table>
		    	<tr>
		    		<td>
		    			<label for="thumb_border_color2">Thumbnail border color 2:</label>
		    		</td>
		    		<td>
		    			<input id="thumb_border_color2" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the lower color of the thumbnails border. If these two border color values are different then they create a gradient effect,
								if they are the same then there is a single color.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="transparent_images">Use transparent images:</label>
		    		</td>
		    		<td>
		    			<select id="transparent_images" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="If 'yes' then the background and border of the thumbnails won't be displayed and you can use png images with transparent backgrounds.
								If 'no' then the background and border will be displayed.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumbs_alignment">Thumbnails alignment:</label>
		    		</td>
		    		<td>
		    			<select id="thumbs_alignment" class="ui-corner-all">
							<option value="top">top</option>
							<option value="center">center</option>
							<option value="bottom">bottom</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the alignment of the thumbnails of the coverflow relative to the center one. On images of the same size there isn't any difference,
								but for different size images if 'bottom' is selected then they will all be aligned to the bottom of the thumbnail with the biggest height.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="max_thumbs_mobile">Maximum number of thumbnails <br> on mobile:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="max_thumbs_mobile" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the maximum number of thumbnails to be displayed only on the mobile devices for performance reasons.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_thumbs_gradient">Show thumbnail gradient:</label>
		    		</td>
		    		<td>
		    			<select id="show_thumbs_gradient" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is used to show or hide the side thumbnails gradient (used for the shadow effect).">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_gradient_color1">Thumbnail gradient color 1:</label>
		    		</td>
		    		<td>
		    			<input id="thumb_gradient_color1" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the side thumbnails gradient left color with transparency. If these two color values are different then they create a gradient effect,
								if they are the same then there is a single color. It is recommended to use an alpha transparency otherwise the image can't be seen.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="thumb_gradient_color2">Thumbnail gradient color 2:</label>
		    		</td>
		    		<td>
		    			<input id="thumb_gradient_color2" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the side thumbnails gradient right color with transparency. If these two color values are different then they create a gradient effect,
								if they are the same then there is a single color. It is recommended to use an alpha transparency otherwise the image can't be seen.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_thumbs_text">Show thumbnail text:</label>
		    		</td>
		    		<td>
		    			<select id="show_thumbs_text" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is used to show or hide the thumbnails hover text.">
		    		</td>
		    	</tr>
				<tr>
		    		<td>
		    			<label for="text_offset">Thumbnail text offset:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="text_offset" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is a value used for the text offset of the base of the center thumbnail of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_thumb_box_shadow">Show thumbnail box shadow:</label>
		    		</td>
		    		<td>
		    			<select id="show_thumb_box_shadow" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is used to show a box shadow on the thumbnail if desired.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="box_shadow_css">Thumbnail box shadow CSS:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="box_shadow_css" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the CSS box-shadow property for the thumbnail. It will be displayed only if the previous 'Show thumbnail box shadow' setting is set to 'yes'.">
		    		</td>
		    	</tr>
		    </table>
		    
	    	<table>
		    	<tr>
		    		<td>
		    			<label for="show_tooltip">Show tooltip:</label>
		    		</td>
		    		<td>
		    			<select id="show_tooltip" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="dynamic_tooltip">Dynamic tooltip:</label>
		    		</td>
		    		<td>
		    			<select id="dynamic_tooltip" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="If 'yes' the the thumbnail tooltip will be dynamically following the mouse cursor.
								If 'no' then it will be shown static above the thumbnail.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_reflection">Show image reflection:</label>
		    		</td>
		    		<td>
		    			<select id="show_reflection" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="reflection_height">Thumbnail reflection height:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="reflection_height" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="reflection_distance">Thumbnail reflection distance:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="reflection_distance" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="reflection_opacity">Thumbnail reflection opacity:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="reflection_opacity" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the opacity of the thumbnails reflection. It must be a float value between 0 and 1.">
		    		</td>
		    	</tr>
		    </table>
		</div>
		  
		<div id="tab3">
	    	<table>
	    		<tr>
		    		<td>
		    			<label for="controls_max_width">Controls maximum width:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="controls_max_width" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the maximum width of the controls bar and is used to scale the scrollbar at resize.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="controls_position">Controls position:</label>
		    		</td>
		    		<td>
		    			<select id="controls_position" class="ui-corner-all">
							<option value="top">top</option>
							<option value="bottom">bottom</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="controls_offset">Controls offset:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="controls_offset" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the Y offset of the controls based on the position.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_prev_btn">Show previous button:</label>
		    		</td>
		    		<td>
		    			<select id="show_prev_btn" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_next_btn">Show next button:</label>
		    		</td>
		    		<td>
		    			<select id="show_next_btn" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="disable_btns_mobile">Disable next and previous buttons <br> on mobile:</label>
		    		</td>
		    		<td>
		    			<select id="disable_btns_mobile" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_slideshow_btn">Show slideshow button:</label>
		    		</td>
		    		<td>
		    			<select id="show_slideshow_btn" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="timer_color">Slideshow timer color:</label>
		    		</td>
		    		<td>
		    			<input id="timer_color" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the color of the slideshow timer button display numbers.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_scrollbar">Show scrollbar:</label>
		    		</td>
		    		<td>
		    			<select id="show_scrollbar" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="scrollbar_handler_width">Scrollbar handler width:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="scrollbar_handler_width" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		     </table>
		     
		     <table>
		    	<tr>
		    		<td>
		    			<label for="scrollbar_text_normal_color">Scrollbar text normal color:</label>
		    		</td>
		    		<td>
		    			<input id="scrollbar_text_normal_color" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the normal color of the text from the scrollbar handler.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="scrollbar_text_selected_color">Scrollbar text selected color:</label>
		    		</td>
		    		<td>
		    			<input id="scrollbar_text_selected_color" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the selected color of the text from the scrollbar handler.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="disable_scrollbar_mobile">Disable scrollbar on mobile:</label>
		    		</td>
		    		<td>
		    			<select id="disable_scrollbar_mobile" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="enable_mouse_wheel">Enable mouse wheel scroll:</label>
		    		</td>
		    		<td>
		    			<select id="enable_mouse_wheel" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    </table>
		</div>
	
		<div id="tab4">
			<table>
		    	<tr>
		    		<td>
		    			<label for="show_categories_menu">Show categories menu:</label>
		    		</td>
		    		<td>
		    			<select id="show_categories_menu" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is used to show or hide the coverflow categories menu. This is used to select the coverflow categories.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="start_category">Categories menu start category:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="start_category" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is used to specify the selected start category of the categories menu if there is more than one category. Please note that the counting starts from 1.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="categories_menu_max_width">Categories menu maximum width:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="categories_menu_max_width" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the maximum width of the categories menu. If the menu width gets bigger than this, then it will become scrollable.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="categories_menu_offset">Categories menu offset:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="categories_menu_offset" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the offset of the categories menu, it represents the distance from the top of the coverflow.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="category_normal_color">Category normal color:</label>
		    		</td>
		    		<td>
		    			<input id="category_normal_color" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the normal color of a category of the categories menu.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="category_selected_color">Category selected color:</label>
		    		</td>
		    		<td>
		    			<input id="category_selected_color" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the selected color of a category of the categories menu.">
		    		</td>
		    	</tr>
		    </table>
		</div>
			
		<div id="tab5">
			<table>
		    	<tr>
		    		<td>
		    			<label for="lightbox_keyboard_support">Add lightbox keyboard navigation support:</label>
		    		</td>
		    		<td>
		    			<select id="lightbox_keyboard_support" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_lightbox_next_prev_btns">Show lightbox next and previous buttons:</label>
		    		</td>
		    		<td>
		    			<select id="show_lightbox_next_prev_btns" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_lightbox_zoom_btn">Show lightbox zoom button:</label>
		    		</td>
		    		<td>
		    			<select id="show_lightbox_zoom_btn" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_lightbox_info_btn">Show lightbox info button:</label>
		    		</td>
		    		<td>
		    			<select id="show_lightbox_info_btn" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_lightbox_slideshow_btn">Show lightbox slideshow button:</label>
		    		</td>
		    		<td>
		    			<select id="show_lightbox_slideshow_btn" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="show_lightbox_info_default">Show lightbox info window by default:</label>
		    		</td>
		    		<td>
		    			<select id="show_lightbox_info_default" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="If 'yes' the lightbox will open the info window automatically when the first item is opened.
								If 'no' then the info window will not be opened.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_slideshow_autoplay">Lightbox slideshow autoplay:</label>
		    		</td>
		    		<td>
		    			<select id="lightbox_slideshow_autoplay" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is used to enable the lightbox slideshow to start to play when the first item is opened.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_video_autoplay">Lightbox video autoplay:</label>
		    		</td>
		    		<td>
		    			<select id="lightbox_video_autoplay" class="ui-corner-all">
							<option value="yes">yes</option>
							<option value="no">no</option>
						</select>
						<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is used to enable the lightbox Youtube and Vimeo videos autoplay feature.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_video_width">Lightbox video width:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_video_width" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_video_height">Lightbox video height:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_video_height" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_iframe_width">Lightbox iframe width:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_iframe_width" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    </table>
		    <table>
		    	<tr>
		    		<td>
		    			<label for="lightbox_iframe_height">Lightbox iframe height:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_iframe_height" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_bg_color">Lightbox background color:</label>
		    		</td>
		    		<td>
		    			<input id="lightbox_bg_color" />
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_info_bg_color">Lightbox info window background color:</label>
		    		</td>
		    		<td>
		    			<input id="lightbox_info_bg_color" />
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_item_border_color1">Lightbox item border color 1:</label>
		    		</td>
		    		<td>
		    			<input id="lightbox_item_border_color1" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the upper color of the lightbox item border. If these two color values are different then they create a gradient effect,
								if they are the same then there is a single color.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_item_border_color2">Lightbox item border color 2:</label>
		    		</td>
		    		<td>
		    			<input id="lightbox_item_border_color2" />
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;"
							title="This is the lower color of the lightbox item border. If these two color values are different then they create a gradient effect,
								if they are the same then there is a single color.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_item_bg_color">Lightbox item background color:</label>
		    		</td>
		    		<td>
		    			<input id="lightbox_item_bg_color" />
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_bg_opacity">Lightbox background opacity:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_bg_opacity" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the opacity of the lightbox background. It must be a float value between 0 and 1.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_info_bg_opacity">Lightbox info window background opacity:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_info_bg_opacity" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    			<img src=<?php echo $this->_dir_url . "load/icons/help-icon.png" ?> style="vertical-align:middle;margin-top:-4px;"
							title="This is the opacity of the lightbox info window background. It must be a float value between 0 and 1.">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_border_size">Lightbox border size:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_border_size" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_border_radius">Lightbox border radius:</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_border_radius" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    	<tr>
		    		<td>
		    			<label for="lightbox_slideshow_delay">Lightbox slideshow delay <br> (milliseconds):</label>
		    		</td>
		    		<td>
		    			<input type="text" id="lightbox_slideshow_delay" style="width:200px;" class="text ui-widget-content ui-corner-all">
		    		</td>
		    	</tr>
		    </table>
		</div>
	</div>
	
	<input type="hidden" id="settings_data" name="settings_data" value="">
	
	<input id="add_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Add new preset" />
	<input id="update_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Update preset settings" />
	<input id="del_btn" type="submit" name="submit" style="cursor:pointer;margin-top:20px;" value="Delete preset" />
	
	<?php wp_nonce_field("fwds3dcov_general_settings_update", "fwds3dcov_general_settings_nonce"); ?>
</form>

<?php echo $msg; ?>

