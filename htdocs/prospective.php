<?php include('inc/doctype.php'); ?>

<html>
<head>
<link rel='stylesheet' type='text/css' href='css/shared.css' />
<link rel='stylesheet' type='text/css' href='css/pcs-default.css' />
<link rel='stylesheet' type='text/css' href='css/prospective.css' />
<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='js/jquery.dimensions.js'></script>
<script type='text/javascript' src='js/jquery.tooltip.min.js'></script>
<script type='text/javascript' src='js/font/cufon-yui.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
<script type="text/javascript">
		Cufon.replace('h2', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('h3', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                Cufon.replace('li ul li', { fontFamily: 'Sanuk-Regular'});
                Cufon.replace("#tooltip *", { fontFamily: 'Sanuk-Black'});
                
                $(document).ready(function() {
                  var refreshed = false;
                  //drop down menus
                  $("ul#top-nav-list > li").hover(
                          function() {
                                  $(this).find("ul").css("display", "block");
                          },
                          function() {
                                  $("ul", this).css("display", "none");
                          }
                  );

                  //tooltips
                  $("div#section-select ul li a img").tooltip({
                        track: true,
                        showURL: false,
                        delay: 0
                  });

                  $("div#section-select ul li a img").hover( function() {
                          Cufon.refresh();
                  });
                  
                });  
                
</script>

</head>
<body id='homepage'>
	<div id='wrapper'>
	<h1>Immanuel College</h1>
	<div id='header'>
		<div id='header-top'>	
		</div>
		
		<img id='header-image' alt='We nourish our pupils with an engaging focus on Jewish Tradition' src='img/header-prospective.jpg' />
                <img alt='Testimonial' src='img/testimonial-prospective.jpg' class='testimonial-image' id='prospective-testimonial-image' />
		
		<div id='search-box'>
			<form action='search.php' method='get'>
				<input type='text' name='search-key' id='search-key' value='Search' />
				<input type='submit' name='search' value='' id='search-button' />
			</form>
		</div>
		
		<div id='quick-links'>
			<select name='quick-links'>
				<option>Quick Links</option>
			</select>
		</div>
                <?php include('inc/nav.php'); ?>
                <div id='section-select'>
                        <ul>
                                <li id='prospective-link' class='selected'>
                                        <a href='#'>
                                                <img title='Prospective Students' src='img/buttons/prospective-button.gif' />
                                        </a>
                                </li>
                                <li id='current-link' class=''>
                                        <a href='#'>
                                                <img title='Current Students' src='img/buttons/current-button.gif' />
                                        </a>
                                </li>
                                <li id='staff-link'>
                                        <a href='#'>
                                                 <img title='Staff' src='img/buttons/staff-button.gif' />
                                        </a>
                                </li>
                        </ul>
                </div>
	</div> <!-- /header -->
	
	<div id='main'>
		<p id='margin-spacer'>margin-spacer</p>
                <div id='content'>
                        <div id='breadcrumb'>
                        </div>
                        <h1>Welcome Prospective Pupils and Parents</h1>


                </div>
                <div id='sidebar'>

                </div>
		
	</div><!-- /main -->
	<div class='cleardiv'></div>
                <?php include('inc/footer.php'); ?>
                <?php include('inc/actual-footer.php'); ?>
	</div><!-- /wrapper -->
<?php include('inc/analytics.php'); ?>
</body>

</html>
