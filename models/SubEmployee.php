<?php

namespace app\models;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "sub_employee".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $username
 * @property string $email
 * @property int $role
 * @property string $password
 *
 * @property User $employee
 */
class SubEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // Username rules
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username', 
                'unique', 
                'targetClass' => '\app\models\SubEmployee', 
                'filter' => ['employee_id' => $this->employee_id], // Unique per employee_id
                'message' => 'This SubEmployee Username has already been taken for this employee.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],
    
            // Email rules
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email', 
                'unique', 
                'targetClass' => '\app\models\SubEmployee', 
                'filter' => ['employee_id' => $this->employee_id], // Unique per employee_id
                'message' => 'This SubEmployee email address has already been taken for this employee.'
            ],
    
            // Password rules
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'username' => 'Username',
            'email' => 'Email',
            'role' => 'Role',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(User::class, ['id' => 'employee_id']);
    }


    public function search($params, $id = null)
    {
        $query = SubEmployee::find()->joinWith('employee');

        if ($id) {
            // Filter the query based on the passed id (matching user.id with subemployee.employee_id)
            $query->andWhere(['user_login.id' => $id]);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'role', $this->email])
            ->andFilterWhere(['like', 'password', $this->password]);
        return $dataProvider;
    }
}
