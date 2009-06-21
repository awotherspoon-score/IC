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
