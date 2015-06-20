<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property string $post_id
 * @property string $post_name
 * @property string $post_content
 * @property string $post_image
 * @property string $category_id
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $deleted
 *
 * @property Categories $category
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_name', 'category_id'], 'required'],
            [['post_content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['deleted'], 'boolean'],
            [['post_name'], 'string', 'max' => 50],
            [['post_image'], 'file', 'extensions' => 'jpg, gif, png'],
            ['post_name', 'unique'],
            ['category_id', 'exist', 'targetClass' => '\app\models\Category', 'targetAttribute' => 'category_id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_name' => 'Post Name',
            'post_content' => 'Post Content',
            'post_image' => 'Post Image',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return Category::find()->where(['deleted' => 0, 'category_id' => $this->category_id])->one();
    }
}
