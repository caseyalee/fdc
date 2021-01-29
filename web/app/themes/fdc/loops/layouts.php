<?php
        // Check value exists.
        if( have_rows('layouts') ):

            // Loop through rows.
            while ( have_rows('layouts') ) : the_row();

                // Case: Basic Content
                if( get_row_layout() == 'basic_content' ):
                    $content = get_sub_field('content');
                    echo '<div class="prose max-w-6xl prose-lg">';
                    echo apply_filters('the_content', $content);
                    echo '</div>';


                // Case: Two Column Content
                elseif( get_row_layout() == 'two_column_content' ): 
                    $column_one_content = get_sub_field('column_one_content');
                    $column_two_content = get_sub_field('column_two_content');
                    $vertical_alignment = get_sub_field('vertical_alignment');
                    echo '<div class="lg:flex py-6 lg:py-10 max-w-6xl" style="align-items:'.$vertical_alignment.'">';
                    echo '<div class="lg:w-1/2 pb-4">';
                    echo '<div class="prose prose-lg lg:pr-3">';
                    echo apply_filters('the_content', $column_one_content);
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="lg:w-1/2 pb-4">';
                    echo '<div class="prose prose-lg lg:pl-3">';
                    echo apply_filters('the_content', $column_two_content);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                // Case: Three Column Content
                elseif( get_row_layout() == 'three_column_content' ): 
                    $column_one_content = get_sub_field('column_one_content');
                    $column_two_content = get_sub_field('column_two_content');
                    $column_three_content = get_sub_field('column_three_content');
                    echo '<div class="lg:flex py-6 lg:py-10 max-w-6xl">';
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

                elseif( get_row_layout() == 'html_code' ):
                    $purgecss = '<div class="prose max-w-6xl prose-lg py-6 lg:py-10"><table><tbody><tr><td></td><th></th></tr></tbody></table></div>';
                    $code = get_sub_field('code');
                    $code = str_replace("<i class=\"fa fa-times\"></i>", "<i style=\"color:red\" class=\"fa fa-times\"></i>", $code);
                    $code = str_replace("<i class=\"fa fa-check\"></i>", "<i style=\"color:green\" class=\"fa fa-check\"></i>", $code);
                    echo '<div class="prose max-w-6xl prose-lg py-6 lg:py-10">';
                    echo apply_filters('the_content', $code);
                    echo '</div>';

                elseif( get_row_layout() == 'modal_image_grid' ):
                    $grid_items = get_sub_field('mig_grid_items');
                    
                    echo '<div class="flex flex-wrap justify-center items-center content-center max-w-6xl py-4">';
                    $i = 0;
                    foreach ($grid_items as $grid_item) {
                        $i++;
                        $title = $grid_item['grid_item_title'];
                        $image = $grid_item['grid_item_image'];
                        if ($image) {
                        echo '<div class="py-20 mx-2 px-32 relative flex justify-center border">';
                        echo '<a href="#modal-content-'.$i.'" class="modal absolute top-0 left-0 w-full h-full bg-c-purple bg-opacity-50 hover:bg-opacity-75 transition-all duration-200 font-semibold text-xl z-20 flex justify-center items-center text-white">'.$title.'</a>';
                        echo '<img class="absolute object-cover top-0 left-0 w-full h-full" src="'.$image['sizes']['medium'].'" alt="'.$title.'">';
                        echo '</div>';
                        // echo '<div class="p-6">';
                        // echo '<h4>'.$title.'</h4>';
                        // echo '</div>';
                        }
                    }
                    echo '</div>';

                    $i = 0;
                    foreach ($grid_items as $grid_item) {
                        $i++;
                        $content = apply_filters('the_content', $grid_item['grid_item_content']);
                        $title = $grid_item['grid_item_title'];
                        $image = $grid_item['grid_item_image'];
                        echo '<div id="modal-content-'.$i.'" class="relative bg-white w-auto mx-auto my-20 max-w-6xl mfp-hide">';
                        echo '<img class="hidden lg:block mx-auto" src="'.$image['url'].'" alt="img"/>';
                        echo '<div class="p-10">';
                        echo '<h4 class="text-xl lg:text-3xl text-c-purple-dark mb-8">'.$title.'</h4>';
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