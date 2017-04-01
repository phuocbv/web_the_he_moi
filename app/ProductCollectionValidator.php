<?php

namespace App;

use \Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ProductCollectionValidator extends LaravelValidator
{
    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'collection_id' => 'required|exists:collections,id'
    ];
}
