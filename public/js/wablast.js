let regex = /%([^%]+)%/g;

$(document).ready(function () {
  initReplace();
  replaceOnInput();
});

function initReplace() {
  let txtArea = $("#editabelSaveKeeping").text();

  let replacedHTML = txtArea.replace(regex, function (match, keyword) {
    let check = availableFormat(match);

    if (check) {
      return `
        <span class="badge rounded-pill text-bg-primary me-1" contenteditable="false">${match}</span>
        `;
    }
    return match;
  });

  $("#editabelSaveKeeping").html(replacedHTML);
}

function replaceOnInput() {
  $("#editabelSaveKeeping").on("input", function () {
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
      break;
    case "%cust_phone%":
      return true;
      break;
    case "%product_count%":
      return true;
      break;
    case "%product_name%":
      return true;
      break;
    case "%date%":
      return true;
      break;
    case "%detail%":
      return true;
      break;
    case "%status%":
      return true;
      break;
    default:
      return false;
  }
}
