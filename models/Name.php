<?php

namespace app\models;

use yii\db\ActiveRecord;

class Name extends ActiveRecord
{
    public static function tableName()
    {
        return 'name';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}

