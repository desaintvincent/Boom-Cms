<?php
namespace Boom\Model;

use Boom\Helper\Security;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;

class Model extends Table
{

    public function beforeSave(Event $event, EntityInterface $entity, $options)
    {
        if (isset($entity->password)) {
            $entity->password = Security::crypt($entity->password);
        }
    }
}