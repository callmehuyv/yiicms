<?php

namespace app\controllers;
use app\models\Category;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
    	$category = new Category();
        return $this->render('create', ['category' => $category]);
    }
}
