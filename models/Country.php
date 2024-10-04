<?php

namespace app\models;

use app\models\Name;
use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    public static function tableName()
    {
        return 'country';
    }

    public function rules()
    {
        return [
            [['name_id', 'country'], 'required'],
            [['name_id'], 'integer'],
            [['country'], 'string', 'max' => 255],
            [['name_id'], 'exist', 'targetClass' => Name::class, 'targetAttribute' => 'id'],
        ];
    }

    public function getName()
    {
        return $this->hasOne(Name::class, ['id' => 'name_id']);
    }
}
