<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package theme
 */
?>

<?php get_header(); ?>
<?php do_action( 'theme_content_wrap', 'start' ); ?>
<?php do_action( 'theme_before_content' ); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="error-404 not-found">
			<div class="wrap">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Sorry, that page can&rsquo;t be found.', 'clarity' ); ?></h1>
				</header><!-- .page-header -->
				<div class="block page-content">
					<p>
						The page you were looking for appears to have been moved, deleted or does not exist. You could go back to <a href="#" onclick="history.back(-1)">where you were</a> or head straight to our <a href="/">homepage</a>.
					</p>
				</div><!-- .page-content -->
			</div><!-- .wrap -->
		</section><!-- .error-404 -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php do_action( 'theme_after_content' ); ?>
<?php do_action( 'theme_content_wrap', 'end' ); ?>
<?php get_footer(); ?>
