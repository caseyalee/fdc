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
                <!-- This is an example component -->
                <div class="h-screen w-screen bg-gray-100 flex items-center">
                    <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                        <div class="max-w-md">
                            <div class="text-4xl font-dark font-bold">404</div>
                            <p class="text-2xl md:text-3xl font-light leading-normal">
                                Sorry we couldn't find this page. </p>
                                <p class="mb-4"></p>
                                <a class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-c-purple active:bg-c-purple hover:bg-c-purple-light" href="/">Back to Home</a>
                        </div>
                        <div class="max-w-lg">
                        </div>

                    </div>
                </div>
			</div><!-- .wrap -->
		</section><!-- .error-404 -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php do_action( 'theme_after_content' ); ?>
<?php do_action( 'theme_content_wrap', 'end' ); ?>
<?php get_footer(); ?>
