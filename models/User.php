<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_password
 * @property string $user_auth_key
 *
 * @property Posts[] $posts
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_email', 'user_password', 'user_auth_key'], 'required'],
            [['user_name', 'user_email'], 'string', 'max' => 64],
            [['user_password', 'user_auth_key'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_email' => 'User Email',
            'user_password' => 'User Password',
            'user_auth_key' => 'User Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['user_id' => 'user_id']);
    }


    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (User::find()->all() as $user) {
            if ($user->accessToken === $token) {
                return User::findOne($user->user_id);
            }
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        foreach (User::find()->all() as $user) {
            if (strcasecmp($user->user_email, $email) === 0) {
                return User::findOne($user->user_id);
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->user_auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($user_auth_key)
    {
        return $this->user_auth_key === $user_auth_key;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($user_password)
    {
        return $this->user_password === $user_password;
    }
}
