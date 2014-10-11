<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo the_title(); ?> - Tammy Battle</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo get_template_directory_uri() ?>/assets/css/style.css" type="text/css" rel="stylesheet" /> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="container">
				<div class="row" style="padding-top: 10px; margin-bottom: 25px;">
					<a href="<?php echo home_url() ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/tammy-battle-logo.png" width="285px" height="50px" /></a>
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => false ) ); ?>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="container">
				<div class="row">
					<div id="left-col" class="col-md-8">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="row post frost pad">
								<h1><?php the_title(); ?></h1>
								<?php the_content() ?>
							</div>
						<?php endwhile; endif; ?>

					</div>
					<div id="right-col" class="col-md-3">
						<div class="row frost pad">
							<h2>Live Concert in Goldsboro, NC</h2>
							<p>On Saturday, November 8th (2014), Tammy will return to her hometown of Goldsboro, NC for a live concert. Be there as she presents her new single, "Broken", before a live audience.</p>
							<table class="table">
								<tbody>
									<tr>
										<td>Date</td>
										<td>Saturday, November 8th, 2014</td>
									</tr>
									<tr>
										<td>Time</td>
										<td>6:00PM</td>
									</tr>
									<tr>
										<td>Location</td>
										<td>
											Paramount Theatre<br />
											139 S. Center St<br />
											Goldsboro, NC
										</td>
									</tr>
								</tbody>
							</table>
							<p><a href="<?php echo home_url('concert') ?>" class="button wide"><i class="fa fa-credit-card"></i> Buy Ticket</a></p>
							<?php
								$tweet = "?url=" . urlencode( "http://bit.ly/1o25QAg" );
								$tweet .= "&original_referer=" . urlencode( home_url() . $_SERVER['REQUEST_URI'] );
								$tweet .= "&text=" . urlencode( "@Tammy_Battle performs her new single \"Broken\" 11/8/14" );
								$tweet .= "&hashtags=" . urlencode( "BrokenLive,NewMusic" );
								$tweet .= "&related=" . urlencode( "@Tammy_Battle" );
							?>
							<a class="button wide twitter-blue" href="https://twitter.com/intent/tweet<?php echo $tweet ?>" data-text="Have you heard? @Tammy_battle is"><i class="fa fa-twitter"></i> #brokenLive</a>
						</div>
						<div class="row white pad">
							<h2>About Tammy</h2>
							<img class="pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/tammy-profile-pic.jpg" height="150" style="margin-right: 15px;" />
							<p>Tammy Battle is an American singer-songwriter. Known for her theatrical arrangements, convicting lyrics and beautiful tone, it's easy for listeners to get consumed in a sound dubbed, "acoustic-pop-soul." While her music is unapologetically Gospel, her lyrics remain relevant to anyone who's struggled in their faith and found themselves with unanswered questions.</p>
							<a class="twitter-follow-button"
							  href="https://twitter.com/tammy_battle"
							  data-show-count="false"
							  data-lang="en">
							Follow @Tammy_Battle
							</a>
							<script type="text/javascript">
							window.twttr = (function (d, s, id) {
							  var t, js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src= "https://platform.twitter.com/widgets.js";
							  fjs.parentNode.insertBefore(js, fjs);
							  return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
							}(document, "script", "twitter-wjs"));
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid" style="background-color: #eee; padding-top: 15px;">
			<div class="container">
				<div class="row">
					<?php date_default_timezone_set('America/New_York'); ?>
					<p>&copy; <?php echo date('Y'); ?> <strong>Tammy Battle</strong>. All Rights Reserved.</p>
				</div>
			</div>
		</div>
	</body>
</html>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-26588142-3', 'auto');
  ga('send', 'pageview');

</script>