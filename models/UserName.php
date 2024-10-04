<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_login".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
  * @property string $role

 */
class UserName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_login';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password','email'], 'required'],
            [['username','email'], 'string', 'max' => 255],
            [['password', ], 'string', 'min' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email'=> 'Email',
            'password' => 'Password',
          
        ];
    }


    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    

}
