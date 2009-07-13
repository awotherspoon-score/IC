var TYPE_NEWS = 2;
var TYPE_EVENT = 3;

$(document).ready(function() {
	init_header();

	/*** START EVENT BINDING FUNCTIONS ***
	 * These functions bind interactive features to various DOM events
	 */

	/**
	 * Album Title Field - Keypress
	 *
	 * Updates title value on 'enter' keypress
	 */
	 $("form#gallery-form input#title").keypress( function(e) {
		 var code = e.keyCode || e.which;
		 if (code == 13) {
		 	//alert($(this).val());
			update_album(album_id);
			return false;
		 }

	 });

	 /**
	  * Album Title Field - Blur
	  *
	  * Updates album title field when it loses focus
	  */
	 $("form#gallery-form input#title").blur( function() {
		update_album(album_id);
	 });

	 /**
	  * Album Status Select Option - Click
	  *
	  * Updates album status field on click
	  */
	 $("form#gallery-form select#status option").click( function() {
		album_status = $(this).parent().val();
		update_album(album_id);
	 });

	 /**
	  * Date Inputs - Click
	  *
	  * Update album dates on click
	  */
	  $("#date-day").add("#date-month").add("#date-year").click(function () {
		  update_album(album_id);
	  });

	 /**
	  * News Select Option Button - Click
	  *
	  * Updates the album news id field on click
	  */
	 $("div#associated-news-inputs select option").click( function() {
		var selected_newsevent_id = $(this).parent().val();
		var edit_selected_newsevent_anchor = $(this).parent().parent().children("a");
		if ( selected_newsevent_id == 0 ) {
			edit_selected_newsevent_anchor.attr('href', '#');
		} else {
			edit_selected_newsevent_anchor.attr('href', "/admin/list-news.php?newsevent-id=" + selected_newsevent_id);
		}
		var album = album_data(album_id);
		alert(album);
		update_album(album_id);
	 });

	 /**
	  * Create New News Story Button - Click
	  *
	  * Creates a new news story for the user, adds it to the select input and clicks it
	  */
	 $("input#new-news").click( function()  {

		 var news_title = prompt("Enter A Title For Your New News Story", "");
		 if (news_title) {
			var today = new Date();
			var time = (today.getTime() / 1000) | 0;
			$.post("../php/command/ajaxcommandrunner.php", {
				obj: 'yes',
				type: 'newsevent',
				action: 'create-news-event',
				title: news_title,
				keywords: 'enter keywords',
				text: 'enter text here',
				stat: STATUS_PENDING,
				datedisplayed: time,
				newseventtype: TYPE_NEWS
			}, function(data) {
				var new_news_id = data['newsevent']['id'];
				var new_news_title= data['title'];
				var new_news_option = "<option value='" + new_news_id + "'>" + new_news_title + "</option>";
				$("#news-select").children(":first-child").after(new_news_option);
				$("#news-select").val(new_news_id);
				$("#edit-associated-news").attr('href', '/admin/list-news.php?newsevent-id=' + new_news_id);
				update_album(album_id);
			}, "json");

		 }
		 return false;
	 });
	 

	 /**
	  * Events Select Option Button - Click
	  *
	  * Updates the album events id field on click
	  */
	 $("div#associated-event-inputs select option").click( function() {
		var selected_newsevent_id = $(this).parent().val();
		var edit_selected_newsevent_anchor = $(this).parent().parent().children("a");
		if ( selected_newsevent_id == 0 ) {
			edit_selected_newsevent_anchor.attr('href', '#');
		} else {
			edit_selected_newsevent_anchor.attr('href', "/admin/list-events.php?newsevent-id=" + selected_newsevent_id);
		}
		update_album(album_id);
	 });

	 /**
	  * Create New Event Button - Click
	  *
	  * Creates a new event for the user, adds it to the select input and clicks it
	  */
	 $("input#new-event").click( function()  {

		 var event_title = prompt("Enter A Title For Your New Event", "");
		 if (event_title) {
			var today = new Date();
			var time = (today.getTime() / 1000) | 0;
			$.post("../php/command/ajaxcommandrunner.php", {
				obj: 'yes',
				type: 'newsevent',
				action: 'create-news-event',
				title: event_title,
				keywords: 'enter keywords',
				text: 'enter text here',
				stat: STATUS_PENDING,
				datedisplayed: time,
				newseventtype: TYPE_EVENT
			}, function(data) {
				var new_event_id = data['newsevent']['id'];
				var new_event_title= data['title'];
				var new_event_option = "<option value='" + new_event_id + "'>" + new_event_title + "</option>";
				$("#event-select").children(":first-child").after(new_event_option);
				$("#event-select").val(new_event_id);
				$("#edit-associated-event").attr('href', '/admin/list-events.php?newsevent-id=' + new_event_id);
				update_album(album_id);
			}, "json");

		 }
		 return false;
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
	 */
	 $("td.image-featured-select-radio-cell input").click( function() {
		 //album_id is defined in html head js script, we get the value from php
		 var image_id = $(this).parent().parent().attr("id");
		 $("td.image-featured-select-radio-cell input").attr("checked", false);
		 $(this).attr("checked", true);
		 update_album(album_id);
	 });


	 /*** END EVENT BINDING FUNCTIONS ***/

	
	 /*** START UTILITY FUNCTIONS ***
	  *
	  * These functions do the actual work of updating the site
	  * and manipulating the content
	  */ 

	 function update_album(id) {
		 var album = album_data(id);
		 $.post("../php/command/ajaxcommandrunner.php", {
			obj: 'yes',
			type: 'album',
			action: 'update-album',
			id: album['id'],
			title: album['title'],
			stat: album['stat'],
			newsid: album['newsid'],
			eventid: album['eventid'],
			featuredimageid: album['featuredimageid'],
			datedisplayed: album['datedisplayed']
		 }, function (data, textstatus) {
		 }, "json");
	 }

	 /**
	  * Gets album data from the form/table
	  */
	 function album_data(id) {
		var checked_radio = $("td.image-featured-select-radio-cell input:checked");
		var fid = checked_radio.parent().parent().attr('id');
		var album = {
			id: id,
			title: $("form#gallery-form input#title").val(),
			stat: $("form#gallery-form select#status").val(),
			newsid: $("form#gallery-form select#news-select").val(),
			eventid: $("form#gallery-form select#event-select").val(),
			featuredimageid: fid,
			datedisplayed: get_date()
		}

		album.toString = function() {
			var output = "id: " + this.id + "\n" +
				     "title: " + this.title + "\n" +
				     "status: " + this.stat + "\n" +
				     "newsid: " + this.newsid + "\n" +
				     "eventid: " + this.eventid +  "\n" +
				     "featuredimageid: " + this.featuredimageid + "\n" +
				     "datedisplayed: " + this.datedisplayed + "\n";
			return output;
		}
		return album;
         }

	 /**
	  * Update Image
	  *
	  * For a given image, take values from the table and update its record on the server
	  *
	  * @param id int the id of the image to update
	  */
	  function update_image(id) {
		  var  image = image_data(id);
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
		  if (prospective) { prospective = '1'; } else { prospective = '0'; }
		  if (current) { current = "1"; } else { current = "0"; }
		  if (staff) { staff = "1"; } else { staff = "0"; }

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

	  /**
	   * Gets the date from the date input
	   * 
	   * Returns an 11 digit unix timstamp
	   */
	  function get_date() {
		var day   = $("#date-day").val();   //1-31
		var month = $("#date-month").val(); //1-12
		var year  = $("#date-year").val();  //4-digit year
		var displayDate = new Date();
		displayDate.setFullYear($("#date-year").val());
		displayDate.setUTCMonth($("#date-month").val() - 1);
		displayDate.setUTCDate($("#date-day").val());
		return (displayDate.getTime() / 1000) | 0; //bitwise OR 0 truncates to int
	  }
});

