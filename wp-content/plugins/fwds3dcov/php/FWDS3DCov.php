<?php

// main FWD Simple 3D Coverflow plugin class
class FWDS3DCov
{
	// constants
	const MIN_WP_VER =  "3.5.0";
	const CAPABILITY = "edit_fwds3dcov";
	
	// variables
	private $_data;
	private $_dir_url;
    
    private static $_cov_id = 0;
    
    // constructor
    public function FWDS3DCov()
    {
		$this->_dir_url = plugin_dir_url(dirname(__FILE__));
		
    	// set hooks
    	add_action("admin_menu", array($this, "add_plugin_menu"));
		add_shortcode("fwds3dcov", array($this, "set_coverflow"));
		add_filter("the_posts",  array($this, "add_scripts_and_styles"));
		
		// set data
		$this->_data = new FWDS3DCovData();
    }

    // functions
    public function add_plugin_menu()
    {
    	// add menus
        add_menu_page("Coverflow Title", "FWD Simple 3D Coverflow", FWDS3DCov::CAPABILITY, "FWDS3DCovMenu-General-Settings", array($this, "set_general_settings"), $this->_dir_url . "load/icons/menu-icon.png");
       	add_submenu_page("FWDS3DCovMenu-General-Settings", "General settings", "General settings", FWDS3DCov::CAPABILITY, "FWDS3DCovMenu-General-Settings");
       	add_submenu_page("FWDS3DCovMenu-General-Settings", "Playlists manager", "Playlists manager", FWDS3DCov::CAPABILITY, "FWDS3DCovMenu-Playlists-Manager", array($this, "set_playlists_manager"));
       	add_submenu_page("FWDS3DCovMenu-General-Settings", "CSS Editor", "CSS Editor", FWDS3DCov::CAPABILITY, "FWDS3DCovMenu-CSS-Editor", array($this, "set_css_editor"));
       	
       	// add meta boxes
       	$post_type_screens = array("post", "page");

    	foreach ($post_type_screens as $screen)
    	{
       		add_meta_box("fwds3dcov-shortcode-generator", "FWDS3DCov Shortcode Generator",  array($this, "set_custom_meta_box"), $screen, "side", "default");
    	}
    }
	
	public function add_scripts_and_styles($posts)
	{
		if (empty($posts)) return $posts;
	 
		$shortcode_found = false;
		
		foreach ($posts as $post)
		{
			if (stripos($post->post_content, "[fwds3dcov") !== false)
			{
				$shortcode_found = true;
				break;
			}
		}
	 
		if ($shortcode_found)
		{
			wp_enqueue_style("fwds3dcov_cov_css", $this->_dir_url . "css/fwds3dcov.css");
			wp_enqueue_script("fwds3dcov_cov_script", $this->_dir_url . "js/FWDSimple3DCoverflow.js");
		}
	 
		return $posts;
	}
    
	private function check_wp_ver()
	{
	    global $wp_version;
	    
		$exit_msg = "The FWD Simple 3D Coverflow plugin requires WordPress " . FWDS3DCov::MIN_WP_VER . " or newer. <a href='http://codex.wordpress.org/Updating_WordPress'>Please update!</a>";
		
		if (version_compare($wp_version, FWDS3DCov::MIN_WP_VER) <= 0)
		{
			echo $exit_msg;
			
			return false;
		}
		
		return true;
	}

    public function set_general_settings()
    {
    	if (!$this->check_wp_ver())
    	{
    		return;
    	}
    	
    	$msg = "";
    	
    	$set_id = 0;
		$set_order_id = 0;
		$tab_init_id = 0;
    	
	    if (!empty($_POST) && check_admin_referer("fwds3dcov_general_settings_update", "fwds3dcov_general_settings_nonce"))
		{
			$data_obj = json_decode(str_replace("\\", "", $_POST["settings_data"]), true);
			
			$action = $data_obj["action"];
			$settingsAr = $data_obj["settings_ar"];
			
			$this->_data->settings_ar = $settingsAr;
			$this->_data->set_data();
			
			switch ($action)
			{
			    case "add":
			        $msg = "<div class='fwd-updated'><p style='padding:8px;'>Your new preset has been added!</p></div>";
			        $set_id = $data_obj["set_id"];
					$set_order_id = $data_obj["set_order_id"];
					$tab_init_id = $data_obj["tab_init_id"];
			        break;
			    case "save":
			        $msg = "<div class='fwd-updated'><p style='padding:8px;'>Your preset settings have been updated!</p></div>";
			        $set_id = $data_obj["set_id"];
					$set_order_id = $data_obj["set_order_id"];
					$tab_init_id = $data_obj["tab_init_id"];
			        break;
			    case "del":
			       	$msg = "<div class='fwd-updated'><p style='padding:8px;'>Your preset has been deleted!</p></div>";
			        break;
			}
		}
		
		// jquery ui
		wp_enqueue_style("fwds3dcov_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-tooltip");
		
		// spectrum colorpicker
    	wp_enqueue_style("fwds3dcov_spectrum_css", $this->_dir_url . "css/spectrum.css");
    	wp_enqueue_script("fwds3dcov_spectrum_script", $this->_dir_url . "js/spectrum.js");
    	
    	// general settings script
		wp_enqueue_media();
        wp_enqueue_script("fwds3dcov_general_settings_script", $this->_dir_url . "js/general_settings.js");
		
    	include_once "general_settings.php";
    }
    
 	public function set_playlists_manager()
    {
    	if (!$this->check_wp_ver())
    	{
    		return;
    	}
    	
    	$msg = "";
    	
	    if (!empty($_POST) && check_admin_referer("fwds3dcov_playlist_manager_update", "fwds3dcov_playlist_manager_nonce"))
		{
			$playlistsAr = json_decode(str_replace("\\", "", $_POST["playlist_data"]), true);
			
			$this->_data->playlists_ar = $playlistsAr;
			$this->_data->set_data();
			
			$msg = "<div class='fwd-updated'><p style='padding:8px;'>Your playlists have been updated!</p></div>";
		}
		
		// jquery ui
		wp_enqueue_style("fwds3dcov_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-ui-dialog");
		wp_enqueue_script("jquery-ui-tooltip");
		
		// playlist manager script
		wp_enqueue_media();
        wp_enqueue_script("fwds3dcov_playlist_manager_script", $this->_dir_url . "js/playlist_manager.js");
        
    	include_once "playlist_manager.php";
    }
    
    public function set_css_editor()
    {
    	if (!$this->check_wp_ver())
    	{
    		return;
    	}
    	
    	$msg = "";
    	$scroll_pos = 0;
    	
    	$css_file = plugin_dir_path(dirname(__FILE__)) . "css/fwds3dcov.css";
    	
	    if (!empty($_POST) && check_admin_referer("fwds3dcov_css_editor_update", "fwds3dcov_css_editor_nonce"))
		{
			$handle = fopen($css_file, "w") or die("Cannot open file: " . $css_file);
			
			$data = $_POST["css_data"];
			$scroll_pos = $_POST["scroll_pos"];
			
			fwrite($handle, $data);
			
			$msg = "<div class='fwd-updated'><p style='padding:8px;'>The CSS file has been updated!</p></div>";
		}
		
		wp_enqueue_style("fwds3dcov_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
	  			
		$handle = fopen($css_file, "r") or die("Cannot open file: " . $css_file);
        
    	include_once "css_editor.php";
    	
    	fclose($handle);
    }
    
	public static function set_action_links($links)
	{
		$settings_link = "<a href='" . get_admin_url(null, "admin.php?page=FWDS3DCovMenu-General-Settings") . "'>Settings</a>";
   		array_unshift($links, $settings_link);
   		
   		return $links;
	}
    
    public function get_constructor($sid, $pid)
    {
    	$preset = NULL;
    	
    	foreach ($this->_data->settings_ar as $set)
    	{
    		if ($set["id"] == $sid)
    		{
    			$preset = $set;
    		}
    	}
    	
    	if (is_null($preset))
    	{
    		return "Preset with id ". $sid . " does not exist!";
    	}
    	
    	$playlist = NULL;
    	
    	foreach ($this->_data->playlists_ar as $pl)
    	{
    		if ($pl["id"] == $pid)
    		{
    			$playlist = $pl;
    		}
    	}
    	 	
    	if (is_null($playlist))
    	{
    		return "Playlist with id ". $pid . " does not exist!";
    	}
    	
    	return "<script type='text/javascript'>
			FWDS3DCovUtils.checkIfHasTransforms();

			window.fwds3dcov" . FWDS3DCov::$_cov_id. " = new FWDSimple3DCoverflow(
			{" . 
				//required settings
			   "coverflowHolderDivId:'fwds3dcovDiv" . FWDS3DCov::$_cov_id. "',
				coverflowDataListDivId:'fwds3dcovPlaylist" . $pid . "'," . 

				//main settings
			   "displayType:'" . $preset['display_type'] . "',
				autoScale:'" . $preset['autoscale'] . "',
				coverflowWidth:" . $preset['cov_width'] . ",
				coverflowHeight:" . $preset['cov_height'] . ",
				skinPath:'" . $preset['skin_path'] . "',
				backgroundColor:'" . $preset['cov_bg_color'] . "',
				backgroundImagePath:'" . $preset['cov_bg_image_url'] . "',
				backgroundRepeat:'" . $preset['bg_repeat'] . "',
				showDisplay2DAlways:'" . $preset['show_2d_display'] . "',
				coverflowStartPosition:'" . $preset['cov_start_pos'] . "',
				coverflowTopology:'" . $preset['cov_topology'] . "',
				coverflowXRotation:" . $preset['cov_x_rot'] . ",
				coverflowYRotation:" . $preset['cov_y_rot'] . ",
				numberOfThumbnailsToDisplayLeftAndRight:" . $preset['nr_side_thumbs'] . ",
				infiniteLoop:'" . $preset['infinite_loop'] . "',
				autoplay:'" . $preset['cov_autoplay'] . "',
				slideshowDelay:" . $preset['cov_slideshow_delay'] . ",
				rightClickContextMenu:'" . $preset['right_click_context_menu'] . "',
				addKeyboardSupport:'" . $preset['cov_keyboard_support'] . "', 
				fluidWidthZIndex:" . $preset['fluid_width_z_index'] . "," . 
											
				//thumbs settings
				"thumbnailXOffset3D:" . $preset['thumb_x_offset_3d'] . ",
				thumbnailXSpace3D:" . $preset['thumb_x_space_3d'] . ",
				thumbnailZOffset3D:" . $preset['thumb_z_offset_3d'] . ",
				thumbnailZSpace3D:" . $preset['thumb_z_space_3d'] . ",
				thumbnailYAngle3D:" . $preset['thumb_y_angle_3d'] . ",
				thumbnailXOffset2D:" . $preset['thumb_x_offset_2d'] . ",
				thumbnailXSpace2D:" . $preset['thumb_x_space_2d'] . ",
				thumbnailHoverOffset:" . $preset['thumb_hover_offset'] . ",
				thumbnailBorderSize:" . $preset['thumb_border_size'] . ",
				thumbnailBackgroundColor:'" . $preset['thumb_bg_color'] . "',
				thumbnailBorderColor1:'" . $preset['thumb_border_color1'] . "',
				thumbnailBorderColor2:'" . $preset['thumb_border_color2'] . "',
				transparentImages:'" . $preset['transparent_images'] . "',
				thumbnailsAlignment:'" . $preset['thumbs_alignment'] . "',
				maxNumberOfThumbnailsOnMobile:" . $preset['max_thumbs_mobile'] . ",
				showThumbnailsGradient:'" . $preset['show_thumbs_gradient'] . "',
				thumbnailGradientColor1:'" . $preset['thumb_gradient_color1'] . "',
				thumbnailGradientColor2:'" . $preset['thumb_gradient_color2'] . "',
				showText:'" . $preset['show_thumbs_text'] . "',
				textOffset:" . $preset['text_offset'] . ",
				showThumbnailBoxShadow:'" . $preset['show_thumb_box_shadow'] . "',
				thumbnailBoxShadowCss:'" . $preset['box_shadow_css'] . "',
				showTooltip:'" . $preset['show_tooltip'] . "',
				dynamicTooltip:'" . $preset['dynamic_tooltip'] . "',
				showReflection:'" . $preset['show_reflection'] . "',
				reflectionHeight:" . $preset['reflection_height'] . ",
				reflectionDistance:" . $preset['reflection_distance'] . ",
				reflectionOpacity:" . $preset['reflection_opacity'] . "," . 
											
				//controls settings
			   "controlsMaxWidth:" . $preset['controls_max_width'] . ",
				controlsPosition:'" . $preset['controls_position'] . "',
				controlsOffset:'" . $preset['controls_offset'] . "',
				showPrevButton:'" . $preset['show_prev_btn'] . "',
				showNextButton:'" . $preset['show_next_btn'] . "',
				disableNextAndPrevButtonsOnMobile:'" . $preset['disable_btns_mobile'] . "',
				showSlideshowButton:'" . $preset['show_slideshow_btn'] . "',
				slideshowTimerColor:'" . $preset['timer_color'] . "',
				showScrollbar:'" . $preset['show_scrollbar'] . "',
				scrollbarHandlerWidth:" . $preset['scrollbar_handler_width'] . ",
				scrollbarTextColorNormal:'" . $preset['scrollbar_text_normal_color'] . "',
				scrollbarTextColorSelected:'" . $preset['scrollbar_text_selected_color'] . "',
				disableScrollbarOnMobile:'" . $preset['disable_scrollbar_mobile'] . "',
				enableMouseWheelScroll:'" . $preset['enable_mouse_wheel'] . "'," . 
											
				//categories menu settings
			   "showCategoriesMenu:'" . $preset['show_categories_menu'] . "',
				startAtCategory:" . $preset['start_category'] . ",
				categoriesMenuMaxWidth:" . $preset['categories_menu_max_width'] . ",
				categoriesMenuOffset:" . $preset['categories_menu_offset'] . ",
				categoryColorNormal:'" . $preset['category_normal_color'] . "',
				categoryColorSelected:'" . $preset['category_selected_color'] . "'," . 
											
				//lightbox settings
			   "addLightBoxKeyboardSupport:'" . $preset['lightbox_keyboard_support'] . "',
				showLightBoxNextAndPrevButtons:'" . $preset['show_lightbox_next_prev_btns'] . "',
				showLightBoxZoomButton:'" . $preset['show_lightbox_zoom_btn'] . "',
				showLightBoxInfoButton:'" . $preset['show_lightbox_info_btn'] . "',
				showLightBoxSlideShowButton:'" . $preset['show_lightbox_slideshow_btn'] . "',
				showLightBoxInfoWindowByDefault:'" . $preset['show_lightbox_info_default'] . "',
				slideShowAutoPlay:'" . $preset['lightbox_slideshow_autoplay'] . "',
				lightBoxVideoAutoPlay:'" . $preset['lightbox_video_autoplay'] . "',
				lightBoxVideoWidth:" . $preset['lightbox_video_width'] . ",
				lightBoxVideoHeight:" . $preset['lightbox_video_height'] . ",
				lightBoxIframeWidth:" . $preset['lightbox_iframe_width'] . ",
				lightBoxIframeHeight:" . $preset['lightbox_iframe_height'] . ",
				lightBoxBackgroundColor:'" . $preset['lightbox_bg_color'] . "',
				lightBoxInfoWindowBackgroundColor:'" . $preset['lightbox_info_bg_color'] . "',
				lightBoxItemBorderColor1:'" . $preset['lightbox_item_border_color1'] . "',
				lightBoxItemBorderColor2:'" . $preset['lightbox_item_border_color2'] . "',
				lightBoxItemBackgroundColor:'" . $preset['lightbox_item_bg_color'] . "',
				lightBoxMainBackgroundOpacity:" . $preset['lightbox_bg_opacity'] . ",
				lightBoxInfoWindowBackgroundOpacity:" . $preset['lightbox_info_bg_opacity'] . ",
				lightBoxBorderSize:" . $preset['lightbox_border_size'] . ",
				lightBoxBorderRadius:" . $preset['lightbox_border_radius'] . ",
				lightBoxSlideShowDelay:" . $preset['lightbox_slideshow_delay'] . "
			});
		</script>";
    }
    
    public function get_playlist($pid)
    {
    	$playlist = NULL;
    	
    	foreach ($this->_data->playlists_ar as $pl)
    	{
    		if ($pl["id"] == $pid)
    		{
    			$playlist = $pl;
    		}
    	}
    	
    	if (is_null($playlist))
    	{
    		return "Playlist with id ". $pid . " does not exist!";
    	}
    	
    	$playlist_str = "<ul id='fwds3dcovPlaylist$pid' style='display: none;'>";
    	
    	foreach ($playlist["categories"] as $category)
    	{
    		$playlist_str .= "<ul data-cat='" . $category["name"] . "'>";
    		
    		foreach ($category["thumbs"] as $thumb)
    		{
				$playlist_str .= "<ul>
					<li data-type='" . $thumb["type"] . "' data-url='" . $thumb["url"] . "' data-target='" . $thumb["target"] . "'></li>
					<li data-thumbnail-path='" . $thumb["path"] . "' data-thumbnail-width='" .  $thumb["width"] . "' data-thumbnail-height='" .  $thumb["height"] . "'></li>
					<li data-thumbnail-text=''>"
						 . $thumb["text"] . "
					</li>
					<li data-info=''>"
						 . $thumb["info"] . "
					</li>
				</ul>";
    		}
    		
    		$playlist_str .= "</ul>";
    	}
    	
    	$playlist_str .= "</ul>";
    	
    	return $playlist_str;
    }
    
 	public function set_coverflow($atts)
	{
		extract(shortcode_atts(array("preset_id" => 0, "playlist_id" => 0), $atts, "fwds3dcov"));
		
		$cov_constructor = $this->get_constructor($preset_id, $playlist_id);
		$cov_div = "<div id='fwds3dcovDiv" . FWDS3DCov::$_cov_id. "'></div>";
		$cov_playlist = $this->get_playlist($playlist_id);
		
		FWDS3DCov::$_cov_id++;
		
		$cov_output = $cov_div . $cov_constructor . $cov_playlist;
		
		return $cov_output;
	}
	
	public function set_custom_meta_box($post)
	{
		if (!$this->check_wp_ver())
    	{
    		return;
    	}
		
		// presets
		$presetsNames = array();
		
		foreach ($this->_data->settings_ar as $setting)
    	{
    		$el = array(
    						"id" => $setting["id"],
    						"name" => $setting["name"]
    				   );
    				   
    		array_push($presetsNames, $el);
    	}
    	
		// playlists
		$playlistsNames = array();
		
		if (isset($this->_data->playlists_ar))
		{
			foreach ($this->_data->playlists_ar as $playlist)
	    	{
	    		$el = array(
	    						"id" => $playlist["id"],
	    						"name" => $playlist["name"]
	    				   );
	    				   
	    		array_push($playlistsNames, $el);
	    	}
		}
		
    	wp_enqueue_style("fwds3dcov_fwd_ui_css", $this->_dir_url . "css/fwd_ui.css");
		wp_enqueue_script("fwds3dcov_shortcode_script", $this->_dir_url . "js/shortcode.js");
		
    	include_once "meta_box.php";
	}
}

?>