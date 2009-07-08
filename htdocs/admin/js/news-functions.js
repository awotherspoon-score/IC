var TYPE_NEWS = 2;
var TYPE_EVENT = 3;

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

/*
function enableEditor(id) {
	var oEditor = FCKeditorAPI.GetInstance(id);
	oEditor.EditorDocument.body.disabled=false;
}

function disableEditor(id) {
	var oEditor = FCKeditorAPI.GetInstance(id);
	oEditor.EditorDocument.body.disabled=true;
}
*/

function refreshNewsEvent(news) {
	//pull values into the form
	$("#title").val(news['title']);		
	$("#status-input").val(news['status']);
	$("#meta-keywords").val(news['keywords']);
	$("#meta-description").val(news['description']);
	setfckval("content", news['text']);	
	$("#id").val(news['id']);

	//load the date in correctly
	var displayDate = new Date();
	displayDate.setTime( news['dateDisplayed'] * 1000 );
	displayDate.setHours(12);
	$("#date-day").val( displayDate.getUTCDate() );
	$("#date-month").val( displayDate.getUTCMonth() + 1 );
	$("#date-year").val( displayDate.getUTCFullYear() );
	
	//show the new values in the left column
	//title
	$("a#" + newsEvent.id + ".news-button").text(news['title']);
	//status
	var selector = "td#" + news['id'] + ".status span";
	status_span = $(selector);	
	status_span.removeClass('live pending');
	if (news['status'] == STATUS_PENDING) {
		status_span.text('pending');
		status_span.addClass('pending');
	} else {
		status_span.text('live');
		status_span.addClass('live');
	}
		
	
	var selector = "span#" + news['id'] + ".status span";
	status_span = $(selector);	
	status_span.removeClass('live pending');
	if (news['status'] == STATUS_PENDING) {
		status_span.text('pending');
		status_span.addClass('pending');
	} else {
		status_span.text('live');
		status_span.addClass('live');
	}
	
	//show modified date	
	var modifiedDate = new Date();
	modifiedDate.setTime(news['dateModified'] * 1000);
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
function getNewsButton() {
	newsEvent.id = this.id;
        fetchNewsEvent(newsEvent.id);
}
function fetchNewsEvent(id) {
	$.post("../php/command/ajaxcommandrunner.php", {
		'action' : 'get-news-event',
		'newsevent-id' : id
	}, function (data, textStatus) { 
		refreshNewsEvent(data['newsevent']); 
		//$("#status-input").removeAttr('disabled');	
		//$("#title").removeAttr('disabled');	
		//enableForm();

	}, "json");
}

function getTimestampFromForm() {
	var day   = $("#date-day").val();   //1-31
	var month = $("#date-month").val(); //1-12
	var year  = $("#date-year").val();  //4-digit year
	var displayDate = new Date();
	displayDate.setFullYear($("#date-year").val());
	displayDate.setUTCMonth($("#date-month").val() - 1);
	displayDate.setUTCDate($("#date-day").val());
	return (displayDate.getTime() / 1000) | 0; //bitwise OR 0 truncates to int
}

function updateNewsEvent() {
	$.post("../php/command/ajaxcommandrunner.php",
		{
			obj: 'yes',
			type: 'newsevent',
			id: newsEvent.id,
			title: $("#title").val(),
			keywords: $("#meta-keywords").val(),
			description: $("#meta-description").val(),
			text: getfckval("content"),
			action: 'update-news-event',
			stat: $("#status-input").val(),
			datedisplayed: getTimestampFromForm()
		},
		function(data, textstatus) {
			refreshNewsEvent(data['newsevent']);
			
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

function newsToggle() {
        $(this).parent().children().filter('table').toggle();
	var plusMinusIcon =$(this).parent().children().filter('a.news-section-toggle-button').children().filter('img'); 
	plusMinusIcon.each(swapPlusMinus);
        //$(this).children().filter('img').each(swapPlusMinus);
}

function grandchildDeleteButton() {
        var confirmMessage = "Are you sure you want to delete this page?\nBe careful, this can't be undone!";
        if ($(this).parent().attr('class') == 'child-buttons') {
                confirmMessage += "\n\nThis will also delete all child pages.";
        }
        var deletionConfirmed = confirm(confirmMessage);
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
                        that.parent().parent().hide();
                        that.parent().parent().remove();
			disableForm();
                  }, "json");
          
        }
        return false;
}

function disableForm() {
	$(".text-input").attr('disabled', 'disabled');
	$("select#status-input").attr('disabled', 'disabled');
	disableEditor('introduction');
	disableEditor('content');
	$("#save-button").attr('disabled', 'disabled');
}

function enableForm() {
	$(".text-input").removeAttr('disabled');
	$("select#status-input").removeAttr('disabled');
	enableEditor('introduction');
	enableEditor('content');
	$("#save-button").removeAttr('disabled');
}

function newseventAddButton() {
	var today = new Date();
	var time = (today.getTime() / 1000) | 0;
	var listItem = $(this).parent();
        $.post("../php/command/ajaxcommandrunner.php",
		{
			obj: 'yes',
			type: 'newsevent',
			action: 'create-news-event',
			title: 'New News Story',
			keywords: 'keyword1, keyword2',
			description: 'description text',
			text: 'news text',
			stat: STATUS_PENDING,
			datedisplayed: time,
			newseventtype: TYPE_NEWS
		},
		function(data) {
			listItem.after(newNewseventHtml(data['newsevent']));	
			newsEvent.id = data['newsevent']['id'];
			refreshNewsEvent(data['newsevent']);
		}, "json"
	);
}

function newNewseventHtml(newsevent) {
	var html = "<li><table>";
		html += "<tr><td class='title-cell'><a class='news-button'>";
		html += newsevent['title'];
		html += "</a></td></tr>";
		html += "</table></li>";
	return html;
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
                         +"<span class='pending'>pending</span>"
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
			that.before(childMenuItem(data['page']));
			$("a.page-button").click(getPageButton);
			$("a.delete-button").click(grandchildDeleteButton);
			$("a.add-grandchild-button").click(grandchildAddButton);
			$("a.pages-toggle-button").click(grandchildrenToggle); 
			page.id = data['page']['id']
			fetchPage(page.id);
                },
                "json"
        );
        
}

function childMenuItem(page) {
	var childMenuItem = "<li><a class='page-button' id='" + page['id'] + "'>"+ page['title'] + "</a>\n"
		 + "<a class='pages-toggle-button'><img class='plus-minus-icon' src='img/icons/minus.gif'></a>\n"
		 + "<span class='child-buttons'>\n"
		 + "<a id='" + page['id'] + "' class='delete-button'>\n"
		 + "<img src='img/buttons/delete-button.gif' class='delete-button' /></a>\n"
		 + "<span class='status' id='" + page['id'] + "'>\n"
		 + "<span class='pending'>pending</span>\n"
		 + "</span>\n"
		 + "</span>\n"
		 + "<table>\n"
		 +	 "<tr>\n"
		 + 		"<td>\n"
		 +      	"<a class='add-grandchild-button' id='" + page['id'] + "'>\n"
		 +			  "<img src='img/buttons/add-child-button.gif' /></a>\n"
	         +		"</td>\n"
	         +		"<td></td>\n"
	         +		"<td></td>\n"
	         +        "</tr>\n"
		 + "</table>\n"
	         + "</li>\n"
	return childMenuItem;
}
