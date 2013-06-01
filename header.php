<!DOCTYPE html>

<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php global $general_options; require_once( get_stylesheet_directory(). '/general-vars.php' ); ?>

<?php // dealing with user log in or sign up
if ( is_page('home-temp') ) {
include "user-home.php";
} else {
include "user.php";
}
?>

<title>
<?php
	/* From twentyeleven theme
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	echo $general_options['blogname'];

	// Add the blog description for the home/front page.
	$site_description = $general_option['blogdesc'];
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'spainlab' ), max( $paged, $page ) );

	?>
</title>

<meta content="<?php echo $general_options['metaauthor']; ?>" name="author" />
<meta content="<?php echo $general_options['blogdesc']; ?>" name="description" />
<meta content="<?php echo $general_options['metatags']; ?>" name="keywords" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="alternate" type="application/rss+xml" title="<?php echo $general_options['blogname']; ?> RSS Feed suscription" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php echo $general_options['blogname']; ?> Atom Feed suscription" href="<?php bloginfo('atom_url'); ?>" /> 
<link href="http://fonts.googleapis.com/css?family=Signika" rel="stylesheet" type="text/css">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Bootstrap -->
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet" />
	<!-- Bootstrap responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php bloginfo('template_url'); ?>/css/bootstrap-responsive.css" rel="stylesheet">
<!-- /Bootstrap -->

<!--[if IE 6 | IE 7 | IE 8]>
	<script src="<?php echo "{$general_options['blogtheme']}/js/html5.js" ?>" type="text/javascript">
	</script>
<![endif]-->

<?php // including copy of jQuery hosted in WordPress package
wp_enqueue_script("jquery");
 
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head();
?>
</head>

<?php // better to use body tag as the main container ?>
<body <?php body_class(); ?>>
	<div class="container">
		<?php if ( !is_user_logged_in() ) { ?>
		<div id="userbar" style="display:none;">
			<ul class="centrator">
				<li class="user-opt"><?php echo $success_msg; ?></li>
			</ul>
		</div>

		<?php } ?>
		<?php if ( is_user_logged_in() ) { ?>
		<div id="userbar" style="display:none;">
			<ul class="centrator userbarbg">
				<li class="user-msg"><?php echo $success_msg; ?></li>
				<li class="user-opt"><?php echo "<a href='" .$general_options['blogurl']. "/wp-admin/profile.php'>Edit profile</a>"; ?></li>
				<li class="user-opt"><?php echo "<a href='" .$general_options['blogurl']. "/wp-admin/edit.php?post_type=remotes'>View and edit my projects</a>"; ?></li>
				<li class="user-opt"><?php echo $logout_form; ?></li>
			</ul>
		</div>
	<?php } ?>

	<header id="pre" role="banner" class="<?php echo $banner_class; ?>">
		<div class="masthead">
			<div class="pull-right">
				<?php include "searchform.php";?>
			</div>
			<h1 class="muted"><?php echo "<a href='" .$general_options['blogurl']. "' title='Ir al inicio'>" .$general_options['blogname']. "</a>"; ?> <small id="blogdesc"><?php echo $general_options['blogdesc']; ?></small></h1>
		</div>
		<div class="navbar">
			<div class="navbar-inner">
				<?php // main navigation menu 1
				$menu_slug = "header-left-menu";
				$args = array(
					'theme_location' => $menu_slug,
					'container' => 'true',
					'container_class' => 'container',
					'menu_class' => 'nav',
					'menu_id' => 'mainmenu1'
				);
					wp_nav_menu( $args );
				?>
			</div>
		</div><!-- /.navbar -->
	</header><!-- end #pre -->

	<div class="row-fluid">
