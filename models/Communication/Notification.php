<?php

namespace app\models\Communication;

use app\core\BaseModel;

class Notification extends BaseModel {

    protected $table = 'notification';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>