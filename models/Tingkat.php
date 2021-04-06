<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tingkat".
 *
 * @property string $id
 * @property string $nama
 *
 * @property PenunjangLain[] $penunjangLains
 */
class Tingkat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tingkat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'string', 'max' => 1],
            [['nama'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[PenunjangLains]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenunjangLains()
    {
        return $this->hasMany(PenunjangLain::className(), ['tingkat_id' => 'id']);
    }
}
