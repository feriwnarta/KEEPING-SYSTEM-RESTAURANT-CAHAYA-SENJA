let id = "";
let isFormProcessing = false;

$(function () {});

function sweetAlertDestroy() {
  // Menutup SweetAlert menggunakan fungsi close()
  Swal.close();
}

function outKeeping(obj) {
  id = obj.getAttribute("value");

  let data = {
    id: id,
  };

  let jsonData = JSON.stringify(data);

  $.ajax({
    type: "POST",
    url: "out-keeping",
    data: jsonData,
    dataType: "JSON",
    success: function (response) {
      sweetAlertDestroy();
      let html = `
        <div class="row" id="${response.body.phone_number}">
              <div class="col-12 item" id="${response.body.id_keeping}">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                      <div class="prdct d-none d-sm-block" id="${response.body.id_menu}">
                          <img src="public/menu/${response.body.thumbnail}" alt="" srcset="" width="80" class="me-2">
                          ${response.body.name}
                      </div>

                    <div class="prdct d-sm-none d-flex flex-column align-items-center" id="${response.body.id_menu}">
                      <img src="public/menu/${response.body.thumbnail}" alt="" srcset="" width="80" class="me-2">
                      <div>${response.body.name}</div>
                    </div>
    
                      <div class="item d-flex flex-row align-items-center">
                          <div class="number-input d-flex flex-row">
                              <button class="btn minus" onclick="stepDown(event, this, ${response.body.product_count})">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-dash" viewBox="0 0 16 16">
                                      <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" stroke="white" stroke-width="1"></path>
                                  </svg>
    
                              </button>
    
                              <input id="quantity-input" class="quantity form-control" min="0" name="quantity" value="${response.body.product_count}" type="number">
    
                              <button class="btn  plus" onclick="stepUp(event, this, ${response.body.product_count})">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus" viewBox="0 0 16 16">
                                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" stroke="white" stroke-width="1"></path>
                                  </svg>
                              </button>
    
    
                          </div>
                      </div>
    
                  </div>
                  <hr>
              </div>
    
          </div>
        `;

      $(".list-product").html(html);

      quantityChange(response.body.product_count);
    },
  });
}

function quantityChange(val) {
  $("#quantity-input").on("input", function () {
    let realVal = parseInt($("#quantity-input").val());

    if (realVal > val) {
      $("#quantity-input").val("");
    }

    if (realVal > val || realVal < 1) {
      $("#quantity-input").val("");
    }
  });
}

function stepUp(event, button, val) {
  event.preventDefault();
  var input = button.parentNode.querySelector("input.quantity");
  let realVal = $("#quantity-input").val();

  if (realVal < val) {
    input.stepUp();
  }
}

function stepDown(event, button, val) {
  event.preventDefault();
  var input = button.parentNode.querySelector("input.quantity");
  let realVal = $("#quantity-input").val();

  if (realVal > 1) {
    input.stepDown();
  }
}

$(document).ajaxStart(function () {
  Swal.fire({
    html: `
    <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
    <div style="width: 3rem; height: 3rem;" class="spinner-border text-warning" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  
    `,
    showCancelButton: false,
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
    customClass: {
      popup: "swal-custom-popup",
      content: "swal-custom-content",
    },
  });
});

function processOut() {
  let phoneNumber = $(".list-product .row").attr("id");
  let id = $(".list-product .item").attr("id");
  let productId = $(".prdct").attr("id");
  let val = $(".list-product .item .quantity").val();

  let data = JSON.stringify({
    id: id,
    productId,
    phoneNumber: phoneNumber,
    val: val,
  });

  if (isFormProcessing == false) {
    isFormProcessing = true;

    $.ajax({
      type: "POST",
      url: "process-out",
      data: data,
      dataType: "JSON",
      success: function (response) {
        if (
          response.status == "success" &&
          response.message == "berhasil keluarkan barang"
        ) {
          Swal.fire({
            icon: "success",
            title: "Berhasil keluarkan barang",
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
          if (
            JSON.parse(xhr.responseText).message == "gagal keluarkan barang"
          ) {
            Swal.fire({
              icon: "error",
              title: "Gagal keluarkan barang",
              showConfirmButton: true,
              didClose: () => {
                location.reload();
              },
            });
          } else if (
            JSON.parse(xhr.responseText).message == "minus stock out keeping"
          ) {
            Swal.fire({
              icon: "error",
              title: "Error minus stock",
              text: "Ada yang salah saat mengeluarkan barang sehingga menyebabkan stock minus. pastikan tidak terjadi double click dan pastikan koneksi internet yang lancar",
              showConfirmButton: true,
              didClose: () => {
                location.reload();
              },
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Ada sesuatu yang salah",
              showConfirmButton: true,
              didClose: () => {
                location.reload();
              },
            });
          }
        }
      },
    });
  }

  isFormProcessing = false;
}
