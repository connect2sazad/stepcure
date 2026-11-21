<?php
require_once __DIR__ . '/../composer/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Exception as DompdfException;

/**
 * Generate a PDF from HTML
 *
 * @param string $html         The HTML content
 * @param string $file_name    The PDF filename (without path)
 * @param string $save_path    Folder where PDF should be saved (optional)
 * @param bool   $stream       Whether to stream PDF to browser
 *
 * @return string|bool  Saved PDF path if saved, true if streamed, false on error
 */
function generatePDF($html, $file_name = 'document.pdf', $save_path = '', $stream = false)
{
    // Path to log errors
    $log_file = __DIR__ . '/error.log';

    try {
        // Ensure Dompdf is loaded
        if (!class_exists('Dompdf\Dompdf')) {
            throw new Exception("Dompdf is not loaded! Check require_once for vendor/autoload.php");
        }

        // Create Dompdf instance
        $dompdf = new Dompdf();

        $dompdf->set_option('isRemoteEnabled', true); // ✅ Allow HTTP/HTTPS images

        // Debug log
        file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] Generating PDF: $file_name\n", FILE_APPEND);

        // Load HTML
        $dompdf->loadHtml($html);

        // Set paper size & orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        $canvas = $dompdf->getCanvas();
        $canvas->page_script('
            $font = $fontMetrics->get_font("Arial", "normal");
            $size = 8;
            $pageText = "Page $PAGE_NUM of $PAGE_COUNT";
            $y = 810; $x = 520;
            $pdf->text($x, $y, $pageText, $font, $size);
        ');

        if ($stream) {
            // Stream directly to browser
            $dompdf->stream($file_name, ["Attachment" => false]);
            return true;
        }

        if ($save_path) {
            // Ensure folder exists
            if (!is_dir($save_path)) {
                if (!mkdir($save_path, 0777, true)) {
                    throw new Exception("Failed to create directory: $save_path");
                }
            }

            $full_path = rtrim($save_path, '/\\') . DIRECTORY_SEPARATOR . $file_name;

            if (file_put_contents($full_path, $dompdf->output()) === false) {
                throw new Exception("Failed to save PDF to: $full_path");
            }

            file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] PDF saved at: $full_path\n", FILE_APPEND);

            return $full_path;
        }

        // If no save path, return PDF binary
        return $dompdf->output();
    } catch (DompdfException $de) {
        $error_message = "[DompdfException] " . $de->getMessage();
        file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] $error_message\n", FILE_APPEND);
        return false;
    } catch (Exception $e) {
        $error_message = "[Exception] " . $e->getMessage();
        file_put_contents($log_file, "[" . date('Y-m-d H:i:s') . "] $error_message\n", FILE_APPEND);
        return false;
    }
}
