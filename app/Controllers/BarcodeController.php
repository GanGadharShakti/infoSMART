<?php

namespace App\Controllers;


class BarcodeController extends BaseController
{
    public function index()
    {

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/barcode_form')
            . view('templates/htmlclose');
    }
    public function generate()
    {
        $rackId = $this->request->getPost('rack_product_id');
        $barcodeValue = $this->request->getPost('barcode_value');

        if (empty($rackId)) {
            return redirect()->back()->with('error', 'Rack Product ID is required.');
        }

        // If barcode is not provided, auto-generate it
        if (empty($barcodeValue)) {
            $barcodeValue = 'PNV-' . str_pad($rackId, 4, '0', STR_PAD_LEFT);
        }

        // Generate barcode image
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeValue, $generator::TYPE_CODE_128);

        // Convert to GD image
        $barcodeGD = imagecreatefromstring($barcodeImage);

        // Final image dimensions
        $finalWidth = 192;
        $finalHeight = 96;

        $fontSize = 2;
        $textHeight = imagefontheight($fontSize);
        $barcodeAreaHeight = $finalHeight - $textHeight;

        $canvas = imagecreatetruecolor($finalWidth, $finalHeight);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        $black = imagecolorallocate($canvas, 0, 0, 0);
        imagefill($canvas, 0, 0, $white);

        // Resize and copy barcode into canvas
        imagecopyresampled(
            $canvas,
            $barcodeGD,
            0,
            0,
            0,
            0,
            $finalWidth,
            $barcodeAreaHeight,
            imagesx($barcodeGD),
            imagesy($barcodeGD)
        );

        // Draw barcode value below the barcode (centered)
        $textWidth = imagefontwidth($fontSize) * strlen($barcodeValue);
        $textX = ($finalWidth - $textWidth) / 2;
        $textY = $barcodeAreaHeight + 1;
        imagestring($canvas, $fontSize, $textX, $textY, $barcodeValue, $black);

        // Save the image
        $fileName = $barcodeValue . '_' . time() . '.png';
        $savePath = FCPATH . 'barcodes/' . $fileName;

        if (!is_dir(FCPATH . 'barcodes')) {
            mkdir(FCPATH . 'barcodes', 0777, true);
        }

        imagepng($canvas, $savePath);

        // Save to DB
        $model = new \App\Models\BarcodeModel();
        $model->insert([
            'rack_product_id' => $rackId,
            'barcode_value'   => $barcodeValue,
            'qr_image_path'   => '/barcodes/' . $fileName,
            'generated_by'    => session()->get('user_name') ?? 'system'
        ]);

        // Clean up
        imagedestroy($barcodeGD);
        imagedestroy($canvas);

        return redirect()->to(base_url('barcode/list'))->with('success', 'Barcode generated for ' . $barcodeValue);
    }
    public function list()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pine_store_warehouse_barcodes b');
        $builder->select('b.*, i.item_name, c.id AS customer_id, c.customer_name');
        $builder->join('customer_inventory i', 'i.id = b.rack_product_id', 'left');
        $builder->join('pine_upload_inventory c', 'c.id = i.upload_inventory_id', 'left');
        $builder->orderBy('b.generated_at', 'DESC');

        // Apply search filters if present
        $customerName = $this->request->getGet('customer_name');
        $customerId = $this->request->getGet('customer_id');

        if (!empty($customerName)) {
            $builder->like('c.customer_name', $customerName);
        }

        if (!empty($customerId)) {
            $builder->where('c.id', $customerId);
        }

        $query = $builder->get();
        $data['barcodes'] = $query->getResultArray();

        // Pass filters to view so form retains values
        $data['filters'] = [
            'customer_name' => $customerName,
            'customer_id' => $customerId,
        ];

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/barcode_list', $data)
            . view('templates/htmlclose');
    }
    public function getChildBarcodes($inventoryId)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('customer_inventory_child_barcodes');
        $builder->where('inventory_id', $inventoryId);
        $query = $builder->get();
        $barcodes = $query->getResultArray();

        if (empty($barcodes)) {
            echo '<p>No child barcodes found.</p>';
            return;
        }

        echo '<div class="table-responsive"><table class="table table-bordered">';
        echo '<thead><tr><th>#</th><th>Child Barcode</th><th>Serial</th><th>Status</th><th>QR</th><th>Created At</th></tr></thead><tbody>';

        foreach ($barcodes as $index => $child) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . esc($child['child_barcode_value']) . '</td>';
            echo '<td>' . esc($child['serial_number']) . '</td>';
            echo '<td>' . esc($child['item_status']) . '</td>';
            echo '<td>';
            if (!empty($child['qr_image_path'])) {
                echo '<img src="' . base_url($child['qr_image_path']) . '" style="width:70px;" class="border rounded p-1">';
            } else {
                echo 'No QR';
            }
            echo '</td>';
            echo '<td>' . date('d M Y, h:i A', strtotime($child['created_at'])) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table></div>';
    }
}
