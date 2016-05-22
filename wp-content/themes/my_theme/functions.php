<?php

//Register & include CSS-files/js-files in theme "my_theme"
function add_my_scripts() {
    wp_register_style('bootstrap_css', get_template_directory_uri().'/assets/bootstrap/css/bootstrap.css', array(), false, 'all');
    wp_register_script('bootstrap_js', get_template_directory_uri().'/assets/bootstrap/js/bootstrap.js', array('jquery'), false, 'all');
    wp_register_style('style_css', get_template_directory_uri().'/style.css', array('bootstrap_css'), false, 'all');
    wp_register_script('main_js', get_template_directory_uri().'/assets/js/main.js', array('bootstrap_js'), false, 'all');

    wp_enqueue_style('bootstrap_css');
    wp_enqueue_script('bootstrap_js');
    wp_enqueue_style('style_css');
    wp_enqueue_script('main_js');

    //wp_localize_script( 'main_js', 'jsObject', array('text' => 'Hello! I am test string(wp_localize_script) !') );
    //-----------------------------------------------
    wp_localize_script( 'main_js', 'myAjax',
        array(
            'ajaxurl1' => admin_url('admin-ajax.php')
        ));
    //-----------------------------------------------
}
add_action('wp_enqueue_scripts', 'add_my_scripts');


//Register menu for theme "my_theme"
function main_menu() { //Main Menu
    register_nav_menu( 'primary', 'Main Menu' );
}
add_action( 'after_setup_theme', 'main_menu' );


//get "Modal window for Order"
function sh_code_get_modal_window_order( $atts, $content ) {  //var_dump( the_ID() );

    //for getting all Products
    $posts_name = '';
    $posts = get_posts( array(
        'numberposts'    => 5, // the same as posts_per_page
        'offset'         => 0,
        'category'       => '',
        'orderby'        => 'post_date',
        'order'          => 'DESC',
        'include'        => '',
        'exclude'        => '',
        'meta_key'       => '',
        'meta_value'     => '',
        'post_type'      => 'postTypeProducts',  //created record post-type "postTypeProducts"
        'post_mime_type' => '', //image, video, video/mp4
        'post_parent'    => '',
        'post_status'    => 'publish'
    ) );

    //for getting all Delivery Methods
    $terms = get_terms( array( 'order_delivery' ), array(
        'orderby'                => 'id',
        'order'                  => 'ASC',
        'hide_empty'             => false,
        'exclude'                => array(),
        'exclude_tree'           => array(),
        'include'                => array(),
        'number'                 => '',
        'fields'                 => 'all',
        'slug'                   => '',
        'parent'                 => '',
        'hierarchical'           => true,
        'child_of'               => 0,
        'get'                    => '',
        //ставим all чтобы получить все термины
        'name__like'             => '',
        'pad_counts'             => false,
        'offset'                 => '',
        'search'                 => '',
        'cache_domain'           => 'core',
        'name'                   => '',
        //str/arr поле name для получения термина по нему. C 4.2.
        'childless'              => false,
        //true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
        'update_term_meta_cache' => true,
        //подгружать метаданные в кэш
        'meta_query'             => '',
    ) );

    $current_user = wp_get_current_user();  //for getting private information about logged User
    $current_id_post = get_the_ID();  //for getting this ID post(id of product)
    $current_title_post = get_the_title();  //for getting this Title of product


    $html_modal_window_order = '
        <!-- MODAL WINDOW BLOCK -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog"> <!--modal-sm / modal-lg-->
                <div class="modal-content">

                    <!--Header of modal window-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title text-center" id="myModalLabel"><em class="glyphicon glyphicon-shopping-cart"></em>&nbsp Checkout order</h3>
                    </div>
                    <!--/Header of modal window-->

                    <!--Content of modal window-->
                    <div class="modal-body">

                        <!--form-->
                        <form class="form-inline" action=" '.home_url( '/archive-products' ).' " method="POST">

                            <div class="input-group">
                                <select name="name_product" class="form-control">';
                                    foreach ( array_reverse($posts) as $post ) {  //get all Products    action=" '.home_url('/result_buy').' "   action=" '.home_url( '/archive-products' ).' "
                                        if( $current_id_post == $post->ID ){
                                            $posts_name .= '<option value="'.$post->ID.'" selected> '.$post->post_name .' </option>';
                                        }
                                        else{
                                            $posts_name .= '<option value="'.$post->ID.'|'.$post->post_name.'"> '.$post->post_name .' </option>';
                                        }

                                    }
    $html_modal_window_order .= $posts_name;
    $html_modal_window_order .= '
                                 </select>
                             </div>
                            <div style="height:5px;"></div> <!--devider-->


                            <div class="input-group">';
                            if( 0 == $current_user->ID || $current_user->user_firstname == null || $current_user->user_firstname == '') {  //when User: is not logged in /is has no name /is has name as empty string
    $html_modal_window_order .= '
                                <span class="input-group-addon "> <em class="glyphicon glyphicon-user"></em> </span>
                                <input class="form-control input-lg" type="text" name="name_user" placeholder="Name" required>';
                            }
                            else{  //when User is logged in
    $html_modal_window_order .= '
                                <span class="input-group-addon "> <em class="glyphicon glyphicon-user"></em> </span>
                                <input class="form-control input-lg" type="text" name="name_user" placeholder="Name" value=" '.$current_user->user_firstname.' ">';
                            }
    $html_modal_window_order .= '
                            </div>
                            <div style="height:5px;"></div> <!--devider-->


                            <div class="input-group">';
                            if( 0 == $current_user->ID || $current_user->last_name == null || $current_user->last_name == '') {  //when User: is not logged in /is has no last name /is has last name as empty string
    $html_modal_window_order .= '
                                <span class="input-group-addon "> <em class="glyphicon glyphicon-user"></em> </span>
                                <input class="form-control input-lg" type="text" name="lastname_user" placeholder="Last Name" required>';
                            }
                            else{  //when User is logged in
    $html_modal_window_order .= '
                                <span class="input-group-addon "> <em class="glyphicon glyphicon-user"></em> </span>
                                <input class="form-control input-lg" type="text" name="lastname_user" placeholder="Name" value=" '.$current_user->last_name.' ">';
                            }
    $html_modal_window_order .= '
                            </div>
                            <div style="height:5px;"></div> <!--devider-->


                            <div class="input-group">';
                            if( 0 == $current_user->ID ) {  //when User is not logged in
    $html_modal_window_order .= '
                                <span class="input-group-addon "> <em class="glyphicon glyphicon-envelope"></em> </span>
                                <input class="form-control input-lg" type="text" name="email" placeholder="Email address" required>';
                            }
                            else{  //when User is logged in
    $html_modal_window_order .= '
                                <span class="input-group-addon "> <em class="glyphicon glyphicon-envelope"></em> </span>
                                <input class="form-control input-lg" type="text" name="email" placeholder="Email address" value=" '.$current_user->user_email.' ">';
                            }
    $html_modal_window_order .= '
                            </div>


                            <input class="form-control input-lg" type="hidden" name="title_product" value=" '.$current_title_post.' ">
                            <div style="height:5px;"></div> <!--devider-->

                            <div class="input-group">
                                <select name="delivery_method" class="form-control">';
                                    foreach ( $terms as $term ) {  //get all Delivery Methods
                                        $html_modal_window_order .= '<option value="' . $term->term_id . '">' . $term->name . '</option>';
                                    }
   $html_modal_window_order .= '
                                </select>
                            </div>
                            <br><br>

                                <button class="btn btn-success btn-lg"><em class="glyphicon glyphicon-usd"></em> Buy </button>
                        </form>
                        <!--/form-->

                    </div>
                    <!--/Content of modal window-->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Closed</button>
                    </div>

                </div> <!--/Content of modal window -->
            </div> <!--/class="modal-dialog"-->
        </div>
        <!--/MODAL WINDOW BLOCK -->
    ';

    return $html_modal_window_order;
}
add_shortcode("get_modal_window_order", "sh_code_get_modal_window_order");



/**
Ajax handlers
 */
function page_result1(){

    try {
        if ( empty( $_POST['name_product'] ) ) {
            throw new Exception( 'ID Товара.' );
        } else {
            $name_product = sanitize_text_field( $_POST['name_product'] );
        }
        if ( empty( $_POST['title_product'] ) ) {
            throw new Exception( 'Наименование Товара.' );
        } else {
            $title_product = sanitize_text_field( $_POST['title_product'] );
        }
        if ( empty( $_POST['delivery_method'] ) ) {
            throw new Exception( 'Способ доставки.' );
        } else {
            $delivery_method = sanitize_text_field( $_POST['delivery_method'] );
        }
        if ( empty( $_POST['name_user'] ) ) {
            throw new Exception( 'Внесите свое Имя' );
        } else {
            $name_user = sanitize_text_field( $_POST['name_user'] );
        }
        if ( empty( $_REQUEST['lastname_user'] ) ) {
            throw new Exception( 'Внесите свою Фамилию' );
        } else {
            $lastname_user = sanitize_text_field( $_POST['lastname_user'] );
        }
        if ( empty( $_POST['email'] ) ) {
            throw new Exception( 'Почта.' );
        } else {
            $email = sanitize_email( $_POST['email'] );
        }

        //if $name_product have '|' that means chosen are not the same product that the default in "Modal window for Order"
        if (strstr ($name_product, '|') ){   //split string variables and we put in the array
            $name_product = explode('|', $name_product);  //$name_product(array): [0]=>10, [1]=> book1
        } else{  //put in array variables, that is the already default in "Modal window for Order"
            $name_product = array($name_product, $title_product); //$name_product(array): [0]=>10, [1]=> book1
        }

        $post_content = '
            <p> <span style="color:blue; font-weight: bold">1.ID of Product: </span> '.$name_product[0].' </p>
            <p> <span style="color:blue; font-weight: bold">1.Nomenclature\'s Product: </span> '.$name_product[1].' </p>
            <p> <span style="color:blue; font-weight: bold">2.Сustomer Name: </span> '.$name_user.' </p>
            <p> <span style="color:blue; font-weight: bold">3.Сustomer Surname: </span>'.$lastname_user.' </p>
            <p> <span style="color:blue; font-weight: bold">4.Сustomer E-mail: </span>' .$email.' </p>
            <p> <span style="color:blue; font-weight: bold">4.Registration Date of Order: </span>' .current_time('d M Y, H:i:s', 0).' </p>
            ';

        $term_processed = get_term_by( 'slug', 'processed', 'order_status' );
        $post_data = array(
            'post_title'    => wp_strip_all_tags( 'New Order' ),
            'post_content'  => $post_content,
            'post_type'     => 'postTypeOrders',  //'postTypeOrders' - record post-type "postTypeOrders"
            'post_status'   => 'Обрабатывается',
            'post_author'   => $email,
            'post_status'   => 'private',
            'tax_input'     => array(
                'order_delivery' => array( $delivery_method ),
                'order_status'   => array( $term_processed->term_id )
            ),
            'post_category' => array( 8, 39 )
        );
        $post_id = wp_insert_post( $post_data );
        if ( $post_id == 0 ) {
            throw new Exception( '<span class="text-danger"> Error of Order! </span>' );
        }
    } catch ( Exception $e ) {
        return 'Ошибка: ' . $e->getMessage() . "\n";
    }
   $data = $post_id;

    //echo json_encode($data); die;
    return "<p class='text-success text-center center-block'> <strong>Purchase completed successfully!</strong> </p>";
}
add_action('wp_ajax_nopriv_page_result1', 'page_result1');
add_action('wp_ajax_page_result1', 'page_result1');

add_shortcode( 'page_result1', 'page_result1' );



//no used(!) - without AJAX
function page_result() {  //$_REQUEST
    try {
        if ( empty( $_POST['name_product'] ) ) {
            throw new Exception( 'ID Товара' );
        } else {
            $name_product = sanitize_text_field( $_POST['name_product'] );
        }
        if ( empty( $_POST['title_product'] ) ) {
            throw new Exception( 'Наименование Товара' );
        } else {
            $title_product = sanitize_text_field( $_POST['title_product'] );
        }
        if ( empty( $_POST['delivery_method'] ) ) {
            throw new Exception( 'Способ доставки.' );
        } else {
            $delivery_method = sanitize_text_field( $_POST['delivery_method'] );
        }
        if ( empty( $_POST['name_user'] ) ) {
            throw new Exception( 'Внесите свое Имя' );
        } else {
            $name_user = sanitize_text_field( $_POST['name_user'] );
        }
        if ( empty( $_REQUEST['lastname_user'] ) ) {
            throw new Exception( 'Внесите свою Фамилию' );
        } else {
            $lastname_user = sanitize_text_field( $_POST['lastname_user'] );
        }
        if ( empty( $_POST['email'] ) ) {
            throw new Exception( 'Почта.' );
        } else {
            $email = sanitize_email( $_POST['email'] );
        }

        //if $name_product have '|' that means chosen are not the same product that the default in "Modal window for Order"
        if (strstr ($name_product, '|') ){   //split string variables and we put in the array
            $name_product = explode('|', $name_product);  //$name_product(array): [0]=>10, [1]=> book1
        } else{  //put in array variables, that is the already default in "Modal window for Order"
            $name_product = array($name_product, $title_product); //$name_product(array): [0]=>10, [1]=> book1
        }

        $post_content = '
            <p> <span style="color:blue; font-weight: bold">1.ID of Product: </span> '.$name_product[0].' </p>
            <p> <span style="color:blue; font-weight: bold">1.Nomenclature\'s Product: </span> '.$name_product[1].' </p>
            <p> <span style="color:blue; font-weight: bold">2.Сustomer Name: </span> '.$name_user.' </p>
            <p> <span style="color:blue; font-weight: bold">3.Сustomer Surname: </span>'.$lastname_user.' </p>
            <p> <span style="color:blue; font-weight: bold">4.Сustomer E-mail: </span>' .$email.' </p>
            <p> <span style="color:blue; font-weight: bold">4.Registration Date of Order: </span>' .current_time('d M Y, H:i:s', 0).' </p>
            ';


        $term_processed = get_term_by( 'slug', 'processed', 'order_status' );
        $post_data = array(
            'post_title'    => wp_strip_all_tags( 'New Order' ),
            'post_content'  => $post_content,
            'post_type'     => 'postTypeOrders',  //'postTypeOrders' - record post-type "postTypeOrders"
            'post_status'   => 'Обрабатывается',
            'post_author'   => $email,
            'post_status'   => 'private',
            'tax_input'     => array(
                'order_delivery' => array( $delivery_method ),
                'order_status'   => array( $term_processed->term_id )
            ),
            'post_category' => array( 8, 39 )
        );
        $post_id = wp_insert_post( $post_data );
        if ( $post_id == 0 ) {
            throw new Exception( '<span class="text-danger"> Error of Order! </span>' );
        }
    } catch ( Exception $e ) {
        return 'Ошибка: ' . $e->getMessage() . "\n";
    }
    return "<p class='text-success text-center center-block'> <strong>Purchase completed successfully!</strong> </p>";

}
add_shortcode( 'page_result', 'page_result' );




//---------------------------------------------------------------

//get html content with "Modal window for Order" from file-html(/wp-content/themes/my_theme/modal_window_order.html)
//function sh_code_get_modal_window_order($atts, $content) {
//    $html_modal_window_order = file_get_contents( get_template_directory_uri().'/modal_window_order.php' ); //the path to the HTML-file with "Modal window for Order"
//    if($html_modal_window_order) {  return $html_modal_window_order; }
//}
//add_shortcode("get_modal_window_order", "sh_code_get_modal_window_order");
