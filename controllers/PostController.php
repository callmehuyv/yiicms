<?php
namespace app\controllers;
use yii;
use yii\helpers\ArrayHelper;
use app\models\Post;
use app\models\Category;
use yii\web\UploadedFile;
use yii\data\Pagination;

class PostController extends \yii\web\Controller
{
    public function actionCreate()
    {
    	$model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'post_image');
                if ($file) {
                    $model->save();
                    $file->saveAs('uploads/post_'.$model->post_id.'.'.$file->extension);
                    $model->post_image = 'uploads/post_'.$model->post_id.'.'.$file->extension;
                } else {
                    $model->post_image = 'uploads/no-thumbnail.png';
                }
                $model->save();
                Yii::$app->session->setFlash('message', 'Create new post success');
                return $this->redirect(['post/index']);
            }
        }

    	if (isset($_GET['category'])) {
    		$model->category_id = (int)$_GET['category'];
    	}

    	$data['model'] = $model;
    	$data['list_categories'] = ArrayHelper::map(Category::find()->where(['deleted' => 0])->all(), 'category_id', 'category_name');
    	return $this->render('create', $data);
    }

    public function actionIndex() {
        $params['deleted'] = 0;
        if (isset($_GET['category'])) {
            $selected_category = $_GET['category'];
            $params['category_id'] = (int)$_GET['category'];
        } else {
            $selected_category = null;
        }

        $list_categories = Category::find()->where(['deleted'  => 0])->all();

        $query = Post::find()->where($params);

        if (isset($_GET['name'])) {
           $query = $query->where(['like', 'post_name', $_GET['name']]);
        }

        if (isset($_GET['date'])) {
            $query = $query->where('YEAR(created_at) = :year', [':year' => date('Y', strtotime($_GET['date']))]);
            $query = $query->andWhere('MONTH(created_at) = :month', [':month' => date('m', strtotime($_GET['date']))]);
            $query = $query->andWhere('DAY(created_at) = :day', [':day' => date('d', strtotime($_GET['date']))]);
        }


        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->defaultPageSize = 5;
        $posts = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        $data['list_categories'] = $list_categories;
        $data['pagination'] = $pagination;
        $data['selected_category'] = $selected_category;
        $data['posts'] = $posts;
        return $this->render('index', $data);
    }

    public function actionEdit()
    {
        $selected_post = (int)$_GET['post'];
        $model = Post::findOne($selected_post);
        $oldImage = $model->post_image;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
                $file = UploadedFile::getInstance($model, 'post_image');
                if ($file) {
                    $file->saveAs('uploads/post_'.$model->post_id.'.'.$file->extension);
                    $model->post_image = 'uploads/post_'.$model->post_id.'.'.$file->extension;
                } else {
                    $model->post_image = $oldImage;
                }
                $model->save();
                Yii::$app->session->setFlash('message', 'Update post success');
                return $this->redirect(['post/edit', 'post' => $model->post_id]);
            }
        }
        $data['list_categories'] = ArrayHelper::map(Category::find()->where(['deleted' => 0])->all(), 'category_id', 'category_name');
        $data['model'] = $model;
        return $this->render('edit', $data);
    }


    public function actionDelete(){
        $selected_posted = (int)$_POST['post'];
        $model = Post::findOne($selected_posted);
        $model->deleted = 1;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'status' => $model->save(),
            'element' => '#post_'.$selected_posted
        ];
    }
}
