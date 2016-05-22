/**
 * Created by littus on 5/16/16.
 */
;
jQuery(function() {
    //alert(jsObject.text);



    //get "Modal window for Order"
    jQuery("[data-toggle='popover']").popover({
            //trigger: "click"  //in default value
            trigger: "hover"
        });


    //remove the message about the successful order after placing the order
    setTimeout(function() { jQuery("p.text-success.text-center.center-block").remove() }, 2000 );


    /**_______AJAX */

    jQuery("#myModal > div > div > div.modal-body > form > button").click(function(){
        console.log('click');
        console.log(myAjax.ajaxurl1);

        jQuery.ajax({
            url: myAjax.ajaxurl1,
            type: "POST",
            dataType: "json",
            data:{
                action: 'page_result1',
               // content: myAjax.data
            },

            success: function(data){
                console.log('OUTPUT');  //check success function
                console.dir(data);
            } //success
        });


    });
    //.change();












}); //__/jQuery(function()
