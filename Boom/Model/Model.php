<?php
namespace Boom\Model;

use Boom\Helper\Security;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;

class Model extends Table
{
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options) {
        //d($_FILES);
    }

    public function beforeSave(Event $event, EntityInterface $entity, $options)
    {
        if (isset($entity->password) && !isset($entity->isConnecting)) {
            $entity->password = Security::crypt($entity->password);
        }
    }
}