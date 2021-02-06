<?php

namespace NiagahosterTest\Controller;

use NiagahosterTest\Controller\BaseController;
use NiagahosterTest\Model\Price;

class PriceController extends BaseController
{
    public $allowed_fields = array("name", "price", "discount", "total_usage", "features");

    public function find()
    {
        $price = new Price();

        echo json_encode($price->find($this->params));
    }

    public function findById()
    {
        $price = new Price();

        echo json_encode($price->findById($this->params['id']));
    }

    public function update()
    {   
        if (empty($this->body) || empty($this->params['id'])) {
            http_response_code(400);
            echo json_encode(array('success' =>  false));
        }

        $price = new Price();
        $succeed = $price->update($this->params['id'], $this->body);

        if (!$succeed) http_response_code(400);
        echo json_encode(array('success' =>  $succeed));
    }

    public function delete() {
        if (empty($this->params['id'])) {
            http_response_code(400);
            echo json_encode(array('success' =>  false));
        }

        $price = new Price();
        $succeed = $price->delete($this->params['id'], $this->body);
        
        if (!$succeed) http_response_code(400);
        echo json_encode(array('success' =>  $succeed));
    }
}
