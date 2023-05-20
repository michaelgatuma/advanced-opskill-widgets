<?php
require_once plugin_dir_path(__FILE__) . '../includes/data-query.php';

class Order_Form_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'opskill_order_form';
    }

    public function get_title()
    {
        return __('Opskill Order Form', 'advanced-opskill-widgets');
    }

    public function get_icon()
    {
        return 'eicon-price-list';
    }

    public function get_categories()
    {
        return ['general'];
    }

    // This is where the magic happens
    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'advanced-opskill-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_label',
            [
                'label' => __( 'Button Text', 'advanced-opskill-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => __( 'Button Text', 'advanced-opskill-widgets' ),
                'default' => __( 'Continue', 'advanced-opskill-widgets' ),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __( 'Button URL', 'advanced-opskill-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( get_site_url(null,'/order'), 'advanced-opskill-widgets' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'advanced-opskill-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'advanced-opskill-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .aow-form-wrapper, {{WRAPPER}} .aow-widget-field, {{WRAPPER}} .aow-widget-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render()
    {
        wp_enqueue_style(
            'aow-widget-styles',
            plugin_dir_url(__DIR__) . 'assets/css/aow-widget-styles.css'
        );
        wp_enqueue_script(
            'aow-widget-calculations',
            plugin_dir_url(__DIR__) . 'assets/js/aow-widget-calculations.js',
            ['jquery'], // This script requires jQuery
            false,
            true // This script goes in the footer
        );
        // Get Elementor's color scheme settings
        $color_scheme = get_option('elementor_scheme_color');

// Check if the color scheme is set
        if ($color_scheme) {
            $primary_color = $color_scheme[1]; // Primary color is the first item in the array
            $accent_color = $color_scheme[4]; // Accent color is the fourth item in the array
        } else {
            // Fallback color if the color scheme is not set
            $primary_color = '#1369ce';
            $accent_color = '#a832a6';
        }

        $academic_levels = fetch_academic_levels();
        $subjects = fetch_subjects();
        $paper_types = fetch_paper_types();
        $urgencies = fetch_urgency();

        // Get the settings
        $settings = $this->get_settings_for_display();
        // Get the button URL
        $button_url = $settings['button_url']['url'];
        $button_label = $settings['button_label'];

        echo '<div class="aow-form-wrapper">';

        echo '<select id="academic-level" class="aow-widget-field">';
        echo '<option selected>Select Academic Level</option>';
        foreach ($academic_levels as $level) {
            echo '<option value="' . $level['value'] . '" >' . $level['name'] . '</option>';
        }
        echo '</select>';

        echo '<select id="subject" class="aow-widget-field">';
        echo '<option selected>Select Subject</option>';
        foreach ($subjects as $subject) {
            echo '<option value="' . $subject['value'] . '" >' . $subject['name'] . '</option>';
        }
        echo '</select>';

        echo '<select id="paper-type" class="aow-widget-field">';
        echo '<option selected>Select Type of paper</option>';
        foreach ($paper_types as $type) {
            echo '<option value="' . $type['value'] . '" >' . $type['name'] . '</option>';
        }
        echo '</select>';

        echo '<select id="urgency" class="aow-widget-field">';
        echo '<option selected>Select Urgency</option>';
        foreach ($urgencies as $urgency) {
            echo '<option value="' . $urgency['value'] . '" >' . $urgency['urgency'] . $urgency['duration'] . '</option>';
        }
        echo '</select>';

        echo '<select id="pages" class="aow-widget-field">';
        echo '<option selected>Select Words/Page</option>';
        for ($i=1;$i<=30;$i++) {
            echo '<option value="' . $i . '" >' . 275*$i.' Words (double) ('.$i.' pgs)' . '</option>';
        }
        echo '</select>';

        echo '<div class="aow-total-wrapper"><div class="aow-total-label">Total:</div><div class="aow-total">$0.00</div></div>';

        echo '<a href="'.esc_url($button_url).'" style="width: 100%; background-color: '.$primary_color.'!important;" class="aow-widget-button elementor-button-link elementor-button elementor-size-sm elementor-button-full-width">
                    <span class="elementor-button-content-wrapper">
                        <span class="elementor-button-text">'.$button_label.'</span>
                    </span>
                </a>';

        echo '</div>';

        // This is just a basic example and will need to be modified to suit your exact needs
    }

    private function get_form_ids()
    {
        // This function should query your database and return an array of form IDs. The array keys will be the form IDs and the array values will be the form names.
    }
}
