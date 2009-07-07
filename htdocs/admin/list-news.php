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
	$introEditor = $fh->getEditor('introduction', 'Basic', '100', null, '');

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
    var page = new Object();
    $(document).ready(function() {
		init_header();
		$("a.news-section-toggle-button").click(newsToggle); 
		/*
		$("a.news-button").click(getPageButton);
		$("#meta-inputs").hide();
		$("#save-button").click(updatePage);
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
     <li>
      <a class='add-child-button'>
      <img src='img/buttons/add-child-button.gif' />
      </a>
     </li>
  </ul>
 </div>
 <div id='col-2'>
		<form id='page-form'>
		
		  <label for='title'>Title: </label>
		  <input class='text-input' type='text' id='title' name='title' value='' />

		  <label for='status'>Status: </label>
		  <select name='status' id='status-input'>
			<option value=''>Pending</option>
			<option value=''>Live</option>
		  </select>
		

		  <a id='meta-toggle-button'>Meta Data <img src='img/icons/plus.gif' class='plus-minus-icon'/></a>

		  <div id='meta-inputs'>
			  <label for='meta-keywords'>Keywords:</label>
			  <input class='text-input' type='text' id='meta-keywords' name='meta-keywords' />

			  <label for='meta-description'>Description:</label>
			  <input class='text-input' type='text' id='meta-description' name='meta-description' />
		 </div><!-- /#meta-inputs -->

		  <label for='introduction'>Introduction:</label>
		  <?php $introEditor->Create(); ?>
		  <!-- <input class='text-input' type='text' id='introduction' name='introduction' /> -->

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
