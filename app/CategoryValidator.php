<?php

namespace App;

use \Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class CategoryValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required|max:50|unique:categories,name',
            'sort' => 'required|numeric',
        ],
    ];
}
