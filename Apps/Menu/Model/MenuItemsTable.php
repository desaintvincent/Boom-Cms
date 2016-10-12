<?php


namespace Apps\Menu\Model;


use Apps\Menu\Model\Entities\MenuItemEntity;
use Cake\ORM\Table;

class MenuItemsTable extends Table
{
    public function initialize(array $config)
    {
        $this->entityClass(MenuItemEntity::class);
        $this->belongsTo('Menus');
        $this->hasMany('Children', [
            'className' => 'MenuItems',
            'foreignKey' => 'parent_id'
        ]);
    }
}