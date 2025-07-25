<h4>Customer PDFs</h4>
<table class="table">
    <thead>
        <tr>
            <th>Customer</th>
            <th>City</th>
            <th>PDF</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pdfs as $pdf): ?>
            <tr>
                <td><?= esc($pdf->customer_name) ?></td>
                <td><?= esc($pdf->city) ?></td>
                <td>
                    <a href="<?= base_url('uploads/pdfs/' . $pdf->pdf_name) ?>" target="_blank">Download</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
