function loadCart() {
  // console.log("cart called");
  $.get('/cart',  // url
    function (data, textStatus, jqXHR) {  // success callback
      // console.log(data);
        $('#cart_ajax').html(data);
  });
}

var url_redirect = function(key,val){
  var href = new URL(window.location.href);
  href.searchParams.set(key,val);
  console.log(href.toString()); // https://google.com/?q=dogs
  window.location.href = href;
};

var setCollectionParams = function(){
  var href = new URL(window.location.href);
  if(href.searchParams.get("limit") != null) $('#limit').val(href.searchParams.get("limit"));
};



$(document).ready(function (e){

    $('#ck-sort-by').change(function(){
      url_redirect('sort-by', $(this).val());
    });

    $('#ck-limit').change(function(){
      url_redirect('limit', $(this).val());
    });

    setCollectionParams();

    $('.add-cart').click(function(){
      console.log("here submit");
      var validate = true;
       $('.product_options').each(function(){

            if($(this).val() == "")

              validate = false;


        });
        if(validate == false) alert("Please choose an option");
        return validate;
    });

    $(document).on('change', '.product_options',function(){
        console.log('product option change...')

        $("#variant_id > option").each(function() {
            var opt = JSON.parse($(this).attr('option-name'));
            var optval = this.value;
            var optobj = $(this);
            //console.log(obj);
            var matched = true;
            $('.product_options').each(function(){
              //	console.log("matching here",obj[$(this).attr('data-name')]);
              if(opt[$(this).attr('data-name')] != $(this).val())
                 matched = false;
             });

            if(matched){
              $("#variant_id").val(optval);

              //console.log("selected here",opj);
              //$("#variant_id").trigger('change');
              console.log("opt val here ",optval);
              return false;
            }else {
                $("#variant_id").val(0);
            }


        });
        if($("#variant_id").val() > 0){
          $('.add-cart').prop("disabled",false);
          var variantobj = JSON.parse($( "#variant_id option:selected").attr("data-opt"));
          $("#quantity").attr("max-stock",variantobj.max_stock);
          if(variantobj.max_stock < 0)
             $('.add-cart').prop("disabled",true);
        }else{
          $('.add-cart').prop("disabled",true);
        }
        $("#variant_id").trigger('change');

    });

    $("#quantity").change(function(){
      if($(this).val() > $(this).attr('max-stock'))
        $(this).val($(this).attr('max-stock'));

    });



//    cart
    $(".ck-cart-item-remove").click(function () {
        //console.log('cart item remove button click');
        event.preventDefault();
        $(this).closest('.ck-cart-item').remove();
        $('.ck-cart-form')[0].submit();
    });

    $(".ck-cart-item-quantity").change(function (){
        $('.ck-cart-form')[0].submit();
    });

    /*
      FOR LAZY LOADING PRODUCT
      Add "{{ Html.script(jquery.inview) }}" code in layout file.
      Add "collection-container" class in parent tag of product.
      Add "<img id="loader" width="128px" src="{{ Url.build(/img/) }}loader.gif">" code bottom of the parent.

    */


    var previous_url =  window.location.href;
    $('#loader').on('inview', function(event, isInView) {
      if (isInView) {
         //console.log("reached");
            var href = new URL(previous_url);
            var page = (href.searchParams.get("page") != null) ? href.searchParams.get('page') : 1;
            page = parseInt(page) + 1;

            href.searchParams.set('page', page);
            previous_url = href;

            $.get(href.toString(),function(data){
                if(data.trim().length == 0){
                  $("#loader").hide();
                }else{
                  $('.collection-container').append(data);
                }
            });
      }
    });

    /* $(".ck-rating").rating(
                {
                emptyStar: "fa fa-star-o",
                halfStar: "fa fa-star-half",
                filledStar: "fa fa-star",

                }
     ); */

$("body").on("click", ".ck-close", function(){
    // console.log("clicked");
    $(this).closest("#ck-flash").remove();
});


});
