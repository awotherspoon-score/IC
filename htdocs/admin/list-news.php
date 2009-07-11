<?php
        include('../init.php');

	//setup some helpers
        include('inc/fckeditor/fckeditor.php');
        $fh = RequestRegistry::getFormHelper();
	
		
	//if we're saving an event, send it to the database and set it as the event to show in the form
	if (isset($_POST['save-button'])) {
		$parameters = array('newsevent-id' => $_POST['id']);
		$newsevent = CommandRunner::run('get-news-event', $parameters)->get('newsevent');
		$newsevent->setContentType(NewsEvent::TYPE_NEWS);
		$newsevent->setDateDisplayed($fh->timestampFromPost());
		$newsevent->setTitle($_POST['title']);
		$newsevent->setKeywords($_POST['meta-keywords']);
		$newsevent->setDescription($_POST['meta-description']);
		$newsevent->setText($_POST['content']);
		$newsevent->setStatus($_POST['status']);
		CommandRunner::run('update-news-event', array('newsevent' => $newsevent));
	}

	//get the most recent news story to display if we didn't get anything on saving (above)
	if ( ! isset( $newsevent ) ) {
		$newsevent = CommandRunner::run('get-most-recent-news')->get('newsevent');	
	}


	//$news is an array of NewsEventCollections
	//e.g. array( 'section-1-heading' => NewsEventCollection $collection)
	//don't worry about including empty sections, we'll ignore them when we loop through later
	
	//to start lets add sections for recently edited news and future news
	$news = array(
		'recently-edited-news' => CommandRunner::run('get-recently-modified-news')->get('news'),
		'future-news' => CommandRunner::run('get-future-news')->get('news'),
	);

	//add a section each for the past three months
	$thisMonth = date('n');
	$threeMonthsAgo = $thisMonth - 3;
	$monthArray = $fh->getMonthArray();
	while ( $thisMonth > $threeMonthsAgo ) {
		$monthString = $monthArray[$thisMonth - 1]['name'];
		$news[$monthString] = CommandRunner::run('get-news-for-month', array( 'month' => $thisMonth ) )->get('news');
		$thisMonth--;
	}


	//add a section for each of the last ten years
	$thisYear = date('Y');
	$tenYearsAgo = $thisYear - 10;

	while ($thisYear > $tenYearsAgo) {
		$news[$thisYear] = CommandRunner::run('get-news-for-year', array('year' => $thisYear) )->get('news');
		$thisYear--;
	}

        //init fckeditor
        $editor = $fh->getEditor('content', 'Basic', null, null, $newsevent->getText());
	$dateInput = $fh->getDateInput( $newsevent->getDateDisplayed() );

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
		$("a#add-news-story-button").click( newseventAddButton );
		$("a.delete-button").click(newsEventDeleteButton);
		$("#meta-toggle-button").click(metaToggle); 
		$("#meta-inputs").hide();
		/*
		$("#meta-inputs").hide();
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

	<td class='delete-button-cell'>
	 <a class='delete-button' id='<?= $story->getId() ?>'>
	  <img src='img/buttons/delete-button.gif' class='delete-button' />
         </a>
	</td>

	<td class='status' id='<?= $story->getId() ?>'>
	 <?php if ($story->getStatus() == Content::STATUS_LIVE): ?>
	  <span class='live'>live</span> 
	 <?php else: ?>		
	  <span class='pending'>pending</span>
	 <?php endif ?>
	</td>

       </tr>	
      <?php endforeach ?>
     </table>

    </li>

   <?php endforeach ?>


  </ul>

 </div>
 <div id='col-2'>

 <form id='page-form' method='post' action='<?= $_SERVER['PHP_SELF'] ?>'>
 <label for='title'>Title: </label>
 <input class='text-input' type='text' id='title' name='title' value='<?= stripslashes( htmlentities( $newsevent->getTitle(), ENT_QUOTES ) ) ?>' />
 <label for='date-input'>Displayed Date: </label>
 <?= $dateInput ?>
 <label for='status'>Status: </label>
 <select name='status' id='status-input'>
 <option value='0'<?= ($newsevent->getStatus() == Content::STATUS_PENDING) ? ' selected' : '' ?>>Pending</option>
 <option value='1'<?= ($newsevent->getStatus() == Content::STATUS_LIVE) ? ' selected' : '' ?>>Live</option>
 </select>
 <a id='meta-toggle-button'>Meta Data <img src='img/icons/plus.gif' class='plus-minus-icon'/></a>

 <div id='meta-inputs'>
  <label for='meta-keywords'>Keywords:</label>
  <input class='text-input' type='text' id='meta-keywords' name='meta-keywords' value='<?= $newsevent->getKeywords() ?>' />
  <label for='meta-description'>Description:</label>
  <input class='text-input' type='text' id='meta-description' name='meta-description' value='<?= $newsevent->getDescription() ?>' />
 </div><!-- /#meta-inputs -->
 <label for='content'>Content:</label>
 <?php $editor->Create(); ?><br />

 <!-- 
 <p id='modify-date'>Last Modified On 
 <?php //echo date(' D M j Y ', $page->getDateModified()); ?>
  at
 <?php //echo date(' H:i ', $page->getDateModified()); ?>
 </p>
 -->
	 <input type='hidden' id='id' name='id' value='<?= $newsevent->getId() ?>' />
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
