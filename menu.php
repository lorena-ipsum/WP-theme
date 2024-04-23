<?php
/**
 * Nav Menu API: Mota_Walker_Nav_Menu class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
class Mota_Walker_Nav_Menu extends Walker {
    /**
     * What the class handles.
     *
     * @since 3.0.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = array('post_type', 'taxonomy', 'custom');

    /**
     * Database fields to use.
     *
     * @since 3.0.0
     * @todo Decouple this.
     * @var string[]
     *
     * @see Walker::$db_fields
     */
    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    /**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $classes = array('sub-menu');
        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "\n$indent<ul$class_names>\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     * @since 5.9.0 Renamed `$item` to `$data_object` and `$id` to `$current_object_id`
     *              to match parent class for PHP 8 named parameter support.
     *
     * @see Walker::start_el()
     *
     * @param string   $output            Used to append additional content (passed by reference).
     * @param WP_Post  $data_object       Menu item data object.
     * @param int      $depth             Depth of menu item. Used for padding.
     * @param stdClass $args              An object of wp_nav_menu() arguments.
     * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
     */
    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $menu_item = $data_object;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($menu_item->classes) ? array() : (array) $menu_item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($menu_item->attr_title) ? $menu_item->attr_title : '';
        $atts['target'] = !empty($menu_item->target) ? $menu_item->target : '';
        $atts['rel']    = !empty($menu_item->xfn) ? $menu_item->xfn : '';
        $atts['href']   = !empty($menu_item->url) ? $menu_item->url : '';
        $atts['aria-current'] = $menu_item->current ? 'page' : '';

        $attributes = $this->build_atts($atts);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $menu_item->title, $menu_item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        if (in_array('menu-item-has-children', $menu_item->classes)) {
            $item_output .= '<button type="button" aria-expanded="false" aria-controls="sub-menu-item-' . $menu_item->ID . '">
                             <span aria-hidden="true">+</span>
                             <span class="sr-only">' . __('Ouvrir le sous-menu', 'text-domain') . '</span>
                             </button>';
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 3.0.0
     * @since 5.9.0 Renamed `$item` to `$data_object` to match parent class for PHP 8 named parameter support.
     *
     * @see Walker::end_el()
     *
     * @param string   $output      Used to append additional content (passed by reference).
     * @param WP_Post  $data_object Menu item data object. Not used.
     * @param int      $depth       Depth of page. Not Used.
     * @param stdClass $args        An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }

    /**
     * Builds a string of HTML attributes from an array of key/value pairs.
     * Empty values are ignored.
     *
     * @since 6.3.0
     *
     * @param  array $atts Optional. An array of HTML attribute key/value pairs. Default empty array.
     * @return string A string of HTML attributes.
     */
    protected function build_atts($atts = array()) {
        $attribute_string = '';
        foreach ($atts as $attr => $value) {
            if (!is_null($value) && $value !== '') {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attribute_string .= ' ' . $attr . '="' . $value . '"';
            }
        }
        return $attribute_string;
    }
}
