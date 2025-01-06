<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderReviewsFeedback extends BaseModel {

    protected $table = 'order_reviews_feedback';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>