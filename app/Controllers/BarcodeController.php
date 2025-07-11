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

        if (empty($rackId) || empty($barcodeValue)) {
            return redirect()->back()->with('error', 'Fields required.');
        }

        // Generate Barcode using PNG (GD required)
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeValue, $generator::TYPE_CODE_128);

        // Save file to public/barcodes/
        $fileName = $barcodeValue . '_' . time() . '.png';
        $publicDir = FCPATH . 'barcodes/';
        $relativePath = 'barcodes/' . $fileName;

        // Create the barcodes directory if it doesn't exist
        if (!is_dir($publicDir)) {
            mkdir($publicDir, 0777, true);
        }

        file_put_contents($publicDir . $fileName, $barcodeImage);

        // Save barcode entry to DB
        $model = new BarcodeModel();
        $model->insert([
            'rack_product_id' => $rackId,
            'barcode_value'   => $barcodeValue,
            'qr_image_path'   => $relativePath, // stored relative to base_url
            'generated_by'    => 1 // Use session ID if available
        ]);

        return redirect()->to(base_url('barcode/list'))->with('success', 'Barcode generated and saved!');
    }

    public function list()
    {
        $model = new BarcodeModel();
        $data['barcodes'] = $model->findAll();

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/barcode_list', $data)
            . view('templates/htmlclose');
    }
}
