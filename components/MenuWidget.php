<?php
/**
 * Created by PhpStorm.
 * User: maxus
 * Date: 05.10.2018
 * Time: 15:07
 */

namespace app\components;


use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        $menu = \Yii::$app->cache->get('menu');
        if ($menu){
            return $menu;
        }
        $this->data = Category::find()->indexBy('id')->asArray()->all();
//        dd($this->data);
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
//        dd($this->tree);
        \Yii::$app->cache->set('menu', $this->menuHtml, 60);
        return $this->menuHtml;
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                //мой вариант
//                $tree[$node['parent_id']]['childs'][$id] = $node;
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
//        dd($tree);
        return $tree;
    }

    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->categoryToTemplate($category);
        }
        return $str;
    }

    protected function categoryToTemplate($category)
    {
        ob_start();
        include __DIR__.'/menu_tpl/'. $this->tpl;
//        return ob_get_contents();
        return ob_get_clean();
    }


}