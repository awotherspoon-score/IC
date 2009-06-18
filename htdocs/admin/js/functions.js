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

function updateInputs(page) {
	$("#title").val(page['title']);		
	$("#meta-keywords").val(page['keywords']);
	$("#meta-description").val(page['description']);
	setfckval("content", page['text']);	
}

/**
 * Gets a page from the site and updates the inputs on list-pages
 *
 * should be called in context of a.page-button
 */
function getPage() {
	$.post("../php/command/ajaxcommandrunner.php", {
		'action' : 'get-page',
		'page-id' : this.id
	}, function (data, textStatus) { updateInputs(data['page']); }, "json");
}
