<?php
if( !is_user_logged_in() ) {  //show button "login in"  when the User is not logged in
    echo '<a href=" '.home_url().'/wp-login.php " class="btn btn-default" id="btn_login_in"><em class="glyphicon glyphicon-user"></em> Login in</a><br><br>';
}
?>

<?php wp_head(); ?>
<div class='col-sm-12' id="header_div">
    <br>
        <p class='text-center'> HEADER </p>
    <br>
</div>

