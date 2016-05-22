<?php
/**
 * Created by PhpStorm.
 * User: littus
 * Date: 5/16/16
 * Time: 19:30 PM
 */
?>

<br>
<!--CONTAINER-FLUID-->
<div class='container-fluid'>

<!--HEADER-->
    <?php  get_header(); ?>
<!--/HEADER-->

<!--MAIN CONTENT INDEX PAGE-->
    <div class='col-sm-9 center-block text-danger' id="home_main_content_wrap">
<?php
        //Set & show main_menu
        $args = array(
        'theme_location'  => 'primary',
        'menu'            => 'main_menu',
        'container'       => 'div',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0
        );
        wp_nav_menu($args); //Show main_menu
?>
    <hr>
        <!-- if "Home Page" -->
        <?php if ( is_home() && is_front_page() ) : ?>
                    <p class="text-success">
                        This content "Home Page..........."
                    </p>
        <?php endif; ?>

        <!-- if not "Home Page" -->
        <?php if( have_posts() ) : ?>

            <?php if ( !is_home() && ! is_front_page() ) : ?>
                    <h2 class="page-title screen-reader-text text-success" data-value="<?php echo get_the_ID(); ?>"><?php single_post_title(); ?></h2>
                    <div class="mm">
                <?php
                    while( have_posts() ) {
                        the_post();
                        echo '<span class="title_item_product">Title of product: </span>';
                        the_title();
                        echo '<br> <span class="title_item_product">Description of product: </span>';
                        the_content();
                        echo '<span class="title_item_product">Add to Archive: </span>';
                        the_date();
                        echo ' ';
                        the_time();
                    }
                ?>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-shopping-cart"></i> Order product</button></li>

                <?php  echo do_shortcode('[get_modal_window_order]'); ?> <!--get html content with "Modal window for Order" from file-html(/wp-content/themes/my_theme/modal_window_order.html)-->
                <br><br>
            <?php endif; ?>
        <?php
        else :  //If no content, include the "No posts found" template.
            get_template_part( 'content', 'none' );
        endif;
        ?>

<!--(!)TESTING ZONE-->
        <?php //( isset($_POST) && !empty($_POST) ) ? var_dump($_POST) : '' ?>
        <?php //if( isset($_POST) && !empty($_POST) ): echo do_shortcode('[page_result1]'); endif; ?>
<!--/(!)TESTING ZONE-->
    </div>
<!--/MAIN CONTENT INDEX PAGE-->


<!--FOOTER-->
    <?php get_footer(); ?>
<!--/FOOTER-->

</div>
<!--/CONTAINER-FLUID-->