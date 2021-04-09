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
            </div>
            <div class="filter mb-8">
              <h3 class="d-block mb-2 font-semibold text-xl">Subcategory</h3>
              <div id="categories-list"></div>
            </div>
        </div>

        <div class="fei-index-container xl:w-9/12 pt-6 lg:pt-0 pb-6 px-4">

            <div class="filter-controls lg:flex lg:space-x-2">
                <div id="searchbox" class="ais-SearchBox lg:w-1/2 xl:w-9/12"></div>
                <div class="lg:w-1/2 xl:w-3/12 flex space-x-2 text-sm pt-2 lg:pt-0">
                    <a class="toggle-sidebar focus:none focus:outline-none xl:hidden w-1/2 text-center" href="#"><span class="bg-c-purple text-white px-8 py-3 block uppercase">Filters</span></a>
                    <div id="clear-refinements" class="w-1/2 lg:w-full"></div>
                </div>
            </div>

            <div class="fei-index mt-4" id="brandListings"></div>

            <div id="pagination"></div>
        </div>

    </div>

</div>

<?php endwhile; ?>
<?php get_footer(); ?>