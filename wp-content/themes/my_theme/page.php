<br>
<!--CONTAINER-FLUID-->
<div class='container-fluid'>

<!--HEADER-->
    <?php  get_header(); ?>
<!--/HEADER-->


<!--MAIN CONTENT page.php-->
    <div class='col-sm-9 center-block text-danger' id="page_main_content_wrap">

        <?php wp_nav_menu($args);  //show main_menu ?>
        <hr>

        <div class="title_products center-block">
            <h3 class="text-success">Archive of Products:</h3>
        </div>

        <?php
        //show all Archive of Products (record post-type "postTypeProducts")
        $the_query = new WP_Query( array('post_type' => 'postTypeProducts'));

        if ( $the_query->have_posts() ) {  //if have posts in table "wp_posts" in DB
        echo '<ol class="text-success">';
            while ( $the_query->have_posts() ) {  //** -  */id_post_data_value=" '.get_the_ID().' "
            $the_query->the_post();
            echo '<li>
                     <a href="/'.$the_query->post->post_name.'" id_post_data_value="'.get_the_ID().'" data-toggle="popover" data-placement="top" title="'.get_the_title().'" data-content="'.get_the_content().'">'.get_the_title().'</a> &nbsp;
                     <a href="/'.$the_query->post->post_name.'" class="btn btn-success"><i class="glyphicon glyphicon-info-sign"></i> View product</a>
                   </li>';
            }
        echo '</ol>';
        }
        else { echo "There are no products !"; //no posts found
        }
        wp_reset_postdata();
        ?>
    </div>
<!--/MAIN CONTENT page.php-->
    <?php //isset($_POST) ?: var_dump($_POST) ?>

<!--FOOTER-->
    <?php get_footer(); ?>
<!--/FOOTER-->

</div>
<!--/CONTAINER-FLUID-->

<?php  echo do_shortcode('[get_modal_window_order]'); ?> <!--get html content with "Modal window for Order" from file-html(/wp-content/themes/my_theme/modal_window_order.html)-->

<?php if( isset($_POST) && !empty($_POST) ): echo do_shortcode('[page_result1]'); endif; ?>