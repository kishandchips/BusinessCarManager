<?php
class Advert_Widget extends WP_Widget {

	function __construct() {
		 $widget_opts = array('classname' => 'widget_advert', 'description' => __('Use this widget is to show an advertisment.') );
        parent::__construct('advert', 'Advert', $widget_opts);
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$placement_id = (isset($instance['placement_id']))? esc_attr($instance['placement_id'] ) : '';
		$keywords = (isset($instance['keywords']))? esc_attr($instance['keywords'] ) : '';
	?>

		<p>
			<label>Placement Name</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo $title; ?>">
		</p>
		<p>	
			<label>Placement ID</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('placement_id') ?>" value="<?php echo $placement_id; ?>">
		</p>
		<p>	
			<label>Keyword(s)</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('keywords') ?>" value="<?php echo $keywords; ?>">
		</p>

	<?php
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function widget( $args, $instance ) {
		
		$placement_id = $instance['placement_id'];
		$keywords = ( !empty($instance['keywords'])) ? $instance['keywords'] : '';

		echo $args['before_widget'];
			
			include_module('advert', array(
				'placement_id' => $placement_id,
				'keywords' => $keywords
			));

		echo $args['after_widget'];
	}	
}

register_widget( 'Advert_Widget' );