var STATUS_PENDING = 0;
var STATUS_LIVE = 1;

function init_header() {
  $("ul#top-nav-list > li").hover(
          function() {
                  $(this).find("ul").css({'display' : 'block','z-index' : '1000'});
          },
          function() {
                  $("ul", this).css("display", "none");
          }
  );
}

function getfckval(id) {
       if ( typeof(FCKeditorAPI) !== undefined ) { 
          return FCKeditorAPI.GetInstance(id).GetHTML();
        }
        return "";
}

function setfckval(id, html) {
        if ( typeof(FCKeditorAPI) !== undefined ) { 
          FCKeditorAPI.GetInstance(id).SetHTML(html);
          return FCKeditorAPI.GetInstance(id).GetHTML();
        }

        return "";
}
function refreshPage(page) {
	$("#title").val(page['title']);		
	$("#meta-keywords").val(page['keywords']);
	$("#meta-description").val(page['description']);
	setfckval("content", page['text']);	
	setfckval("introduction", page['introduction']);
	var selector = "a#" + page.id + ".page-button";
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
function getPageButton() {
	page.id = this.id;
        fetchPage(page.id);
}
function fetchPage(id) {
	$.post("../php/command/ajaxcommandrunner.php", {
		'action' : 'get-page',
		'page-id' : id
	}, function (data, textStatus) { refreshPage(data['page']); }, "json");
}

function updatePage() {
	$.post("../php/command/ajaxcommandrunner.php",
		{
			obj: 'yes',
			type: 'page',
			id: page.id,
			title: $("#title").val(),
			keywords: $("#meta-keywords").val(),
			description: $("#meta-description").val(),
			text: getfckval("content"),
			action: 'update-page',
			introduction: getfckval("introduction") 
		},
		function(data, textstatus) {
			refreshPage(data['page']);
			
			//var selector = "#" + page.id;	
			//$(selector).text(data['title']);	
		}, "json");
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


function metaToggle() {
        $("#meta-inputs").toggle('fast');
        $("#meta-toggle-button img").each(swapPlusMinus);
        return false;
}

function grandchildrenToggle() {
        $(this).parent().children().filter('table').toggle();
        $(this).children().filter('img').each(swapPlusMinus);
}

function grandchildDeleteButton() {
        var deletionConfirmed = confirm("Are you sure you want to delete this page?\nBe careful, this can't be undone!");
        var that = $(this);
        var child = that.parent().parent().parent();
        var grandchildRows =  child.children();
        
        if (deletionConfirmed) {
          $.post("../php/command/ajaxcommandrunner.php",
                  {
                          obj: 'yes',
                          type: 'page',
                          id: this.id,
                          action: 'delete-page'
                  },
                  function(data, textstatus) {
                        
                        //remove the 'delete/status' headers
                        if (grandchildRows.size() == 3) {
                                //why 3? one row for 'addchild' button, one for the existing delete/status headers
                                //and one more because grandchildRows hasn't been reloaded yet (think about it!)
                                grandchildRows.filter(".table-headers").hide();
                                grandchildRows.filter(".table-headers").remove();
                        }

                        that.parent().parent().hide();
                        that.parent().parent().remove();
                        

                  }, "text");
          
        }
        return false;
}

/**
 * Action on 'add child' button click 
 * under section header
 */
function grandchildAddButton() {
        
        var parentid = $(this).parent().parent().parent().parent().parent().children().filter("a").attr("id");
        var thisButton = $(this);
        var grandchildRows = thisButton.parent().parent().parent().children();
        var lastGrandchildRow = thisButton.parent().parent().parent().children(":last");
        
        $.post("../php/command/ajaxcommandrunner.php",
                {
                        obj: 'yes',
                        type: 'page',
                        action: 'create-page',
                        parentid: parentid,
                        text: 'new page',
                        introduction: 'new page introduction',
                        keywords: 'new page keywords',
                        stat: STATUS_PENDING,
                        title: 'New Page'

                },
                function(data, textStatus) {
                      //if this is the first grandchild page under this child, add the header row
                      if (grandchildRows.size() == 1) {
                        lastGrandchildRow.before(headerRow());
                      }
                       
                      //add the new page listing to the columns
                      lastGrandchildRow.before(newGrandChildMenuItem(data['page']));
                      //now delete/retrieve functionality to the relevant buttons
                      $("a.page-button").click(getPageButton);
                      $("a.delete-button").click(grandchildDeleteButton);
                      //open up out new page for editing
                      page.id = data['page']['id'];     //for the save button
                      fetchPage(page.id);               //get the data into the form
                },
                "json"
        );

        
}

function headerRow() {
        var header = ""
          + "<tr class='table-headers'>"
                + "<td></td>"
                + "<td>Delete</td>"
                + "<td>Status</td>"
          + "</tr>";
        return header;
}

function newGrandChildMenuItem(page) {
        var menuItem =   "<tr>"

                         +"<td class='title-cell'>"
                         +"<a class='page-button' id='" + page['id'] + "'>" + page['title'] + "</a>"
                         +"</td>"

                         +"<td class='delete-button-cell'>"
                         +"<a id='" + page['id']  + "' class='delete-button'>"
                         +"<img src='img/buttons/delete-button.gif' class='delete-button' />"
                         +"</a>"
                         +"</td>"

                         +"<td class='status'>"
                         +"<span class='pending'>&nbsp;pending</span>"
                         +"</td>"

                         +"<td>"
                         +"</td>"

                         +"</tr>";
        return menuItem;
}

function childAddButton() {
        var that = $(this);
        var parentid = that.attr('id');


        $.post("../php/command/ajaxcommandrunner.php",
                {
                        obj: 'yes',
                        type: 'page',
                        action: 'create-page',
                        parentid: parentid,
                        text: 'new page',
                        introduction: 'new page introduction',
                        keywords: 'new page keywords',
                        stat: STATUS_PENDING,
                        title: 'New Page'

                },
                function(data, textStatus) {
                },
                "json"
        );
        
}
