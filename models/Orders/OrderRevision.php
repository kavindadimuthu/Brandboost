<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderRevision extends BaseModel {

    protected $table = 'order_revision';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>