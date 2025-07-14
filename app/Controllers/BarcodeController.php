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

        // Generate barcode
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeValue, $generator::TYPE_CODE_128);

        // Convert to image
        $barcodeGD = imagecreatefromstring($barcodeImage);

        // Desired final size (in pixels)
        $finalWidth = 192; // 2 inches at 96 DPI
        $finalHeight = 96; // 1 inch at 96 DPI

        // Add text space
        $fontSize = 2; // smaller font to fit
        $textHeight = imagefontheight($fontSize);
        $barcodeAreaHeight = $finalHeight - $textHeight;

        // Create final canvas
        $canvas = imagecreatetruecolor($finalWidth, $finalHeight);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        $black = imagecolorallocate($canvas, 0, 0, 0);
        imagefill($canvas, 0, 0, $white);

        // Resize original barcode proportionally
        imagecopyresampled(
            $canvas,
            $barcodeGD,
            0,
            0,                 // dest x,y
            0,
            0,                 // src x,y
            $finalWidth,
            $barcodeAreaHeight,    // dest w,h
            imagesx($barcodeGD),
            imagesy($barcodeGD)  // src w,h
        );

        // Add text below barcode
        $textWidth = imagefontwidth($fontSize) * strlen($barcodeValue);
        $textX = ($finalWidth - $textWidth) / 2;
        $textY = $barcodeAreaHeight + 1;

        imagestring($canvas, $fontSize, $textX, $textY, $barcodeValue, $black);

        // Save
        $fileName = $barcodeValue . '_' . time() . '.png';
        $savePath = FCPATH . 'barcodes/' . $fileName;
        if (!is_dir(FCPATH . 'barcodes')) {
            mkdir(FCPATH . 'barcodes', 0777, true);
        }
        imagepng($canvas, $savePath);
        // Save in DB
        $model = new \App\Models\BarcodeModel();
        $model->insert([
            'rack_product_id' => $rackId,
            'barcode_value'   => $barcodeValue,
            'qr_image_path'   => 'barcodes/' . $fileName,
           'generated_by' => session()->get('user_name')

        ]);

        // Cleanup
        imagedestroy($barcodeGD);
        imagedestroy($canvas);

        return redirect()->to(base_url('barcode/list'))->with('success', 'Barcode generated with fixed size.');
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
