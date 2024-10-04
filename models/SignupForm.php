<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\UserName;
use yii\web\UploadedFile;

/**
 * Signup form
 */

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $role;

    public $state;

    public $city;

    public $profileImage;

    public $hobbies;

    private $_user = false;

    /**
     * {@inheritdoc}
     */public function rules()
{
    return [
      
        ['username', 'trim'],
        ['username', 'required'],
        ['username', 'unique', 'targetClass' => '\app\models\UserName', 'message' => 'This username has already been taken.'],
        ['username', 'string', 'min' => 2, 'max' => 255],

        ['email', 'trim'],
        ['email', 'required'],
        ['email', 'email'],
        ['email', 'string', 'max' => 255],
        ['email', 'unique', 'targetClass' => '\app\models\UserName', 'message' => 'This email address has already been taken.'],

        ['password', 'required'],
        ['password', 'string', 'min' => 8],

        ['role', 'required'],
        ['role', 'in', 'range' => ['admin', 'employee']],

        ['state', 'required'],
        ['state', 'in', 'range' => ['rajasthan', 'gujarat', 'delhi', 'maharashtra']],

        ['city', 'required'],
        ['city', 'each', 'rule' => ['in', 'range' => ['Chittorgarh', 'Ahmedabad', 'Nashik', 'Delhi']]],

        ['hobbies', 'each', 'rule' => ['in', 'range' => ['coding', 'cricket', 'singing', 'traveling']]],


        ['profile_image', 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],

    ];
}


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new UserName();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->state = $this->state;
        if (is_array($this->city)) {
            $user->city = implode(', ', $this->city);  // Store as a comma-separated string
        }    

        if (is_array($this->hobbies)) {
            $user->hobbies = implode(', ', $this->hobbies);  // Store as a comma-separated string
        }  

        $this->profileImage = UploadedFile::getInstance($this, 'profileImage');
        if ($this->profileImage) {
            $fileName = 'profile_image_' . time() . '.' . $this->profileImage->extension;
    $filePath = 'uploads/profile_images/' . $fileName;
            // Save the file in the uploads folder
    if ($this->profileImage->saveAs($filePath)) {
        $user->profile_image = $filePath;  // Store the relative file path in the database
    }
        }
        $user->password=$this->password;
     
        return $user->save() ? $user : null;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }


}