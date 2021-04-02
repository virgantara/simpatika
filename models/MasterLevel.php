<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_level".
 *
 * @property int $level
 * @property float $exp
 */
class MasterLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level', 'exp'], 'required'],
            [['level'], 'integer'],
            [['exp'], 'number'],
            [['level'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'level' => 'Level',
            'exp' => 'Exp',
        ];
    }

    public static function getLevel($exp)
    {
        $query = MasterLevel::find();
        $query->where(['>=','exp',$exp]);
        $query->orderBy(['exp'=>SORT_ASC]);
        $query->limit(1);
        $model = $query->one();
        return !empty($model) ? $model->level : 0;
    }
}
