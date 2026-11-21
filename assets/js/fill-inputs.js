/**
 * Fill-Inputs JavaScript
 * Requires JQuery 3.7.1
 */
console.warn('Fill Inputs is active! Kindly disable it before production.');

const first_names_array = [
    'Aarav', 'Priya', 'Rahul', 'Ananya', 'Rohit', 'Neha', 'Vijay', 'Diya', 'Rohan', 'Aishwarya',
    'Karan', 'Isha', 'Arjun', 'Shruti', 'Akash', 'Manav', 'Tanvi', 'Nikhil', 'Meera', 'Siddharth',
    'Sneha', 'Aditya', 'Pooja', 'Ritika', 'Tanya', 'Kunal', 'Sanya', 'Dev', 'Ira', 'Ayaan',
    'Kavya', 'Lakshya', 'Mira', 'Yash', 'Simran', 'Aryan', 'Tara', 'Om', 'Jaya', 'Raj',
    'Divya', 'Harsh', 'Naina', 'Varun', 'Swati', 'Rehan', 'Anjali', 'Krishna', 'Zoya', 'Pranav',
    'Ishaan', 'Lavanya', 'Tarun', 'Rhea', 'Bhavya', 'Dhruv'
];
const last_names_array = [
    'Sharma', 'Patel', 'Verma', 'Singh', 'Gupta', 'Reddy', 'Mehta', 'Iyer', 'Nair', 'Joshi',
    'Shukla', 'Kumar', 'Chaudhary', 'Das', 'Yadav', 'Thakur', 'Bhat', 'Kapoor', 'Chopra', 'Bose',
    'Pandey', 'Naidu', 'Shetty', 'Tripathi', 'Mishra', 'Dubey', 'Ghosh', 'Rastogi', 'Banerjee', 'Rana',
    'Saxena', 'Rajput', 'Gill', 'Kaul', 'Desai', 'Malhotra', 'Aggarwal', 'Jain', 'Menon', 'Bhattacharya',
    'Sethi', 'Kohli', 'Chatterjee', 'Kulkarni', 'Vohra', 'Rawat', 'Dey', 'Chand', 'Pillai', 'Sawant',
    'Salunkhe', 'Lal', 'Hooda'
];

const indian_streets_array = [
    'MG Road', 'Brigade Road', 'Park Street', 'Marine Drive', 'Nehru Place', 'Lajpat Nagar',
    'Connaught Place', 'Anna Salai', 'Carter Road', 'Baner Road', 'Banjara Hills', 'Salt Lake Sector V',
    'Civil Lines', 'Sarjapur Road', 'Indiranagar 100 Feet Road', 'Juhu Tara Road', 'Linking Road',
    'Kolkata Airport Road', 'Rajaji Salai', 'Greater Kailash I', 'Rajendra Nagar', 'Ashok Vihar',
    'Dwarka Sector 21', 'NIBM Road', 'Gopalapuram Main Road', 'Golf Course Road', 'Brookefield Road',
    'Bannerghatta Road', 'Vashi Road', 'Himayatnagar Main Road', 'Powai Lake Road', 'Vasant Kunj Road',
    'Saket Main Road', 'Ambattur Industrial Road', 'BTM Layout Road', 'Malviya Nagar Main Road',
    'New BEL Road', 'T. Nagar High Road', 'Nungambakkam High Road', 'Kharghar Main Street',
    'Tilak Road', 'FC Road', 'Apte Road', 'Versova Link Road', 'ECR Road', 'OMR Road', 'Hudson Lane',
    'Subhash Marg', 'Kukatpally Main Road', 'Gachibowli Road', 'KR Puram Main Road'
];
const indian_cities_array = [
    'Bhubaneswar', 'Bangalore', 'Chennai', 'Delhi', 'Mumbai', 'Kolkata', 'Hyderabad', 'Jaipur',
    'Lucknow', 'Pune', 'Ahmedabad', 'Indore', 'Patna', 'Chandigarh', 'Guwahati', 'Bhopal',
    'Raipur', 'Ranchi', 'Vijayawada', 'Visakhapatnam', 'Mysore', 'Thiruvananthapuram', 'Kochi',
    'Madurai', 'Jodhpur', 'Udaipur', 'Agra', 'Varanasi', 'Meerut', 'Amritsar', 'Nagpur', 'Nashik',
    'Aurangabad', 'Kanpur', 'Gwalior', 'Dehradun', 'Haridwar', 'Noida', 'Gurgaon', 'Faridabad',
    'Vadodara', 'Surat', 'Jamshedpur', 'Srinagar', 'Shimla', 'Panaji', 'Tirupati', 'Tiruchirappalli',
    'Thrissur', 'Erode', 'Salem', 'Mangalore', 'Howrah'
];


window.Fill_Input_firstname = () => first_names_array[Math.floor(Math.random() * first_names_array.length)];
window.Fill_Input_lastname = () => last_names_array[Math.floor(Math.random() * last_names_array.length)];
window.Fill_Input_name = () => window.Fill_Input_firstname() + " " + window.Fill_Input_lastname();

// Function to generate random Aadhar Number (12 digits)
window.Fill_Input_aadhar = function () {
    let aadhar = '';
    for (let i = 0; i < 12; i++) {
        aadhar += Math.floor(Math.random() * 10); // Generates a random digit (0-9)
    }
    return aadhar;
}

// Function to generate random Aadhar Number (14 digits)
window.Fill_Input_uhid = function () {
    let uhid = '';
    for (let i = 0; i < 14; i++) {
        uhid += Math.floor(Math.random() * 10); // Generates a random digit (0-9)
    }
    return uhid;
}

// Function to generate random Number 
window.Fill_Input_number = function (digits) {
    let uhid = '';
    for (let i = 0; i < digits; i++) {
        uhid += Math.floor(Math.random() * 10); // Generates a random digit (0-9)
    }
    return uhid;
}

// Function to generate random PAN Number (AAAAA1234A)
window.Fill_Input_pan = function () {
    const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let pan = '';

    // First 5 characters - Random uppercase letters
    for (let i = 0; i < 5; i++) {
        pan += letters.charAt(Math.floor(Math.random() * letters.length));
    }

    // Next 4 characters - Random digits
    for (let i = 0; i < 4; i++) {
        pan += Math.floor(Math.random() * 10); // Random digit (0-9)
    }

    // Last character - Random uppercase letter
    pan += letters.charAt(Math.floor(Math.random() * letters.length));

    return pan;
}

// Function to generate random Indian DL number
window.Fill_Input_dl = function () {
    // List of state codes (first two letters)
    const stateCodes = ['DL', 'MH', 'KA', 'UP', 'TN', 'RJ', 'GJ', 'WB', 'BR', 'AP', 'KL', 'MP', 'HR', 'JK', 'OR', 'AS'];

    // Get a random state code
    const stateCode = stateCodes[Math.floor(Math.random() * stateCodes.length)];

    // Generate random 4-digit number (YYYY)
    const yearPart = Math.floor(Math.random() * 10000).toString().padStart(4, '0');

    // Generate another random 4-digit number (YYYY)
    const numberPart = Math.floor(Math.random() * 10000).toString().padStart(4, '0');

    // Generate a 5-digit random number (XXXXX)
    const randomDigits = Math.floor(Math.random() * 100000).toString().padStart(5, '0');

    // Combine them to form the DL number
    return `${stateCode}-${yearPart}-${numberPart}-${randomDigits}`;
}

// Function to generate random User ID (lowercase letters, numbers, and underscores)
window.Fill_Input_userid = function (length = 8) {
    const characters = 'abcdefghijklmnopqrstuvwxyz0123456789_';
    let userID = '';
    for (let i = 0; i < length; i++) {
        userID += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return userID;
}

// Function to generate random Email (name@lyncdigit.com)
window.Fill_Input_email = function () {
    const letters = 'abcdefghijklmnopqrstuvwxyz';
    let emailName = '';

    // Generate a random email name
    for (let i = 0; i < 8; i++) {
        emailName += letters.charAt(Math.floor(Math.random() * letters.length));
    }

    // Random domain (for simplicity, I'm using "lyncdigit.com")
    const domain = 'lyncdigit.com';
    return `${emailName}@${domain}`;
}

// Function to generate random Password (mix of lowercase, uppercase, numbers, and special characters)
window.Fill_Input_password = function (length = 12) {
    const lowercase = 'abcdefghijklmnopqrstuvwxyz';
    const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const numbers = '0123456789';
    const specialChars = '!@#$%^&*()_-+=<>?';

    const allChars = lowercase + uppercase + numbers + specialChars;
    let password = '';

    for (let i = 0; i < length; i++) {
        password += allChars.charAt(Math.floor(Math.random() * allChars.length));
    }

    return password;
}

// Generate random PIN code (6 digits, realistic Indian range 110001–999999)
window.Fill_Input_pin = function () {
    return Math.floor(100000 + Math.random() * 900000).toString();
};

// Generate random Indian city
window.Fill_Input_city = function () {
    return indian_cities_array[Math.floor(Math.random() * indian_cities_array.length)];
};

// Generate random Indian address
window.Fill_Input_address = function () {
    const houseNo = Math.floor(Math.random() * 500) + 1; // 1–500
    const street = indian_streets_array[Math.floor(Math.random() * indian_streets_array.length)];
    const city = window.Fill_Input_city();
    return `${houseNo} ${street}, ${city}`;
};

// Generate random Indian phone number (starting with 6-9)
window.Fill_Input_phone = function () {
    const firstDigit = Math.floor(Math.random() * 4) + 6; // 6–9
    let number = firstDigit.toString();
    for (let i = 0; i < 9; i++) {
        number += Math.floor(Math.random() * 10);
    }
    return number;
};

// WhatsApp number (same logic as phone)
window.Fill_Input_whatsapp = function () {
    return window.Fill_Input_phone();
};

// Alternate phone number
window.Fill_Input_altno = function () {
    return window.Fill_Input_phone();
};













// call this function to individually for every input to fill the form
const fill = function (type, field_id) {
    const ftype = "Fill_Input_" + type;  // Dynamically construct the function name
    if (typeof window[ftype] === 'function') {  // Check if the function exists
        const val = window[ftype]();  // Call the function dynamically
        const field = '#' + field_id;
        $(field).val(val).trigger('input').trigger('change').trigger('blur');
        const fill_details = {
            'type': type,
            'field': field,
            'value': val
        };
        console.log(fill_details);

    } else {
        console.error(`Function ${ftype} not found!`);  // Log error if the function doesn't exist
    }
};

// call this function to fill password & confirm password
const fill_password = function (password_field_id, confirm_password_field_id) {
    const val = window.Fill_Input_password();
    field = "#" + password_field_id;
    cfield = "#" + confirm_password_field_id;
    $(field).val(val).trigger('input').trigger('change').trigger('blur');
    $(cfield).val(val).trigger('input').trigger('change').trigger('blur');
    const fill_details = {
        'type': 'password',
        'field': field,
        'cfield': cfield,
        'value': val
    };
    console.log(fill_details);
}

// call this function to fill select
const fill_select = function (select_field_id, select2 = false) {
    const selector = "#" + select_field_id;
    const $select = $(selector);

    // Get all valid options (not disabled & not placeholder)
    const options = $select.find("option").filter(function () {
        return !$(this).is(':disabled') && $(this).val() !== '';
    });

    if (options.length === 0) {
        console.warn(`No valid options found for ${selector}`);
        return;
    }

    // Pick random option
    const randomOption = options.eq(Math.floor(Math.random() * options.length));
    const randomValue = randomOption.val();
    const randomText = randomOption.text();

    // Set value
    $select.val(randomValue);

    if (select2) {
        // If using Select2, trigger proper update
        $select.trigger('change.select2');
    } else {
        $select.trigger('change');
    }

    // Log details with text + (value)
    console.log({
        type: 'select',
        field: selector,
        selected_value: `${randomText} (${randomValue})`,
        selected_text: randomText
    });
};

// call this function to fill radio
const fill_radio = function (radio_name) {
    const $radios = $(`input[type="radio"][name="${radio_name}"]:not(:disabled)`);

    if ($radios.length === 0) {
        console.warn(`No enabled radio buttons found with name: ${radio_name}`);
        return;
    }

    const $randomRadio = $radios.eq(Math.floor(Math.random() * $radios.length));
    $randomRadio.prop('checked', true).trigger('change');

    console.log({
        type: 'radio',
        name: radio_name,
        selected_value: $randomRadio.val()
    });
};

// call this function to fill checkbox
const fill_checkboxes = function (checkbox_name, maxToCheck = 1) {
    const $checkboxes = $(`input[type="checkbox"][name="${checkbox_name}"]:not(:disabled)`);

    if ($checkboxes.length === 0) {
        console.warn(`No enabled checkboxes found with name: ${checkbox_name}`);
        return;
    }

    // Decide how many to check (random number up to maxToCheck or available number)
    const countToCheck = Math.min(maxToCheck, $checkboxes.length);
    const shuffled = $checkboxes.sort(() => 0.5 - Math.random());

    // Uncheck all first
    $checkboxes.prop('checked', false);

    // Check a few randomly
    const selected = shuffled.slice(0, countToCheck);
    selected.prop('checked', true).trigger('change');

    const selectedValues = selected.map(function () {
        return $(this).val();
    }).get();

    console.log({
        type: 'checkbox',
        name: checkbox_name,
        selected_values: selectedValues
    });
};

// call this function to fill number
const fill_number = function (field_id, length = 5) {
    const val = window.Fill_Input_number(length);
    field = "#" + field_id;
    $(field).val(val).trigger('input').trigger('change').trigger('blur');
    const fill_details = {
        'type': 'number',
        'field': field,
        'value': val
    };
    console.log(fill_details);
}




//  this will log the manual
function fills_manual() {
    // Find all Fill_Input_* functions for single field types
    const fillFunctions = Object.keys(window)
        .filter(key => typeof window[key] === 'function' && key.startsWith('Fill_Input_'));

    const result = fillFunctions.map(fnName => {
        const type = fnName.replace('Fill_Input_', '');
        let example, return_type;

        try {
            example = window[fnName]();
            return_type = typeof example;
        } catch (err) {
            example = `⚠️ Error: ${err.message}`;
            return_type = 'unknown';
        }

        return { type, example, return_type };
    });

    // Pretty log
    console.log(`
==========================
📌 FORM AUTO-FILL HELP (Requires jQuery 3.7.1+)
==========================

✅ For single input fields:
   fill(type, field_id)

   • type → one of the predefined types below
   • field_id → the HTML input field's ID

✅ For password fields:
   fill_password(password_field_id, confirm_password_field_id)

   • password_field_id → password input ID
   • confirm_password_field_id → confirm password input ID

✅ For select dropdowns:
   fill_select(select_field_id, select2)

   • select_field_id → <select> element ID
   • select2 → true if using Select2, false otherwise

✅ For radio buttons:
   fill_radio(radio_name)

   • radio_name → name attribute of radio group

✅ For checkboxes:
   fill_checkboxes(checkbox_name, maxToCheck)

   • checkbox_name → name attribute shared by checkboxes
   • maxToCheck → how many checkboxes to randomly check (default = 1)

--------------------------
Available Predefined Input Types:
`);

    // List types like: firstname → "Alice" (string)
    result.forEach(item => {
        console.log(`• ${item.type} → "${item.example}" (${item.return_type})`);
    });

    console.log('--------------------------');
    console.log('💡 Example: fill("firstname", "first_name")');
    console.log('--------------------------');

    return result;
}