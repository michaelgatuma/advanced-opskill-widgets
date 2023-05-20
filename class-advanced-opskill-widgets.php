<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Advanced_Opskill_Widgets {

    private static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
    }

    public function init_widgets() {
        // Include Order Form 1 widget
        require_once( __DIR__ . '/widgets/order-form-widget.php' );
        // Register Order Form widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Order_Form_Widget() );
        // ... do this for any additional widgets ...
    }

}

// Instantiate Plugin Class
Advanced_Opskill_Widgets::instance();
