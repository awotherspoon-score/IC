function init_header() {
  $("ul#top-nav-list > li").hover(
          function() {
                  $(this).find("ul").css({
                        'display' : 'block',
                        'z-index' : '1000'
                  });
          },
          function() {
                  $("ul", this).css("display", "none");
          }
  );
}

function getfckval(id) {
        return FCKeditorAPI.GetInstance(id).GetHTML();
}

function setfckval(id, html) {
        FCKeditorAPI.GetInstance(id).SetHTML(html);
        return FCKeditorAPI.GetInstance(id).GetHTML();
}

function refreshPage(page) {
	$("#title").val(page['title']);		
	$("#meta-keywords").val(page['keywords']);
	$("#meta-description").val(page['description']);
	setfckval("content", page['text']);	
	var selector = "#" + page.id;
	$(selector).text(page['title']);
	
	//show modified date	
	var modifiedDate = new Date();
	modifiedDate.setTime(page['dateModified'] * 1000);
	var minutes = modifiedDate.getUTCMinutes();
	if (minutes < 10) {
		minutes = "0" + minutes;
	}
	var dateText = "Last Modified On " + modifiedDate.toDateString() + " at " + modifiedDate.getHours() + ":" + minutes; 
	var modifyDate = $("#modify-date");
	modifyDate.text(dateText);
	
}

/**
 * Gets a page from the site and updates the inputs on list-pages
 *
 * should be called in context of a.page-button
 */
function getPage() {
	page.id = this.id;
	$.post("../php/command/ajaxcommandrunner.php", {
		'action' : 'get-page',
		'page-id' : this.id
	}, function (data, textStatus) { refreshPage(data['page']); }, "json");
}

function updatePage() {
	$.post("../php/command/ajaxcommandrunner.php",
		{
			object: 'yes',
			class: 'page',
			id: page.id,
			title: $("#title").val(),
			keywords: $("#meta-keywords").val(),
			description: $("#meta-description").val(),
			text: getfckval("content"),
			action: 'update-page'
		},
		function(data, textstatus) {
			refreshPage(data['page']);
			//var selector = "#" + page.id;	
			//$(selector).text(data['title']);	
		},
		"json"
	);
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
