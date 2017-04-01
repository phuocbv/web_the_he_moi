<?php

namespace App;

use \Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ProductValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:50|unique:products,name',
            'code' => 'required|unique:products,code',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required',
            'status' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'shop_id' => 'required|exists:shops,id'
        ],
    ];
}
