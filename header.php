<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aussie_Home_Haven
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aussie-home-haven' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="top-nav">
			<div class="container">
				<div class="d-flex justify-content-between">
					<div>
						<?php 
						 $email = get_field( 'top_nav_email', 'option' );
						 if($email) {
						?>
						<a href="#" class="top-nav-menu-item">
						<?php $top_nav_email_icon = get_field( 'top_nav_email_icon', 'option' ); ?>
						<?php if ( $top_nav_email_icon ) : ?>
							<img src="<?php echo esc_url( $top_nav_email_icon['url'] ); ?>" alt="<?php echo esc_attr( $top_nav_email_icon['alt'] ); ?>" />
						<?php endif; ?>
						<?php echo $email; ?>
						</a>
						<?php } ?>
						<?php 
						 $phone = get_field( 'top_nav_phone', 'option' );
						 if($phone) {
						?>
						<a href="#" class="top-nav-menu-item">
						<?php $top_nav_phone_icon = get_field( 'top_nav_phone_icon', 'option' ); ?>
						<?php if ( $top_nav_phone_icon ) : ?>
							<img src="<?php echo esc_url( $top_nav_phone_icon['url'] ); ?>" alt="<?php echo esc_attr( $top_nav_phone_icon['alt'] ); ?>" />
						<?php endif; ?>
						 <?php echo $phone; ?>
						</a>
						<?php } ?>
					</div>
					<div>
					<?php
					  $user = get_field( 'login_sign_up_test', 'option' );
					  if($user) {
					 ?>
					<a href="#" class="top-nav-menu-item">
					<?php $user_icon = get_field( 'user_icon', 'option' ); ?>
					<?php if ( $user_icon ) : ?>
						<img src="<?php echo esc_url( $user_icon['url'] ); ?>" alt="<?php echo esc_attr( $user_icon['alt'] ); ?>" />
					<?php endif; ?>
					<?php echo $user; ?>
					</a>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	  <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
			<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand" href="#">
			<div class="site-branding">
			<h1 class="site-title"><?php the_custom_logo(); ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-name mt-2"><?php bloginfo( 'name' ); ?></a></h1>
				</div><!-- .site-branding -->
						</a>
						<?php
						wp_nav_menu( array(
							'theme_location'    => 'primary',
							'depth'             => 3,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'bs-example-navbar-collapse-1',
							'menu_class'        => 'nav navbar-nav',
							'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
							'walker'            => new WP_Bootstrap_Navwalker(),
						) );
						?>
						<span class="menu-icon">
						 <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
						 </svg>
						</span>
					</div>
		</nav>
	</header><!-- #masthead -->
