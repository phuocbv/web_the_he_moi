<?php

namespace App;

use \Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class CollectionValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|max:50|unique:collections,name',
            'shop_id' => 'required|exists:shops,id',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:50|unique:collections,name',
        ],
    ];
}
