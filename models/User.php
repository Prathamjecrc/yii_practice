<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;

class User extends ActiveRecord implements IdentityInterface
{

    public $authKey;
    public $accessToken;
    public static function tableName()
    {
        return 'user_login'; // Table where login credentials are stored
    }

    public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {

        // Convert array to string for saving
        if (is_array($this->city)) {
            $this->city = implode(', ', $this->city);
        }
        if (is_array($this->hobbies)) {
            $this->hobbies = implode(', ', $this->hobbies);
        }

        // Check if a new image file has been uploaded
        $this->profile_image = UploadedFile::getInstance($this, 'profile_image');
        if ($this->profile_image) {
            // Save the new image
            $fileName = 'profile_image_' . time() . '.' . $this->profile_image->extension;
            $filePath = 'uploads/profile_images/' . $fileName;
            if ($this->profile_image->saveAs($filePath)) {
                $this->profile_image = $filePath; // Store the new file path
            }
        } else {
            // If no new image is uploaded, retain the existing image path
            $this->profile_image = $this->getOldAttribute('profile_image');
        }

        return true;
    }
    return false;
}


    public function afterFind()
    {
        parent::afterFind();

        // Convert string to array for form
        if (!is_array($this->city)) {
            $this->city = explode(', ', $this->city);
        }
        if (!is_array($this->hobbies)) {
            $this->hobbies = explode(', ', $this->hobbies);
        }
    }
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['role', 'required'],
            ['role', 'in', 'range' => ['admin', 'employee']],
    
            ['state', 'required'],
            ['state', 'in', 'range' => ['rajasthan', 'gujarat', 'delhi', 'maharashtra']],
    
            ['city', 'required'],
            ['city', 'each', 'rule' => ['in', 'range' => ['Chittorgarh', 'Ahmedabad', 'Nashik', 'Delhi']]],
    
            ['hobbies', 'each', 'rule' => ['in', 'range' => ['coding', 'cricket', 'singing', 'traveling']]],
    
    
            ['profile_image', 'file', 'extensions' => 'png, jpg, jpeg'],
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
            'state' => 'State',
            'city' => 'City',
            'hobbies' => 'Hobbies',
            'authkey' => 'Authkey',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
    //    if($this->password === $password){
    //     echo '1';die;
    //    }
    //    else{
    //     echo '2' ;die;
    //    }
       
        return $this->password === $password;
    }

    public function getSubEmployees()
    {
        return $this->hasMany(SubEmployee::class, ['employee_id' => 'id']);
    }
    
}
