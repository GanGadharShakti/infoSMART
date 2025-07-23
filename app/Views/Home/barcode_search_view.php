<!-- Add to your main template -->
<div class="container mt-4">
    <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Stored Barcodes</h4>

        <!-- <a href="<?= base_url('barcode/list') ?>" class="btn custom-button gen-bord">Box barcode</a> -->

    </div>
    <!-- Toggle Buttons -->
    <div class="mb-3">
        <button id="btnBox" class="btn btn-primary" onclick="setSearchType('box')">Box Barcode</button>
        <button id="btnItem" class="btn btn-outline-primary" onclick="setSearchType('item')">Item Barcode</button>
    </div>

    <!-- Search Input -->
    <div class="input-group mb-3">
        <input type="text" id="barcodeSearch" class="form-control" placeholder="Enter Barcode id..." />
        <button class="btn btn-success" onclick="searchBarcode()">Search</button>
    </div>

    <!-- Search Results -->
    <div id="barcodeResults" class="mt-4"></div>
</div>