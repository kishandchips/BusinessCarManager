<?php
class Widget_Image_Button extends WP_Widget {

   function __construct() {
        $widget_opts = array('classname' => 'widget_image_button', 'description' => __('Use this widget is to show an image button.') );
        parent::WP_Widget('image_button', 'Image Button', $widget_opts);
    }

    function form($instance) {
        $title = (isset($instance['title'])) ? esc_attr($instance['title']) : '';
        $url = (isset($instance['url'])) ? esc_attr($instance['url']) : '';
    ?>
        <p>
            <label>Title <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
         <p>
            <label>Url <input class="widefat" name="<?php echo $this->get_field_name('url') ?>" type="text" value="<?php echo $url; ?>" /></label>
        </p>
        
    <?php 
    }

    function update($new_instance, $old_instance){
        return $new_instance;
    }

    function widget($args, $instance) {
        
        echo $args['before_widget'];
        $name = 'widget_'.$args['widget_id'];
        $image = get_field('image', $name);
        $button_label = get_field('button_label', $name);
        $class = array();
        $class[] = ( $image ) ? 'image-btn' : '';
        if( $image ) :
    ?>
        <a class="<?php echo implode(' ', $class); ?>" href="<?php echo $instance['url']; ?>">
            
            <figure class="image">
                <img src="<?php echo get_image($image, array(250, 160)); ?>" />
            </figure>
            <?php if($button_label) : ?>
            <span class="primary-btn"><?php echo $button_label; ?></span>
            <?php endif; ?>
        </a>
    <?php
        endif;
        echo $args['after_widget'];
    }
}

register_widget('Widget_Image_Button');