<?php
        include('../init.php');

        
        //get content
        $page = RequestRegistry::getPageMapper()->find($_GET['id']);
        $level2 = $page->getChildren();


?>
<?php include('../inc/doctype.php'); ?>
<html>
        <head>
                <title>Immanuel College Admin Panel</title>
                <link rel='stylesheet' type='text/css' href='css/style.css' />
                <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
                <script type='text/javascript' src='js/documentation.js'></script>
                <script type='text/javascript' src='js/jquery.MetaData.js'></script>
                <script type='text/javascript' src='js/jquery.form.js'></script>
                <script type='text/javascript' src='js/jquery.FCKEditor.js'></script>
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
                                $("#content").fck({
                                        path: 'fckeditor/'
                                });

                                $("#button").click(function() {
                                        alert(setfckval("content", "butt"));
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
                                  <input type='text' id='title' name='title' value='' />

                                  <label for='introduction'>Introduction:</label>
                                  <input type='text' id='introduction' name='introduction' />

                                  <label for='content'>Content:</label>
                                  <textarea id='content'></textarea>
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
