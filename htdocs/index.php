<?php include('inc/doctype.php'); ?>

<?php include( 'init.php' ); ?>

<html>
<head>
<link rel='stylesheet' type='text/css' href='css/shared.css' />
<link rel='stylesheet' type='text/css' href='css/home.css' />
<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
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
		
		<img id='header-image' alt='Immanuel College Banner Image' src='img/header.jpg' />
		<ul id='pcs-nav'>
				<li class='has-margin'><a href='/prospective/'><img src='img/buttons/home-prospective.jpg' /></a></li>
				<li class='has-margin'><a href='/current/'><img src='img/buttons/home-current.jpg' /></a></li>
				<li><a href='/staff/'><img src='img/buttons/home-staff.jpg' /></a></li>
		</ul>
		
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
		<div id='col-123'>
		
			<div id='col-12'>
			
				
				<div class='column' id='col-2'>
					<a href='http://google.com/'>
					<h2 class='cufoned-headers'>Welcome</h2></a>
					<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance.</p>
				</div><!-- /col2 -->
				<div class='column' id='col-1'>
					
					<div id='showcase'>
						<h4>SHOWCASE</h4>
						<img src='img/showcase/showcase1.jpg' />
						<div id='showcase-box'> <!-- little box inside showcase box -->
							<h5>Year 7 Boys</h5>
							<p>Find out what the young men are focusing on this month...</p>
						</div><!-- /showcase-box -->
					</div><!-- /showcase -->
					
					<div id='download-prospectus-button'>
						<a href='#'>Download or request a Prospectus</a>
					</div>
					
				</div><!-- /col1 -->
				
			</div><!-- /col-12 -->
			
			<div class='column' id='col-3'>
				<div id='news-column'>
						<h3 class='cufoned-headers'>News</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet arcu dui. <a href='#' class='morelink'>more</a></p>
						<p>Lorem ipsum dolor sit amet. Cras sit amet arcu dui. <a href='#' class='morelink'>more</a></p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet arcu dui. <a href='#' class='morelink'>more</a></p>
						<div class='rss-box'>
							<a href=''><img src='img/icons/big-rss-icon.jpg' /></a>
							<p class='rss-box-text'><a href=''>Subscribe</a> to receive updates<br /><a href=''>What is RSS?</a></p>
						</div>
				</div><!-- /news-column -->
			</div><!-- /col-3 -->
			
		</div><!-- /col-123 -->
		<div class='column' id='col-4'>
			<div id='events-column'>
				<h3 class='cufoned-headers'>Calendar</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href='#' class='morelink'>more</a></p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet arcu dui. <a href='#' class='morelink'>more</a></p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet arcu dui. <a href='#' class='morelink'>more</a></p>
					<div class='rss-box'>
							<a href=''><img src='img/icons/big-rss-icon.jpg' /></a>
							<p class='rss-box-text'><a href=''>Subscribe</a> to receive updates<br /><a href=''>What is RSS?</a></p>
					</div>
			</div>
		</div><!-- /col-4 -->
		
	</div><!-- /main -->
	<div class='cleardiv'></div>

        <?php include('inc/footer.php'); ?>
        <?php include('inc/actual-footer.php'); ?>
        
	</div><!-- /wrapper -->
<?php include('inc/analytics.php'); ?>
</body>

</html>
