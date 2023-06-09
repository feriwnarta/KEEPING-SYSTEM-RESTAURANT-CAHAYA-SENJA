function outKeeping(obj) {
  let id = obj.getAttribute("value");

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
      console.log(response);
      // console.log(response.body.cust_name);

      let html = `
        <div class="row" id="${response.body.phone_number}">
              <div class="col-12 item" id="${response.body.id_keeping}">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                      <div class="prdct" id="${response.body.id_menu}">
                          <img src="${response.body.thumbnail}" alt="" srcset="" width="80" class="me-2">
                          ${response.body.name}
                      </div>
    
                      <div class="item d-flex flex-row align-items-center">
                          <div class="number-input d-flex flex-row">
                              <button class="btn minus" onclick="stepDown(event, this)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-dash" viewBox="0 0 16 16">
                                      <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" stroke="white" stroke-width="1"></path>
                                  </svg>
    
                              </button>
    
                              <input class="quantity form-control" min="0" name="quantity" value="${response.body.product_count}" type="number">
    
                              <button class="btn  plus" onclick="stepUp(event, this)">
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
    },
  });
}

function stepUp(event, button) {
  event.preventDefault();
  var input = button.parentNode.querySelector("input.quantity");
  input.stepUp();
}

function stepDown(event, button) {
  event.preventDefault();
  var input = button.parentNode.querySelector("input.quantity");
  input.stepDown();
}

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

  $.ajax({
    type: "POST",
    url: "process-out",
    data: data,
    dataType: "JSON",
    success: function (response) {
      console.log(response);
    },
  });
}
