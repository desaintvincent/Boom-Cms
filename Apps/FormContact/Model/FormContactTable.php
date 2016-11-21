<?php
namespace Apps\FormContact\Model;

use Apps\FormContact\Model\Entities\FormContactEntity;
use Apps\Pages\Model\Entities\PageEntity;
use Boom\Model\Model;

class FormContactTable extends Model {
    public function initialize(array $config)
    {
        $this->entityClass(FormContactEntity::class);
    }
}