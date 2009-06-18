<?php
        include('../init.php');
        include('inc/fckeditor/fckeditor.php');


        //init fckeditor
        $fh = RequestRegistry::getFormHelper();
        $editor = $fh->getEditor('editor');
        
         
        
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
                       
                        $(document).ready(function() {
                                init_header();
                                $("#button").click(function() {
                                        alert(getfckval("editor"));
                                });
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

                                        <li><?php echo $child->getTitle(); ?>
                                                <?php if(count($level3) > 0): ?>
                                                  <ul>
                                                          <?php foreach ( $level3 as $grandchild ): ?>
                                                                <li><?php echo $grandchild->getTitle(); ?></li>
                                                          <?php endforeach ?>
                                                  </ul>
                                                <?php endif ?>
                                        </li>
                                <?php endforeach ?>
                                </ul>
                            </div>
                            <div id='col-2'>
                                <form id='page-form'>
                                  <label for='title'>Title: </label>
                                  <input class='text-input' type='text' id='title' name='title' value='' />

                                  <label for='introduction'>Introduction:</label>
                                  <input class='text-input' type='text' id='introduction' name='introduction' />

                                  <label for='meta-keywords'>Keywords:</label>
                                  <input class='text-input' type='text' id='meta-keywords' name='meta-keywords' />

                                  <label for='meta-description'>Description:</label>
                                  <input class='text-input' type='text' id='meta-description' name='meta-description' />

                                  <label for='content'>Content:</label>
                                  <?php $editor->Create(); ?><br />
                                  <a id='button' href='#'>Button</a>
                                </form>
                            </div>
                    </div><!-- /#main -->

                </div><!-- /#wrapper -->
                <script type='text/javascript'>
                        Cufon.now();
                </script> 
        </body>
</html>
