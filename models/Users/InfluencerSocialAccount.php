<?php

namespace app\models\Users;

use app\core\BaseModel;

class InfluencerSocialAccount extends BaseModel {

    protected $table = 'influencer_social_account';

    public function __construct() {
        parent::__construct($this->table);
    }
}
?>