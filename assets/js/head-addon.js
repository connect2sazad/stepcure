/**
 * Addon JavaScript
 */


function toaster(code, message = "", nav_loc = "./") {

  console.log('hii, this is from addon.js');
  switch (code) {
    case 'success':
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#4fbe87",
      }).showToast();

      window.location.href = nav_loc;

      break;

    case 'failed':
      Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "red",
      }).showToast();

      break;
  }
}
