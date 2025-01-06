<?php

namespace app\models\Users;

use app\core\BaseModel;

class DesignerProject extends BaseModel {

    protected $table = 'designer_project';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>