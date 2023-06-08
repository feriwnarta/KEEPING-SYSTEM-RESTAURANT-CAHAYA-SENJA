$(function () {});

function updateKeeping() {
  $(".form-update-keeping").submit(function (e) {
    e.preventDefault(); // Mencegah tindakan bawaan formulir
    let id = $(this).attr("id");
    let phoneNumber = $(".input-phone-number-cust").val();
    let nameCust = $(".input-name-cust").val();
    let product = $("#productDropdown").val();
    let count = $(".input-count-product").val();

    let data = {
      id: id,
      phoneNumber: phoneNumber,
      nameCust: nameCust,
      product: product,
      count: count,
    };

    $.ajax({
      type: "POST",
      url: "procesUpdate",
      data: data,
      dataType: "JSON",
      success: function (response) {},
    });
  });
}
