<?php
	/*
	Template Name: Download Page
	*/

	if ( is_user_logged_in() ) {
		
		global $current_user;
      	get_currentuserinfo();

      	$first_name = isset( $current_user ) ? $current_user->user_firstname : '';
      	$last_name = isset( $current_user ) ? $current_user->user_lastname : '';
      	$email = isset( $current_user ) ? $current_user->user_email : '';

	} else {

		$first_name = '';
		$last_name = '';
		$email = '';

	}

	$stripe_mode = get_option('stripe_mode');

	if ( $stripe_mode ) {
		$stripe_key = get_option('stripe_live_public_key');
	} else {
		$stripe_key = get_option('stripe_test_public_key');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo the_title(); ?> - Tammy Battle</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo get_template_directory_uri() ?>/assets/css/style.css" type="text/css" rel="stylesheet" />

		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="https://checkout.stripe.com/checkout.js"></script>
		<?php wp_head(); ?>
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
						<div class="row white pad">
						
							<?php if ( isset( $_REQUEST['payment_id']) ): ?>

								<h4>Payment Success. Thank You for your support!</h4>
								<p>Your payment was successfuly submitted! A receipt has been emailed to you. If you do not receive a receipt within 24hrs or have trouble downloading your copy of "Broken", please email tammy@tammybattle.com.</p>
								<!-- <p><a class="button wide twitter-blue" href="<?php echo home_url('download?payment_id=' . $_REQUEST['payment_id']); ?>">Download</a></p> -->
								<p><a class="button wide twitter-blue" href="http://tammybattle.com/wp-content/uploads/sites/7/2014/10/01-Broken.mp3" download="01-Broken.mp3">Download</a></p>
								
								<?php
									$tweet = "?url=" . urlencode( "http://tammybattle.com/broken-single" );
									$tweet .= "&original_referer=" . urlencode( home_url() . $_SERVER['REQUEST_URI'] );
									$tweet .= "&text=" . urlencode( "Just downloaded @Tammy_Battle's new single \"Broken\"" );
									$tweet .= "&hashtags=" . urlencode( "Broken,NewMusicTuesday" );
									$tweet .= "&related=" . urlencode( "@Tammy_Battle" );
								?>
								<p><a class="button wide clear" href="https://twitter.com/intent/tweet<?php echo $tweet ?>"><i class="fa fa-twitter"></i> Spread The Word</a></p>

								
							<?php else: ?>

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									
									<h1><?php the_title(); ?></h1>
									<?php the_content() ?>
								
								<?php endwhile; endif; ?>

								<h2>iTunes?</h2>
								<p>If you have an iPhone or iPad,<a href="https://itunes.apple.com/us/album/broken-single/id930896157"> download from iTunes</a>.</p>
								<h2>Droid?</h2>
								<p>Download the single directly from this secure form, or wait 2 weeks for it to be available in Google Play. Yeah we knew you couldn't wait that long.</p>
								<form class="form-horizontal" role="form" action="" method="POST">
									<div class="form-group">
										<label for="first_name" class="col-sm-3 control-label">First Name</label>
									    <div class="col-sm-9">
									    	<input type="first_name" class="form-control required" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $first_name ?>">
									    </div>
									</div>
									<div class="form-group">
										<label for="last_name" class="col-sm-3 control-label">Last Name</label>
									    <div class="col-sm-9">
									    	<input type="last_name" class="form-control required" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $last_name ?>">
									    </div>
									</div>
									<div class="form-group">
										<label for="gender" class="col-sm-3 control-label">Gender</label>
										<div class="col-sm-9">
											<select class="form-control required" name="user_meta[gender]">
												<option></option>
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="age_range" class="col-sm-3 control-label">Age Range</label>
										<div class="col-sm-9">
											<select class="form-control required" name="user_meta[age_range]">
												<option></option>
												<option value="13-17">13-17</option>
												<option value="18-25">18-25</option>
												<option value="26-30">26-30</option>
												<option value="31-40">31-40</option>
												<option value="41-50">41-50</option>
												<option value="51+">51+</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="last_name" class="col-sm-3 control-label">Amount</label>
									    <div class="col-sm-9">
									    	<p id="total" class="form-control-static">$1.29</p>
									    	<input name="amount" type="hidden" value="" />
									    </div>
									</div>
									<input name="quantity" type="hidden" value="1" />
									<input name="description" type="hidden" value="" />
									<input name="stripeEmail" type="hidden" value="" />
									<input name="stripeToken" type="hidden" value="" />
									<input name="stripeType" type="hidden" value="" />
									<button class="stripe-button button wide">Buy "Broken" Now</button>
								</form>
								<p>&nbsp;</p>
								<p align="center">If you have problems downloading, please e-mail press@tammybattle.com.</p>
							<?php endif; ?>
						</div>
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
		<?php wp_footer(); ?>
	</body>
</html>

<script>
	(function( $ ) {
		
		var stripe_key = "<?php echo $stripe_key ?>";
		var form = $('.stripe-button').closest('form');

		var email = "<?php echo $email ?>";
		var name = "<?php echo get_bloginfo('name') ?>";
		var orig_description = "Download for 'Broken'";
		var description = "1 " + orig_description;
		var orig_amount = 129;
		var amount = orig_amount;

		var handler = StripeCheckout.configure({
			key: stripe_key,
			token: function(token) {
				// Use the token to create the charge with a server-side script.
				// You can access the token ID with `token.id`
				$('input[name="stripeToken"]').val( token.id );
				$('input[name="stripeType"]').val( token.type );
				$('input[name="stripeEmail"]').val( token.email );

				$(form).submit();

			}
		});

		$('.stripe-button').on( 'click', function(e) {
			
			e.preventDefault();

			if ( ! form_is_valid() ) {

				alert('Please complete all fields');
				return false;

			}

			// Populate fields
			$('input[name="amount"]').val( amount );
			$('input[name="description"]').val( description );

			// Open Checkout with further options
			handler.open({
				name: name,
				description: description,
				amount: amount,
				email: email,
				allowRememberMe: false
			});
			
		});

		$('select[name="quantity"]').on( 'change', function(e) {

			var quantity = $(this).val();

			amount = quantity * orig_amount;
			display_amount = '$' + ( amount / 100 ) + '.00';

			$('#total').text( display_amount );

			description = quantity + ' ' + orig_description;

		});

		function form_is_valid() {

			var is_valid = false;

			$( form ).find('.required').each(function( i, v ){

				if ( $(this).val() == '' ) {
					is_valid = false;
					return false
				} else {
					is_valid = true;
				}

			});

			if ( is_valid )
				return true;
			else
				return false;

		}

	})( jQuery );
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-26588142-3', 'auto');
  ga('send', 'pageview');

</script>