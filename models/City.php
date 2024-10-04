<?php
namespace app\models;

use app\models\Name;
use app\models\State;
use app\models\Country;
use yii\db\ActiveRecord;

class City extends ActiveRecord
{
    public static function tableName()
    {
        return 'city';
    }

    public function rules()
    {
        return [
            [['name_id', 'country_id','state_id', 'city'], 'required'],
            [['name_id', 'country_id','state_id'], 'integer'],
            [['city'], 'string', 'max' => 255],
            [['name_id'], 'exist', 'targetClass' => Name::class, 'targetAttribute' => 'id'],
            [['country_id'], 'exist', 'targetClass' => Country::class, 'targetAttribute' => 'id'],
            [['state_id'], 'exist', 'targetClass' => State::class, 'targetAttribute' => 'id'],
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

    public function getState()
    {
        return $this->hasOne(State::class, ['id' => 'state_id']);
    }
}
