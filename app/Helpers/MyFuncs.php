<?php

namespace App\Helpers;

use Mail;

class MyFuncs
{
    public static function handleTitle($string, $num)
    {
        $arr = explode(' ', $string);
        $description = '';
        if (count($arr) > $num) {
            for ($i = 0; $i < $num; $i++) {
                $description .= $arr[$i] . ' ';
            }
        } else {
            $description = $string;
        }
        $description .= ' ...';
        return $description;
    }

    public static function sendEmail($content)
    {
        Mail::send($content['view'], $content['data'], function($message) use ($content) {
            $message->to($content['email']);
            $message->subject($content['subject']);
        });
    }

    public static function getListProduct($categoryShow)
    {
        $listProduct = null;
        if ($categoryShow->parent_id == null) {
            $listProduct = $categoryShow->allProductsByCate;
        } else {
            $listProduct = $categoryShow->products;
        }

        return $listProduct;
    }

    public static function getDiscount($priceProduct, $discount)
    {
        if ($discount > 0) {
            $priceProduct *= (1 - $discount / 100);
        }

        return round($priceProduct, -3);
    }

    public static function getSumMoney($orderedProducts)
    {
        $sum = 0;
        foreach ($orderedProducts as $key => $value) {
            $sum += $value->product->price * (1 - $value->product->discount / 100) * $value->quantity_item;
        }

        return $sum;
    }
}
