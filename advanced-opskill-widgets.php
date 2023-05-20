<?php

/*
Plugin Name: Advanced Opskill Widgets
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: gatuma
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

final class Advanced_Opskill_Widgets_Plugin {

    const VERSION = '1.0.1';

    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    const MINIMUM_PHP_VERSION = '7.4';

    public function __construct() {

        add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
        // Once we get here, We have passed all validation checks so we can safely include our plugin
        require_once( 'class-advanced-opskill-widgets.php' );
    }

    public function on_plugins_loaded(){
        $customizer_content = '';

        $plugin = 'elementor/elementor.php';

        $installed_plugins = get_plugins();

        $is_elementor_installed = isset( $installed_plugins[ $plugin ] );

        // Check if Elementor installed and activated
        if ( ! $is_elementor_installed ) {
            //Install Elementor
            add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
            return;
        }elseif ( ! defined( 'ELEMENTOR_VERSION' ) ) {
            //Activate Elementor
            add_action( 'admin_notices', array( $this, 'admin_notice_activate_main_plugin' ) );
            return;
        }elseif ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '<' ) ) {
            // Update Elementor
            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
            return;
        }

//        // Check for required Elementor version
//        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
//            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
//            return;
//        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
            return;
        }
    }

    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed.', 'advanced-opskill-widgets' ),
            '<strong>' . esc_html__( 'Advanced Opskill Widgets', 'advanced-opskill-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'advanced-opskill-widgets' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_activate_main_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be activated.', 'advanced-opskill-widgets' ),
            '<strong>' . esc_html__( 'Advanced Opskill Widgets', 'advanced-opskill-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'advanced-opskill-widgets' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advanced-opskill-widgets' ),
            '<strong>' . esc_html__( 'Advanced Opskill Widgets', 'advanced-opskill-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'advanced-opskill-widgets' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'advanced-opskill-widgets' ),
            '<strong>' . esc_html__( 'Advanced Opskill Widgets', 'advanced-opskill-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'advanced-opskill-widgets' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

}

// Instantiate Advanced_Opskill_Widgets.
new Advanced_Opskill_Widgets_Plugin();
