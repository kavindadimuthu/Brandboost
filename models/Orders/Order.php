<?php

namespace app\models\Orders;

use app\core\BaseModel;

class Order extends BaseModel {

    protected $table = 'order';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>