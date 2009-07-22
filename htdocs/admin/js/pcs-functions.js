$(function() {
	init_header();
	$("#meta-inputs").hide();
	$("#meta-toggle-button").click(metaToggle); 

	//generic functions copy-pasted in 
	//pulling these out into an include would be a good refactoring exercise
	function metaToggle() {
		$("#meta-inputs").toggle('fast');
		$("#meta-toggle-button img").each(swapPlusMinus);
		return false;
	}

	function swapPlusMinus() {
		var plusPath = "img/icons/plus.gif";
		var minusPath = "img/icons/minus.gif";
		if (this['src'].indexOf(plusPath) == -1) {
			this['src'] = plusPath;
		} else {
			this['src'] = minusPath;
		}
	}

	$('#add-suggested-link-button').click( function() {
		var href = $("#href").val();
		var anchor_text = $("#anchor-text").val();
		var last_link = $(this).parent().children("ul").children("li:last");
		var new_link_html = "<li>" + anchor_text + "<br />"
				   + "<span class='suggested-link-href'>"
				   + href + "</span></li>";

		//note to self:
		//if you ask for json and get rubbish, this method breaks!
		$.post("../php/command/ajaxcommandrunner.php", {
			action: 'create-suggested-link',
			pageid: page.id,
			href: href,
			anchortext: anchor_text
		}, function(data) {
			last_link.after(new_link_html);		
		}, 
		"json");
		return false;
	});

	$('.delete-suggested-link-button').click( function() {
		//check if the user is sure, return if he isn't
		var deletion_confirmed = confirm('Delete This Link?');
		if (!deletion_confirmed) { return false; }
		var link_id = $(this).attr('id');
		var list_item = $(this).parent();
		$.post("../php/command/ajaxcommandrunner.php", {
			action: 'delete-suggested-link',
			suggestedlinkid: link_id
		}, function() {
			list_item.hide();
		}	
		);
	});

});
