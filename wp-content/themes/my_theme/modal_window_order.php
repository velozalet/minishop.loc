<?php $tt = 'qqqqqqqqqqqqqq'; ?>

<!-- MODAL WINDOW BLOCK -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog"> <!--modal-sm / modal-lg-->
        <div class="modal-content">

            <!--Header of modal window-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center" id="myModalLabel"><em class='glyphicon glyphicon-shopping-cart'></em>&nbsp Оформить Заказ</h3>
            </div>
            <!--/Header of modal window-->

            <!--Content of modal window-->
            <div class="modal-body">

                <!--form-->
                <form class='form-inline' action="" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon "> <em class='glyphicon glyphicon-user'></em> </span>
                        <input class="form-control input-lg" type="text" name='name_user' placeholder="Name">
                    </div>
                    <div style='height:5px;'></div> <!--devider-->
                    <div class="input-group">
                        <span class="input-group-addon "> <em class='glyphicon glyphicon-user'></em> </span>
                        <input class="form-control input-lg" type="text" name='lastname_user' placeholder="Last Name">
                    </div>
                    <div style='height:5px;'></div> <!--devider-->
                    <div class="input-group">
                        <span class="input-group-addon "> <em class='glyphicon glyphicon-envelope'></em> </span>
                        <input class="form-control input-lg" type="text" name='email' placeholder="Email address">
                    </div>

                    <input class="form-control input-lg" type="hidden" name='hd' value="<?php echo $tt ?>">
                    <div style='height:5px;'></div> <!--devider-->

                    <div class="input-group">
                        <select name="delivery_method" class="form-control">
                            <option value="3">Доставка почтой</option>
                            <option value="4">Курьерская доставка</option>
                            <option value="2">Cамовывоз</option>
                        </select>
                    </div>
                    <br><br>

                        <button class='btn btn-success btn-lg'><em class='glyphicon glyphicon-usd'></em> Buy </button>
                </form>
                <!--/form-->

            </div>
            <!--/Content of modal window-->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Closed</button>
            </div>

        </div> <!-- modal-content. END -->
    </div> <!-- modal-dialog. END -->
</div>
<!--/MODAL WINDOW BLOCK -->