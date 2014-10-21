<?php

	function register_menu() {
		register_nav_menu('header-menu',__( 'Header Menu' ));
	}

	add_action( 'init', 'register_menu' );

	add_theme_support( 'post-thumbnails' );

	function download() {

		global $wp;

		$page_requested = isset( $wp->request ) ? $wp->request : '';
		$paid = isset( $_REQUEST['payment_id'] ) ? $_REQUEST['payment_id'] : false;

		if ( $page_requested != 'download' )
			return false;

		if ( ! $paid )
			return false;	

		$upload_dir = wp_upload_dir();

		$file = get_attached_file( 9 );
		
		// $file = "http://tammybattle.lemonboxcreative.com/wp-content/uploads/sites/7/2014/10/01-Broken.mp3";
		// $file = "http://tammybattle.com/wp-content/uploads/sites/7/2014/10/Broken-preview.mp3";
		$basename = basename( $file );

		header('Content-Type: application/force-download');
	    header('Content-Disposition: attachment; filename="'.basename($file).'"');
	    header("Content-Transfer-Encoding: binary");
	    header('Accept-Ranges: bytes');

	    /* The three lines below basically make the 
	    download non-cacheable */
	    header("Cache-control: no-cache, pre-check=0, post-check=0");
	    header("Cache-control: private");
	    header('Pragma: private');
	    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		readfile($file);		// push it out
		exit();


	}

	add_action( 'template_redirect', 'download' );