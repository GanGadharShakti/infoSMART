<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="content-wrapper">
    <div class="container py-4">
        <h4><?= isset($unit) ? 'Edit' : 'Add' ?> Storage Unit</h4>
        <form method="post" action="<?= isset($unit) ? base_url('storage-units/update/' . $unit['id']) : base_url('storage-units/store') ?>">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <label>City ID</label>
                    <input type="number" name="city_id" class="form-control" value="<?= $unit['city_id'] ?? '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Short Title</label>
                    <input type="text" name="short_title" class="form-control" value="<?= $unit['short_title'] ?? '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Unit Size</label>
                    <input type="text" name="unit_size" class="form-control" value="<?= $unit['unit_size'] ?? '' ?>">
                </div>

                <div class="col-md-4">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control" value="<?= $unit['price'] ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <label>Square Feet</label>
                    <input type="number" name="sq_ft" class="form-control" value="<?= $unit['sq_ft'] ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <label>Image URL</label>
                    <input type="text" name="image" class="form-control" value="<?= $unit['image'] ?? '' ?>">
                </div>

                <!-- Features -->
                <div class="col-md-3">
                    <label><input type="checkbox" name="has_wifi" value="1" <?= !empty($unit['has_wifi']) ? 'checked' : '' ?>> Wifi</label>
                </div>
                <div class="col-md-3">
                    <label><input type="checkbox" name="has_camera" value="1" <?= !empty($unit['has_camera']) ? 'checked' : '' ?>> Camera</label>
                </div>
                <div class="col-md-3">
                    <label><input type="checkbox" name="has_lock" value="1" <?= !empty($unit['has_lock']) ? 'checked' : '' ?>> Lock</label>
                </div>
                <div class="col-md-3">
                    <label><input type="checkbox" name="has_truck" value="1" <?= !empty($unit['has_truck']) ? 'checked' : '' ?>> Truck</label>
                </div>

                <div class="col-12">
                    <label>Unit Features</label>
                    <textarea name="unit_features" class="form-control"><?= $unit['unit_features'] ?? '' ?></textarea>
                </div>

                <div class="col-12">
                    <button class="btn btn-success" type="submit"><?= isset($unit) ? 'Update' : 'Save' ?></button>
                    <a href="<?= base_url('storage-units') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?= view('templates/htmlclose') ?>
