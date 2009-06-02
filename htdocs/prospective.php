<?php include('inc/doctype.php'); ?>

<html>
<head>
<link rel='stylesheet' type='text/css' href='css/shared.css' />
<link rel='stylesheet' type='text/css' href='css/pcs-default.css' />
<link rel='stylesheet' type='text/css' href='css/prospective.css' />
<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='js/font/cufon-yui.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
<script type="text/javascript">
		Cufon.replace('h2');
		Cufon.replace('h3');
		Cufon.replace('#top-nav');
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
                <!--
		<ul id='pcs-nav'>
				<li class='has-margin'><a href='#'><img src='img/buttons/home-prospective.jpg' /></a></li>
				<li class='has-margin'><a href='#'><img src='img/buttons/home-current.jpg' /></a></li>
				<li><a href='#'><img src='img/buttons/home-staff.jpg' /></a></li>
		</ul>
                -->
		
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
                <div id='top-nav'>
                        <ul>
                                <li class='page-nav-link'>The School</li>
                                <li class='page-nav-link'>Joining Us</li>
                                <li class='page-nav-link'>Way of Life</li>
                                <li class='nav-link'>News</li>
                                <li class='nav-link'>Events</li>
                                <li class='nav-link'>Gallery</li>
                                <li class='nav-link'>Contact Us</li>
                        </ul>
                </div><!-- /top-nav -->
	</div> <!-- /header -->
	
	<div id='main'>
		<p id='margin-spacer'>margin-spacer</p>
		
	</div><!-- /main -->
	<div class='cleardiv'></div>
                <?php include('inc/footer.php'); ?>
                <?php include('inc/actual-footer.php'); ?>
	</div><!-- /wrapper -->
<?php include('inc/analytics.php'); ?>
</body>

</html>
