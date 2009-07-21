<?php
        include('../init.php');
        include('inc/fckeditor/fckeditor.php');

    $page_mapper = RequestRegistry::getPageMapper();
	$page = $page_mapper->findPcsPage( $_REQUEST['code'] );

	if ( isset ( $_POST['save-button'] ) ) {
		$page->setTitle( $_POST['title'] );
		$page->setStatus( $_POST['status'] );
		$page->setKeywords( $_POST['meta-keywords'] );	
		$page->setDescription( $_POST['meta-description'] );
		$page->setText( $_POST['content'] );
		$page->setIntroduction( $_POST['introduction'] );
		RequestRegistry::getPageMapper()->update( $page );
	}

        //init fckeditor
        $fh = RequestRegistry::getFormHelper();
        $editor = $fh->getEditor('content', 'Basic', null, null, stripslashes(
	$page->getText() ));
	$introEditor = $fh->getEditor('introduction', 'Basic', '100', null, stripslashes(
	$page->getIntroduction() ));

        $suggested_links = $page_mapper->findSuggestedLinksForPage( $page->getId() );
?>
<?php include('../inc/doctype.php'); ?>
<html>
        <head>
                <title>Immanuel College Admin Panel</title>
                <link rel='stylesheet' type='text/css' href='css/style.css' />
                <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
                <script type='text/javascript' src='js/generic-functions.js'></script>
                <script type='text/javascript' src='js/pcs-functions.js'></script>
                <script type='text/javascript' src='js/font/cufon-yui.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
                <script type="text/javascript">
                        Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('div#home-show-links a', { fontFamily: 'Sanuk-Black'});
                        var page = new Object();
                        page.id = <?= $page->getId() ?>;

                </script>

        </head>

        <body>
                <div id='wrapper'>

                        <?php include('inc/header.php'); ?>
                    <div id='main'>
                            <div id='col-1'>
                               <h3 id='suggested-link-header'>Suggested Links</h3>
                               <ul id='suggested-links-list'>
                                    <?php foreach( $suggested_links as $link ): ?>
                                        <li><?= $link['anchor_text'] ?><br />
					<span class='suggested-link-href'>
					<?= $link['href'] ?>
					</span>
					</li>
                                    <?php endforeach ?>
                               </ul>
                                
                              <label for='href'>URL:</label>
                              <input type='text' name='href' id='href' />
                              <label for='anchor-text'>Anchor Text:</label>
                              <input type='text' name='anchor-text' id='anchor-text' />
                              <br />
                              
                              <a id='add-suggested-link-button'>Add Suggested Link</a>
                                
			    	
                            </div>
                            <div id='col-2'>
                                <form id='page-form' method='POST' action='<?= $_SERVER['PHP_SELF'] ?>' >
				
                                  <label for='title'>Title: </label>
                                  <input class='text-input' type='text' id='title'
				  name='title' value='<?= htmlentities( stripslashes(
					  $page->getTitle() ), ENT_QUOTES) ?>' />

				  <label for='status'>Status: </label>
				  <select name='status' id='status-input'>
				  	<option value='<?= Content::STATUS_PENDING ?>'<?= ($page->getStatus() == Content::STATUS_PENDING) ? ' selected' : '' ?>>Pending</option>
				  	<option value='<?= Content::STATUS_LIVE ?>'<?= ($page->getStatus() == Content::STATUS_LIVE) ? ' selected' : '' ?>>Live</option>
				  </select>

				  <a id='meta-toggle-button'>Meta Data <img src='img/icons/plus.gif' class='plus-minus-icon'/></a>

				  <div id='meta-inputs'>
					  <label for='meta-keywords'>Keywords:</label>
					  <input value='<?= htmlentities( stripslashes( $page->getKeywords()
					  ), ENT_QUOTES ) ?>' class='text-input' type='text' id='meta-keywords' name='meta-keywords' />

					  <label for='meta-description'>Description:</label>
					  <input value='<?= htmlentities( stripslashes(
						  $page->getDescription() ) ) ?>' class='text-input' type='text' id='meta-description' name='meta-description' />
				 </div><!-- /#meta-inputs -->

                                  <label for='introduction'>Introduction:</label>
				  <?php $introEditor->Create(); ?>
                                  <!-- <input class='text-input' type='text' id='introduction' name='introduction' /> -->
                                  <label for='content'>Content:</label>
                                  <?php $editor->Create(); ?><br />
				  
				  <p id='modify-date'>Last Modified On 
				  <?php echo date(' D M j Y ', $page->getDateModified()); ?>
			          at
				  <?php echo date(' H:i ', $page->getDateModified()); ?>
				  </p>
				  <input type='hidden' value='<?= $_GET['code'] ?>' name='code' />
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
