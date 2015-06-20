<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property string $category_id
 * @property string $category_name
 * @property string $category_image
 * @property string $category_description
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $deleted
 *
 * @property Posts[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_description'], 'string'],
            [['created_at'], 'safe'],
            [['deleted'], 'boolean'],
            [['category_name'], 'string', 'max' => 50],
            [['category_image'], 'string', 'max' => 255],
            [['category_name'], 'unique'],
            [['category_image'], 'file', 'extensions' => 'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_image' => 'Category Image',
            'category_description' => 'Category Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['category_id' => 'category_id']);
    }
}
