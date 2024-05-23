add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_663245a6f099b',
	'title' => 'Photo',
	'fields' => array(
		array(
			'key' => 'field_663245a7505b1',
			'label' => 'Type',
			'name' => 'type',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'Argentique' => 'Argentique',
				'Numérique' => 'Numérique',
			),
			'default_value' => 'Numérique',
			'return_format' => 'value',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 1,
			'ajax' => 1,
			'placeholder' => '',
		),
		array(
			'key' => 'field_663245b8505b2',
			'label' => 'Reference',
			'name' => 'reference',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'portfolio',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => 'reference',
	'show_in_rest' => 1,
) );
} );

add_action( 'init', function() {
	register_taxonomy( 'categorie', array(
	0 => '',
), array(
	'labels' => array(
		'name' => 'Categories',
		'singular_name' => 'Categorie',
		'menu_name' => 'Catégories',
		'all_items' => 'Tout les Catégories',
		'edit_item' => 'Modifier Catégorie',
		'view_item' => 'Voir Catégorie',
		'update_item' => 'Mettre à jour Catégorie',
		'add_new_item' => 'Ajouter Catégorie',
		'new_item_name' => 'Nom du nouveau Catégorie',
		'search_items' => 'Rechercher Catégories',
		'popular_items' => 'Catégories populaire',
		'separate_items_with_commas' => 'Séparer les catégories avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer catégories',
		'choose_from_most_used' => 'Choisir parmi les catégories les plus utilisés',
		'not_found' => 'Aucun catégories trouvé',
		'no_terms' => 'Aucun catégories',
		'items_list_navigation' => 'Navigation dans la liste Catégories',
		'items_list' => 'Liste Catégories',
		'back_to_items' => '← Aller à « catégories »',
		'item_link' => 'Lien Catégorie',
		'item_link_description' => 'Un lien vers un catégorie',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
	'show_admin_column' => true,
) );

	register_taxonomy( 'formats', array(
	0 => 'photos',
), array(
	'labels' => array(
		'name' => 'Formats',
		'singular_name' => 'Formats',
		'menu_name' => 'Formats',
		'all_items' => 'Tout les Formats',
		'edit_item' => 'Modifier Formats',
		'view_item' => 'Voir Formats',
		'update_item' => 'Mettre à jour Formats',
		'add_new_item' => 'Ajouter Formats',
		'new_item_name' => 'Nom du nouveau Formats',
		'search_items' => 'Rechercher Formats',
		'popular_items' => 'Formats populaire',
		'separate_items_with_commas' => 'Séparer les formats avec une virgule',
		'add_or_remove_items' => 'Ajouter ou retirer formats',
		'choose_from_most_used' => 'Choisir parmi les formats les plus utilisés',
		'not_found' => 'Aucun formats trouvé',
		'no_terms' => 'Aucun formats',
		'items_list_navigation' => 'Navigation dans la liste Formats',
		'items_list' => 'Liste Formats',
		'back_to_items' => '← Aller à « formats »',
		'item_link' => 'Lien Formats',
		'item_link_description' => 'Un lien vers un formats',
	),
	'public' => true,
	'show_in_menu' => true,
	'show_in_rest' => true,
) );
} );

add_action( 'init', function() {
	register_post_type( 'portfolio', array(
	'labels' => array(
		'name' => 'Portfolio',
		'singular_name' => 'portfolio',
		'menu_name' => 'Portfolio',
		'all_items' => 'Tout les Portfolio',
		'edit_item' => 'Modifier portfolio',
		'view_item' => 'Voir portfolio',
		'view_items' => 'Voir Portfolio',
		'add_new_item' => 'Ajouter portfolio',
		'add_new' => 'Ajouter portfolio',
		'new_item' => 'Nouveau portfolio',
		'parent_item_colon' => 'portfolio parent :',
		'search_items' => 'Rechercher Portfolio',
		'not_found' => 'Aucun portfolio trouvé',
		'not_found_in_trash' => 'No portfolio found in Trash',
		'archives' => 'Archives des portfolio',
		'attributes' => 'Attributs des portfolio',
		'insert_into_item' => 'Insérer dans portfolio',
		'uploaded_to_this_item' => 'Téléversé sur ce portfolio',
		'filter_items_list' => 'Filtrer la liste portfolio',
		'filter_by_date' => 'Filtrer portfolio par date',
		'items_list_navigation' => 'Navigation dans la liste Portfolio',
		'items_list' => 'Liste Portfolio',
		'item_published' => 'portfolio publié.',
		'item_published_privately' => 'portfolio publié en privé.',
		'item_reverted_to_draft' => 'portfolio repassé en brouillon.',
		'item_scheduled' => 'portfolio planifié.',
		'item_updated' => 'portfolio mis à jour.',
		'item_link' => 'Lien portfolio',
		'item_link_description' => 'Un lien vers un portfolio.',
	),
	'public' => true,
	'show_in_rest' => true,
	'menu_position' => 2,
	'menu_icon' => 'dashicons-format-gallery',
	'supports' => array(
		0 => 'title',
		1 => 'editor',
		2 => 'thumbnail',
		3 => 'custom-fields',
		4 => 'post-formats',
	),
	'taxonomies' => array(
		0 => 'formats',
		1 => 'categorie',
	),
	'delete_with_user' => false,
) );
} );

