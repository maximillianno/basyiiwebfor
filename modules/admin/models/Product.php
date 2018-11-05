<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 */
class Product extends \yii\db\ActiveRecord
{

    public $image;
    public $gallery;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Название категории',
            'name' => 'Название товара',
            'content' => 'Content',
            'price' => 'Цена',
            'keywords' => 'Keywords',
            'description' => 'Description',
//            'img' => 'Img',
            'image' => 'Фото',
            'gallery' => 'Галерея',
            'hit' => 'Хит',
            'new' => 'Новинка',
            'sale' => 'Распродажа',
        ];
    }

    public function getCategory(){
        /** @noinspection PhpLanguageLevelInspection */
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function upload()
    {
        if ($this->validate()){

            $path = 'files/store/' . $this->image->baseName . '.' . $this->image->extension;
//            dd($path);
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            return true;
        }
        return false;
    }
    public function uploadGallery()
    {
        if ($this->validate()){
            foreach ($this->gallery as $item) {

                $path = 'files/store/' . $item->baseName . '.' . $item->extension;
    //            dd($path);
                $item->saveAs($path);
                $this->attachImage($path, false);
                @unlink($path);
            }
            return true;
        }
        return false;
    }
}
