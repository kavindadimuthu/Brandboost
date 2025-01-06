<?php

namespace app\models\Services;

use app\core\BaseModel;

class ServiceCustomPackage extends BaseModel {

    protected $table = 'service_custom_package';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>