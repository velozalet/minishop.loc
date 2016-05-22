<?php
/**
 * Created by PhpStorm.
 * User: littus
 * Date: 5/16/16
 * Time: 23:33
 */

class Minishop
{

    public function __construct() {
        //add_action('init', 'postTypeProducts', 1); add_action('init', 'postTypeOrders', 2);
        add_action('init', array($this, 'postTypeProducts'), 1); //hook load function postTypeProducts()
        add_action('init', array($this, 'postTypeOrders'), 2); //hook load function postTypeOrders()
        add_action('init', array($this, 'addMyTaxonomy'), 0);  //hook load function addMyTaxonomy()
    }


    //create record post-type "postTypeProducts"
    public function postTypeProducts() {
        $labels = array(
            'name' => 'Products',
            'singular_name' => 'Single Product',
            'add_new' => 'Add New',
            'add_new_item' => 'Add new Product',
            'edit' => 'Edit',
            'edit_item' => 'Edit Product',
            'new_item' => 'New Product',
            'view' => 'View',
            'view_item' => 'View Product',
            'search_items' => 'Search Product',
            'not_found' =>  'Not Found the Product',
            'not_found_in_trash' => 'Not Found the Product in Trash',
            'parent' => 'Parent Product',
            'parent_item_colon' => '',
            'menu_name' => 'Menu of Products'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false, //true
            'menu_position' => null, //77
            'supports' => array('title','editor','author','thumbnail'),
            'taxonomies' => array('post_tag', 'category'), //2 standart(usual) taxonomies for record type "postTypeProducts"
            'has_archive' => true
        );
        register_post_type('postTypeProducts', $args);  //register record type "postTypeProducts"
    }  //__/function postTypeProducts()


    //create record post-type "postTypeOrders"
    public function postTypeOrders() {
        $labels = array(
            'name' => 'Orders',
            'singular_name' => 'Single Order',
            'add_new' => 'Add New',
            'add_new_item' => 'Add new Order',
            'edit' => 'Edit',
            'edit_item' => 'Edit Order',
            'new_item' => 'New Order',
            'view' => 'View',
            'view_item' => 'View Order',
            'search_items' => 'Search Order',
            'not_found' =>  'Not Found the Order',
            'not_found_in_trash' => 'Not Found the Order in Trash',
            'parent' => 'Parent Order',
            'parent_item_colon' => '',
            'menu_name' => 'Menu of Orders'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false, //true
            'menu_position' => null, //77
            'supports' => array('title','editor','author','thumbnail'),
            'taxonomies' => array('order_delivery', 'order_status'),  //2 custom taxonomies for record type "postTypeOrders"
            'has_archive' => true
        );
        register_post_type('postTypeOrders', $args);  //register record type "postTypeOrders"
    }  //__/function postTypeOrders()



    //create Taxonomy for "postTypeOrders"
    public function addMyTaxonomy() {

        //1.Delivery Method taxonomy(order_delivery)
        $labels = array(
            'name' => _x('Delivery Method', 'taxonomy general name'),
            'singular_name' => _x('Delivery singular Method', 'taxonomy singular name'),
            'search_items' => __('Search Delivery'),
            'popular_items' => __('Popular Delivery'),
            'all_items' => __('All Deliveries'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Delivery'),
            'update_item' => __('Update Delivery'),
            'add_new_item' => __('Add New Method'),  //'Add New Category'
            'new_item_name' => __('New Delivery Name'),
            'separate_items_with_commas' => __('Separate Delivery with commas'),
            'add_or_remove_items' => __('Add or remove Delivery'),
            'choose_from_most_used' => __('Choose from the most used Delivery'),
            'menu_name' => __('Delivery Method'),
        );
        register_taxonomy('order_delivery', 'postTypeOrders', array(
            'hierarchical' => true,  //true - по типу рубрик; false - по типу меток; default - false
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true, //tag cloud for taxonomy
            'update_count_callback' => '_update_post_term_count',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'order_delivery', //label
                               'hierarchical' => true,  //разрешить вложенность
             ),
        ));

        $parent_term = term_exists('order_delivery');
        $parent_term_id = $parent_term['term_id']; //id of term
        wp_insert_term(
            'Самовывоз', //new term
            'order_delivery', //taxonomy
            array(
                'description' => 'Способ доставки "Cамовывоз".',
                'slug' => 'pickup',
                'parent' => $parent_term_id
            )
        );
        wp_insert_term(
            'Доставка почтой', //new term
            'order_delivery', //taxonomy
            array(
                'description' => 'Способ доставки "Доставка почтой".',
                'slug' => 'delivery_by_mail',
                'parent' => $parent_term_id
            )
        );
        wp_insert_term(
            'Курьерская доставка', //new term
            'order_delivery', //taxonomy
            array(
                'description' => 'Способ доставки "Курьерская доставка".',
                'slug' => 'delivery_by_courier',
                'parent' => $parent_term_id
            )
        );


        //2.Status Order taxonomy(order_status)
        $labels = array(
            'name' => _x('Status Order', 'taxonomy general name'),
            'singular_name' => _x('Status singular Order', 'taxonomy singular name'),
            'search_items' => __('Search Order'),
            'popular_items' => __('Popular Order'),
            'all_items' => __('All Orders'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Order'),
            'update_item' => __('Update Order'),
            'add_new_item' => __('Add New Order'),
            'new_item_name' => __('New Order Name'),
            'separate_items_with_commas' => __('Separate Order with commas'),
            'add_or_remove_items' => __('Add or remove Order'),
            'choose_from_most_used' => __('Choose from the most used Order'),
            'menu_name' => __('Status Order'),
        );
        register_taxonomy('order_status', 'postTypeOrders', array(
            'hierarchical' => true,  //true - по типу рубрик; false - по типу меток; default - false
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true, //tag cloud for taxonomy
            'update_count_callback' => '_update_post_term_count',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'order_status', //label
                'hierarchical' => false,  //разрешить вложенность
            ),
        ));

        $parent_term1 = term_exists('order_status');
        $parent_term_id1 = $parent_term1['term_id']; //id of term
        wp_insert_term(
            'Обрабатывается', //new term
            'order_status', //taxonomy
            array(
                'description' => 'Статус "Обрабатывается".',
                'slug' => 'processed',
                'parent' => $parent_term_id1
            )
        );
        wp_insert_term(
            'Отправлен', //new term
            'order_status', //taxonomy
            array(
                'description' => 'Статус "Отправлен".',
                'slug' => 'sent',
                'parent' => $parent_term_id1
            )
        );
        wp_insert_term(
            'Отклонен', //new term
            'order_status', //taxonomy
            array(
                'description' => 'Статус "Отклонен".',
                'slug' => 'rejected',
                'parent' => $parent_term_id1
            )
        );

    }  //__/function create_taxonomy()


    //Add new custom role "Seller" with rights
    public function add_role_seller() {
        add_role('seller', 'Seller', array(
                                            'read' => true,
                                            'create_posts' => true,
                                            'edit_posts' => true,
                                            'delete_posts' => true,
                                            'publish_posts' => true,
                                            'manage_categories' => false,
                                            'edit_pages' => true,
                                            'edit_others_posts' => false,
                                            'edit_themes' => false,
                                            'install_plugins' => false,
                                            'update_plugin' => false,
                                            'update_core' => false,
                                        )
        );
    }

    //Add new custom role "Buyer" with rights
    public function add_role_buyer() {
        add_role('buyer', 'Buyer', array(
                                            'read' => true,
                                            'create_posts' => true,
                                            'edit_posts' => true,
                                            'delete_posts' => false,
                                            'publish_posts' => true,
                                            'manage_categories' => false,
                                            'edit_pages' => false,
                                            'edit_others_posts' => false,
                                            'edit_themes' => false,
                                            'install_plugins' => false,
                                            'update_plugin' => false,
                                            'update_core' => false,
                                    )
        );
    }

    //Remove all custom roles for Users when deactivating this plugin
    public function remove_custom_roles(){
        remove_role( 'seller' );
        remove_role( 'buyer' );
    }



} //___/class Minishop
