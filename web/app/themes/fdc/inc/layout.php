<?php
/**
 * Theme Header
 * @return [string] persistent header markup
 */

function site_header() { ?>

    <div id="mobilenav" class="relative hidden lg:block" data-navigation-handle="#navtoggle" data-navigation-content=".page-wrap">
        <a id="hidemenu" href="#">CLOSE <i class="fa fa-times"></i></a>
        <?php wp_nav_menu( array(
            'theme_location'  => 'primary_header',
            'container'       => 'div',
            'container_class' => 'mobile-nav',
            'walker' => new TailwindsCSS_Menu_Walker(),
        ));
        ?>


        <?php $sidebar_links = get_field('sidebar_links','option');?>
        <div class="border-t border-white border-opacity-25 pt-4 mt-4">
        <?php foreach ($sidebar_links as $slink) : ?>
            <a class="block py-2" href="<?php echo $slink['link']['url']; ?>" target="<?php echo $slink['link']['target']; ?>">
                <span class="block text-white text-xl w-full flex-auto leading-none"><?php echo $slink['link']['title']; ?></span>
                <span class="block text-white text-opacity-50 text-sm my-1 leading-tight">
                    <?php echo $slink['caption']; ?>
                </span>
            </a>
        <?php endforeach; ?>    
        </div>

        <span class="py-4 mt-4 border-t border-white border-opacity-25 block"></span>
        <div class="social flex items-center justify-center">
            <?php do_action('social_links'); ?>
        </div>

    </div>

    <!-- End Mobile Nav -->

    <div class="page-wrap">

        <div id="sidemenu" class="w-72 h-screen hidden lg:inline fixed z-50 transition-all duration-300">
            <a href="<?php echo get_home_url(); ?>">
                <img class="block h-12 w-auto mt-6 mx-auto" src="<?php echo get_stylesheet_directory_uri()?>/assets/img/logo.png" alt="Faith Driven Consumer">
            </a>
            <div class="mt-12 px-5">
                <?php
                    $sidebar_heading = get_field('sidebar_heading','option');
                    $sidebar_text = get_field('sidebar_text','option');
                    $sidebar_links = get_field('sidebar_links','option');
                ?>
                <h4 class="text-white text-lg uppercase font-bold text-center"><?php echo $sidebar_heading; ?></h4>
                <div class="text-white text-sm py-4">
                    <?php echo $sidebar_text; ?>
                </div>
                <div class="flex flex-wrap sidelinks">
                    <?php foreach ($sidebar_links as $slink) : ?>
                        <a class="relative bg-c-purple hover:bg-white text-white hover:text-c-purple py-3 px-3 mb-2 w-full transition-all duration-300" href="<?php echo $slink['link']['url']; ?>" target="<?php echo $slink['link']['target']; ?>">
                            <span class="block text-3xl w-full flex-auto uppercase leading-none font-semibold"><?php echo $slink['link']['title']; ?></span>
                            <span class="block text-xs my-1 leading-tight">
                                <?php echo $slink['caption']; ?>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    	<div id="header" class="py-2 bg-c-purple-dark z-20 lg:fixed w-full lg:bg-opacity-85">

            <div class="relative max-w-screen-3xl mx-6">

                <div class="flex justify-between h-16 lg:h-20">

                    <div class="flex lg:hidden items-center">
                        <a href="<?php echo get_home_url(); ?>">
                            <img class="h-10 w-auto" src="<?php echo get_stylesheet_directory_uri()?>/assets/img/logo.png" alt="Faith Driven Consumer">
                        </a>
                    </div>


                    <a id="navtoggle" href="#" class="block lg:hidden absolute top-0 right-0 mt-5 mr-6">
                        <svg width="40px" height="23px" viewBox="0 0 40 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>navtoggle-icon</title>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="navtoggle-icon" fill="#FFFFFF">
                                    <rect id="line3" x="0" y="0" width="40" height="3"></rect>
                                    <rect id="line2" x="0" y="10" width="40" height="3"></rect>
                                    <rect id="line1" x="0" y="20" width="40" height="3"></rect>
                                </g>
                            </g>
                        </svg>
                    </a>

                    <div class="hidden h-20 lg:flex items-center lg:pl-80">
                        <a class="button" href="/join">Join</a>
                    </div>


                	<?php
                    wp_nav_menu( array(
                		'theme_location'  => 'primary_header',
                		'container'       => 'div',
                		'container_class' => 'navigation flex-grow',
                        'menu_class'      => 'hidden lg:flex justify-end items-center h-16 lg:h-20 text-center',
                        'walker' => new TailwindsCSS_Menu_Walker(),
                	) );
                    ?>

                    <div class="hidden lg:flex items-center justify-center border-l border-white border-opacity-25 pl-6 h-6 my-7">
                        <?php do_action('social_links'); ?>
                    </div>
                </div>
            </div>
        </div>
<?php }
add_action( 'theme_header', 'site_header', 1 );


/**
 * Theme Footer
 * @return [string] persistent footer markup
 */
function site_footer() {

    // Member Benefits
    $member_benefits_image = get_field('mb_image','option');
    $member_benefits_button = get_field('mb_button','option');

    if( $member_benefits_image ) {
        echo '<div id="member-benefits-modal" class="relative bg-white mx-auto my-20 max-w-4xl py-5 px-5 text-center mfp-hide">';
        echo '<h4 class="font-semibold text-xl lg:text-5xl tracking-tight uppercase text-center text-c-purple">Member Benefits</h4>';
        echo '<img class="block mx-auto" src="'.$member_benefits_image['sizes']['large'].'" alt="img"/>';
        if (!empty($member_benefits_button)) {
            echo '<a class="button text-lg mx-auto bg-c-purple text-white hover:bg-c-purple-light hover:text-white" href="'.$member_benefits_button['url'].'" target="'.$member_benefits_button['target'].'" tabindex="0">'.$member_benefits_button['title'].' <i class="fas fa-angle-right"></i></a>';
        }
        echo '</div>';
    }

    ?>
	<div id="footer" class="bg-c-purple-darker bg-opacity-85">
        <div class="container lg:pl-80">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <div class="text-xs text-white text-opacity-50">
                    <p><?php echo get_bloginfo( $show = 'description', $filter = 'raw' ); ?></p>
                </div>
                <div class="logo flex-shrink-0 flex items-center">
                    <a href="<?php echo get_home_url(); ?>">
                        <img class="block h-12 w-auto" src="<?php echo get_stylesheet_directory_uri()?>/assets/img/logo.png" alt="Faith Driven Consumer">
                    </a>
                </div>
            </div>
        </div>
        <div class="bg-c-purple-darker">
            <div class="container lg:pl-80 text-xs flex justify-between text-c-purple-lighter py-3">
                <div>&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo( $show = 'name', $filter = 'raw' ); ?>. All Rights Reserved.</div>
                <a href="#" class="hover:text-white">Privacy Policy</a>
            </div>
        </div>
    </div>
    </div> <!-- /.page-wrap -->
<?php }
add_action( 'theme_footer', 'site_footer', 1 );


/**
 * reusable content wrapper with dynamic sidebar detection
 * @return [string]
 */
function content_wrapper( $phase ) {
	$output          = false;
	$container_class = ( is_active_sidebar( 'sidebar-1' ) ) ? 'has-sidebar' : 'no-sidebar';
	switch ( $phase ) {
		case 'start':
			$output = '<div class="container ' . $container_class . '">'; // start container
			break;
		case 'end':
			$output = '</div><!-- .container -->'; // end container
			break;
	}
	// echo $output;
}
add_action( 'theme_content_wrap', 'content_wrapper' );

/**
 * opening main content area container
 * @return [string]
 */
function before_content() {
	echo '<div class="main">';
}
add_action( 'theme_before_content', 'before_content' );

/**
 * closing main content area container
 * @return [string]
 */
function after_content() {
	echo '</div><!-- .main -->';
}
add_action( 'theme_after_content', 'after_content' );

/**
 * displays custom content before each singular entry
 * @return [string]
 */
function before_entry() {}
add_action( 'theme_before_entry', 'before_entry' );

/**
 * displays custom content after each singular entry
 * @return [string]
 */
function after_entry() {}
add_action( 'theme_after_entry', 'after_entry' );

/**
 * displays custom content before sidebar(s)
 * @return [string]
 */
function before_sidebar() {}
add_action( 'theme_before_sidebar', 'before_sidebar' );

/**
 * displays custom content after sidebar(s)
 * @return [string]
 */
function after_sidebar() {}
add_action( 'theme_after_sidebar', 'after_sidebar' );


function theme_social_links() {
    $social_media_links = get_field('social_media_links','option');
    if ($social_media_links) {
        foreach ($social_media_links as $sl) {
            echo '<a class="text-white px-2" href="'.$sl['url'].'" target="_blank">'.$sl['icon_class'].'</a>';
        }
    }
}
add_action( 'social_links', 'theme_social_links' );


function theme_entry_header() {
    echo __('Posted ','fdc') . get_the_date();
}
function theme_entry_footer() {
    // echo __('Posted on ','fdc') . get_the_date();
}
