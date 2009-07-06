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
                        });
                </script>
        </head>
        <body>
                <div id='wrapper'>
			<?php include('inc/header.php'); ?>

                    <div id='main'>
                            <div id='col-1'>
                            </div>
                            <div id='col-2'>
			    	<form id='gallery-form'>
					<fieldset>
					<legend>Gallery Info</legend>
						<label for='title'>Title:</label>
						<input name='title' id='title' type='text' class='text-input' />
						<label for='display-date'>Display Date:</label>
						<span>Insert Date Input Here</span>
					</fieldset>

					<fieldset>
						<legend>News/Event Associations</legend>
						<select name='news'>
						</select>

						<select name='events'>
						</select>

						<input type='submit' name='new-news' id='new-news' value='Create New News Story' />
						<input type='submit' name='new-event' id='new-event' value='Create New Event' />
						<a href='#' id='edit-associated'>Edit Associated News/Events</a>
					</fieldset>

					<fieldset>
						<legend>Images</legend>
						<table>
							<thead>
								<th></th>
								<th>Caption</th>
								<th>Thumbnail</th>
								<th>Prospective</th>
								<th>Current</th>
								<th>Staff</th>
								<th>FeatureImage</th>
							</thead>
							<tbody>
								<tr>
								<td><input type='checkbox'></input></td>
								<td>Caption</td>
								<td>Thumbnail Image</td>
								<td><input type='checkbox'></input></td>
								<td><input type='checkbox'></input></td>
								<td><input type='checkbox'></input></td>
								<td><input type='radio'></input></td>
								</tr>
							</tbody>
						</table>	
					</fieldset>
				</form>
                            </div>
                    </div><!-- /#main -->

                </div><!-- /#wrapper -->
                <script type='text/javascript'>
                        Cufon.now();
                </script> 
        </body>
</html>
