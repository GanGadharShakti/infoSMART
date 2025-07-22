<?php

namespace App\Controllers;

use App\Models\BarcodeModel;
use Picqer\Barcode\BarcodeGeneratorPNG;

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

        $textWidth = imagefontwidth($fontSize) * strlen($barcodeValue);
        $textX = ($finalWidth - $textWidth) / 2;
        $textY = $barcodeAreaHeight + 1;
        imagestring($canvas, $fontSize, $textX, $textY, $barcodeValue, $black);

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

        imagedestroy($barcodeGD);
        imagedestroy($canvas);

        return redirect()->to(base_url('barcode/list'))->with('success', 'Barcode generated for ' . $barcodeValue);
    }



    // public function list()
    // {
    //     $model = new BarcodeModel();
    //     $data['barcodes'] = $model->findAll();

    //     return view('templates/header')
    //         . view('templates/sidebar')
    //         . view('Home/barcode_list', $data)
    //         . view('templates/htmlclose');
    // }

    public function list()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pine_store_warehouse_barcodes b');
        $builder->select('b.*, c.id AS customer_id, c.customer_name');
        $builder->join('customer_inventory i', 'i.id = b.rack_product_id', 'left');
        $builder->join('pine_upload_inventory c', 'c.id = i.upload_inventory_id', 'left');
        $builder->orderBy('b.generated_at', 'DESC');

        $query = $builder->get();
        $data['barcodes'] = $query->getResultArray();

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/barcode_list', $data)
            . view('templates/htmlclose');
    }
}
