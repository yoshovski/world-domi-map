<?php

class WDM_Shortcode {

    private $wdm_shortcode_name = 'world-domi-map';
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new WDM_Shortcode();
        }
        return self::$instance;
    }

    public function __construct() {
        add_shortcode($this->wdm_shortcode_name, array($this, 'wdm_map_container_shortcode'));
    }

    public function wdm_map_container_shortcode($atts = [], $content = null) {
        $allowed_html = array(
            'div' => array(
                'class' => array(),
            ),
        );
        return wp_kses('<div class="wdm-map-container"></div>', $allowed_html);
    }

    public function get_shortcode_name() {
        return $this->wdm_shortcode_name;
    }
}
