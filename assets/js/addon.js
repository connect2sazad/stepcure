/**
 * Addon JavaScript
 */

'use strict';

(function () {

  // Move admin-navbar to the top of header
  document.addEventListener("DOMContentLoaded", function () {
    const navAdmin = document.getElementById("admin-navbar");
    const header = document.querySelector(".header");
    if (navAdmin && header) {
      header.insertBefore(navAdmin, header.firstChild);
    }
  });

  // Move nav_admin to the beginning of the header
  var nav_admin = document.getElementById("admin-navbar");
  var header = document.querySelector(".header") || document.querySelector("header");

  if (nav_admin && header) {
    header.insertBefore(nav_admin, header.firstChild);
  }

})();


function slug_creator(title) {
  title = title.toLowerCase();
  title = title.split(' ').join('-');
  title = title.replace(/[^a-z0-9-]/g, "");
  return title;
}

$(document).ready(function () {
  $.fn.dataTable.ext.errMode = 'none';

  // Loop through each table
  $('table').each(function () {
    var $table = $(this);
    var info = $table.attr('data-info');

    // Skip initializing DataTable for tables with data-info="ignore-dt"
    if (info === 'ignore-dt') return;

    // Common options
    var options = {
      select: true,
    };

    // If the data-info is "no-pagination", disable pagination
    if (info === 'no-pagination') {
      options.paging = false;
    }

    // Initialize DataTable with the computed options
    var table = $table.DataTable(options);

    // Optional: handle DataTables errors
    table.on('error.dt', function (e, settings, techNote, message) {
      console.log('An error has been reported by DataTables: ', message);
    });
  });
});


$(document).ready(function () {
  const maxChars = 150;

  // Find the textarea with data-info="remarks"
  const $textarea = $('textarea#remarks[data-info="remarks"]');

  if ($textarea.length) {
    // Create and insert the counter element dynamically
    const $counter = $('<small>', {
      id: 'remarks-counter',
      class: 'form-text text-muted',
      text: `0 / ${maxChars} characters`
    });

    $textarea.after($counter);

    // Function to update character count and trim input
    function updateCounter() {
      let text = $textarea.val();

      // Remove emojis and non-keyboard characters (retain only ASCII 32–126)
      text = text.replace(/[^\x20-\x7E]/g, '');

      // Enforce max character limit
      if (text.length > maxChars) {
        text = text.substring(0, maxChars);
      }

      $textarea.val(text);
      $counter.text(`${text.length} / ${maxChars} characters`);
    }

    // Initial update in case textarea is pre-filled
    updateCounter();

    // Attach input event listener
    $textarea.on('input', updateCounter);
  }

  // search in select
  $('select').select2();
  $('.select2-container').removeAttr('style');

});


function ConfirmDialogBox(message = "Are you sure?", title = "Please Confirm", optionalNote = "") {
  return new Promise((resolve) => {
    const modalElement = document.getElementById("customConfirmModal");
    const modal = new bootstrap.Modal(modalElement);

    document.getElementById("customConfirmMessage").textContent = message;
    document.getElementById("customNote").textContent = optionalNote;
    document.getElementById("customConfirmModalLabel").innerHTML = "<i class=\"fas fa-info-circle text-info\"></i> " + title;

    const okButton = document.getElementById("customConfirmOk");
    const cancelButton = document.querySelector("#customConfirmModal .btn-label-secondary");

    const onConfirm = () => {
      resolve(true);
      cleanup();
      modal.hide();
    };

    const onCancel = () => {
      resolve(false);
      cleanup();
      modal.hide();
    };

    const onKeyDown = (e) => {
      if (e.key === "Enter") {
        onConfirm();
      } else if (e.key === "Escape") {
        onCancel();
      } else {
        onCancel();
      }
    };

    const cleanup = () => {
      okButton.removeEventListener("click", onConfirm);
      cancelButton.removeEventListener("click", onCancel);
      document.removeEventListener("keydown", onKeyDown);
    };

    okButton.addEventListener("click", onConfirm);
    cancelButton.addEventListener("click", onCancel);
    document.addEventListener("keydown", onKeyDown);

    modal.show();
  });
}


document.addEventListener('keydown', function (e) {
  if (e.ctrlKey && e.key === 'f') {
    e.preventDefault(); // Stop the browser's default find behavior
    const searchInput = $('input[type="search"]');
    if (searchInput) {
      searchInput.focus();
      searchInput.select(); // Optional: selects the current text
    }
  }
});




// ========================================================context menu
let clickedImageSrc = null;

document.addEventListener('contextmenu', function (e) {
  e.preventDefault();

  const menu = document.getElementById('custom-context-menu');
  menu.style.display = 'block';

  const menuWidth = menu.offsetWidth;
  const menuHeight = menu.offsetHeight;
  const viewportWidth = window.innerWidth;
  const viewportHeight = window.innerHeight;

  let x = e.clientX;
  let y = e.clientY;

  if (x + menuWidth > viewportWidth) x = viewportWidth - menuWidth - 10;
  if (y + menuHeight > viewportHeight) y = viewportHeight - menuHeight - 10;

  menu.style.left = `${x}px`;
  menu.style.top = `${y}px`;

  // Context awareness
  const selection = window.getSelection().toString().trim();
  const isTextSelected = selection.length > 0;
  const isInput = e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA';
  const isLink = e.target.closest('a[href]');
  const isImage = e.target.tagName === 'IMG';

  window._activeInput = isInput ? e.target : null;
  window._activeLinkHref = isLink ? isLink.href : null;
  clickedImageSrc = isImage ? e.target.src : null;

  // Toggle dynamic items
  document.getElementById('copyTextItem').style.display = isTextSelected ? 'block' : 'none';
  document.getElementById('cutTextItem').style.display = isInput ? 'block' : 'none';
  document.getElementById('copyInputTextItem').style.display = isInput ? 'block' : 'none';
  document.getElementById('pasteTextItem').style.display = isInput ? 'block' : 'none';
  document.getElementById('openInNewTabItem').style.display = isLink ? 'block' : 'none';
  document.getElementById('openInNewWindowItem').style.display = isLink ? 'block' : 'none';
  document.getElementById('openImageInNewTabItem').style.display = isImage ? 'block' : 'none';
  document.getElementById('copyImageAddressItem').style.display = isImage ? 'block' : 'none';
});

document.querySelectorAll('#custom-context-menu .has-submenu').forEach(item => {
  item.addEventListener('mouseenter', function () {
    const submenu = this.querySelector('.submenu');
    if (!submenu) return;

    // Reset to default right position
    submenu.style.left = '100%';
    submenu.style.right = 'auto';

    const rect = submenu.getBoundingClientRect();
    const viewportWidth = window.innerWidth;

    if (rect.right > viewportWidth) {
      // Not enough space on right, open to the left
      submenu.style.left = 'auto';
      submenu.style.right = '100%';
    }
  });
});

document.addEventListener('click', function () {
  document.getElementById('custom-context-menu').style.display = 'none';
});

// Clipboard actions
function copySelectedText() {
  const text = window.getSelection().toString();
  navigator.clipboard.writeText(text);
}

function cutInputText() {
  const input = window._activeInput;
  if (input) {
    navigator.clipboard.writeText(input.value.substring(input.selectionStart, input.selectionEnd));
    const before = input.value.substring(0, input.selectionStart);
    const after = input.value.substring(input.selectionEnd);
    input.value = before + after;
  }
}

function copyInputText() {
  const input = window._activeInput;
  if (input) {
    navigator.clipboard.writeText(input.value.substring(input.selectionStart, input.selectionEnd));
  }
}

function pasteIntoInput() {
  const input = window._activeInput;
  if (input) {
    navigator.clipboard.readText().then(text => {
      const before = input.value.substring(0, input.selectionStart);
      const after = input.value.substring(input.selectionEnd);
      input.value = before + text + after;
    });
  }
}

// Link actions
function openLinkInNewTab() {
  if (window._activeLinkHref) {
    window.open(window._activeLinkHref, '_blank');
  }
}

function openLinkInNewWindow() {
  if (window._activeLinkHref) {
    window.open(window._activeLinkHref, '_blank', 'noopener,noreferrer,width=800,height=600');
  }
}

// Image actions
function openImageInNewTab() {
  if (clickedImageSrc) {
    window.open(clickedImageSrc, '_blank');
  }
}

function copyImageAddress() {
  if (clickedImageSrc) {
    navigator.clipboard.writeText(clickedImageSrc);
    Toastify({
      text: "Image Address Copied to Clipboard!",
      duration: 3000,
      close: true,
      gravity: "top",
      position: "right",
      backgroundColor: "#4fbe87",
    }).showToast();
  }
}

// Focus search
function focusSearch() {
  const searchInput = $('input[type="search"]');
  if (searchInput.length) {
    searchInput.focus();
    searchInput.select();
  }
}

// Hooking actions to menu
document.getElementById('openImageInNewTabItem').onclick = openImageInNewTab;
document.getElementById('copyImageAddressItem').onclick = copyImageAddress;
// ========================================================context menu


// ====================================================== unsaved changes
function enableUnsavedChangesWarning(formSelector) {
  let formIsDirty = false;
  const $form = $(formSelector);

  if (!$form.length) {
    console.warn(`Form not found: ${formSelector}`);
    return;
  }

  // Mark form dirty on any input/change
  $form.on('input change', () => {
    formIsDirty = true;
  });

  // Provide a function to reset dirty flag on successful submit
  // We'll return it so you can call after AJAX success
  function markFormClean() {
    formIsDirty = false;
  }

  // Setup beforeunload warning once
  if (!window.unsavedChangesWarningEnabled) {
    $(window).on('beforeunload', function (e) {
      if (formIsDirty) {
        e.preventDefault();
        e.returnValue = '';
      }
    });
    window.unsavedChangesWarningEnabled = true;
  }

  return {
    markFormClean
  };
}

// ===================================== ENABLE PERFECT SCROLLBAR =======================
// just add the class name "enable-perfect-scrollbar" to the class list of the component where you want
document.addEventListener('DOMContentLoaded', function () {
  const scrollContainer = document.querySelector('.enable-perfect-scrollbar');

  if (scrollContainer) {
    // Init Perfect Scrollbar
    const ps = new PerfectScrollbar(scrollContainer);

    // Lock scroll to the element when needed
    scrollContainer.addEventListener('wheel', function (e) {
      const delta = e.deltaY;
      const scrollTop = scrollContainer.scrollTop;
      const scrollHeight = scrollContainer.scrollHeight;
      const offsetHeight = scrollContainer.offsetHeight;

      const isScrollingDown = delta > 0;
      const isAtBottom = scrollTop + offsetHeight >= scrollHeight;
      const isAtTop = scrollTop <= 0;

      // Block scroll if we're at the top or bottom and trying to scroll beyond
      if ((isAtTop && !isScrollingDown) || (isAtBottom && isScrollingDown)) {
        e.preventDefault(); // don't let outer scroll happen
      }
    }, {
      passive: false
    });
  }
});
// ===================================== ENABLE PERFECT SCROLLBAR =======================


// view selected uploaded image
function previewSelectedUploadImage(inputSelector, imgSelector) {
  $(inputSelector).on('change', function () {
    const file = this.files[0];
    const $img = $(imgSelector);

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        $img.attr('src', e.target.result).show();
      };
      reader.readAsDataURL(file);
    } else {
      $img.attr('src', '').hide();
    }
  });

  // Only hide if no image is already set
  const $img = $(imgSelector);
  if (!$img.attr('src')) {
    $img.hide();
  }
}


function slugify(text) {
  return text
    .toString()
    .toLowerCase()
    .trim()
    .replace(/[\s\W-]+/g, '-')  // Replace spaces and non-word characters with hyphen
    .replace(/^-+|-+$/g, '');   // Remove leading/trailing hyphens
}


const inWords = (num) => {
  if (typeof num !== 'number') num = parseFloat(num);
  if (isNaN(num)) return 'Invalid amount';

  const a = [
    '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six',
    'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve',
    'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen',
    'Eighteen', 'Nineteen'
  ];
  const b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
  // const units = ['Crore', 'Lakh', 'Thousand', 'Hundred', ''];

  const makeGroup = (n) => {
    if (n < 20) return a[n];
    const tens = Math.floor(n / 10);
    const ones = n % 10;
    return b[tens] + (ones ? ' ' + a[ones] : '');
  };

  const makeWords = (n) => {
    let str = '';

    const crore = Math.floor(n / 10000000);
    n %= 10000000;
    const lakh = Math.floor(n / 100000);
    n %= 100000;
    const thousand = Math.floor(n / 1000);
    n %= 1000;
    const hundred = Math.floor(n / 100);
    const rest = n % 100;

    if (crore) str += makeGroup(crore) + ' Crore ';
    if (lakh) str += makeGroup(lakh) + ' Lakh ';
    if (thousand) str += makeGroup(thousand) + ' Thousand ';
    if (hundred) str += a[hundred] + ' Hundred ';
    if (rest) str += (str !== '' ? 'and ' : '') + makeGroup(rest);

    return str.trim();
  };

  const whole = Math.floor(num);
  const fraction = Math.round((num - whole) * 100);

  let result = 'Rupees ' + makeWords(whole);
  if (fraction > 0) {
    result += ' and ' + makeWords(fraction) + ' Paise';
  }
  return result + ' only';
}


const indianNumberFormat = (amount) => {
  if (amount == null) return '';

  const parts = amount.toString().split('.');
  let integerPart = parts[0];
  const decimalPart = parts.length > 1 ? '.' + parts[1].padEnd(2, '0') : '.00';

  // First 3 digits (right-most)
  const lastThree = integerPart.slice(-3);
  const otherDigits = integerPart.slice(0, -3);

  const formattedOther = otherDigits.replace(/\B(?=(\d{2})+(?!\d))/g, ',');

  const formattedNumber = (otherDigits ? formattedOther + ',' : '') + lastThree;

  return formattedNumber + decimalPart;
}

// Adds ₹ symbol and formats number
const indianRupee = (amount = null) => {
  if (amount === null) {
    return '₹';
  }
  return '₹' + indianNumberFormat(Math.round(amount * 100) / 100);
}