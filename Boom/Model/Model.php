<?php
namespace Boom\Model;


use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;

class Model extends Table
{
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options) {
        dd($entity);
    }
}