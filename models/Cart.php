<?php

namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class TestForm
 * @package app\models
 */
class Cart extends ActiveRecord
{
    public function addToCart()
    {
        echo 'Worked!';

    }


}