<?php

namespace app\models\Users;

use app\core\BaseModel;

class Businessman extends BaseModel {

    protected $table = 'businessman';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>