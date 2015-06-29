<?php
class Widgets_Widget extends WP_Widget {

	function __construct() {
		 $widget_opts = array('classname' => 'widget_widgets', 'description' => __('Use this widget is to other widgets.') );
        parent::__construct('widgets', 'Widgets', $widget_opts);
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
	?>

		<p>
			<label>Title</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo $title; ?>">
		</p>
	
	<?php
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function widget( $args, $instance ) {
		$name = 'widget_'.$args['widget_id'];
        $widgets = get_field('widgets', $name);
		echo '<!-- Widgets: '. $instance['title'] . ' -->';
		if( $widgets ) {
			foreach($widgets as $widget) {
				acf_Widget::widget_instance($widget);
			}
		}
	}	
}

register_widget( 'Widgets_Widget' );