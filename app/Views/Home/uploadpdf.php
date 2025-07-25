<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('customer/upload-pdf') ?>" method="post" enctype="multipart/form-data">
            <label>Select PDF:</label>
            <input type="file" name="pdf_file" accept="application/pdf" required>
            <button type="submit" class="btn btn-primary mt-2">Upload PDF</button>
        </form>