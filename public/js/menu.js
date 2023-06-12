let parentIdMenu = null;
let parentThumbnail = null;
let parentMenuName = null;

function updateMenu(thumbnail, name, idMenu) {
  $(".list-product").html(
    `
            
            <form id="formUpdateMenu" class="d-flex flex-row align-items-center">
                    <img src="${thumbnail}" class="input-image " alt="" srcset="" width="100" height="100">
                    

                    <div class="form-floating ms-4">
                            <input type="text" class="form-control input-name-menu" id="floatingInput" placeholder="name@example.com" name="inputNameMenu" required value="${name}">
                            <label for="floatingInput">Nama Menu</label>
                    </div>
            </form>
          
        
        `
  );

  changeImageMenu();
  parentIdMenu = idMenu;
  parentThumbnail = thumbnail;
  parentMenuName = name;
  //   processUpdateMenu();
}

let fileImage = null;

function changeImageMenu() {
  $(".input-image").click(function (e) {
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

function processUpdateMenu() {
  if (fileImage == null) {
    fileImage = "no-image-update";
  }

  if (parentIdMenu == null) {
    parentIdMenu = "idnull";
  }

  let menuName = $(".input-name-menu").val();

  if (menuName === parentMenuName && fileImage === "no-image-update") {
    // => sama

    Swal.fire({
      icon: "error",
      title: "Tidak ada perubahan data",
      showConfirmButton: true,
    });

    return false;
  }

  let formData = new FormData();
  formData.append("idMenu", parentIdMenu);
  formData.append("imageMenu", fileImage);
  formData.append("menuName", menuName);

  $.ajax({
    type: "POST",
    url: "update-menu",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      response = JSON.parse(response);

      if (response.status == "success") {
        Swal.fire({
          icon: "success",
          title: "Menu berhasil diupdate",
          showConfirmButton: true,

          didClose: () => {
            location.reload();
          },
        });
      }
    },
    error: function (xhr, status, error) {
      if (xhr.status === 400) {
        if (
          JSON.parse(xhr.responseText).message ==
          "Ekstensi file tidak diperbolehkan, hanya menerima file JPEG, JPG, dan PNG."
        ) {
          Swal.fire({
            icon: "error",
            title:
              "Ekstensi file tidak diperbolehkan, hanya menerima file JPEG, JPG, dan PNG.",
            showConfirmButton: true,
            didClose: () => {
              location.reload();
            },
          });
        } else if (
          JSON.parse(xhr.responseText).message ==
          "Ukuran file terlalu besar, maksimal 2MB."
        ) {
          Swal.fire({
            icon: "error",
            title: "Ukuran file terlalu besar, maksimal 2MB.",
            showConfirmButton: true,
            didClose: () => {
              location.reload();
            },
          });
        } else if (
          JSON.parse(xhr.responseText).message ==
          "Terjadi kesalahan saat menyimpan gambar."
        ) {
          Swal.fire({
            icon: "error",
            title: "Terjadi kesalahan saat menyimpan gambar.",
            showConfirmButton: true,
            didClose: () => {
              location.reload();
            },
          });
        } else if (
          JSON.parse(xhr.responseText).message == "gagal update menu"
        ) {
          Swal.fire({
            icon: "error",
            title: "Gagal update menu",
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

function removeMenu(id) {
  Swal.fire({
    title: "Konfirmasi Hapus Data",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "delete-menu",
        data: {
          id: id,
        },
        success: function (response) {
          response = JSON.parse(response);

          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Menu berhasil dihapus",
              showConfirmButton: true,

              didClose: () => {
                location.reload();
              },
            });
          }
        },
        error: function (xhr, status, error) {
          if (xhr.status === 400) {
            if (JSON.parse(xhr.responseText).message == "gagal delete menu") {
              Swal.fire({
                icon: "error",
                title: "Gagal hapus menu",
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
  });
}
