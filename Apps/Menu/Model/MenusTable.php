<?php
namespace Apps\Menu\Model;

use Apps\Menu\Model\Entities\MenuEntity;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class MenusTable extends Table
{

    public function initialize(array $config)
    {
        $this->entityClass(MenuEntity::class);
        $this->hasMany('Items', [
            'className' => 'MenuItems'
        ]);
    }

    public function save(EntityInterface $entity, $options = [])
    {
        /**
         * @var MenuEntity $entity
         */
        $menu_id = $entity->id;

        if (isset($entity->mitems)) {
            $mitems = json_decode($entity->mitems);
            $this->saveMenuItems($mitems, $menu_id);
            unset($entity->mitems);
        }

        parent::save($entity);

    }

    public function get_mitems($id, $parent = null)
    {
        $menuItemsTable = TableRegistry::get('MenuItems', ['className' => MenuItemsTable::class]);
        if ($parent == null) {
            $items = $menuItemsTable->find()->where("menu_id = $id AND parent_id is NULL")->contain(['Children']);
        } else {
            $items = $menuItemsTable->find()->where("menu_id = $id and parent_id = $parent")->contain(['Children']);
        }

        foreach ($items->all() as $k => $item) {
            $children = $this->get_mitems($id, $item->id);
            if (!empty($children)) {
                $item->children = $children;
            }
        }

        return $items;
    }

    public function saveMenuItems($items, $menu_id, $parent_id = null)
    {
        $menuItemTable = TableRegistry::get('MenuItems', ['className' => MenuItemsTable::class]);

        foreach ($items as $position => $mitem) {
            // Suppression
            if ($mitem->deleted == 1) {
                $mitem = $menuItemTable->get($mitem->id);
                if ($mitem) {
                    $menuItemTable->delete($mitem);
                }
                continue;
            }

            // Update
            $children_update = false;
            if ($mitem->new == 0 && $mitem->deleted == 0) {
                unset($mitem->new);
                unset($mitem->deleted);
                if (isset($mitem->children)) {
                    $children_update = $mitem->children;
                    unset($mitem->children);
                }
                $toUpdate = $menuItemTable->get($mitem->id);
                if ($toUpdate) {
                    if ($parent_id) {
                        $mitem->parent_id = $parent_id;
                    } else {
                        $mitem->parent_id = null;
                    }
                    $mitem->display_order = $position;
                    $updated = $menuItemTable->patchEntity($toUpdate, (array)$mitem);
                    $menuItemTable->save($updated);
                }
                if ($children_update) {
                    $this->saveMenuItems($children_update, $menu_id, $mitem->id);
                }
                continue;
            }

            // New
            $children = false;
            if ($mitem->new) {
                unset($mitem->new);
                unset($mitem->deleted);
                unset($mitem->id);
                if (isset($mitem->children)) {
                    $children = $mitem->children;
                    unset($mitem->children);
                }
                $mitem->display_order = $position;
                $mitem->menu_id = $menu_id;
                $new = new MenuEntity((array)$mitem);
                $menuItemTable->save($new);
                if ($children) {
                    $this->saveMenuItems($children, $menu_id, $new->id);
                }
            }
        }
    }
}