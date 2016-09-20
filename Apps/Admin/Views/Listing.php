<table>
    <thead>
        <tr>
            <?php foreach($fields as $field => $title): ?>
                <th><?= $title ?></th>
                <th>Actions</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
            <tr>
                <?php foreach($fields as $field => $title): ?>
                    <td><?= $item->{$field} ?></td>
                    <td><a href="<?= $base_url . $item->id ?>">Editer</a></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>