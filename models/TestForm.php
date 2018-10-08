<?php

namespace app\models;


//use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class TestForm
 * @package app\models
 */

class TestForm extends ActiveRecord
{
//    public $name;
//    public $email;
//    public $text;
    public static function tableName()
    {
        return 'posts';
    }


    public function attributeLabels()
    {

        return [
            'name' => 'Имя',
            'email' => 'E-Mail',
            'text' => 'Текст сообщения',
        ];
    }

    public function rules()
    {
        return [
            [ ['name', 'text'], 'required'],
            ['email', 'email'],
            
        ];
    }

}