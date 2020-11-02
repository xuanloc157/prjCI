<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $allowedFields = ['name', 'price', 'review'];
    public function getProduct($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->asArray()->where(['id' => $slug])->first();
    }
   
}
