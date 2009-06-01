<?php include('inc/doctype.php'); ?>

<html>
<head>
<link rel='stylesheet' type='text/css' href='css/shared.css' />
<link rel='stylesheet' type='text/css' href='css/prospective.css' />
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/font/cufon-yui.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
<script type="text/javascript">
		Cufon.replace('h2');
		Cufon.replace('h3');
</script>

</head>
<body id='homepage'>
	<div id='wrapper'>
	<h1>Immanuel College</h1>
	<div id='header'>
		<div id='header-top'>	
		</div>
		
		<img id='header-image' alt='We nourish our pupils with an engaging focus on Jewish Tradition' src='img/header-prospective.jpg' />
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

	</div> <!-- /header -->
	
	<div id='main'>
		<p id='margin-spacer'>margin-spacer</p>
		
	</div><!-- /main -->
	<div class='cleardiv'></div>
	<div id='footer'>
		<div id='footer-col-123'>
		
			<div id='footer-col-12'>
			
				<div class='footer-column' id='footer-col-1'>
                                        <h4>The School</h4>
                                        <ul>
                                                <li><a href='#'>About The School</a></li>
                                                <li><a href='#'>Our Ethos</a></li>
                                                <li><a href='#'>The Immanuel College</a></li>
                                                <li><a href='#'>The Sixth Form</a></li>
                                                <li><a href='#'>Alumni</a></li>
                                        </ul>
				</div><!-- /footer-col-1 -->
				
				<div class='footer-column' id='footer-col-2'>
                                        <h4>Joining Us</h4>
                                        <ul>
                                                <li><a href='#'>Open Day</a></li>
                                                <li><a href='#'>Entrance Requirements</a></li>
                                                <li><a href='#'>Admissions</a></li>
                                                <li><a href='#'>Fees</a></li>
                                                <li><a href='#'>Application Forms</a></li>
                                                <li><a href='#'>Staff</a></li>
                                        </ul>
				</div><!-- /footer-col2 -->
				
			</div><!-- /footer-col-12 -->
			
			<div class='footer-column' id='footer-col-3'>
                                <h4>Way of Life</h4>
                                <ul>
                                        <li><a href='#'>Nurturing Our Pupils</a></li>
                                        <li><a href='#'>Jewish Life And Learning</a></li>
                                        <li><a href='#'>Extra Curricular Activities</a></li>
                                </ul>

			</div><!-- /footer-col-3 -->
			
		</div><!-- /footer-col-123 -->
		
		<div class='footer-column' id='footer-col-4'>
                        <ul>
                                <li><a href='#'>News</a></li>
                                <li><a href='#'>Events</a></li>
                                <li><a href='#'>Gallery</a></li>
                                <li><a href='#'>Contact Us</a></li>
                        </ul>
		</div><!-- /footer-col-4 -->
	</div><!-- /footer -->
        <div id='actual-footer'>
                <div id='footer-nav'>
                        <a href='#'>Contact</a> 
                        <a href='#'>Sitemap</a> 
                        <a href='#'>Policies</a> 
                        <a href='#'>Links</a> 
                </div>

                <div id='footer-copyright'>
                        Copyright &copy <?= date('Y'); ?> Immanuel College
                        <a href='#'>Website By <img src='img/icons/score-logo.jpg' />Scorecomms</a>
                </div>
        </div>
	</div><!-- /wrapper -->
</body>

</html>
