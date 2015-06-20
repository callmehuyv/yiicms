<?php

namespace app\controllers;
use app\models\Category;
use Yii;
use yii\web\UploadedFile;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$data['categories'] = Category::find()->where(['deleted' => 0])->all();
        return $this->render('index', $data);
    }

    public function actionCreate()
    {
    	$model = new Category();
    	if ($model->load(Yii::$app->request->post())) {
    		if ($model->validate()) {
    			$model->save();
    			$file = UploadedFile::getInstance($model, 'category_image');
    			if ($file) {
    				$file->saveAs('uploads/category_'.$model->category_id.'.'.$file->extension);
    				$model->category_image = 'uploads/category_'.$model->category_id.'.'.$file->extension;
                } else {
                    $model->post_image = 'uploads/no-thumbnail.png';
                }
                $model->save();
                Yii::$app->session->setFlash('message', 'Create new post success');
    			return $this->redirect(['category/index']);
    		}
    	}
        $data['model'] = $model;
        return $this->render('create', $data);
    }

    public function actionEdit()
    {
    	$selected_category = (int)$_GET['category'];
    	$model = Category::findOne($selected_category);
    	$oldImage = $model->category_image;
    	if ($model->load(Yii::$app->request->post())) {
    		if ($model->validate()) {
                $model->updated_at = date('Y-m-d H:i:s');
    			$model->save();
    			$file = UploadedFile::getInstance($model, 'category_image');
    			if ($file) {
    				$file->saveAs('uploads/category_'.$model->category_id.'.'.$file->extension);
    				$model->category_image = 'uploads/category_'.$model->category_id.'.'.$file->extension;
    			} else {
    				$model->category_image = $oldImage;
    			}
    			$model->save();
                Yii::$app->session->setFlash('message', 'Update category success');
    			return $this->redirect(['category/edit', 'category' => $model->category_id]);
    		}
    	}
        $data['model'] = $model;
        return $this->render('edit', $data);
    }

    public function actionDelete(){
		$selected_category = (int)$_POST['category'];
		$model = Category::findOne($selected_category);
		$model->deleted = 1;
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return [
			'status' => $model->save(),
			'element' => '#category_'.$selected_category
		];
    }
}
