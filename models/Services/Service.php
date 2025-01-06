<?php

namespace app\models\Services;

use app\core\BaseModel;

class Service extends BaseModel {

    protected $table = 'service';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>