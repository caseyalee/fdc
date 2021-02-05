<?php

class TailwindsCSS_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth=0, $args=[], $id=0) {

        $btn_class = in_array('btn', $item->classes) ? 'btn' : '';
        $modal_class = in_array('modal', $item->classes) ? 'modal' : '';
        $active_class = ($item->current || $item->current_item_parent) ? 'active' : '';
        $top_level = (int) $item->menu_item_parent ? false : true;

        $tmp = '<li class="px-6 btn">';
        if ($top_level) {
            $output .= "<li class='whitespace-no-wrap px-4 xl:px-8 " .  $active_class .' '.  $btn_class . "'>";
        } else {
            $output .= "<li class='" .  $active_class . "'>";
        }

        $output .= '<a target="'.$item->target.'" class="font-light uppercase text-xs xl:text-sm tracking-wider text-white hover:text-c-purple-lighter transition duration-150 ease-in-out py-3 '.$modal_class.'" href="' . $item->url . '">';
        // if ($item->url && $item->url != '#') {
        //     $output .= '<a class="font-light uppercase text-white hover:text-c-purple-light transition duration-150 ease-in-out py-3" href="' . $item->url . '">';
        // } else {
        //     $output .= '<span class="font-light uppercase text-white hover:text-c-purple transition duration-150 ease-in-out py-3">';
        // }

        $output .= $item->title;

        // if ($item->url && $item->url != '#') {
        //     $output .= '</a>';
        // } else {
        //     $output .= '</span>';
        // }
        $output .= '</a>';

        if ($args->walker->has_children) {
            $output .= '<i class="caret fa fa-angle-down"></i>';
        }
    }
}