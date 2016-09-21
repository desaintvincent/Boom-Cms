<button class="button"><a href="<?= $add_url ?>"><?= __('Ajouter') ?></a></button>
<table class="admin_listing">
    <thead class="admin_listing_header">
        <tr>
            <?php foreach($fields as $field => $title): ?>
                <th class="admin_listing_header_item"><?= $title ?></th>
                <th class="admin_listing_header_item"><?= __('Actions') ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody class="class="admin_listing_body">
        <?php foreach($items as $item): ?>
            <tr>
                <?php foreach($fields as $field => $title): ?>
                    <td class="admin_listing_body_item"><?= $item->{$field} ?></td>
                    <td class="admin_listing_body_item"><a href="<?= $base_url . $item->id ?>"><?= __('Editer') ?></a></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>