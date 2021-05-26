<?php
/**
* Template Name: FEI
*
*/

get_header(); ?>

<?php while ( have_posts() ) : the_post() ; ?>


<div class="header-spacer"></div>

<div class="lg:pl-80 pb-6 lg:pb-12" id="mainbody">

  <div class="max-w-page bg-white border lg:rounded-lg p-6 mb-6 lg:mx-6 xl:ml-0 relative hidden" id="feilegend">

    <div class="flex flex-wrap 2xl:flex-nowrap">

      <div class="w-full 2xl:w-1/4">

        <div class="text-sm lg:pt-0 xl:px-2 mb-4 2xl:mb-0">
            <h4 class="text-c-purple font-semibold mb-2 text-2xl 2xl:text-xl"><?php the_field('legend_heading'); ?></h4>
            <?php the_field('legend_description'); ?>
            <a href="#" id="hide-fei-legend" class="bg-c-purple text-white hover:bg-c-purple-dark duration-200 w-10 h-10 rounded-full flex justify-center items-center" title="Dismiss"><i class="fal fa-times"></i></a>
        </div>

      </div>

      <div class="2xl:w-3/4 sm:grid sm:grid-flow-col sm:gap-4 lg:pl-6 equalize" data-equalize-options='{"target":".eq"}'>

        <div class="sm:col-span-4 mb-4 lg:mb-0">
          <div class="bg-white shadow-md border" style="border-color:#A2D033">
            <div class="p-6 eq text-sm">
              <?php the_field('legend_compatible'); ?>
            </div>
            <div class="card-bottom score-compatible w-full self-end">
              <span class="flex items-center">
                <img src="/app/themes/fdc/assets/img/icon-compatible.png" align="left" alt="icon">
                <span class="text-white uppercase text-sm ml-2">compatible</span>
              </span>
            </div>
          </div>
        </div>

        <div class="sm:col-span-4 mb-4 lg:mb-0">
          <div class="bg-white shadow-md border" style="border-color:#EAD03C">
            <div class="p-6 eq text-sm">
              <?php the_field('legend_acceptable'); ?>
            </div>
            <div class="card-bottom score-acceptable w-full self-end">
              <span class="flex items-center">
                <img src="/app/themes/fdc/assets/img/icon-acceptable.png" align="left" alt="icon">
                <span class="text-white uppercase text-sm ml-2">acceptable</span>
              </span>
            </div>
          </div>
        </div>

        <div class="sm:col-span-4 mb-4 lg:mb-0">
          <div class="bg-white shadow-md border" style="border-color:#C94546">
            <div class="p-6 eq text-sm">
              <?php the_field('legend_incompatible'); ?>
            </div>
            <div class="card-bottom score-incompatible w-full self-end">
              <span class="flex items-center">
                <img src="/app/themes/fdc/assets/img/icon-incompatible.png" align="left" alt="icon">
                <span class="text-white uppercase text-sm ml-2">incompatible</span>
              </span>
            </div>
          </div>
        </div>
      </div>


      </div>
  </div>

  <div class="lg:flex" id="fei-app">

    <div class="fei-sidebar xl:w-3/12 p-6 bg-white shadow-md outline-none relative" data-navigation-handle=".toggle-sidebar" data-navigation-content=".fei-index-container">

        <a href="#" id="show-fei-legend" class="hidden bg-c-purple text-white hover:bg-c-purple-dark duration-200 text-xs tracking-wider uppercase px-2 py-1 rounded-full flex justify-center items-center" data-title="Show FEI Score Legend"><i class="fas fa-info-circle"></i><span class="ml-1">Legend</span></a>

        <div class="filter mb-8">
          <h3 class="d-block mb-2 font-semibold text-xl">Types</h3>
          <div id="types-list"></div>
        </div>
        <div class="filter mb-8">
          <h3 class="d-block mb-2 font-semibold text-xl">FEI / Score</h3>
          <div id="scores-list"></div>
        </div>
        <div class="filter mb-8">
          <h3 class="d-block mb-2 font-semibold text-xl">Subcategory</h3>
          <div id="categories-list"></div>
        </div>
    </div>

    <div class="fei-index-container w-full xl:w-9/12 pt-6 lg:pt-0 pb-6 px-4">
      <div class="filter-controls lg:flex lg:space-x-2">
        <div class="lg:w-1/2 xl:w-3/12 flex space-x-2 text-sm pt-2 lg:pt-0 mb-2">
          <a class="toggle-sidebar focus:none focus:outline-none xl:hidden w-1/2 text-center" href="#">
            <span class="bg-c-purple text-white px-8 py-3 block uppercase flex items-center justify-center">
            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="16px" style="margin-right:4px"><path fill="currentColor" d="M231.536 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273H436c6.627 0 12-5.373 12-12v-10c0-6.627-5.373-12-12-12H60.113L238.607 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L3.515 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg>
          Filters</span>
          </a>
          <div id="clear-refinements" class="w-1/2 lg:w-full"></div>
        </div>
        <div id="searchbox" class="ais-SearchBox lg:w-1/2 xl:w-9/12"></div>
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