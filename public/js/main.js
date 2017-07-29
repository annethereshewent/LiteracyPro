
//deletes both bands and albums
function delete_element(id, type) {
	if (confirm("Are you sure you want to delete this " + type + '?')) {
		$.post('/delete/' + type + '/' + id, { "_token": $('meta[name="csrf-token"]').attr('content') }, function(data) {
			if (data == 'success') {
				$('#' + type + '_row_' + id).fadeOut(500, function() {
					$(this).hide()
				});	
			}
		});
	}
}

function filter_bands(band_id) {
	//if band id not blank then get the specific artist's albums
	if (band_id != '') {
		$.get(
			'filter_albums/' + band_id, 
			{ "_token": $('meta[name="csrf-token"]').attr('content') }, 
			function(data) {
				$('#albums_table_body').html("");
				//console.debug(data)
				$('#albums_table_body').html(data);
			}
		);
	}
	else {
		//otherwise, get all the albums
		$.get(
			'get_albums',
			function(data) {
				$('#albums_table_body').html(data);	
			}
		);
	}
}

function add_attribute_inputs(callback) {
	$('.attribute').each(function() {
		if ($(this).attr('id') == 'band_name') {
			//ajax to get bands for dropdown list
			//console.log('band name text is ' + $('#band_name').text())
			$.get(
				'/get_bands',
				{ selected: $('#band_name').text() },
				function(data) {
					$('#band_name').html(data);
					if (callback) {
						callback();
					}
				}
			)
			
		}
		else if ($(this).attr('id') == 'still_active') {
			var still_active_value = $(this).text() == 'Yes' ? 1 : 0;
			console.log('still active value: ' + still_active_value);
			$(this).html("<select class='still-active-dropdown' name='still_active'><option value='0'>No</option><option value='1'>Yes</option></select>");
			

			$('.still-active-dropdown').val(still_active_value)
		}
		else {
			$(this).html('<input type="text" class="attribute_input" name="' + $(this).attr('id') + '" value="' + $(this).text() + '">')
		}
	});
}


function hide_attribute_inputs() {
	$('.attribute').each(function() { 
		var value;
		if ($(this).attr('id') == 'band_name') {
			$(this).html($('#band_name_dropdown option:selected').text());
		}
		else if ($(this).attr('id') == 'still_active') {
			$(this).html($(this).children(':first').val() == 0 ? 'No' : 'Yes');

		}
		else {
			 $(this).html($(this).children(':first').val());
		}
	});
}

function show_submit_button() {
	$("#edit_button").hide();
	$("#back_button").hide()
	$("#save_button").show();
	$("#cancel_button").show();
	add_attribute_inputs();
}

function show_edit_button(current_url) {
	//first check the url and make sure the action isn't 'create'
	if (current_url) {
		var url_split = current_url.split('/');

		//not really a url, came from bands or albums page with query string set to previous page
		if (url_split.length == 1) {
			location.href = '/' + current_url;
		}
		else if (url_split[url_split.length-1] == 'create') {
			location.href = url_split[url_split.length-2] == 'album_details' ? '/album' : '/';
		}
	}

	$("#edit_button").show();
	$("#back_button").show();
	$("#save_button").hide();
	$("#cancel_button").hide();
	hide_attribute_inputs();
}


