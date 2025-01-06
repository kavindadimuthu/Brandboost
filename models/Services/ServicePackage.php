<?php

namespace app\models\Services;

use app\core\BaseModel;

class ServicePackage extends BaseModel {

    protected $table = 'service_package';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>