<?php
        include('../init.php');
        include('inc/fckeditor/fckeditor.php');


        //init fckeditor
        $fh = RequestRegistry::getFormHelper();
        $editor = $fh->getEditor('content');
	$introEditor = $fh->getEditor('introduction', 'Basic', '100');
        
        //get page from $_GET
        $context = CommandRunner::run('get-page', array('page-id' => $_GET['id']));

        $page = $context->get('page');
        $level2 = $page->getChildren();


?>
<?php include('../inc/doctype.php'); ?>
<html>
        <head>
                <title>Immanuel College Admin Panel</title>
                <link rel='stylesheet' type='text/css' href='css/style.css' />
                <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
                <script type='text/javascript' src='js/functions.js'></script>
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
                                page.id = <?php echo $page->getId() ?>;
                                fetchPage(page.id);
				$("#meta-inputs").hide();
                                $("a.page-button").click(getPageButton);
				$("#save-button").click(updatePage);


				$("#meta-toggle-button").click(metaToggle); 
				$("a.pages-toggle-button").click(grandchildrenToggle); 


                        });
                </script>
        </head>
        <body>
                <div id='wrapper'>

                        <?php include('inc/header.php'); ?>
                    <div id='main'>
                            <div id='col-1'>
                                <ul>
                                <?php foreach($level2 as $child):
                                        $level3 = $child->getChildren(); ?>

                                        <li><a href='#' class='page-button' id='<?php echo $child->getId() ?>'><?php echo $child->getTitle(); ?></a>
                                                <?php if(count($level3) > 0): ?>
						 <a href='#' class='pages-toggle-button'><img class='plus-minus-icon' src='img/icons/minus.gif'></a>
                                                 <table>
                                                          <?php foreach ( $level3 as $grandchild ): ?>

                                                                <tr>

                                                                  <td class = 'title-cell'>
                                                                    <a href='#' class='page-button' id='<?php echo $grandchild->getId(); ?>'>
                                                                    <?php echo $grandchild->getTitle(); ?>
                                                                    </a>
                                                                  </td>

                                                                  <td>
                                                                  </td>

                                                                  <td>
                                                                  </td>

                                                                  <td>
                                                                  </td>
                                                                </tr>
                                                          <?php endforeach ?>
                                                          <tr>
                                                                <td>Add New</td></td>
                                                          </tr>
                                                </table>
                                                <?php endif ?>
                                        </li>
                                <?php endforeach ?>
                                </ul>
                            </div>
                            <div id='col-2'>
                                <form id='page-form'>
				
                                  <label for='title'>Title: </label>
                                  <input class='text-input' type='text' id='title' name='title' value='' />

				  <a href='#' id='meta-toggle-button'>Meta Data <img src='img/icons/plus.gif' class='plus-minus-icon'/></a>

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
				  
				  <p id='modify-date'></p>
			          <input type='submit' value='Save' name='save-button' id='save-button' />
                                </form>
                            </div>
                    </div><!-- /#main -->

                </div><!-- /#wrapper -->
                <script type='text/javascript'>
                        Cufon.now();
                </script> 
        </body>
</html>
