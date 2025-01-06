<?php

namespace app\models\Actions;

use app\core\BaseModel;

class Complaint extends BaseModel {

    protected $table = 'complaint';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>