<div class="main-panel">
    <div class="content-wrapper">
        <div class="row" style="background-color: white; overflow: scroll">
            <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Warehouse Locations</h4>
                <a href="<?= base_url('warehouse') ?>" class="btn custom-button gen-bord">Back to Warehouse List</a>
            </div>

            <?php if (!empty($locations)): ?>
                <table id="dataTable" class="display table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Hours</th>
                            <th>Active</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($locations as $loc): ?>
                            <tr>
                                <td><?= esc($loc['id']) ?></td>
                                <td><?= esc(is_array($loc['description']) ? implode(', ', $loc['description']) : $loc['description']) ?></td>
                                <td>
                                    <?php if (!empty($loc['location_image'])): ?>
                                        <img src="<?= base_url('uploads/' . $loc['location_image']) ?>" width="80">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $hours = json_decode($loc['hours_json'], true);
                                    if (is_array($hours)):
                                        foreach ($hours as $day => $time):
                                            $timeString = is_array($time) ? implode(', ', $time) : $time;
                                            echo "<strong>" . esc($day) . ":</strong> " . esc($timeString) . "<br>";
                                        endforeach;

                                    else:
                                        echo '<span class="text-muted">N/A</span>';
                                    endif;
                                    ?>
                                </td>
                    
                                <td><?= $loc['is_active'] ? 'Yes' : 'No' ?></td>
                                <td><?= esc($loc['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center w-100 mt-5">No warehouse locations found for this city.</p>
            <?php endif; ?>
        </div>
    </div>
</div>