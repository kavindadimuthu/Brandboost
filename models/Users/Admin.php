<?php

namespace app\models\Users;

use app\core\BaseModel;

class Admin extends BaseModel {

    protected $table = 'admin';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>