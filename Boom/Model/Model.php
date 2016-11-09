<?php
namespace Boom\Model;


use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;

class Model extends Table
{
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options) {
        d($_FILES);
    }
}