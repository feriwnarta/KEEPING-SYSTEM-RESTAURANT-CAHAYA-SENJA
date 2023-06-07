$(function () {
  // Mendapatkan URL saat ini
  var currentURL = window.location.href;

  // Mendapatkan semua elemen <a> di dalam navbar
  var navLinks = document.querySelectorAll(".navbar-nav .nav-link");

  // Meloop melalui setiap elemen <a>
  navLinks.forEach(function (link) {
    // Memeriksa jika URL elemen <a> sesuai dengan URL saat ini
    if (link.href === currentURL) {
      // Menghapus kelas "active" dari elemen <li> sebelumnya
      var previousActiveLi = document.querySelector(".navbar-nav .active");
      if (previousActiveLi) {
        previousActiveLi.classList.remove("active");
      }

      // Menambahkan kelas "active" pada elemen <li> yang merupakan elemen induk dari elemen <a>
      var liElement = link.parentNode;
      liElement.classList.add("active");
    }
  });

  // keepingTemp.push({ id: 1, count: 0 });

  saveKeepingTemp();
  directInputQuantity();
  sendButtonKeepingClicked();
});

function sendButtonKeepingClicked() {
  $("#submit-btn").click(function () {

    keepingTemp = keepingTemp.filter(function (obj, index, self) {
      return (
        self.findIndex(function (item) {
          return item.id === obj.id && item.name === obj.name;
        }) === index
      );
    });

    // Kode penanganan acara saat tombol submit diklik
    console.table(keepingTemp);
  });
}

let keepingTemp = [];

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
    keepingTemp.find(function (element, index, array) {
      if (element.count == 0) {
        array.splice(index, 1);
      }
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
          <div class="col-12 item" ${element.id}>
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
