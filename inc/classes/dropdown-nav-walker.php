<?php
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth, $args = array() ){
        $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
    }

    public function end_lvl( &$output, $depth, $args = array() ){
        $indent = str_repeat("\t", $depth); // don't output children closing tag
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0){

        $url = '#' !== $item->url ? $item->url : '';
        $output .= '<option value="' . $url . '">' . $item->title;
    }

    public function end_el( &$output, $item, $depth = 0, $args = array()){
      $output .= "</option>\n";
    }
}