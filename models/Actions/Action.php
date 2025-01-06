<?php

namespace app\models\Actions;

use app\core\BaseModel;

class Action extends BaseModel {

    protected $table = 'action';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>