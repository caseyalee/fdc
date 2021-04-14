<?php
/**
* Template Name: FEI
*
*/

get_header(); ?>

<?php while ( have_posts() ) : the_post() ; ?>


<div class="header-spacer"></div>

<div class="lg:pl-80 pb-6 lg:pb-12" id="mainbody">
  <div class="lg:flex" id="fei-app">

    <div class="fei-sidebar xl:w-3/12 p-6 bg-white shadow-md outline-none" data-navigation-handle=".toggle-sidebar" data-navigation-content=".fei-index-container">
        <div class="filter mb-8">
          <h3 class="d-block mb-2 font-semibold text-xl">Types</h3>
          <div id="types-list"></div>
        </div>
        <div class="filter mb-8">
          <h3 class="d-block mb-2 font-semibold text-xl">FEI / Score</h3>
          <div id="scores-list"></div>
          <div class="text-sm pt-2 text-gray-600"><?php the_field('fei_sidebar_text'); ?></div>
        </div>
        <div class="filter mb-8">
          <h3 class="d-block mb-2 font-semibold text-xl">Subcategory</h3>
          <div id="categories-list"></div>
        </div>
    </div>

    <div class="fei-index-container w-full xl:w-9/12 pt-6 lg:pt-0 pb-6 px-4">
      <div class="filter-controls lg:flex lg:space-x-2">
        <div id="searchbox" class="ais-SearchBox lg:w-1/2 xl:w-9/12"></div>
        <div class="lg:w-1/2 xl:w-3/12 flex space-x-2 text-sm pt-2 lg:pt-0">
          <a class="toggle-sidebar focus:none focus:outline-none xl:hidden w-1/2 text-center" href="#"><span class="bg-c-purple text-white px-8 py-3 block uppercase">Filters</span></a>
          <div id="clear-refinements" class="w-1/2 lg:w-full"></div>
        </div>
      </div>
      <div class="fei-index mt-4" id="brandListings"></div>
      <div id="pagination"></div>
      <div class="flex flex-nowrap justify-center items-center space-x-2">
        <div>Results per page:</div>
        <div id="hitsperpage"></div>
      </div>
    </div>
  </div>

    <?php
    // Check rows exists.
    if( have_rows('fei_cta_boxes') ):
        echo '<div class="lg:flex mt-8 max-w-page">';
        $i = 0;
        // Loop through rows.
        while( have_rows('fei_cta_boxes') ) : the_row();
            $i++;
            $heading = get_sub_field('heading');
            $content = get_sub_field('content');
            $button = get_sub_field('button');
            $pad = ($i === 1) ? 'lg:ml-0' : 'lg:mr-0';
        ?>
        <div class="lg:w-1/2 mb-4 mx-4 <?php echo $pad; ?>">
          <div class="bg-white shadow-md p-8">
            <h5 class="text-c-purple font-semibold text-lg md:text-xl lg:text-2xl xl:text-3xl mb-2"><?php echo $heading; ?></h5>
            <div class="text-base prose max-w-none">
              <?php echo $content; ?>
              <?php if($button) : ?>
              <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="button"><?php echo $button['title']; ?></a>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php
        // End loop.
        endwhile;
        echo '</div>';
    endif;
    ?>


</div>



<?php endwhile; ?>
<?php get_footer(); ?>