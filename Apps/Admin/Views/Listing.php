<h1><?=$listing_title?></h1>
<?php if (isset($add_items)) : ?>
    <div class="add_item">
        <?php foreach ($add_items as $add_item) : ?>
            <a href="<?= BASE_URL . "admin/crud/" . $add_item['appname'] . DS . $add_item['crud'] ?>" class="button"><?= $add_item['name'] ?></a>
        <?php endforeach ?>
    </div>
<?php endif ?>
<table class="admin_listing">
    <thead class="admin_listing_header">
        <tr>
            <?php foreach($fields as $field => $title): ?>
                <th class="admin_listing_header_item"><?= $title ?></th>
            <?php endforeach; ?>
            <th class="admin_listing_header_item action"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody class="admin_listing_body">
        <?php foreach($items as $item): ?>
            <tr>
                <?php foreach($fields as $field => $title): ?>
                    <td class="admin_listing_body_item"><?= $item->{$field} ?></td>
                <?php endforeach; ?>
                <td class="admin_listing_body_item action">
                    <a href="<?= $update_url . $item->id ?>"><span class="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                    <a href="<?= $see_url . $item->id ?>"><span class="see"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                    <a href="<?= $delete_url . $item->id ?>" class="popup_confirm" data-what="<?=$item->id?>"><span class="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>