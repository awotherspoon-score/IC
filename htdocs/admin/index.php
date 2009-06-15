<?php
        include('../init.php');
        $page = new Page();
?>
<?php include('../inc/doctype.php'); ?>
<html>
        <head>
                <title>Immanuel College Admin Panel</title>
                <link rel='stylesheet' type='text/css' href='css/style.css' />
                <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
                <script type='text/javascript' src='js/font/cufon-yui.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
                <script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
                <script type="text/javascript">
                        Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
                        Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                       
                        $(document).ready(function() {
                          $("ul#top-nav-list > li").hover(
                                  function() {
                                          $(this).find("ul").css({
                                                'display' : 'block',
                                                'z-index' : '1000'
                                          });
                                  },
                                  function() {
                                          $("ul", this).css("display", "none");
                                  }
                          );
                        });
                </script>
        </head>
        <body>
                <div id='wrapper'>

                    <div id='header'>
                            <div id='header-col-1'>
                                    <div id='header-image'>
                                            <img src='img/header.jpg' />
                                    </div>
                                    <?php include('inc/nav.php'); ?>
                            </div><!-- /#header-col-1 -->

                            <div id='header-col-2'>
                            </div><!-- /#header-col-2 -->
                    </div><!-- /#header -->

                    <div id='main'>
                            <div id='col-1'>
                            </div>
                            <div id='col-2'>
                            </div>
                    </div><!-- /#main -->

                </div><!-- /#wrapper -->
                <script type='text/javascript'>
                        Cufon.now();
                </script> 
        </body>
</html>
