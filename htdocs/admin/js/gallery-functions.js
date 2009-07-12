$(document).ready(function() {
	init_header();

	/**
	 * Click Edit Caption Button
	 *
	 * Prompts the user for a new caption, updates image on confirmation
	 * TODO Acually update the image
	 */
	$("input.edit-caption-button").click( function() {
		var id = $(this).parent().parent().attr('id');
		var caption_span = $(this).parent().children('span.caption');
		var old_caption = caption_span.text();
		var new_caption = prompt("Edit Caption", old_caption);
		if (new_caption) {
			caption_span.text(new_caption);
			//update_image(id);
		}
		return false;
	});

	/**
	 * Click Prospective, Current or Staff Checkboxes
	 *
	 * Changes the selected value manually and updates image
	 * TODO: Actually update the image
	 */
	$("td.image-pcs-checkbox-cell input").click( function() {
		var id = $(this).parent().parent().attr('id');
		//update_image(id);
	});

	/**
	 * Click Feature Image Radio Button
	 *
	 * Ensures only one radio button is selected 
	 * and runs a set featured image update on the gallery
	 * TODO: Run the set featured image update (requires separate update method)
	 */
	 $("td.image-featured-select-radio-cell input").click( function() {
			 //album_id is defined in html head js script, we get the value from php
			 var image_id = $(this).parent().parent().attr("id");

			 $("td.image-featured-select-radio-cell input").attr("checked", false);
			 $(this).attr("checked", true);


	 });
});

