<table>
    <thead>
        <tr>
            <?php foreach($fields as $field => $title): ?>
                <th><?= $title ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
            <tr>
                <?php foreach($fields as $field => $title): ?>
                    <td><?= $item->{$field} ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>