<?php
/**
 * The template for displaying all single posts.
 *
 * @package theme
*/?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post() ; ?>

<div class="spacer lg:py-12"></div>

<div class="lg:pl-80 py-6 lg:py-12" id="mainbody">
    <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-7xl'); ?>>

            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl mb-6 xl:mb-8 font-bold leading-none">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-meta text-sm text-gray-600 mb-4 prose max-w-7xl prose-xs">
                <?php theme_entry_header(); ?>
                <div class="share flex items-center lg:float-right">
                    <?php $postlink = urlencode(get_permalink()); ?>
                    <span class="mr-1 text-sm">Share:</span>
                    <a style="color:#4E4990" class="mx-1 text-2xl" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postlink; ?>"><i class="fab fa-facebook-square"></i></a>
                    <a style="color:#0098F4" class="mx-1 text-2xl" target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $postlink; ?>&text=<?php echo get_the_title(); ?>"><i class="fab fa-twitter-square"></i></a>
                    <a style="color:#0067B1" class="mx-1 text-2xl" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $postlink; ?>&title=<?php echo get_the_title(); ?>"><i class="fab fa-twitter-square"></i></a>
                </div>
                <hr>
            </div>

            <div class="entry-content prose max-w-7xl prose-lg">
                <?php $podcast_url = get_field('podcast_url');
                    if ($podcast_url) {
                        echo do_shortcode('[simplecast-embed src="'.$podcast_url.'"]');
                    }
                ?>
                <?php the_content(); ?>
            </div><!-- .entry-content -->

        </article><!-- #post-## -->
    </div>
</div>
<?php endwhile;?>

<?php get_footer(); ?>