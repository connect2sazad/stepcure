<?php

// Ajax Requester & Secure

use function PHPSTORM_META\type;

function getAjaxRequester()
{
    $requester_script = "
        <script>
        function ajax_request(data, is_serialized = true, files = false) {
            const api_url = \"" . systemVariable('SITE_DIR') . "api/\";
            const api_key = \"" . API_KEY . "\";

            const dataType = is_serialized ? 'json' : 'text';

            let ajaxOptions = {
                url: api_url,
                method: 'POST',
                dataType: dataType
            };

            if (files === true) {
                // ✅ FILE UPLOAD MODE
                if (!(data instanceof FormData)) {
                    console.warn('Files=true but data is not FormData. Converting...');
                    let fd = new FormData();
                    
                    // If data is a serialized string like foo=bar&baz=qux
                    if (typeof data === 'string') {
                        data.split('&').forEach(pair => {
                            let [key, value] = pair.split('=');
                            if (key) fd.append(decodeURIComponent(key), decodeURIComponent(value || ''));
                        });
                    } else if (typeof data === 'object') {
                        // If it's a normal object
                        for (const key in data) {
                            fd.append(key, data[key]);
                        }
                    }
                    data = fd;
                }

                // Always append API key
                data.append('api_key', api_key);

                ajaxOptions.data = data;
                ajaxOptions.processData = false;
                ajaxOptions.contentType = false;

            } else {
                // ✅ NORMAL MODE (existing behaviour)
                if (typeof data === 'object') {
                    data.api_key = api_key;
                } else {
                    data += '&api_key=' + api_key;
                }
                ajaxOptions.data = data;
            }

            return $.ajax(ajaxOptions);
        }
        </script>
    ";

    return $requester_script;
}


function secure_API_KEY($request)
{
    if (array_key_exists('api_key', $request)) {
        unset($request['api_key']);
    }
    return $request;
}


// Misc functions
function prefix_0($no)
{
    return ($no < 10 && $no > 0) ? $no = '0' . $no : $no;
}

function prefix_00($no)
{
    $no = intval($no);  // Convert to integer to ensure it's a number

    // Check if it's between 1 and 99 and prepend "00"
    return ($no > 0 && $no < 100) ? str_pad($no, 3, '0', STR_PAD_LEFT) : $no;
}


function prefix_000($no)
{
    $no = intval($no);  // Convert to integer to ensure it's a number

    // Check if it's between 1 and 999, and prepend "000"
    return ($no > 0 && $no < 1000) ? str_pad($no, 4, '0', STR_PAD_LEFT) : $no;
}


function rectify_location($location, $admin_url = false)
{
    // $first_four = substr($location, 0, 7);
    // $first_five = substr($location, 0, 8);
    // if ($first_four == 'http://' || $first_five == 'https://') {
    //     return $location;
    // } else {
    //     if (!$admin_url) {
    //         return SITE_DIR . $location;
    //     } else {
    //         return ___ADMIN_DIR___ . $location;
    //     }
    // }
}

function getRandomId($length, $type = 'alpha_numeric')
{
    switch ($type) {
        case 'alpha_numeric':
            $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'alpha':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'alpha_uppercase':
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'alpha_uppercase_numeric':
            $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'alpha_lowercase':
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 'alpha_lowercase_numeric':
            $str = '0123456789abcdefghijklmnopqrstuvwxyz';
            break;
        case 'numeric':
            $str = '0123456789';
            break;
        default:
            break;
    }
    return substr(str_shuffle($str), 0, $length);
}

function minify_html($html)
{
    $minified_html = preg_replace('/\s+/', ' ', $html);
    $minified_html = str_replace("\t", "", $html);
    $minified_html = str_replace("\n", "", $minified_html);
    return $minified_html;
}

function minifier($code)
{
    $search = array(
        // Remove whitespaces after tags
        '/\>[^\S ]+/s',
        // Remove whitespaces before tags
        '/[^\S ]+\</s',
        // Remove multiple whitespace sequences
        '/(\s)+/s',
        // Removes comments
        '/<!--(.|\s)*?-->/'
    );
    $replace = array('>', '<', '\\1');
    $code = preg_replace($search, $replace, $code);
    return $code;
}

function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

function getMetaFieldId($string, $startString)
{
    return str_replace($startString, '', $string);
}

function json_validator($data)
{
    if (!empty($data)) {
        return is_string($data) &&
            is_array(json_decode($data, true)) ? true : false;
    }
    return false;
}

function assets($loc = '')
{
    $url = SITE_DIR . "assets/" . $loc;
    return $url;
}

function css($css)
{
    $url = assets('css') . "/" . $css . ".css";
    return $url;
}

function js($js)
{
    $url = assets('js') . "/" . $js . ".js";
    return $url;
}

function is_url($url)
{
    return stripos($url, "http") === 0;
}

function url_contains($substring)
{
    return strpos($_SERVER['REQUEST_URI'], $substring) !== false;
}

function hit_url($api_url)
{
    $ch = curl_init($api_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it

    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if ($data === null) {
        die('Error decoding JSON data');
    }

    return $data;
}

function rupee($amount = null, $symbol = '₹')
{
    if ($amount === null) {
        return $symbol;
    } else {
        $roundedAmount = round((float)$amount, 2);
        return $symbol . indian_number_format_amount($roundedAmount);
    }
}

function indian_number_format($number)
{
    $pattern = "/\B(?=(\d{3})+(?!\d))/";
    $replace = ",";
    $commas = preg_replace($pattern, $replace, $number);
    return $commas;
}

function indian_number_format_amount($number)
{
    $number = number_format((float)$number, 2, '.', ''); // Ensure 2 decimal places
    $parts = explode('.', $number);

    $integerPart = $parts[0];
    $decimalPart = isset($parts[1]) ? $parts[1] : '00';

    // Apply Indian format to integer part
    $lastThree = substr($integerPart, -3);
    $rest = substr($integerPart, 0, -3);

    if ($rest != '') {
        $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
        $formattedInteger = $rest . ',' . $lastThree;
    } else {
        $formattedInteger = $lastThree;
    }

    return $formattedInteger . '.' . $decimalPart;
}

function in_words($number)
{
    $no = floor($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '',
        '1' => 'One',
        '2' => 'Two',
        '3' => 'Three',
        '4' => 'Four',
        '5' => 'Five',
        '6' => 'Six',
        '7' => 'Seven',
        '8' => 'Eight',
        '9' => 'Nine',
        '10' => 'Ten',
        '11' => 'Eleven',
        '12' => 'Twelve',
        '13' => 'Thirteen',
        '14' => 'Fourteen',
        '15' => 'Fifteen',
        '16' => 'Sixteen',
        '17' => 'Seventeen',
        '18' => 'Eighteen',
        '19' => 'Nineteen',
        '20' => 'Twenty',
        '30' => 'Thirty',
        '40' => 'Forty',
        '50' => 'Fifty',
        '60' => 'Sixty',
        '70' => 'Seventy',
        '80' => 'Eighty',
        '90' => 'Ninety'
    );
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
        $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';

    $in_words = "Rupees " . $result;
    if ($points) {
        $in_words .= "and " . $points . " Paise";
    }
    $in_words .= ' only';
    return $in_words;
}

function compareMonths($a, $b)
{
    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $aMonth = array_search(explode(' ', $a)[0], $months);
    $bMonth = array_search(explode(' ', $b)[0], $months);

    return $aMonth - $bMonth;
}

function compressAndConvertToWebP($sourcePath, $destinationPath, $quality = 80)
{
    // Get the image dimensions
    list($width, $height, $type) = getimagesize($sourcePath);

    // Create a new image resource based on the source image type
    switch ($type) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        default:
            return false; // Unsupported image type
    }

    // Create a new true color image with the same dimensions
    $outputImage = imagecreatetruecolor($width, $height);

    // Preserve transparency for PNG and GIF images
    if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
        imagecolortransparent($outputImage, imagecolorallocatealpha($outputImage, 0, 0, 0, 127));
        imagealphablending($outputImage, false);
        imagesavealpha($outputImage, true);
    }

    // Copy and resize the source image to the new image resource
    imagecopyresampled($outputImage, $sourceImage, 0, 0, 0, 0, $width, $height, $width, $height);

    // Save the compressed image as WebP
    imagewebp($outputImage, $destinationPath, $quality);

    // Free up memory
    imagedestroy($sourceImage);
    imagedestroy($outputImage);
}

function formatDate($dateStr)
{
    // Create a DateTime object from the input date string
    $date = new DateTime($dateStr);

    // Format the date as "23 April, 2021"
    return $date->format('d M, Y');
}

function formatDateTime($dateStr)
{
    // Create a DateTime object from the input date string
    $date = new DateTime($dateStr);

    // Format the date as "23 April, 2021"
    return $date->format('d M, Y h:i A');
}

function get_stars($average_rating)
{
    // Round the average rating to two decimal places
    $roundedCount = round($average_rating, 2);

    // Convert the rounded count to an integer for the number of stars
    $starCount = round($roundedCount);

    // Return the corresponding number of stars
    return str_repeat('&#9733;', $starCount); // Using &#9733; as the star symbol
}

function time_diff($start_date, $end_date = null)
{
    // If no end date is provided, use the current time
    if ($end_date === null) {
        $end_date = new DateTime();
    } else {
        $end_date = new DateTime($end_date);
    }

    // Convert the start date to DateTime object
    $start_date = new DateTime($start_date);

    // Calculate the difference
    $interval = $start_date->diff($end_date);

    // Get the absolute difference in different units
    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;
    $hours = $interval->h;
    $minutes = $interval->i;
    $seconds = $interval->s;

    // Calculate weeks from the days difference
    $weeks = floor($days / 7);
    $remaining_days = $days % 7;

    // Determine what to return based on the largest unit of time
    if ($years > 0) {
        return $years . ' yr ' . (($months != 0) ? $months . ' months' : '');
    } elseif ($months > 0) {
        return $months . ' months';
    } elseif ($weeks > 0) {
        return $weeks . ' weeks';
    } elseif ($days > 0) {
        return $days . ' days';
    } elseif ($hours > 0) {
        return $hours . ' hours';
    } elseif ($minutes > 0) {
        return $minutes . ' minutes';
    } else {
        return $seconds . ' seconds';
    }
}

function get_initials($text)
{
    // Split the text by spaces
    $words = explode(" ", $text);

    $initials = "";
    foreach ($words as $word) {
        if (!empty($word)) {
            // Get the first character of each word
            $initials .= strtoupper($word[0]);
        }
    }

    return $initials;
}

function get_color_pair($text = '')
{
    // Bootstrap-inspired soft palette
    $colors = [
        ['bg' => '#E3F2FD', 'txt' => '#0D47A1'], // Blue
        ['bg' => '#FCE4EC', 'txt' => '#880E4F'], // Pink
        ['bg' => '#F3E5F5', 'txt' => '#4A148C'], // Purple
        ['bg' => '#E8F5E9', 'txt' => '#1B5E20'], // Green
        ['bg' => '#FFF3E0', 'txt' => '#E65100'], // Orange
        ['bg' => '#ECEFF1', 'txt' => '#263238'], // Gray
        ['bg' => '#FFFDE7', 'txt' => '#F57F17'], // Yellow
        ['bg' => '#E0F7FA', 'txt' => '#006064'], // Cyan
    ];

    // If you want deterministic color → hash the name
    $index = 0;
    if ($text !== '') {
        $hash = crc32(strtolower($text));
        $index = $hash % count($colors);
    } else {
        $index = array_rand($colors);
    }

    return $colors[$index];
}



function today_date()
{
    return formatDate(date('Y-m-d'));
}

function get_city_code($city_name)
{
    return strtoupper(substr($city_name, 0, 3));
}


function upload_file($file_field, $target_dir = __DIR__ . "/../uploads/")
{
    // Check if file exists
    if (!isset($_FILES[$file_field]) || $_FILES[$file_field]['error'] !== UPLOAD_ERR_OK) {
        return ['status' => 'failed', 'err_code' => "FILE_NOT_SELECTED", 'message' => 'No file uploaded or upload error.'];
    }

    $file = $_FILES[$file_field];

    // Validate file size (1MB max)
    if ($file['size'] > UPLOAD_FILE_SIZE) {
        return ['status' => 'failed', 'message' => 'File size exceeds 1MB limit.'];
    }

    // Generate unique filename
    $timestamp = date('YmdHi');
    $random = rand(1000, 9999);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $original_name = $timestamp . '_' . $random;

    // Ensure target dir exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $tmp_name = $file['tmp_name'];
    $mime = mime_content_type($tmp_name);

    // Check if image
    if (strpos($mime, 'image/') === 0) {
        $webp_path = rtrim($target_dir, '/') . '/' . $original_name . '.webp';

        $image = null;
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($tmp_name);
                break;
            case 'image/png':
                $image = imagecreatefrompng($tmp_name);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($tmp_name);
                break;
            case 'image/webp':
                // Already WebP
                move_uploaded_file($tmp_name, $webp_path);
                return ['status' => 'success', 'file_name' => basename($webp_path)];
            default:
                return ['status' => 'failed', 'message' => 'Unsupported image type.'];
        }

        if (!$image) {
            return ['status' => 'failed', 'message' => 'Failed to process image.'];
        }

        // ✅ Convert to true color if needed (fixes palette error)
        if (!imageistruecolor($image)) {
            imagepalettetotruecolor($image);
        }

        // Save as WebP
        if (!imagewebp($image, $webp_path, 80)) {
            imagedestroy($image);
            return ['status' => 'failed', 'message' => 'Failed to save WebP image.'];
        }

        imagedestroy($image);
        return ['status' => 'success', 'file_name' => basename($webp_path)];
    }

    // Non-image files, retain original extension
    $final_name = $original_name . '.' . strtolower($ext);
    $target_path = rtrim($target_dir, '/') . '/' . $final_name;

    if (!move_uploaded_file($tmp_name, $target_path)) {
        return ['status' => 'failed', 'message' => 'Failed to move uploaded file.'];
    }

    return ['status' => 'success', 'file_name' => basename($target_path)];
}

function upload_multiple_files($file_field, $target_dir = FILE_UPLOAD_DIR)
{
    $attachments = [];

    // Ensure input is a multi-file field
    if (
        !isset($_FILES[$file_field]) ||
        !is_array($_FILES[$file_field]['name']) ||
        count($_FILES[$file_field]['name']) === 0
    ) {
        return $attachments;
    }

    $file_count = count($_FILES[$file_field]['name']);

    for ($i = 0; $i < $file_count; $i++) {
        $temp_field = 'temp_file_' . $i;

        // Normalize each file into its own temporary entry
        $_FILES[$temp_field] = [
            'name'     => $_FILES[$file_field]['name'][$i],
            'type'     => $_FILES[$file_field]['type'][$i],
            'tmp_name' => $_FILES[$file_field]['tmp_name'][$i],
            'error'    => $_FILES[$file_field]['error'][$i],
            'size'     => $_FILES[$file_field]['size'][$i],
        ];

        $upload_result = upload_file($temp_field, $target_dir);

        if ($upload_result['status'] === 'success') {
            $attachments[] = $upload_result['file_name']; // ✅ Now generic
        }

        unset($_FILES[$temp_field]);
    }

    return $attachments;
}



function getDP(array $options = []): string
{
    $defaults = [
        'full_name'   => 'Unknown User',
        'file_name'   => '',
        'file_loc'    => 'uploads/',
        'alt'         => 'User Avatar',
        'id'          => '',
        'class'       => '',
    ];

    $opts = array_merge($defaults, $options);
    $file_path = FILE_UPLOAD_DIR . $opts['file_name'];


    // ✅ If actual image exists
    if (!empty($opts['file_name']) && file_exists($file_path)) {
        return sprintf(
            '<img src="%s%s" alt="%s" style="width:100%%;height:100%%;border-radius:50%%;object-fit:cover;" />',
            systemVariable('SITE_HOME'),
            $opts['file_loc'] . $opts['file_name'],
            htmlspecialchars($opts['alt'])
        );
    }

    // ✅ Placeholder
    $color_pair = get_color_pair($opts['full_name']);
    $initials = strtoupper(get_initials($opts['full_name'])); // max 2 letters

    return sprintf(
        '<div style="
            width:100%%;
            height:100%%;
            background:%s;
            color:%s;
            font-weight:600;
            font-size:15px; /* relative to parent size */
            border-radius:50%%;
            display:flex;
            align-items:center;
            justify-content:center;
            text-transform:uppercase;
            letter-spacing:1px;
        ">%s</div>',
        $color_pair['bg'],
        $color_pair['txt'],
        htmlspecialchars($initials)
    );
}














/**
 * ✅ Get effective permissions for a module
 */
function getModulePermissions($module)
{

    return [
        'view'   => checkPermissions('view', USER_ALLOWED_PERMISSIONS, USER_GROUP_ALLOWED_PERMISSIONS),
        'create' => checkPermissions('create', USER_ALLOWED_PERMISSIONS, USER_GROUP_ALLOWED_PERMISSIONS),
        'update' => checkPermissions('update', USER_ALLOWED_PERMISSIONS, USER_GROUP_ALLOWED_PERMISSIONS),
        'delete' => checkPermissions('delete', USER_ALLOWED_PERMISSIONS, USER_GROUP_ALLOWED_PERMISSIONS),
    ];
}

/**
 * ✅ Render module tabs dynamically (Active, Trash, Create)
 */
function renderModuleTabs($module, $activeCount, $trashCount, $customTabs = [], $showDefaults = true)
{
    $perm = getModulePermissions($module);

    $tabs = [];
    $usedIndexes = [];

    if ($showDefaults) {
        // Default tabs
        $tabs[] = [
            'label' => "Active ({$activeCount})",
            'target' => '#tab-active',
            'type'   => 'tab',
            'index'  => 100
        ];
        $usedIndexes[] = 100;

        if ($perm['delete']) {
            $tabs[] = [
                'label' => "Trashed ({$trashCount})",
                'target' => '#tab-trash',
                'type'   => 'tab',
                'index'  => 200
            ];
            $usedIndexes[] = 200;
        }

        if ($perm['create']) {
            $tabs[] = [
                'label' => '+ New',
                'target' => "./?new_{$module}",
                'type'   => 'link',
                'index'  => 999
            ];
            $usedIndexes[] = 999;
        }
    }

    // Add custom tabs
    $defaultIndex = 300;
    foreach ($customTabs as $tab) {
        if (isset($tab['permission']) && !$perm[$tab['permission']]) {
            continue;
        }

        $index = $tab['index'] ?? $defaultIndex++;

        // Avoid index conflicts
        while (in_array($index, $usedIndexes)) {
            $index++;
        }

        $usedIndexes[] = $index;

        $tabs[] = [
            'label' => $tab['label'] ?? 'Tab',
            'target' => $tab['target'] ?? '#',
            'type' => (isset($tab['target']) && str_starts_with($tab['target'], 'url:')) ? 'link' : 'tab',
            'index' => $index,
            'forceActive' => $tab['active'] ?? false
        ];
    }

    // Sort tabs by index
    usort($tabs, fn($a, $b) => $a['index'] <=> $b['index']);

    // Determine which tab to make active
    $hasActive = false;
    foreach ($tabs as &$tab) {
        if (!$hasActive && (!empty($tab['forceActive']) || $tab['type'] === 'tab')) {
            $tab['active'] = true;
            $hasActive = true;
        } else {
            $tab['active'] = false;
        }
    }
    unset($tab); // break reference

    // Render
    echo '<ul class="nav nav-tabs">';
    foreach ($tabs as $tab) {
        $label = $tab['label'];
        $activeClass = !empty($tab['active']) ? ' active' : '';

        if ($tab['type'] === 'link') {
            echo "<li class='nav-item'>
                    <a class='nav-link{$activeClass}' style=\"cursor: pointer\" onclick=\"window.location.href='{$tab['target']}'\">
                        {$label}
                    </a>
                  </li>";
        } else {
            echo "<li class='nav-item'>
                    <button class='nav-link{$activeClass}' data-bs-toggle='tab' data-bs-target='{$tab['target']}'>
                        {$label}
                    </button>
                  </li>";
        }
    }
    echo '</ul>';
}




/**
 * ✅ Render a permission-aware table
 * 
 * @param string $module     Module name (e.g. "treatment_site")
 * @param array $rows        Array of records
 * @param array $columns     Column definitions: [ ['key'=>'site_id','label'=>'Site ID'], ... ]
 * @param array $actions     Actions available: ['view','edit','trash','restore','delete_permanent']
 * @param string $rowIdKey   Column key for row id (default 'id')
 */
function renderPermissionAwareTable($module, $rows, $columns, $actions = [], $rowIdKey = 'id')
{
    // ✅ Fetch module permissions
    $perm = getModulePermissions($module);

    echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    // echo '<table class="table table-striped table-responsive">';

    // ✅ Table header
    echo '<thead><tr>';
    echo '<th>SL</th>';
    foreach ($columns as $col) {
        echo '<th>' . htmlspecialchars($col['label']) . '</th>';
    }
    if (!empty($actions)) echo '<th>Actions</th>';
    echo '</tr></thead>';

    echo '<tbody>';

    if (!empty($rows) && count($rows) > 0) {
        $SL = 1;
        foreach ($rows as $row) {
            $rowId = htmlspecialchars($row[$rowIdKey]);
            echo '<tr>';
            echo "<td>{$SL}</td>";

            // ✅ Render all columns
            foreach ($columns as $col) {
                $key = $col['key'];

                // ✅ Default value
                $value = isset($row[$key]) ? $row[$key] : '';

                // ✅ If column has a custom renderer, call it
                if (isset($col['renderer']) && is_callable($col['renderer'])) {
                    $value = $col['renderer']($row);
                } else {
                    $value = htmlspecialchars($value);
                }

                // ✅ Always output a valid cell
                if (empty($value)) {
                    $value = '<span class="text-muted">NA</span>';
                }

                echo "<td>{$value}</td>";
            }

            // ✅ Render actions dropdown
            if (!empty($actions)) {
                $actionHtml = '';

                foreach ($actions as $action) {
                    // 🔹 Default built-in actions
                    if (is_string($action)) {
                        if ($action === 'view' && !empty($perm['view'])) {
                            $actionHtml .= "<li><a class='dropdown-item' href='./?id={$rowId}&view'><i class='fas fa-eye me-1'></i> View</a></li>";
                        } elseif ($action === 'edit' && !empty($perm['update'])) {
                            $actionHtml .= "<li><a class='dropdown-item' href='./?id={$rowId}'><i class='bx bx-edit-alt me-1'></i> Edit</a></li>";
                        } elseif ($action === 'trash' && !empty($perm['delete'])) {
                            $actionHtml .= "<li><a class='dropdown-item' href='javascript:void(0)' onclick='takeAction(\"trash\", {$rowId})'><i class='fas fa-trash me-1'></i> Trash</a></li>";
                        } elseif ($action === 'restore' && !empty($perm['delete'])) {
                            $actionHtml .= "<li><a class='dropdown-item' href='javascript:void(0)' onclick='takeAction(\"restore\", {$rowId})'><i class='fas fa-trash-restore me-1'></i> Restore</a></li>";
                        } elseif ($action === 'delete_permanent' && !empty($perm['delete'])) {
                            $actionHtml .= "<li><a class='dropdown-item text-danger' href='javascript:void(0)' onclick='takeAction(\"delete\", {$rowId})'><i class='fas fa-times me-1'></i> Delete Permanently</a></li>";
                        }
                    }

                    // 🔹 Custom actions
                    elseif (is_array($action)) {
                        $label = htmlspecialchars($action['label'] ?? 'Action');
                        $icon = htmlspecialchars($action['icon'] ?? 'fas fa-cog');
                        $permissionKey = $action['permission'] ?? null;

                        if (!$permissionKey || !empty($perm[$permissionKey])) {
                            $onclickFn = $action['onclick'] ?? null;
                            $params = [];

                            if (!empty($action['params']) && is_array($action['params'])) {
                                foreach ($action['params'] as $paramKey) {
                                    $paramValue = isset($row[$paramKey]) ? json_encode($row[$paramKey]) : 'null';
                                    $params[] = $paramValue;
                                }
                            }

                            $onclick = $onclickFn ? "onclick='{$onclickFn}(" . implode(',', $params) . ")'" : '';

                            $customAttributes = '';
                            if (!empty($action['data']) && is_array($action['data'])) {
                                foreach ($action['data'] as $attr => $valKey) {
                                    $value = isset($row[$valKey]) ? $row[$valKey] : $valKey; // fallback to literal if not in row
                                    $customAttributes .= ' data-' . htmlspecialchars($attr) . '="' . htmlspecialchars($value) . '"';
                                }
                            }

                            $actionHtml .= "<li><a class='dropdown-item' href='javascript:void(0)' {$onclick}{$customAttributes}><i class='{$icon} me-1'></i> {$label}</a></li>";
                        }
                    }
                }

                echo '<td>';
                if (!empty($actionHtml)) {
                    echo '<div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <ul class="dropdown-menu">' . $actionHtml . '</ul>
              </div>';
                }
                echo '</td>';
            }


            echo '</tr>';
            $SL++;
        }
    } else {
        // ✅ No records fallback
        // Ensure number of <td> elements equals number of header columns
        $totalCols = 1 + count($columns) + (!empty($actions) ? 1 : 0); // SL + columns + actions (if any)

        echo '<tr class="no-records">';
        // show the message in the first cell
        echo '<td class="text-center">No records found</td>';

        // add the remaining empty <td> cells so the count matches headers
        for ($i = 1; $i < $totalCols; $i++) {
            echo '<td>&nbsp;</td>';
        }

        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
}


function calculateBMI($weightKg, $heightCm)
{
    // Convert height from cm to meters
    $heightM = $heightCm / 100;

    // Calculate BMI
    if ($heightM > 0) {
        $bmi = $weightKg / ($heightM * $heightM);
        return round($bmi, 2); // Round to 2 decimal places
    } else {
        return 1;
    }
}

