<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property string $post_id
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_detail
 * @property string $post_status
 * @property string $post_slug
 * @property string $post_thumbnail
 * @property string $user_id
 * @property string $category_id
 *
 * @property Users $user
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
            [['post_title', 'post_excerpt', 'post_detail', 'post_status', 'post_slug', 'post_thumbnail', 'user_id', 'category_id'], 'required'],
            [['post_detail'], 'string'],
            [['user_id', 'category_id'], 'integer'],
            [['post_title', 'post_excerpt', 'post_slug'], 'string', 'max' => 255],
            [['post_status'], 'string', 'max' => 64],
            [['post_thumbnail'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_title' => 'Post Title',
            'post_excerpt' => 'Post Excerpt',
            'post_detail' => 'Post Detail',
            'post_status' => 'Post Status',
            'post_slug' => 'Post Slug',
            'post_thumbnail' => 'Post Thumbnail',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'category_id']);
    }
}
