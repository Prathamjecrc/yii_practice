<?php
namespace app\models;

use app\models\Name;
use app\models\Country;
use yii\db\ActiveRecord;

class State extends ActiveRecord
{
    public static function tableName()
    {
        return 'state';
    }

    public function rules()
    {
        return [
            [['name_id', 'country_id', 'state'], 'required'],
            [['name_id', 'country_id'], 'integer'],
            [['state'], 'string', 'max' => 255],
            [['name_id'], 'exist', 'targetClass' => Name::class, 'targetAttribute' => 'id'],
            [['country_id'], 'exist', 'targetClass' => Country::class, 'targetAttribute' => 'id'],
         
        ];
    }

    public function getCountry()                                                                            
    {
        return $this->hasOne( Country::class, ['id' => 'country_id']);
    }

    public function getName()
    {
        return $this->hasOne(Name::class, ['id' => 'name_id']);
    }

   
}
