<table>
    <thead>
        <tr>
            <?php foreach($fields as $field => $title): ?>
                <th><?= $title ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach($items as $item): ?>
                <?php foreach($fields as $field => $title): ?>
                    <td><?= $item->{$field} ?></td>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>