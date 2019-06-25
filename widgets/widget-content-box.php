<?php

add_action('widgets_init', create_function('', 'return register_widget("pa_content_box");'));

class pa_content_box extends WP_Widget {
    /**
     * WordPress Widget Constructor Method
	 *
     * @access public  
	 * @since  1.0.0
    */
	function __construct() {
		parent::__construct(
			'pa_content_box',
			__('PA Content Box', 'widget_name'),
			array('description' => __('Display Content Box...'))
		);
	}
    
    /**
     * WordPress Widget Method
	 *
     * @access public  
	 * @since  1.0.0
    */
	function widget($args, $instance) {
        extract($args);
        $post = get_post($instance['post']); $image = getImage($post);
        require(WPPAGEASSEMBLER.'templates/template-content-box.php');
    }

	/**
     * WordPress Update Method
	 *
     * @access public  
	 * @since  1.0.0
    */
	function update($new_instance, $old_instance) {
        $instance = $old_instance;
        foreach($new_instance as $key=>$value) {
            $instance[$key] = strip_tags($value);
        }
        return $instance;
    }
    
    /**
     * WordPress Form Method
	 *
     * @access public  
	 * @since  1.0.0
    */
	function form($instance) {
		$defaults = array('title' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        global $wpPosts, $alternates, $wpPages, $textAlign, $imageShapes;
        $sliderControls = array(
            "title"                     => "text",
            "footnote"                  => "text",
            "post"                      => $wpPosts,            
            "alternate"                 => $alternates,
            "height"                    => "text",
            "textAlign"                 => $textAlign,
            "imageUniform"              => $alternates,
            "imageShape"                => $imageShapes,
            "captionColor"              => "text",
            "textColor"                 => "text",
            "backgroundColor"           => "text",
            "backgroundImage"           => "text",
            "backgroundOverlay"         => "text",
            "callToActionButtonPage"    => $wpPages,
            "callToActionButtonText"    => "text",
            "callToActionButtonClass"   => "text"
        );
        $sliderControl = new wpFormControl($this, $instance);
        foreach($sliderControls as $key=>$value) {
            $sliderControl->getControl($key, $value);
        }
	}
}

?>