<?php

namespace App;

use App\Controllers\App;
use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), false, null, true);

    if (!is_admin()) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_script('wp-embed');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => "footer navigation"
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

add_filter('wp_nav_menu_args', function ($args) {
    $args['container'] = 'nav';
    $args['menu_class'] = 'menu-list';
    return $args;
});


add_filter('nav_menu_css_class', function ($classes, $item) {
    $c[] = 'menu-item';

    if (in_array('current-menu-item', $classes) || in_array('current_page_item', $classes)
        || ($item->object === 'category' && in_category($item->object_id, get_the_ID()))) {
        $c[] = 'menu-item_current';
    }

    if (in_array('menu-item-has-children', $classes)) {
        $c[] = 'menu-item_sub';
    }

    return $c;
}, 10, 4);

add_filter( 'nav_menu_submenu_css_class', function () {
    return array('menu-menu_sub');
}, 10, 3);

add_filter( 'nav_menu_link_attributes', function ($atts) {
    $atts['class'] =  'menu-link';
    return $atts;
}, 10, 3 );

add_filter( 'nav_menu_item_title', function ($title) {
    return "<span>$title</span> ";
}, 10, 4);


/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

add_filter('intermediate_image_sizes_advanced', function ($sizes) {
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);

    return $sizes;
});

add_action('init', function () {
    remove_image_size('1536x1536');
    remove_image_size('2048x2048');
});
