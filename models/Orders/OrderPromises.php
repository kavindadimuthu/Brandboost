<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderPromises extends BaseModel {

    protected $table = 'order_promises';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>