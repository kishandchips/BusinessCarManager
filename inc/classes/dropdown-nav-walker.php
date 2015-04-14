<?php
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = array()){}

    public function end_lvl(&$output, $depth = 0, $args = array()){}

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){

        $item->title = str_repeat("&nbsp;", $depth * 4) . $item->title;

        parent::start_el($output, $item, $depth, $args);
        $output = str_replace('<li', '<option', $output);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array()){
      $output .= "</option>\n";
    }
}