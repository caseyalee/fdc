<?php get_header(); ?>

<?php while ( have_posts() ) : the_post() ; ?>

<?php
$slides = get_field('slides');
?>

<div class="slider">
    <?php
    foreach ($slides as $slide) :
        $image = $slide['slide_image'];
        $slide_image_src = wp_get_attachment_image_src( $image['ID'], 'full' );
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

<div class="lg:pl-80 pb-6 lg:pb-12" id="mainbody">
    <?php get_template_part( 'loops/layouts', get_post_type() ); ?>
</div>

<?php endwhile; ?>
<?php get_footer(); ?>