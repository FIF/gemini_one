jQuery(document).ready(function($)
{
	$.each(fwds3dcovPresetsObj, function(i, el)
	{
		$("#fwds3dcov_presets_list").append("<option value='" + el.id + "'>" + el.name + "</option>");
	});

	$("#fwds3dcov_presets_list").change(function()
	{
		sid = $("#fwds3dcov_presets_list").val();
	});
	
	$("#fwds3dcov_div").hide();
		
	if (fwds3dcovPlaylistsObj.length > 0)
	{
		$.each(fwds3dcovPlaylistsObj, function(i, el)
		{
			$("#fwds3dcov_playlists_list").append("<option value='" + el.id + "'>" + el.name + "</option>");
		});

		$("#fwds3dcov_playlists_list").change(function()
		{
			pid = $("#fwds3dcov_playlists_list").val();
		});
		
		var sid = $("#fwds3dcov_presets_list").val();
		var pid = $("#fwds3dcov_playlists_list").val();
		
		$("#fwds3dcov_shortcode_btn").click(function()
		{
			var shortcode = '[fwds3dcov preset_id="' + sid + '" playlist_id="' + pid + '"]';
		
			if (typeof tinymce != "undefined")
			{
			    var editor = tinymce.get("content");
			    
			    if (editor && (editor instanceof tinymce.Editor) && ($("textarea#content:hidden").length != 0))
			    {
			        editor.selection.setContent(shortcode);
			        editor.save({no_events: true});
			    }
			    else
			    {
					var text = $("textarea#content").val();
					var select_pos1 = $("textarea#content").prop("selectionStart");
					var select_pos2 = $("textarea#content").prop("selectionEnd");
					
					var new_text = text.slice(0, select_pos1) + shortcode + text.slice(select_pos2);
					
					$("textarea#content").val(new_text);
			    } 
			}
			else
			{
				var text = $("textarea#content").val();
				var select_pos1 = $("textarea#content").prop("selectionStart");
				var select_pos2 = $("textarea#content").prop("selectionEnd");
				
				var new_text = text.slice(0, select_pos1) + shortcode + text.slice(select_pos2);
				
				$("textarea#content").val(new_text);
			}

			$("#fwds3dcov_div").hide();
			$("#fwds3dcov_div").fadeIn(600);
			$("#fwds3dcov_msg").html("The shortcode has been added!");
			
			return false;
		});
	}
	else
	{
		var td = $("#fwds3dcov_playlists_list").parent();
		
		$("#fwds3dcov_playlists_list").remove();
		td.append("<em style='margin-left:8px;'>No playlists are available.</em>");
		
		$("#fwds3dcov_shortcode_btn").prop("disabled", true);
		$("#fwds3dcov_shortcode_btn").css("cursor", "default");
	}
});