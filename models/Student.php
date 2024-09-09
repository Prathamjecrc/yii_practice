<?php

namespace app\models;

use Yii;
use app\models\Subject;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $name
 * @property int $class
 * @property string $house
 *
 * @property Subject[] $subjects
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'class', 'house'], 'required'],
            [['class'], 'integer'],
            [['name', 'house'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class' => 'Class',
            'house' => 'House',
        ];
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::class, ['student_id' => 'id']);
    }
}
