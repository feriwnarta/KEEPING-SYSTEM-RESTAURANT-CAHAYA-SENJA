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

    let jsonData = JSON.stringify(data);

    $.ajax({
      type: "POST",
      url: "process-update",
      data: jsonData,
      dataType: "JSON",
      success: function (response) {
        // if(response.star)
        if (response.status_code == 200 && response.status == "success") {
          Swal.fire({
            icon: "success",
            title: "Data berhasil diupdate",
            showConfirmButton: true,
            didClose: () => {
              location.reload();
            },
          });
        }
      },
      error: function (xhr, status, error) {
        // Handle error response
        if (xhr.status === 400) {
          if (JSON.parse(xhr.responseText).message == "data gagal diupdate") {
            Swal.fire({
              icon: "error",
              title: "Data gagal diupdate",
              showConfirmButton: true,
              didClose: () => {
                location.reload();
              },
            });
          }
        }
      },
    });
  });
}
