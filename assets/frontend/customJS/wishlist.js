//===================================== ADD TO WISHLIST ========================================
function wishlist(obj) {
  var product_id = $(obj).attr("product_id");
  var type_id = $(obj).attr("type_id");
  var status = $(obj).attr("status");
  // var ref ="here_"+type_id;
  var ref ="here";
  $.ajax({
    url: base_url+'Cart/wishlist',
    method: 'post',
    data: {
      product_id: product_id,
      status: status,
      type_id: type_id
    },
    dataType: 'json',
    success: function(response) {
      if (response.status == true) {
        notifySuccess(response.message)
        $("#headerCount").load(window.location.href + " #headerCount > *");   // wishlist count
        $("#footerCount").load(window.location.href + " #footerCount > *");   // wishlist count
        $("#wishlist").load(window.location.href + " #wishlist > *");
        $(".refreshing").load(window.location.href + " .refreshing > *");
      } else if (response.status == false) {
        notifyError(response.message)
      $("#wishlist").load(window.location.href + " #wishlist > *");
      $("#headerCount").load(window.location.href + " #headerCount > *");   // wishlist count
      $("#footerCount").load(window.location.href + " #footerCount > *");   // wishlist count
      $(".refreshing").load(window.location.href + " .refreshing > *");
      }
    }
  });
}

//===================================== ADD TO WISHLIST FROM FILTER PAGE ========================================
function wishlistWithFilter(obj) {
  var product_id = $(obj).attr("product_id");
  var type_id = $(obj).attr("type_id");
  var status = $(obj).attr("status");
  // var ref ="here_"+type_id;
  var ref ="here";
  $.ajax({
    url: base_url+'Cart/wishlist',
    method: 'post',
    data: {
      product_id: product_id,
      status: status,
      type_id: type_id
    },
    dataType: 'json',
    success: function(response) {
      if (response.status == true) {
        notifySuccess(response.message)
        $("#headerCount").load(window.location.href + " #headerCount > *");   // wishlist count
        $("#footerCount").load(window.location.href + " #footerCount > *");   // wishlist count
        if(status=="remove"){
        $('.iWish'+atob(type_id)).html('<a href="javascript:void(0)" product_id="'+product_id+'" type_id="'+type_id+'" status="add" onclick="wishlistWithFilter(this)"><i class="icon-heart float-right" style="color:red;"></i></a>')
      }else{
        $('.iWish'+atob(type_id)).html('<a href="javascript:void(0)" product_id="'+product_id+'" type_id="'+type_id+'" status="remove" onclick="wishlistWithFilter(this)"><i class="fa fa-heart float-right" style="color:red;"></i></a>')
      }
      } else if (response.status == false) {
        notifyError(response.message)
      $("#headerCount").load(window.location.href + " #headerCount > *");   // wishlist count
      $("#footerCount").load(window.location.href + " #footerCount > *");   // wishlist count
      }
    }
  });
}
