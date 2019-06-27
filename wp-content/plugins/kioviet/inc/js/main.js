jQuery(document).ready(function($){
   $('#sync_product').click(function(){
       let arrID = [];
       $.each($('input[name="_productID"]:checked'), function(){
           arrID.push($(this).val());
       });

       $.ajax({
          type: 'post',
          dataType: 'json',
          url: adminurl,
            data: {
              action: 'sync_data_ajax',
              page_size: getUrlParameter('page_size'),
              arrID: arrID
            },
           success: function(response){
              console.log(response);
           }
       });
   });
    $('input[name="allItems"]').click(function(){
        if(this.checked){
            $('input[name="_productID"]').prop('checked', true);
        }else{
            $('input[name="_productID"]').prop('checked', false);
        }

    });
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    $('#sync_categories').click(function(){
        let arrID = [];
        $.each($('input[name="_productID"]:checked'), function(){
            arrID.push($(this).val());
        });
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: adminurl,
            data: {
                action: 'sync_categories_ajax',
                arrID: arrID
            },
            success: function(response){
                console.log(response);
            }
        });
    });
});
