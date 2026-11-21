/**
 * API Requests JavaScript
 */

'use strict';

(function () {

  // login function starts
  $(document).ready(() => {

    $('#admin_login').on('submit', function (e) {
      e.preventDefault();

      let form_data = $(this).serialize();
      form_data += "&request_type=admin_login";

      ajax_request(form_data).done(function (response) {

        if (response.status === 'success') {
          Toastify({
            text: response.message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#4fbe87",
          }).showToast();

          window.location.href = ref_url;

        } else {
          Toastify({
            text: response.message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
          }).showToast();
        }
      }).fail(function (jqXHR, textStatus, errorThrown) {

        console.group("AJAX Request Failed");

        console.log("Text Status:", textStatus);
        console.log("Error Thrown:", errorThrown);

        console.log("Full jqXHR object:", jqXHR);
        console.log("Response Text:", jqXHR.responseText);
        console.log("Status Code:", jqXHR.status);
        console.log("Status Text:", jqXHR.statusText);
        console.log("Ready State:", jqXHR.readyState);
        console.log("Response Headers:", jqXHR.getAllResponseHeaders());

        console.groupEnd();

        console.error("AJAX Error:", textStatus, errorThrown);
        Toastify({
          text: "Server error. Please try again.",
          duration: 3000,
          close: true,
          gravity: "top",
          position: "right",
          backgroundColor: "red",
        }).showToast();
      });
    });
  });
  // login function ends

})();


