<?php
        include('../init.php');
        include('inc/fckeditor/fckeditor.php');

        //get page from $_GET
	$news = array(
		'future-news' => CommandRunner::run('get-future-news')->get('news'),
		'recent-news' => CommandRunner::run('get-recent-news')->get('news')
	);


	$thisYear = date('Y');
	$tenYearsAgo = $thisYear - 10;

	while ($thisYear > $tenYearsAgo) {
		$news[$thisYear] = CommandRunner::run('get-news-for-year', array('year' => $thisYear) )->get('news');
		$thisYear--;
	}


	/*
        $page = $context->get('page');
        $level2 = $page->getChildren();
	*/

        //init fckeditor
        $fh = RequestRegistry::getFormHelper();
        $editor = $fh->getEditor('content', 'Basic', null, null, '');
	$dateInput = $fh->getGenericDateInput();

?>
<?php include('../inc/doctype.php'); ?>
<html>
 <head>
  <title>Immanuel College Admin Panel</title>
  <link rel='stylesheet' type='text/css' href='css/style.css' />
  <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
  <script type='text/javascript' src='js/generic-functions.js'></script>
  <script type='text/javascript' src='js/news-functions.js'></script>
  <script type='text/javascript' src='js/font/cufon-yui.js'></script>
  <script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
  <script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
  <script type="text/javascript">
   Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
   Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
   Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
   Cufon.replace('div#home-show-links a', { fontFamily: 'Sanuk-Black'});
   var newsEvent = new Object();
    $(document).ready(function() {
		init_header();
		newsEvent.id=0;
		$("a.news-section-toggle-button").click(newsToggle); 
		$("a.news-section-button").click(newsToggle); 
		$("a.news-button").click(getNewsButton);
		$("#save-button").click(updateNewsEvent);
		/*
		$("#meta-inputs").hide();
		$("#meta-toggle-button").click(metaToggle); 
		$("a.delete-button").click(grandchildDeleteButton);
		$("a.add-grandchild-button").click(grandchildAddButton);
		$("a.add-child-button").click(childAddButton);

		$("#status-input").attr('disabled', 'disabled');	
		$("#title").attr('disabled', 'disabled');	
		*/

	});
  </script>
 </head>
<body>
<div id='wrapper'>

<?php include('inc/header.php'); ?>
<div id='main'>
 <div id='col-1'>

  <span class='table-headers'>
   <span class='delete-header'>Delete</span>&nbsp;
   <span class='status-header'>Status</span>
  </span>

  <ul>
     <li>
      <a id='add-news-story-button'>
	Add News Story
      </a>
     </li>

   <?php foreach($news as $section => $stories): 

    if (count($stories) == 0) { continue; } ?>
    <li>

     <a class='news-section-button' ><?php echo ucwords(str_replace('-', ' ', $section)) ?></a>
     <a class='news-section-toggle-button'><img class='plus-minus-icon' src='img/icons/minus.gif'></a>

     <table>
      <?php foreach ($stories as $story): ?>
       <tr>
        <td class='title-cell'>
	 <a class='news-button' id='<?= $story->getId() ?>'>
	 <?= $story->getTitle() ?>
	 </a>
        </td>
       </tr>	
      <?php endforeach ?>
     </table>

    </li>

   <?php endforeach ?>


  </ul>

 </div>
 <div id='col-2'>

<form id='page-form'>
 <label for='title'>Title: </label>
 <input class='text-input' type='text' id='title' name='title' value='' />
 <label for='date-input'>Displayed Date: </label>
 <?= $dateInput ?>
 <label for='status'>Status: </label>
 <select name='status' id='status-input'>
  <option value='0'>Pending</option>
  <option value='1'>Live</option>
 </select>
 <a id='meta-toggle-button'>Meta Data <img src='img/icons/plus.gif' class='plus-minus-icon'/></a>

 <div id='meta-inputs'>
  <label for='meta-keywords'>Keywords:</label>
  <input class='text-input' type='text' id='meta-keywords' name='meta-keywords' />
  <label for='meta-description'>Description:</label>
  <input class='text-input' type='text' id='meta-description' name='meta-description' />
 </div><!-- /#meta-inputs -->
 <label for='content'>Content:</label>
 <?php $editor->Create(); ?><br />
  
 <p id='modify-date'>Last Modified On 
 <?php //echo date(' D M j Y ', $page->getDateModified()); ?>
  at
 <?php //echo date(' H:i ', $page->getDateModified()); ?>
 </p>
 <input type='submit' value='Save' name='save-button' id='save-button' />
</form>
	    </div>
    </div><!-- /#min -->

</div><!-- /#wrapper -->
<script type='text/javascript'>
	Cufon.now();
</script> 
</body>
</html>
