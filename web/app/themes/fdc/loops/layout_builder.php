<?php
        // Check value exists.
        if( have_rows('layouts') ):

            // Loop through rows.
            while ( have_rows('layouts') ) : the_row();



                if( get_row_layout() == 'stats_banner' ):
                    $bg_color = get_sub_field('stat_bar_color') ? get_sub_field('stat_bar_color') : 'bg-c-purple';
                    if (have_rows('quick_stats')) :
                        $tmp = '<div class="bg-c-purple-dark text-white py-8 lg:py-12 my-6 lg:-ml-8 lg:my-12 shadow-lg">';
                        $tmp = '<div class="bg-c-purple text-white py-8 lg:py-12 my-6 lg:-ml-8 lg:my-12 shadow-lg">';
                        $tmp = '<div class="bg-black text-white py-8 lg:py-12 my-6 lg:-ml-8 lg:my-12 shadow-lg">';
                        $tmp = '<img class="rounded-md">';
                        ?>
                        <div class="<?php echo $bg_color; ?> text-white py-8 lg:py-12 lg:-ml-8 shadow-lg">
                            <div class="container lg:flex justify-around max-w-screen-2xl">
                                <?php while (have_rows('quick_stats')) :
                                    the_row();
                                    $stat_icon = get_sub_field('stat_icon');
                                    $stat_title = get_sub_field('stat_title');
                                    $stat_caption = get_sub_field('stat_caption');
                                ?>
                                <div class="text-center py-6 px-6 lg:max-w-lg">
                                    <?php if ($stat_icon) : ?>
                                    <img class="mx-auto text-center h-24 mb-5" src="<?php echo $stat_icon; ?>" alt="Icon">
                                    <?php endif; ?>
                                    <div class="text-4xl xl:text-5xl mb-4 font-bold leading-none"><?php echo $stat_title; ?></div>
                                    <div class="text-base"><?php echo $stat_caption; ?></div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>

                    <?php endif;


                elseif( get_row_layout() == 'offset_basic_content' ):

                    $content = get_sub_field('content');
                    echo '<div class="container offset-top-container lg:relative lg:-mt-20 max-w-7xl ml-0 bg-white z-10 px-10 py-8">';
                    echo '<div class="prose prose-lg max-w-none lg:max-w-7xl">';
                    echo apply_filters('the_content', $content);
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="clear-both"></div>';

                // Case: Basic Content
                elseif( get_row_layout() == 'basic_content' ):

                    $content = get_sub_field('content');
                    echo '<div class="container py-6 lg:py-10 xl:py-12 mx-auto">';
                    echo '<div class="prose prose-lg max-w-none lg:max-w-7xl">';
                    echo apply_filters('the_content', $content);
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="clear-both"></div>';
                    


                // Case: Two Column Content
                elseif( get_row_layout() == 'two_column_content' ): 
                    $column_one_content = get_sub_field('column_one_content');
                    $column_two_content = get_sub_field('column_two_content');
                    $vertical_alignment = get_sub_field('vertical_alignment');

                    echo '<div class="container mx-auto">';
                    echo '<div class="lg:flex py-6 lg:py-10 xl:py-12 max-w-7xl" style="align-items:'.$vertical_alignment.'">';
                    echo '<div class="lg:w-1/2 pb-4 lg:p-4">';
                    echo '<div class="prose prose-lg lg:pr-3">';
                    echo apply_filters('the_content', $column_one_content);
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="lg:w-1/2 pb-4 lg:p-4">';
                    echo '<div class="prose prose-lg lg:pl-3">';
                    echo apply_filters('the_content', $column_two_content);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="clear-both"></div>';

                // Case: Three Column Content
                elseif( get_row_layout() == 'three_column_content' ): 
                    $column_one_content = get_sub_field('column_one_content');
                    $column_two_content = get_sub_field('column_two_content');
                    $column_three_content = get_sub_field('column_three_content');
                    echo '<div class="container">';
                    echo '<div class="lg:flex py-6 lg:py-10 xl:py-12 max-w-7xl">';
                    echo '<div class="lg:w-1/3">';
                    echo '<div class="prose prose-lg lg:pr-3">';
                    echo apply_filters('the_content', $column_one_content);
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="lg:w-1/3">';
                    echo '<div class="prose prose-lg lg:px-3">';
                    echo apply_filters('the_content', $column_two_content);
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="lg:w-1/3">';
                    echo '<div class="prose prose-lg lg:pl-3">';
                    echo apply_filters('the_content', $column_three_content);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="clear-both"></div>';

                elseif( get_row_layout() == 'html_code' ):

                    echo '<div class="container max-w-7xl lg:-ml-8">';

                    $code = get_sub_field('code');
                    echo apply_filters('the_content', $code);

                    echo '</div>';

                elseif( get_row_layout() == 'modal_image_grid' ):


                    $grid_items = get_sub_field('mig_grid_items');
                    echo '<div class="containers py-6 lg:py-10 xl:py-12 mx-auto lg:-ml-8">';
                    echo '<div class="flex flex-wrap justify-center items-center content-center">';
                    $i = 0;

                    foreach ($grid_items as $grid_item) {
                        $i++;
                        $title = $grid_item['grid_item_title'];
                        $image = $grid_item['grid_item_image'];
                        $is_modal = $grid_item['grid_item_is_modal'];
                        $link = $grid_item['grid_item_link'];

                        if ($image) {
                        echo '<div class="py-28 xl:py-32 relative flex justify-center border w-1/2 lg:w-1/4">';
                        if ($is_modal) {
                            echo '<a href="#modal-content-'.$i.'" class="modal absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 hover:bg-opacity-75 transition-all duration-200 font-semibold text-xl z-20 flex justify-center items-center text-white"><span class="leading-none text-c-purple bg-white px-8 py-3">'.$title.' <i class="fas fa-angle-right"></i></span></a>';
                        } else {
                            echo '<a href="'.$link['url'].'" target="'.$link['target'].'" class="modal absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 hover:bg-opacity-75 transition-all duration-200 font-semibold text-xl z-20 flex justify-center items-center text-white"><span class="leading-none text-c-purple bg-white px-8 py-3">'.$title.' <i class="fas fa-angle-right"></i></span></a>';
                        }
                        echo '<img class="absolute object-cover top-0 left-0 w-full h-full" src="'.$image['sizes']['medium'].'" alt="'.$title.'">';
                        echo '</div>';
                        // echo '<div class="p-6">';
                        // echo '<h4>'.$title.'</h4>';
                        // echo '</div>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';

                    $i = 0;
                    foreach ($grid_items as $grid_item) {
                        $i++;
                        $content = apply_filters('the_content', $grid_item['grid_item_content']);
                        $title = $grid_item['grid_item_title'];
                        $image = $grid_item['grid_item_image'];
                        echo '<div id="modal-content-'.$i.'" class="relative bg-white w-auto mx-auto my-20 max-w-6xl mfp-hide">';
                        // echo '<img class="hidden lg:block mx-auto" src="'.$image['url'].'" alt="img"/>';
                        echo '<div class="p-10">';
                        echo '<div class="prose max-w-6xl">'.$content.'</div>';
                        echo '</div>';
                        echo '</div>';
                    }



                endif;

            // End loop.
            endwhile;

        // No value.
        else :
            // Do something...
        endif;
        ?>