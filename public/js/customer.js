function getNameAndPhone(name, phone) {
  $("#phoneNumber").val(phone);
  $("#name").val(name);
}

function sendMessageToCust() {
  $("#formSendMessageToCust").submit(function (e) {
    e.preventDefault(); // Mencegah tindakan bawaan formulir

    let phone = $("#phoneNumber").val();
    let name = $("#name").val();
    let message = $("#message").val();

    let data = JSON.stringify({
      phone: phone,
      name: name,
      message: message,
    });

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
        onOpen: () => {
          document.getElementsByClassName(
            "swal-custom-popup"
          )[0].style.overflowY = "auto";
          document.getElementsByClassName(
            "swal-custom-content"
          )[0].style.height = "auto";
        },
        onBeforeOpen: () => {
          Swal.showLoading();
        },
      });
    });

    $.ajax({
      type: "POST",
      url: "send-single-message",
      data: data,
      dataType: "JSON",
      success: function (response) {
        if (response) {
          Swal.fire({
            icon: "success",
            title: "Berhasil kirim pesan",
            showConfirmButton: true,

            didClose: () => {
              location.reload();
            },
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Gagal mengirim pesan",
          showConfirmButton: true,
          didClose: () => {
            location.reload();
          },
        });
      },
    });
  });
}

function sendMessageToAllCust() {
  $("#formSendMessageAll").submit(function (e) {
    e.preventDefault(); // Mencegah tindakan bawaan formulir

    let message = $("#messageAll").val();

    let data = JSON.stringify({
      message: message,
    });

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
        onOpen: () => {
          document.getElementsByClassName(
            "swal-custom-popup"
          )[0].style.overflowY = "auto";
          document.getElementsByClassName(
            "swal-custom-content"
          )[0].style.height = "auto";
        },
        onBeforeOpen: () => {
          Swal.showLoading();
        },
      });
    });

    $.ajax({
      type: "POST",
      url: "send-all-message",
      data: data,
      dataType: "JSON",
      success: function (response) {
        if (response) {
          Swal.fire({
            icon: "success",
            title: "Berhasil kirim pesan",
            showConfirmButton: true,

            didClose: () => {
              location.reload();
            },
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Gagal mengirim pesan",
          showConfirmButton: true,
          didClose: () => {
            location.reload();
          },
        });
      },
    });
  });
}
