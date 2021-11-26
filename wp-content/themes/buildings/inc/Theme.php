<?php

namespace Buildings;

class Theme
{
    private static $_instance;
    /**
     * @var Post
     */
    public $post;
    /**
     * @var Options
     */
    public $options;
    /**
     * @var Filters
     */
    private $filters;

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_theme_support( 'post-thumbnails' );

        $this->post = Post::instance();
        $this->options = Options::instance();
        $this->filters = Filters::instance();
    }

    public function enqueue_scripts() {
        wp_enqueue_style('icomoon', get_theme_file_uri('/assets/fonts/icomoon/icon-font.css'), array(), '1');
        wp_enqueue_style('main', get_theme_file_uri('/assets/css/style.min.css'), array(), '1');
        wp_enqueue_style('animate', get_theme_file_uri('/assets/libs/animate/animate.min.css'), array(), '1');
        wp_enqueue_style('style', get_theme_file_uri('/style.css'), array(), '1');

        wp_enqueue_script('jquery');
        wp_enqueue_script('popper', get_theme_file_uri('/assets/libs/bootstrap/js/popper.min.js'), 'jquery', '1', true);
        wp_enqueue_script('bootstrap', get_theme_file_uri('/assets/libs/bootstrap/js/bootstrap.min.js'), 'jquery', '1', true);
        wp_enqueue_script('ofi', get_theme_file_uri('/assets/libs/ofi/ofi.min.js'), 'jquery', '1', true);
        wp_enqueue_script('wowjs', get_theme_file_uri('/assets/libs/wowjs/wow.min.js'), 'jquery', '1', true);
        wp_enqueue_script('main', get_theme_file_uri('/assets/js/scripts.min.js'), 'jquery', '1', true);
        wp_enqueue_script('custom', get_theme_file_uri('/custom.js'), 'jquery', '1', true);

        wp_localize_script('custom', 'buildings', [
           'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }

    /**
     * @return \Buildings\Theme
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getAjax() {
        get_posts();
    }
}
