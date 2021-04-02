<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_level_class".
 *
 * @property int $id
 * @property int $level_min
 * @property int $level_max
 * @property string $class
 * @property int $stars
 */
class GameLevelClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_level_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level_min', 'level_max', 'class', 'stars'], 'required'],
            [['level_min', 'level_max', 'stars'], 'integer'],
            [['class'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level_min' => 'Level Min',
            'level_max' => 'Level Max',
            'class' => 'Class',
            'stars' => 'Stars',
        ];
    }

    public static function getCurrentClass($level)
    {
        $query = GameLevelClass::find();
        $query->where($level.' <= level_max AND '.$level.' >= level_min');
        $model = $query->one();
        $results = [
            'class' => !empty($model) ? $model->class : '',
            'stars' => !empty($model) ? $model->stars : 0,
        ];
        return $results;
    }
}
