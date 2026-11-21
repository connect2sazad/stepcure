
// Update quantity on increase
function updateStock() {
    const currentQuantity = parseInt($('#current_quantity').val());
    const increaseQuantity = parseInt($('#change_quantity').val());
    const newQuantity = currentQuantity + increaseQuantity;
    const amount = parseFloat($('#discounted_price').val());
    $('#quantity').val(newQuantity);
    $('#amount').val((increaseQuantity * amount).toFixed(2));
}

// Update site_id_value when site_id_select changes
function updateSiteIdValue() {
    const siteId = $('#site_id_select').val();
    $('#site_id_value').val(siteId);
    const selected = document.querySelector('#site_id_select option:checked');
    $('#current_quantity').val(selected?.dataset.quantity || 0);
    updateStock();
}



function add_stock_submit(updated_by, inventory_id) {

    const currentQuantity = parseInt($('#current_quantity').val());
    const newQuantity = parseInt($('#quantity').val());
    const changeQuantity = parseInt($('#change_quantity').val());

    if (newQuantity <= currentQuantity) {
        Toastify({
            text: "New quantity must be greater than current quantity!",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
        return; // stop submission
    }

    if (changeQuantity < 1 || isNaN(changeQuantity)) {
        Toastify({
            text: "Please enter a valid increase quantity!",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
        return; // stop submission
    }

    const site_id = $('#site_id_value').val();

    if (!site_id || site_id === "0") {
        Toastify({
            text: "Please select a valid site!",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
        return; // stop submission
    }


    const formElem = document.getElementById('add_stock');

    let hasFiles = $(formElem).find('input[type="file"]').length > 0;

    let form_data;

    if (hasFiles) {
        // ✅ Create FormData for file upload
        form_data = new FormData(formElem);

        // ✅ Client-side file size validation (1MB max)
        let fileInput = $(formElem).find('input[type="file"]')[0];
        if (fileInput && fileInput.files.length > 0) {
            let file = fileInput.files[0];
            if (file.size > 1048576) { // 1MB = 1024*1024 bytes
                Toastify({
                    text: "File size exceeds 1 MB limit!",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                }).showToast();
                return; // stop submission
            }
        }

        // ✅ Add extra params manually for FormData
        form_data.append('updated_by', updated_by);
        form_data.append('inventory_id', inventory_id);
        form_data.append('request_type', 'add_stock');

    } else {
        // ✅ Old behavior if no files
        form_data = $(formElem).serialize();
        form_data += "&inventory_id=" + inventory_id;
        form_data += "&updated_by=" + updated_by;
        form_data += "&request_type=add_stock";
    }


    ajax_request(form_data, true, hasFiles).done(function (response) {

        if (response.status == 'success') {
            Toastify({
                text: response.message,
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4fbe87",
            }).showToast();

            window.location = "."; // redirect to the same page

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
        console.log(response);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.error(jqXHR);
        Toastify({
            text: jqXHR.responseText,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "red",
        }).showToast();
    });

}