$(document).ready(function() {
	init_header();

	/*** START EVENT BINDING FUNCTIONS ***
	 * These functions bind interactive features to various DOM events
	 */

	/**
	 * Album Title Field - Keypress
	 *
	 * Updates title value on 'enter' keypress
	 * TODO Write updatealbum function
	 */
	 $("form#gallery-form input#title").keypress( function(e) {
		 var code = e.keyCode || e.which;
		 if (code == 13) {
		 	alert($(this).val());
			//update_album(album_id);
			return false;
		 }
	 });

	 /**
	  * Album Title Field - Blur
	  *
	  * Updates album title field when it loses focus
	  * TODO Write update_album function
	  */
	 $("form#gallery-form input#title").blur( function() {
		//update_album(album_id);
	 });

	 /**
	  * News Select Option Button - Click
	  *
	  * Updates the album news id field on click
	  * TODO write update_album function
	  */
	 $("div#associated-news-inputs select option").click( function() {
		var selected_newsevent_id = $(this).parent().val();
		var edit_selected_newsevent_anchor = $(this).parent().parent().children("a");
		if ( selected_newsevent_id == 0 ) {
			edit_selected_newsevent_anchor.attr('href', '#');
		} else {
			edit_selected_newsevent_anchor.attr('href', "/admin/list-news.php?newsevent-id=" + selected_newsevent_id);
		}
		//update_album(album_id);
	 });

	 /**
	  * Events Select Option Button - Click
	  *
	  * Updates the album events id field on click
	  * TODO write update_album function
	  */
	 $("div#associated-event-inputs select option").click( function() {
		var selected_newsevent_id = $(this).parent().val();
		var edit_selected_newsevent_anchor = $(this).parent().parent().children("a");
		if ( selected_newsevent_id == 0 ) {
			edit_selected_newsevent_anchor.attr('href', '#');
		} else {
			edit_selected_newsevent_anchor.attr('href', "/admin/list-events.php?newsevent-id=" + selected_newsevent_id);
		}
		//update_album(album_id);
	 });

	/**
	 * Click Edit Caption Button
	 *
	 * Prompts the user for a new caption, updates image on confirmation
	 */
	$("input.edit-caption-button").click( function() {
		var id = $(this).parent().parent().attr('id');
		var caption_span = $(this).parent().children('span.caption');
		var old_caption = caption_span.text();
		var new_caption = prompt("Edit Caption", old_caption);
		if (new_caption) {
			caption_span.text(new_caption);
			update_image(id);
		}
		return false;
	});

	/**
	 * Click Prospective, Current or Staff Checkboxes
	 *
	 * Changes the selected value manually and updates image
	 */
	$("td.image-pcs-checkbox-cell input").click( function() {
		var id = $(this).parent().parent().attr('id');
		update_image(id);
	});

	/**
	 * Click Feature Image Radio Button
	 *
	 * Ensures only one radio button is selected 
	 * and runs a set featured image update on the gallery
	 *
	 * TODO: Run the set featured image update (requires separate update method)
	 */
	 $("td.image-featured-select-radio-cell input").click( function() {
		 //album_id is defined in html head js script, we get the value from php
		 var image_id = $(this).parent().parent().attr("id");
		 $("td.image-featured-select-radio-cell input").attr("checked", false);
		 $(this).attr("checked", true);
	 });


	 /*** END EVENT BINDING FUNCTIONS ***/

	
	 /*** START UTILITY FUNCTIONS ***
	  *
	  * These functions do the actual work of updating the site
	  * and manipulating the content
	  */ 

	 /**
	  * Update Image
	  *
	  * For a given image, take values from the table and update its record on the server
	  *
	  * @param id int the id of the image to update
	  */
	  function update_image(id) {
		  image = image_data(id);
		  $.post("../php/command/ajaxcommandrunner.php", {
				obj: 'yes',
				type: 'image',
				action: 'update-image',
				id: image['id'],
				title: image['caption'],
				prospective: image['prospective'],
				current: image['current'] ,
				staff: image['staff']
		  }, function(data, textstatus) {
		  }, "json");
	  }

	  /**
	   * Get image data from the table
	   * 
	   * Gets image data for a given image id from the table
	   *
	   * @param id int the id of the image to retrieve from the table
	   */
	  function image_data(id) {
		  var image_row = $("table#images-table tbody tr#" + id);
		  var caption = image_row.children("td.image-caption-cell").children("span.caption").text();
		  var prospective = image_row.children(".prospective-cell").children(".prospective").attr("checked");
		  var current = image_row.children(".current-cell").children(".current").attr("checked");
		  var staff = image_row.children(".staff-cell").children(".staff").attr("checked");
		  if (prospective) { prospective = 1; } else { prospective = 0; }
		  if (current) { current = 1; } else { current = 0; }
		  if (staff) { staff = 1; } else { staff = 0; }

		  //adds a sane toString for debugging
		  var image = {
			id: id,
			caption: caption,
			prospective: prospective,
			current: current,
			staff: staff,
			toString: function () {
				var output = "id: " + this.id + "\n" +
					     "caption: " + this.caption + "\n" +
					     "prospective: " + this.prospective + "\n" +
					     "current: " + this.current + "\n" +
					     "staff: " + this.staff + "\n";
				return output;
			}
	          };
		  return image;
		  
          }
});

