<?php
/**
 * Nav Menu API: Mota_Walker_Nav_Menu class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Classe principale utilisée pour implémenter une liste HTML des éléments de menu de navigation.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
class Mota_Walker_Nav_Menu extends Walker {
    /**
     * Type de structure que la classe gère.
     *
     * @since 3.0.0
     * @var string
     *
     * @see Walker::$tree_type
     */
    public $tree_type = array('post_type', 'taxonomy', 'custom');

    /**
     * Champs de la base de données à utiliser.
     *
     * @since 3.0.0
     * @todo Découpler ceci.
     * @var string[]
     *
     * @see Walker::$db_fields
     */
    public $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id',
    );

    /**
     * Commence la liste avant que les éléments ne soient ajoutés.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Utilisé pour ajouter du contenu supplémentaire (passé par référence).
     * @param int      $depth  Profondeur de l'élément de menu. Utilisé pour le padding.
     * @param stdClass $args   Un objet des arguments de wp_nav_menu().
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $classes = array('sub-menu');
        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "\n$indent<ul$class_names>\n";
    }

    /**
     * Termine la liste après que les éléments ont été ajoutés.
     *
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Utilisé pour ajouter du contenu supplémentaire (passé par référence).
     * @param int      $depth  Profondeur de l'élément de menu. Utilisé pour le padding.
     * @param stdClass $args   Un objet des arguments de wp_nav_menu().
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    /**
     * Commence la sortie de l'élément.
     *
     * @since 3.0.0
     * @since 4.4.0 Le filtre {@see 'nav_menu_item_args'} a été ajouté.
     * @since 5.9.0 Renommé `$item` en `$data_object` et `$id` en `$current_object_id`
     *              pour correspondre à la classe parente pour la prise en charge des paramètres nommés PHP 8.
     *
     * @see Walker::start_el()
     *
     * @param string   $output            Utilisé pour ajouter du contenu supplémentaire (passé par référence).
     * @param WP_Post  $data_object       Objet de données de l'élément de menu.
     * @param int      $depth             Profondeur de l'élément de menu. Utilisé pour le padding.
     * @param stdClass $args              Un objet des arguments de wp_nav_menu().
     * @param int      $current_object_id ID de l'élément de menu actuel. Par défaut 0.
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
     * Termine la sortie de l'élément, si nécessaire.
     *
     * @since 3.0.0
     * @since 5.9.0 Renommé `$item` en `$data_object` pour correspondre à la classe parente pour la prise en charge des paramètres nommés PHP 8.
     *
     * @see Walker::end_el()
     *
     * @param string   $output      Utilisé pour ajouter du contenu supplémentaire (passé par référence).
     * @param WP_Post  $data_object Objet de données de l'élément de menu. Non utilisé.
     * @param int      $depth       Profondeur de la page. Non utilisé.
     * @param stdClass $args        Un objet des arguments de wp_nav_menu().
     */
    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }

    /**
     * Construit une chaîne d'attributs HTML à partir d'un tableau de paires clé/valeur.
     * Les valeurs vides sont ignorées.
     *
     * @since 6.3.0
     *
     * @param  array $atts Un tableau facultatif de paires clé/valeur d'attributs HTML. Par défaut tableau vide.
     * @return string Une chaîne d'attributs HTML.
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
