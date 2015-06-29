<?php 
$class = array('advert');
$class[] = ( !empty($options['responsive']) ) ? 'responsive' : ''; 
?>
<div id="<?php echo $placement_id; ?>" class="<?php echo implode(' ', $class); ?>" data-options="<?php echo ( !empty($options) ) ? esc_js(json_encode($options, JSON_NUMERIC_CHECK)) : ''; ?>" data-placement-id="<?php echo $placement_id; ?>"></div>