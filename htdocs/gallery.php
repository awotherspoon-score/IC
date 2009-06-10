<?php include('inc/doctype.php'); ?>

<html>
<head>
<link rel='stylesheet' type='text/css' href='css/shared.css' />
<link rel='stylesheet' type='text/css' href='css/pcs-default.css' />
<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='js/jquery.dimensions.js'></script>
<script type='text/javascript' src='js/jquery.tooltip.min.js'></script>
<script type='text/javascript' src='js/font/cufon-yui.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Black_500.font.js'></script>
<script type='text/javascript' src='js/font/Sanuk-Regular_500.font.js'></script>
<script type="text/javascript">
		Cufon.replace('h1', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.page-nav-link>a', { fontFamily: 'Sanuk-Black'});
		Cufon.replace('li.nav-link>a', { fontFamily: 'Sanuk-Black'});
                Cufon.replace('li ul li', { fontFamily: 'Sanuk-Regular'});
                Cufon.replace("#tooltip *", { fontFamily: 'Sanuk-Black'});
                Cufon.replace("body div#main div#sidebar div.sidebar-links-title p", { fontFamily: 'Sanuk-Black'});
                
                $(document).ready(function() {
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
                <div class='cleardiv'></div>
                <div id='content'>
                        <div id='breadcrumb'>
                        <a href='#'>Home</a> | <a class='thispage' href='#'>Gallery</a>
                        </div>
                        <h1>Gallery</h1>
                        <p id='first-paragraph'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu sapien nisi, eu mollis nisl. Suspendisse id diam mauris, et rutrum tortor. Sed semper, turpis id tempus dictum, ipsum arcu facilisis odio, id vestibulum quam libero ac erat. Duis pharetra, sem vel sagittis sollicitudin, velit eros cursus diam, non convallis odio elit vel sem. Sed dictum est quis nibh mollis sit amet hendrerit ante fermentum. </p>

                        <table id='gallery-grid'>
                                <tr>
                                        <td>
                                                <img src='img/post-image.jpg' />
                                                <p class='gallery-caption'>consectetur adipiscing elit. Sed eu sapien nisi, eu </p>
                                                <p class='gallery-date'>15/08/2009</p>
                                        </td>
                                        <td>
                                                <img src='img/post-image.jpg' />
                                                <p class='gallery-caption'>consectetur adipiscing elit. Sed eu sapien nisi, eu </p>
                                                <p class='gallery-date'>15/08/2009</p>
                                        </td>
                                        <td>
                                                <img src='img/post-image.jpg' />
                                                <p class='gallery-caption'>consectetur adipiscing elit. Sed eu sapien nisi, eu </p>
                                                <p class='gallery-date'>15/08/2009</p>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                                <img src='img/post-image.jpg' />
                                                <p class='gallery-caption'>consectetur adipiscing elit. Sed eu sapien nisi, eu </p>
                                                <p class='gallery-date'>15/08/2009</p>
                                        </td>
                                        <td>
                                                <img src='img/post-image.jpg' />
                                                <p class='gallery-caption'>consectetur adipiscing elit. Sed eu sapien nisi, eu </p>
                                                <p class='gallery-date'>15/08/2009</p>
                                        </td>
                                        <td>
                                                <img src='img/post-image.jpg' />
                                                <p class='gallery-caption'>consectetur adipiscing elit. Sed eu sapien nisi, eu </p>
                                                <p class='gallery-date'>15/08/2009</p>
                                        </td>
                                </tr>
                        </table>

                </div>
                <div id='sidebar'>
                <div class='sidebar-links-title'>
                  <p>Gallery Archive</p>
                </div>
                <ul class='sidebar-links-list'>
                        <li><a href='#'>June</a></li>
                        <li><a href='#'>May</a></li>
                        <li><a href='#'>April</a></li>
                        <li><a href='#'>2009</a></li>
                        <li><a href='#'>2008</a></li>
                        <li><a href='#'>2007</a></li>
                </ul>
                <div class='sidebar-links-title'>
                  <p>June</p>
                </div>
                <ul class='sidebar-links-list'>
                        <li><a href='#'>Sports Day</a></li>
                        <li><a href='#'>Visiting Knebworth</a></li>
                        <li><a href='#'>Comic Relief Day</a></li>
                        <li><a href='#'>Religious Festival</a></li>
                        <li><a href='#'>Year 3 Dance</a></li>
                <img src='img/post-image.jpg' id='post-image' />


                </div>
		
	</div><!-- /main -->
	<div class='cleardiv'></div>
                <?php include('inc/footer.php'); ?>
                <?php include('inc/actual-footer.php'); ?>
	</div><!-- /wrapper -->
<?php include('inc/analytics.php'); ?>
</body>

</html>
