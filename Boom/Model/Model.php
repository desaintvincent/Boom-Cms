<?php
namespace Boom\Model;

use Boom\Helper\Security;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;

define('TARGET', 'Static/img/cms/');    // Repertoire cible
define('MAX_SIZE', 100000);    // Taille max en octets du fichier
define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels

class Model extends Table
{
    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options) {
        $tabExt = array('jpg','gif','png','jpeg');
        foreach ($_FILES as $key => $file) {
            if (empty($file['name'])) {
                //$data->{$key} = null; yoloooo
            } else {
                $extension  = pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION);
                $nomImage = $key .'.'. $extension;
                move_uploaded_file($_FILES[$key]['tmp_name'], TARGET.$nomImage);
                $_POST[$key] = TARGET.$nomImage;
            }
        }
    }

    public function beforeSave(Event $event, EntityInterface $entity, $options)
    {
        if (isset($entity->password)) {
            $entity->password = Security::crypt($entity->password);
        }
    }
}