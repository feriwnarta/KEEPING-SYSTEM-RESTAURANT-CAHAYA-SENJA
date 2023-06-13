$(function () {
  saveKeepingTemp();
  setKeepingInputDate();
  btnPilihMinumanCliced();
  infiniteLoadingPagination();
  whenPhoneNumberInputActive();
});

let data = [];
let keepingTemp = [];
let dataPaging = [];
let start = 0;

function whenPhoneNumberInputActive() {
  $(".input-cust-number-phone").on("input", function () {
    let val = $(this).val();

    let jsonData = JSON.stringify({ phoneNumber: val });

    $.ajax({
      type: "POST",
      url: "check-phone-number",
      data: jsonData,
      dataType: "JSON",
      success: function (response) {
        if (response != false) {
          $(".input-name-cust").val(response.cust_name);
        } else {
          $(".input-name-cust").val("");
        }
      },
    });
  });
}

function setKeepingInputDate() {
  // Mendapatkan tanggal hari ini
  var today = new Date().toISOString().split("T")[0];

  // Mengatur nilai input tanggal dengan tanggal hari ini
  document.getElementById("floatingDate").value = today;
}

function btnDeleteClicked(obj) {
  let id = obj.parentNode.parentNode.parentNode.parentNode.getAttribute("id");

  $(".list-keeping-picked").find(`#${id}`).remove();
}

function infiniteLoadingPagination() {
  $("#getMenu").on("shown.bs.modal", function () {
    $(this)
      .find(".modal-body")
      .scroll(function () {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(this).prop("scrollHeight");
        var clientHeight = $(this).prop("clientHeight");

        console.log(scrollTop + clientHeight);
        console.log(scrollHeight);

        if (scrollTop + clientHeight + 1 >= scrollHeight) {
          start = dataPaging.length;
          reqAllMinuman();
        }
      });
  });
}

function reqAllMinuman() {
  // awal ajax req dimulai
  $(document).ajaxStart(function () {
    showLoading();
  });

  $.ajax({
    type: "POST",
    url: "get-all-menu",
    data: {
      start: start,
    },
    cache: false,
    success: function (response) {
      const data = JSON.parse(response);

      hideLoading();

      data.forEach(function (element) {
        dataPaging.push(element);
      });

      let html = "";
      dataPaging.forEach(function (element) {
        html += `
            <div class="row">
            <div class="col-12 item" id="${element.id_menu}">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="prdct">
                        <img src="public/menu/${element.thumbnail}" alt="" srcset="" width="80" class="me-2">
                        ${element.name}
                    </div>
  
                    <div class="item d-flex flex-row align-items-center">
                        <div class="number-input d-flex flex-row">
                            <button class="btn minus" onclick="stepDown(event, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" stroke="white" stroke-width="1" />
                                </svg>
  
                            </button>
  
                            <input class="quantity form-control" min="0" name="quantity" value="0" type="number">
  
                            <button class="btn  plus" onclick="stepUp(event, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" stroke="white" stroke-width="1" />
                                </svg>
                            </button>
  
  
                        </div>
                    </div>
  
                </div>
                <hr>
            </div>
  
        </div>
            `;
      });

      $(".list-product").html(html);

      directInputQuantity();
    },
    error: function (xhr, status, error) {
      // Penanganan kesalahan
      hideLoading();
      console.error("Kesalahan permintaan:", error);
      console.log("Pesan kesalahan:", xhr.responseText);
    },
  });
}

var isLoading = false;

// Fungsi untuk menampilkan efek loading
function showLoading() {
  $(".menu-load").html(`<div class="d-flex justify-content-center">
    <div class="spinner-border text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
  </div>`);
}

// Fungsi untuk menyembunyikan efek loading
function hideLoading() {
  $(".menu-load").html(``);
}

function btnPilihMinumanCliced() {
  $(".btn-pilih-minuman").click(function () {
    reqAllMinuman();
  });
}

function sendButtonKeepingClicked() {
  if ($(".list-keeping-picked").html().trim() === "") {
    alert("minuman belum dipilih");
    return;
  }

  $(".form-keeping").submit(function (e) {
    e.preventDefault(); // Mencegah tindakan bawaan formulir
    let custName = $(".input-name-cust").val();
    let custPhoneNumber = $(".input-cust-number-phone").val();

    data = [];

    // get data keeping terupdate
    $(".list-keeping-picked .row").each(function () {
      let id = $(this).find(".item").attr("id");
      let count = $(this).find(".quantity").val();
      let tanggal = $("#floatingDate").val();

      data.push({
        id: id,
        count: count,
        custName: custName,
        custPhoneNumber: custPhoneNumber,
        tanggal: tanggal,
      });
    });

    let jsonData = JSON.stringify(data);

    $(document).ajaxStart(function () {
      Swal.fire({
        html: '<div class="spinner-border text-primary" role="status"></div>',
        showConfirmButton: false,
      });
    });

    $.ajax({
      type: "POST",
      url: "save-keeping",
      data: jsonData,
      dataType: "JSON",
      success: function (response) {
        if (response.status == "success" && response.status_code == 200) {
          Swal.fire({
            icon: "success",
            title: "Data berhasil disimpan",
            showConfirmButton: true,

            didClose: () => {
              location.reload();
            },
          });

          $(".input-name-cust").val("");
          $(".input-cust-number-phone").val("");
          $(".list-keeping-picked").empty();
        }
      },
      error: function (xhr, status, error) {
        // Handle error response
        if (xhr.status === 400) {
          if (JSON.parse(xhr.responseText).message == "data gagal disimpan") {
            Swal.fire({
              icon: "error",
              title: "Data gagal disimpan",
              showConfirmButton: true,
              didClose: () => {
                location.reload();
              },
            });
          } else if (
            JSON.parse(xhr.responseText).message ==
            "nama tidak boleh berbeda dengan nama yang sebelumnya"
          ) {
            Swal.fire({
              icon: "error",
              title:
                "Nama tidak boleh beda dengan nama yang sudah diinput menggunakan nomor ini",
              showConfirmButton: true,
              // didClose: () => {
              //   location.reload();
              // },
            });
          }
        }
      },
    });
  });
}

function directInputQuantity() {
  $(".quantity").on("input", function () {
    let id =
      this.parentNode.parentNode.parentNode.parentNode.getAttribute("id");
    let val = $(this).val();

    let image = this.parentNode.parentNode.parentNode.querySelector("img").src;
    let name = this.parentNode.parentNode.parentNode
      .querySelector(".prdct")
      .textContent.trim();

    if (keepingTemp.length == 0) {
      keepingTemp.push({
        id: id,
        count: val,
        image: image,
        name: name,
      });
    } else {
      keepingTemp.forEach(function (element, index, array) {
        if (element.id == id) {
          element.count = val;
        } else {
          keepingTemp.push({
            id: id,
            count: val,
            image: image,
            name: name,
          });
        }
      });
    }
  });
}

function stepDown(event, button) {
  event.preventDefault();
  var input = button.parentNode.querySelector("input.quantity");
  input.stepDown();

  var id =
    button.parentNode.parentNode.parentNode.parentNode.getAttribute("id");
  // value sesuah button minus ditekan

  addOrRemoveKeepingTemp(button, id);
}

function addOrRemoveKeepingTemp(button, id) {
  var realVal = button.parentNode.querySelector("input.quantity");
  realVal = $(realVal).val();

  let image = button.parentNode.parentNode.parentNode.querySelector("img").src;

  let name = button.parentNode.parentNode.parentNode
    .querySelector(".prdct")
    .textContent.trim();

  // simpan terlebih dahulu
  if (keepingTemp.length == 0) {
    keepingTemp.push({
      id: id,
      count: realVal,
      image: image,
      name: name,
    });
  } else {
    keepingTemp.forEach(function (element, index, array) {
      if (element.id === id) {
        element.count = realVal;
      } else {
        keepingTemp.push({
          id: id,
          count: realVal,
          image: image,
          name: name,
        });
      }
    });
  }
}

function stepUp(event, button) {
  event.preventDefault();
  var input = button.parentNode.querySelector("input.quantity");

  input.stepUp();

  var id =
    button.parentNode.parentNode.parentNode.parentNode.getAttribute("id");

  // value sesuah button minus ditekan
  addOrRemoveKeepingTemp(button, id);
}

function saveKeepingTemp() {
  $(".simpan").on("click", function () {
    let data = [];
    keepingTemp = keepingTemp.filter(function (element) {
      return element.count !== "0";
    });

    keepingTemp = keepingTemp.filter(function (obj, index, self) {
      return (
        self.findIndex(function (item) {
          return item.id === obj.id && item.name === obj.name;
        }) === index
      );
    });

    let html = "";

    keepingTemp.forEach(function (element) {
      html += `
          <div class="row mt-2">
            <div class="col-12 item" id="${element.id}">
                <div class="d-flex flex-row align-items-center justify-content-between" >
                    <div class="prdct">
                        <img src="${element.image}" alt="" srcset="" width="80" class="me-2">
                        ${element.name}
                    </div>
  
                    <div class="item d-flex flex-row align-items-center">
                        <div class="number-input d-flex flex-row">
                            <button class="btn minus" onclick="stepDown(event, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" stroke="white" stroke-width="1" />
                                </svg>
                            </button>
  
                            <input class="quantity form-control" min="0" name="quantity" value="${element.count}" type="number">
  
                            <button class="btn  plus" onclick="stepUp(event, this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" stroke="white" stroke-width="1" />
                                </svg>
                            </button>
  
                            <button class="btn delete ms-2" onClick="btnDeleteClicked(this)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                              <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"  stroke="white" stroke-width="1"/>
                            </svg>
                            </button> 
                        </div>
                    </div>
  
                </div>
              <hr>
          </div>
  
      </div>
  
          `;
    });

    $(".list-keeping-picked").html(html);
  });
}
