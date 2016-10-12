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

    public function get_mitems($id)
    {
        $menuItemsTable = TableRegistry::get('MenuItems', ['className' => MenuItemsTable::class]);
        $items = $menuItemsTable->find()->where("menu_id = $id AND parent_id is NULL")->order('display_order')->contain(['Children']);
        return $items->all();
    }

    public function saveMenuItems($items, $menu_id, $parent_id = null)
    {
        $menuItemTable = TableRegistry::get('MenuItems', ['className' => MenuItemsTable::class]);

        foreach ($items as $position => $mitem) {
            // Suppression
            if ($mitem->deleted) {
                $mitem = $menuItemTable->get($mitem->id);
                if ($mitem) {
                    $menuItemTable->delete($mitem);
                }
            }

            // Update
            if (!!$mitem->new && !!$mitem->deleted) {
                unset($mitem->new);
                unset($mitem->deleted);
                if (isset($mitem->children)) {
                    $this->saveMenuItems($mitem->children, $menu_id, $mitem->id);
                    unset($mitem->children);
                }
                if ($parent_id) {
                	$mitem->parent_id = $parent_id;
                }
                $mitem->display_order = $position;
                $updated = $menuItemTable->get($mitem->id);
                if ($mitem) {
                    $menuItemTable->patchEntities($updated, (array) $mitem);
                    $menuItemTable->save($updated);
                }
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
                $new = new MenuEntity((array) $mitem);
                $menuItemTable->save($new);
                if ($children) {
                    $this->saveMenuItems($mitem->children, $menu_id, $new->id);
                }
            }
        }
    }

    /*function save_items($id, $data, $parent = NULL)
    {
        $order = 0;
        foreach ($data as $item) {

            if ($item['deleted'] == 1) {
                //on delete l'item
                $query = "DELETE FROM `menu_items` WHERE id = :mitem_id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':mitem_id', $item['id']);
                $stmt->execute();
            } else if ($item['new'] == 1) {
                //nouveau item
                $query = "INSERT INTO `menu_items` (`id`, `mitem_parent_id`, `mitem_display_order`, `mitem_menu_id`, `mitem_title`, `mitem_arg`, `mitem_type`) VALUES (NULL, :mitem_parent, :mitem_order, :mitem_parent_id, :mitem_title, NULL, 1);";

                $stmt = $this->db->prepare($query);

                $stmt->bindParam(':mitem_parent', $parent);
                $stmt->bindParam(':mitem_order', $order);
                $stmt->bindParam(':mitem_parent_id', $id);
                $stmt->bindParam(':mitem_title', $item['title']);
                $stmt->execute();
                $item['id'] = $this->db->lastInsertId();


            } else {
                $query = "UPDATE menu_items SET mitem_parent_id=:mitem_parent, mitem_display_order=:mitem_order, mitem_title=:mitem_title, mitem_arg=:mitem_arg, mitem_type=:mitem_type WHERE id=:mitem_id";
                $stmt = $this->db->prepare($query);

                $stmt->bindParam(':mitem_parent', $parent);
                $stmt->bindParam(':mitem_order', $order);
                $stmt->bindParam(':mitem_title', $item['title']);


                $mitem_arg = NULL;
                $mitem_type = 1;
                if (empty($mitem_arg)) {
                    $stmt->bindParam(':mitem_arg', $mitem_arg, \PDO::PARAM_NULL);
                } else {
                    $stmt->bindParam(':mitem_arg', $mitem_arg, \PDO::PARAM_STR);
                }

                $stmt->bindParam(':mitem_type', $mitem_type);
                $stmt->bindParam(':mitem_id', $item['id']);

                $stmt->execute();
                //update item
            }

            //récursive
            if (isset($item['children'])) {
                $this->save_items($id, $item['children'], $item['id']);
            }
            //on incrémente l'order
            $order++;
        }
    }*/

    /*function update($id, $data = null, $table = null)
    {

        $array = json_decode($data['output_items'], true);
        if (!empty($array)) {
            $this->save_items($id, $array);
        }
        unset($data['output_items']);
        return parent::update($id, $data, $table); // TODO: Change the autogenerated stub
    }*/
}