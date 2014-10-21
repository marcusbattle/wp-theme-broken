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

		$file = "http://tammybattle.com/wp-content/uploads/sites/7/2014/10/Broken-preview.mp3";
		$basename = basename( $file );

		header ("Content-type: octet/stream"); 
		header ("Content-disposition: attachment; filename=Broken - Single.mp3;"); 
		header ("Content-Length: " . filesize( $file ) ); 
		
		readfile( $file ); 
		exit;

	}

	add_action( 'template_redirect', 'download' );