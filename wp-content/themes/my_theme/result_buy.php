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
            <h3 class="text-success">Result Buy:</h3>
        </div>

        <?php echo 'ты тут ....!'; ?>
    </div>
    <!--/MAIN CONTENT page.php-->


    <!--FOOTER-->
    <?php get_footer(); ?>
    <!--/FOOTER-->

</div>
<!--/CONTAINER-FLUID-->