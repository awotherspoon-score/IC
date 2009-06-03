<?php include('inc/doctype.php'); ?>

<html>
<head>
<link rel='stylesheet' type='text/css' href='css/shared.css' />
<link rel='stylesheet' type='text/css' href='css/pcs-default.css' />
<link rel='stylesheet' type='text/css' href='css/prospective.css' />
<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='js/font/cufon-yui.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
<script type="text/javascript">
		Cufon.replace('h2', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('h3', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});

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
                <div id='top-nav'>
                        <ul id='top-nav-list'>
                                <li class='page-nav-link'><a href='#'>The School</a>
                                        <ul>
                                                <li><a href='#'>About The School</a></li>
                                                <li><a href='#'>Our Ethos</a></li>
                                                <li><a href='#'>The Immanuel Curriculum</a></li>
                                                <li><a href='#'>The Sixth Form</a></li>
                                                <li><a href='#'>Alumni</a></li>
                                        </ul>
                                </li>
                                <li class='page-nav-link'><a href='#'>Joining Us</a>
                                        <ul>
                                                <li><a href='#'>Open Day</a></li>
                                                <li><a href='#'>Entrance Requirements</a></li>
                                                <li><a href='#'>Admissions</a></li>
                                                <li><a href='#'>Fees</a></li>
                                                <li><a href='#'>Application Forms</a></li>
                                                <li><a href='#'>Staff</a></li>
                                        </ul>
                                </li>
                                <li class='page-nav-link'><a href='#'>Way of Life</a>
                                        <ul>
                                                <li><a href='#'>Nurturing Our Pupils</a></li>
                                                <li><a href='#'>Jewish Life and Learning</a></li>
                                                <li><a href='#'>Extra Curricular Activities</a></li>
                                        </ul>
                                </li>
                                <li class='nav-link'><a href='#'>News</a>
                                </li>
                                <li class='nav-link'><a href='#'>Events</a>
                                </li>
                                <li class='nav-link'><a href='#'/>Gallery</a></li>
                                <li class='nav-link'><a href='#'/>Contact Us</a></li>
                        </ul>
                </div><!-- /top-nav -->
	</div> <!-- /header -->
	
	<div id='main'>
		<p id='margin-spacer'>margin-spacer</p>
                <h1>Hello Sanuk Black</h1>
		
	</div><!-- /main -->
	<div class='cleardiv'></div>
                <?php include('inc/footer.php'); ?>
                <?php include('inc/actual-footer.php'); ?>
	</div><!-- /wrapper -->
<?php include('inc/analytics.php'); ?>
</body>

</html>
