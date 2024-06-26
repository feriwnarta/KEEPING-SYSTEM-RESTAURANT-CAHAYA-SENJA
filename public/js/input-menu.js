$(function () {
    changeImageMenu();

});

let fileImage = null;

function changeImageMenu() {
    $('.input-image').click(function (e) {
        $(
            "<input type='file' accept='image/jpg, image/png, image/jpeg' style='display:none;'>"
        )
            .change(function () {
                let file = this.files[0];
                fileImage = file;
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    let = imageDataUrl = reader.result;
                    $(".input-image").attr("src", imageDataUrl);
                };
            })
            .click();

    });
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

function saveMenu() {
    $("#formSaveMenu").submit(function (e) {
        e.preventDefault(); // Mencegah t
        let menuName = $('.input-name-menu').val();


        if (fileImage == null) {
            fileImage = 'no-image';
        }

        let formData = new FormData();
        formData.append('imageMenu', fileImage);
        formData.append('menuName', menuName);


        $.ajax({
            type: "POST",
            url: 'save-menu',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                response = JSON.parse(response);

                if (response.status == 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Menu berhasil disimpan",
                        showConfirmButton: true,

                        didClose: () => {
                            location.reload();
                        },
                    });
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status === 400) {
                    if (JSON.parse(xhr.responseText).message == "Ekstensi file tidak diperbolehkan, hanya menerima file JPEG, JPG, dan PNG.") {
                        Swal.fire({
                            icon: "error",
                            title: "Ekstensi file tidak diperbolehkan, hanya menerima file JPEG, JPG, dan PNG.",
                            showConfirmButton: true,
                            didClose: () => {
                                location.reload();
                            },
                        });
                    } else if (JSON.parse(xhr.responseText).message == "Ukuran file terlalu besar, maksimal 2MB.") {
                        Swal.fire({
                            icon: "error",
                            title: "Ukuran file terlalu besar, maksimal 2MB.",
                            showConfirmButton: true,
                            didClose: () => {
                                location.reload();
                            },
                        });
                    } else if (JSON.parse(xhr.responseText).message == "Terjadi kesalahan saat menyimpan gambar.") {
                        Swal.fire({
                            icon: "error",
                            title: "Terjadi kesalahan saat menyimpan gambar.",
                            showConfirmButton: true,
                            didClose: () => {
                                location.reload();
                            },
                        });
                    } else if (JSON.parse(xhr.responseText).message == "gagal simpan menu") {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal simpan menu",
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