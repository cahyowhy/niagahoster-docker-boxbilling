<?php

namespace NiagahosterTest\Model;

use NiagahosterTest\Model\Model;

class Price extends Model
{
    public $table_name = "prices";

    public $fields = ["name", "price", "discount", "total_usage", "features"];
}
