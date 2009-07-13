<?php include('init.php'); ?>

<?php
	$slug = mysql_escape_string($_GET['slug']);
	$album = RequestRegistry::getAlbumMapper()->findBySlug($slug);
	$view = RequestRegistry::getViewHelper($album);
?>

<?php include('inc/doctype.php'); ?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='/css/shared.css' />
<link rel='stylesheet' type='text/css' href='/css/jquery.lightbox-0.5.css' />
<link rel='stylesheet' type='text/css' href='/css/pcs-default.css' />
<link rel='stylesheet' type='text/css' href='/css/current.css' />
<script type='text/javascript' src='/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='/js/jquery.dimensions.js'></script>
<script type='text/javascript' src='/js/jquery.tooltip.min.js'></script>
<script type='text/javascript' src='/js/jquery.lightbox-0.5.js'></script>
<script type='text/javascript' src='/js/font/cufon-yui.js'></script>
<script type='text/javascript' src='/js/font/Sanuk-Black_500.font.js'></script>
<script type='text/javascript' src='/js/font/Sanuk-Regular_500.font.js'></script>
<script type="text/javascript">
		Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                Cufon.replace('li ul li', { fontFamily: 'Sanuk-Regular'});
                Cufon.replace("#tooltip *", { fontFamily: 'Sanuk-Black'});
                Cufon.replace("body div#main div#sidebar div.sidebar-links-title p", { fontFamily: 'Sanuk-Black'});
                
                $(document).ready(function() {
		  $("a.image-link").lightBox();
                  var refreshed = false;
                  //drop down menus
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

                  //tooltips
                  $("div#section-select ul li#prospective-link a img").tooltip({
                        track: true,
                        showURL: false,
                        delay: 0,
                        extraClass: "prospective-tooltip"
                  });

                  $("div#section-select ul li#current-link a img").tooltip({
                        track: true,
                        showURL: false,
                        delay: 0,
                        extraClass: "current-tooltip"
                  });

                  $("div#section-select ul li#staff-link a img").tooltip({
                        track: true,
                        showURL: false,
                        delay: 0,
                        extraClass: "staff-tooltip"
                  });

                  $("div#section-select ul li a img").hover( function() {
                          Cufon.refresh();
                  });
                  
                });  
                
</script>

</head>
<body id='homepage'>
	<div id='wrapper'>
	<div id='header'>
		<div id='header-top'>	
		</div>
		
		<img id='header-image' alt='We nourish our pupils with an engaging focus on Jewish Tradition' src='/img/header-prospective.jpg' />
                <img alt='Testimonial' src='/img/testimonial-prospective.jpg' class='testimonial-image' id='prospective-testimonial-image' />
		
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
		<?php include('inc/pcs-buttons.php'); ?>
	</div> <!-- /header -->
	
	<div id='main'>
                <div class='cleardiv'></div>
                <div id='content'>
			<?php /*$view->breadcrumbs();*/ ?>
                        <h1><?= $album->getTitle() ?></h1>
			<?= $view->gallery_grid() ?>
			<p><?= date('l, jS F Y', $album->getDateDisplayed()) ?></p>
                </div>

		<?php /*$view->sidebar();*/ ?>
		
	</div><!-- /main -->
	<div class='cleardiv'></div>
                <?php include('inc/footer.php'); ?>
                <?php include('inc/actual-footer.php'); ?>
	</div><!-- /wrapper -->
<?php include('inc/analytics.php'); ?>
</body>

</html>