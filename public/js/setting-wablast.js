$(function () {
  $(".save-setting").click(function () {
    $.ajax({
      type: "GET",
      url: "barcode",
      success: function (response) {
        
        $('.modal-body').html(response);


      },
    });
  });
});
