let regex = /%([^%]+)%/g;

$(document).ready(function () {
  initReplace("#editabelSaveKeeping");
  replaceOnInput(`#editabelSaveKeeping`, ".preview1");

  initReplace("#editableOutKeeping");
  replaceOnInput(`#editableOutKeeping`, ".preview2");

  // popover
  buttonTmbhVariableClicked(
    ".btnVarSave",
    "#popOverOption2",
    "#editabelSaveKeeping",
    ".preview1"
  );

  buttonTmbhVariableClicked(
    ".btnVarOut",
    "#popOverOption1",
    "#editableOutKeeping",
    ".preview2"
  );

  formatPreview("#editabelSaveKeeping", ".preview1");
  formatPreview("#editableOutKeeping", ".preview2");
});

function saveSettingClicked() {
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
        document.getElementsByClassName("swal-custom-content")[0].style.height =
          "auto";
      },
      onBeforeOpen: () => {
        Swal.showLoading();
      },
    });
  });

  let settingIn = $("#editabelSaveKeeping").text().replace(/\s+/g, " ");
  let settingOut = $("#editableOutKeeping").text().replace(/\s+/g, " ");

  let jsonData = JSON.stringify({
    settingIn: settingIn.trim(),
    settingOut: settingOut.trim(),
  });

  $.ajax({
    type: "POST",
    url: "save-setting-wablast",
    data: jsonData,
    dataType: "JSON",
    success: function (response) {
      if (response == "success") {
        Swal.fire({
          icon: "success",
          title: "Pengaturan berhasil diubah",
          showConfirmButton: true,

          didClose: () => {
            location.reload();
          },
        });
      }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
      if (xhr.responseText == "failed") {
        Swal.fire({
          icon: "error",
          title: "Pengaturan gagal diubah",
          showConfirmButton: true,

          didClose: () => {
            location.reload();
          },
        });
      }
    },
  });
}

function popOverVariable(element, editable, preview) {
  $(element)
    .find(".dropdown-item")
    .click(function () {
      // id tambah variabel
      let id = $(this).attr("id");

      let editableDiv = $(editable);

      let editableDivText = editableDiv.text();

      console.log(editableDivText);

      editableDivText += id;

      editableDiv.html(editableDivText);

      initReplace(editable);

      formatPreview(editable, preview);
    });
}

function buttonTmbhVariableClicked(element, elPopover, editable, preview) {
  $(element).click(function (event) {
    // Mendapatkan posisi dan ukuran tombol
    var button = $(this);
    var buttonPosition = button.offset();
    var buttonWidth = button.outerWidth();

    // Mengatur posisi popover
    var popover = $(elPopover);
    popover.css({
      top: buttonPosition.top + "px",
      left: buttonPosition.left + buttonWidth + "px",
    });

    // Menampilkan popover
    popover.show();

    // Menghentikan event klik dari mempengaruhi dokumen lainnya
    event.stopPropagation();
  });

  // Menyembunyikan popover saat klik di tempat lain pada halaman
  $(document).on("click", function (event) {
    var target = $(event.target);

    // Periksa apakah klik dilakukan pada popover atau tombol
    if (!target.closest(elPopover).length && !target.hasClass(element)) {
      $(elPopover).hide();
    }
  });

  popOverVariable(elPopover, editable, preview);
}

function initReplace(element) {
  let txtArea = $(`${element}`).text();

  let replacedHTML = txtArea.replace(regex, function (match, keyword) {
    let check = availableFormat(match);

    if (check) {
      return `
        <span class="badge rounded-pill text-bg-primary me-1" contenteditable="false">${match}</span>
        `;
    }
    return match;
  });

  $(`${element}`).html(replacedHTML);
}

function replaceOnInput(element, preview) {
  $(`${element}`).on("input", function () {
    var editableDiv = $(this)[0];
    var caretPosition = getCaretPosition(editableDiv);

    var val = $(this).text();

    var replacedHTML = val.replace(regex, function (match, keyword) {
      var check = availableFormat(match);

      if (check) {
        return (
          '<span class="badge rounded-pill text-bg-primary me-1">' +
          match +
          "</span>"
        );
      }
      return match;
    });

    $(this).html(replacedHTML);

    setCaretPosition(editableDiv, caretPosition);
    formatPreview(element, preview);
  });
}

function getCaretPosition(element) {
  var selection = window.getSelection();
  var range = document.createRange();
  range.selectNodeContents(element);
  range.setEnd(selection.anchorNode, selection.anchorOffset);
  var caretPos = range.toString().length;
  return caretPos;
}

function setCaretPosition(element, pos) {
  var range = document.createRange();
  var selection = window.getSelection();
  range.selectNodeContents(element);
  range.collapse(true);
  selection.removeAllRanges();
  selection.addRange(range);

  var textNodes = getTextNodesIn(element);
  var currentNode;
  var totalLength = 0;

  for (var i = 0; i < textNodes.length; i++) {
    var node = textNodes[i];
    var nodeLength = node.textContent.length;
    if (totalLength + nodeLength >= pos) {
      currentNode = node;
      break;
    }
    totalLength += nodeLength;
  }

  if (currentNode) {
    range = document.createRange();
    range.setStart(currentNode, pos - totalLength);
    range.collapse(true);
    selection.removeAllRanges();
    selection.addRange(range);
  }
}

function getTextNodesIn(node) {
  var textNodes = [];
  if (node.nodeType == 3) {
    textNodes.push(node);
  } else {
    var children = node.childNodes;
    for (var i = 0; i < children.length; i++) {
      textNodes.push.apply(textNodes, getTextNodesIn(children[i]));
    }
  }
  return textNodes;
}

function availableFormat(format) {
  switch (format) {
    case "%cust_name%":
      return true;
    case "%cust_phone%":
      return true;
    case "%product_count%":
      return true;
    case "%product_name%":
      return true;
    case "%date%":
      return true;
    case "%detail%":
      return true;
    case "%status%":
      return true;
    default:
      return false;
  }
}

function formatPreview(editable, preview) {
  let editableDiv = $(`${editable}`).text();

  console.log(editableDiv);

  var replacedHTML = editableDiv.replace(regex, function (match, keyword) {
    var check = formatMessage(match);

    if (check) {
      return check;
    }
    return format;
  });

  $(preview).html(replacedHTML);
}

function formatMessage(format) {
  switch (format) {
    case "%cust_name%":
      return "<div>Feri Winarta</div>";
    case "%cust_phone%":
      return "<div>085714342528</div>";
    case "%product_count%":
      return "<div>12</div>";
    case "%product_name%":
      return "<div>Kawa kawa, birguiness,</div>";
    case "%date%":
      return "<div>16-07-2023 : 17:00</div>";
    case "%detail%":
      return `
      =================================== <br>
      Nama Barang = bir guiness <br>
      Jumlah = 2 <br>
      Tanggal 26-07-2023 17:00 <br>
      ===================================
      `;
    case "%status%":
      return `
      <div>
      Kawa kawa => IN 
      <br>Guiness => IN 
      </div>
      `;
    default:
      return "";
  }
}
