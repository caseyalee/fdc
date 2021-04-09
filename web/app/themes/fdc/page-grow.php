<?php get_header(); ?>

<?php while ( have_posts() ) : the_post() ; ?>

<?php
$slides = get_field('slides');
?>
<?php if ($slides) : ?>
<div class="slider">
    <?php
    foreach ($slides as $slide) :
        $image = $slide['slide_image'];
        $slide_image_src = wp_get_attachment_image_src( $image['ID'], 'page-header' );
        $button = $slide['slide_button'];
        $slide_text = $slide['slide_text'];
        $slide_title = $slide['slide_title'];
    ?>
    <div class="slide background" data-background-options='{"source":"<?php echo $slide_image_src[0];?>","alt":"Background Image"}'>
        <div class="overlay flex items-center lg:pl-80 py-16 md:py-24 lg:py-48 xl:py-64 relative overflow-hidden z-20">
            <div class="container">
                <div class="max-w-7xl">
                    <h2 class="text-white font-bold leading-none uppercase text-xl md:text-3xl lg:text-4xl xl:text-5xl 2xl:text-6xl border-b border-white border-opacity-25 pb-4"><?php echo $slide_title; ?></h2>
                    <div class="text-white pt-4 pb-8 text-base md:text-xl xl:text-3xl">
                        <?php echo $slide_text; ?>
                    </div>
                    <?php if (!empty($button)) : ?>
                    <a class="button bg-white text-c-purple hover:bg-c-purple hover:text-white" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?> <i class="fas fa-angle-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else : ?>
<div class="block w-100 h-24"></div>
<?php endif; ?>

<div class="lg:pl-80 pb-6 lg:pb-12" id="mainbody">

    <div class="container max-w-screen-3xl py-6">
        <iframe height="480px" width="100%" frameborder="no" scrolling="no" seamless src="https://player.simplecast.com/94751a5f-9c72-4503-8bd7-abcf24d9f0d9?dark=false&show=true"></iframe>
    </div>

    <?php
        // WP_Query arguments
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $post_args = array (
            'post_type'      => array( 'post' ),
            'posts_per_page' => '6',
            'paged'          => $paged,
            'order'          => 'DESC',
        );
        $q = new WP_Query( $post_args );
        if ( $q->have_posts() ) : ?>
        <div class="container max-w-screen-3xl mt-8">
            <div class="lg:flex flex-wrap equalize" data-equalize-options='{"target":[".eq",".entry-title"]}'>
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>

                <div class="md:w-1/2 lg:w-1/3 lg:px-6 mb-8">
                    <?php do_action( 'theme_before_entry' ); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <header class="entry-header ">
                            <?php the_title( sprintf( '<h3 class="entry-title text-xl font-semibold leading-tight mb-3 flex items-end"><a class="text-black hover:text-c-purple" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                        </header><!-- .entry-header -->

                        <?php
                        if (has_post_thumbnail( $post )) {
                            echo get_the_post_thumbnail( $post, 'large',['class'=>'mb-0 w-full h-auto']);
                        }
                        ?>


                        <div class="prose max-w-7xl prose-lg border-gray-200 border-b pb-4 eq">

                            <div class="entry-meta text-sm text-gray-600 py-2 max-w-7xl ">
                                <?php theme_entry_header(); ?>
                            </div>

                            <div class="entry-content text-base">
                                <?php the_field('post_excerpt'); ?>
                                <div class="float-right mt-8">
                                    <a class="button button-sm" href="<?php echo get_permalink(); ?>"><i class="fad fa-bookmark"></i> Continue Reading</a>
                                </div>
                            </div><!-- .entry-content -->

                        </div>

                    </article><!-- #post-## -->
                </div>


            <?php endwhile; ?>
            </div>

            <?php wp_reset_query(); ?>
            <nav class="w-full pt-6">
                <ul class="flex flex-nowrap items-center justify-between px-6">
                    <li><?php previous_posts_link( '<i class="fas fa-long-arrow-left"></i> Prev', $q->max_num_pages) ?></li> 
                    <li><?php next_posts_link( 'Next <i class="fas fa-long-arrow-right"></i>', $q->max_num_pages) ?></li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>

        <?php get_template_part( 'loops/layout_builder', get_post_type() ); ?>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>