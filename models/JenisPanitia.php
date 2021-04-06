<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_panitia".
 *
 * @property int $id
 * @property string $nama
 *
 * @property PenunjangLain[] $penunjangLains
 */
class JenisPanitia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_panitia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'integer'],
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
        return $this->hasMany(PenunjangLain::className(), ['jenis_panitia_id' => 'id']);
    }
}
