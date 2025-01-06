<?php

namespace app\models\Services;

use app\core\BaseModel;

class ServiceAnalytics extends BaseModel {

    protected $table = 'service_analytics';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>