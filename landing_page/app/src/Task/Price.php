<?php

namespace NiagahosterTest\Task;

use NiagahosterTest\Task\Task;
use NiagahosterTest\Model\Price as PriceModel;

class Price extends Task
{
    function startTask()
    {
        $fields = array(
            'name' => array('type' => 'VARCHAR', 'mustnotnull' => true, 'length' => 30),
            'price' => array('type' => 'INT', 'mustnotnull' => true),
            'discount' => array('type' => 'INT'),
            'total_usage' => array('type' => 'INT'),
            'features' => array('type' => 'TEXT')
        );

        $this->createTable($fields, 'prices');
        $this->seeds();
    }

    function seeds()
    {
        $priceModel = new PriceModel();
        $features_bayi = "
        <ul>
            <li><strong>0.5X RESOURCE POWER</strong></li>
            <li><strong>500 MB</strong> Disk Space</li>
            <li><strong>Unlimited</strong> Bandwidth</li>
            <li><strong>Unlimited</strong> Databases</li>
            <li><strong>1</strong> Domain</li>
            <li><strong>Instant</strong> Backup</li>
            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>
        </ul>
        ";

        $features_pelajar = "
        <ul>
            <li><strong>1X RESOURCE POWER</strong></li>
            <li><strong>Unlimited</strong> Disk Space</li>
            <li><strong>Unlimited</strong> Bandwidth</li>
            <li><strong>Unlimited</strong> POP3 Email</li>
            <li><strong>Unlimited</strong> Databases</li>
            <li><strong>10</strong> Addon Domain</li>
            <li><strong>Instant</strong> Backup</li>
            <li><strong>Domain Gratis</strong> Selamanya</li>
            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>
        </ul>
        ";

        $features_personal = "
        <ul>
            <li><strong>2X RESOURCE POWER</strong></li>
            <li><strong>Unlimited</strong> Disk Space</li>
            <li><strong>Unlimited</strong> Bandwidth</li>
            <li><strong>Unlimited</strong> POP3 Email</li>
            <li><strong>Unlimited</strong> Databases</li>
            <li><strong>Unlimited</strong> Addon Domain</li>
            <li><strong>Instant</strong> Backup</li>
            <li><strong>Domain Gratis</strong> Selamanya</li>
            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>
            <li><strong>Private</strong> Name Server</li>
            <li><strong>SpamAssasin</strong> Mail Protection</li>
        </ul>
        ";

        $features_bisnis = "
        <ul>
            <li><strong>3X RESOURCE POWER</strong></li>
            <li><strong>Unlimited</strong> Disk Space</li>
            <li><strong>Unlimited</strong> Bandwidth</li>
            <li><strong>Unlimited</strong> POP3 Email</li>
            <li><strong>Unlimited</strong> Databases</li>
            <li><strong>Unlimited</strong> Addon Domain</li>
            <li><strong>Magic Auto</strong> Backup & Restore</li>
            <li><strong>Domain Gratis</strong> Selamanya</li>
            <li><strong>Unlimited SSL</strong> Gratis Selamanya</li>
            <li><strong>Private</strong> Name Server</li>
            <li><strong>Prioritas</strong> Layanan Suport</li>
            <li class='has-text-centered'><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i></li>
            <li><strong>SpamExpert</strong> Pro Mail Protection</li>
        </ul>
        ";

        $data_seeds = array(
            array("name" => "Bayi", "price" => 19000, "discount" => 4100, "total_usage" => 938, "features" => $features_bayi),
            array("name" => "Pelajar", "price" => 46900, "discount" => 23450, "total_usage" => 4168, "features" => $features_pelajar),
            array("name" => "Personal", "price" => 58900, "discount" => 20000, "total_usage" => 10017, "features" => $features_personal),
            array("name" => "Bisnis", "price" => 109900, "discount" => 43100, "total_usage" => 3552, "features" => $features_bisnis),
        );

        foreach ($data_seeds as $data_seed) {
            $priceModel->create($data_seed);
        }
    }
}
