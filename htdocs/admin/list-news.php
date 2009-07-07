<?php
        include('../init.php');
        include('inc/fckeditor/fckeditor.php');

        //get page from $_GET
        $context = CommandRunner::run('get-all-news', array());
	$news_sections = array();

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
				/*
				$("#meta-inputs").hide();
                                $("a.page-button").click(getPageButton);
				$("#save-button").click(updatePage);
				$("#meta-toggle-button").click(metaToggle); 
				$("a.pages-toggle-button").click(grandchildrenToggle); 
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
                                <?php foreach($news as $story): ?>

                                        <li><a class='page-button' id='<?php echo $story->getId() ?>'><?php echo $story->getTitle(); ?></a>
						 <a class='pages-toggle-button'><img class='plus-minus-icon' src='img/icons/minus.gif'></a>

                                                 <span class='story-buttons'>
                                                  <a id='<?= $story->getId() ?>' class='delete-button'>
                                                    <img src='img/buttons/delete-button.gif' class='delete-button' /></a>
                                                  <span class='status' id='<?= $story->getId() ?>'>
                                                  <?php if ( $story->getStatus() == Page::STATUS_LIVE ): ?>
                                                    <span class='live'>live</span>
                                                  <?php else: ?>
                                                    <span class='pending'>pending</span>
                                                  <?php endif ?>
                                                  </span>
                                                  </span>
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
