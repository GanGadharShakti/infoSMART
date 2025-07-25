<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="<?= base_url('customer/upload-pdf') ?>" method="post" enctype="multipart/form-data">
    <label>Select PDF:</label>
    <input type="file" name="pdf_file" accept="application/pdf" required>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
