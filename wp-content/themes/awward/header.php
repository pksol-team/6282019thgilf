<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/abel.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<link href="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">



<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.rawgit.com/atatanasov/gijgo/master/dist/combined/js/gijgo.min.js" type="text/javascript"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class('ht-visible'); ?>>
<div class="wrapper">
	<nav class="nav-main" id="nav-main">
	  <div class="top">
	    <div class="header">
	      <div class="pull-right">
	        <div class="bt-close js-close-menu">CLOSE</div>
	      </div>
	    </div>
	    <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
	  </div>
	  <div class="box-bottom">
	    <div class="box-version">
	      <span class="box-version-text">Activate black option</span>
	      <div class="input-check-toggle check-small ">
	        <input id="version-color" type="checkbox" class="js-dark">
	        <label for="version-color">
	        <span class="ball"></span>
	        </label>
	      </div>
	    </div>
	  </div>
	</nav>


<header id="header" role="banner">
	<!-- <?php // dynamic_sidebar( 'header_top' ); ?> -->

	<div class="header-top">
		  <div class="box-left">
		    <div class="item">
		      <span class="link-1 js-nav-main js-nav-lang" data-menu-id="menu-lang">ENGLISH</span>
		    </div>
		  </div>
		  <div class="box-center">
		    <h1 class="slogan"><?php echo ot_get_option('site_slogan'); ?></h1>
		  </div>
		  <div class="box-right">
		    <ul class="list-social item">
	          <li>
	  	        <a href="<?php echo ot_get_option('instagram_link'); ?>">
	  	          <i class="fa fa-instagram" aria-hidden="true"></i>
	  	        </a>
	  	      </li>
	  	      <li>
	  	        <a href="<?php echo ot_get_option('twitter_link'); ?>">
	  	          <i class="fa fa-twitter" aria-hidden="true"></i>
	  	        </a>
	  	      </li>
	  	      <li>
	  	        <a href="<?php echo ot_get_option('facebook_link'); ?>">
	  	         <i class="fa fa-facebook" aria-hidden="true"></i>
	  	        </a>
	  	      </li>
		    </ul>
		  </div>
		</div>

	<div class="header-main">
	  <div class="box-left">
	    <div class="item bt-menu js-nav-main" data-menu-id="menu-main">
	      <div class="ico-menu">
	        <div class="bar"></div>
	        <div class="bar"></div>
	        <div class="bar"></div>
	      </div>
	      <span class="has-tablet">MENU</span>
	    </div>
	  </div>
	  <div class="box-right">
	    <div class="item bt-search" id="js-search-container">
	      <svg class="ico-svg" viewBox="0 0 14 14">
	        <use xlink:href="../assets/images/sprite-icons.svg#search"></use>
	      </svg>
	    </div>
	    <div class="item login">
			<?php
				if ( is_user_logged_in() ) {
					echo '<strong><a class="text-black" href="/edit-profile/">Profile </a></strong>';
					
				} else {
					echo '<span>Are you a member?</span> <strong><a class="text-black lrm-login" href="#" id="show_login">Register / log in</a></strong>';
				}
				?>
	      
	    </div>
	    <div class="item has-tablet" id="bt-submit">
	      <a href="#" class="button button-large">
	      <span>SUBMIT YOUR SITE!</span>
	      </a>
	      
	    </div>
	  </div>
	  <div class="logo-header">
	    <a href="/" aria-label="Awwwards">
	      <?php 
			$custom_logo_id = get_theme_mod( 'custom_logo' );
	      	$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
	      	echo '<img src="' . esc_url( $custom_logo_url ) . '" width="141" alt="">';
	      ?>
	    </a>
	  </div>
	</div>
</header>
<div class="container">


