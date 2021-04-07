<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bkd_dosen".
 *
 * @property int $tahun_id
 * @property int $dosen_id
 * @property int $komponen_id
 * @property float|null $sks
 * @property string $kondisi
 * @property string|null $deskripsi
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class BkdDosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bkd_dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun_id', 'dosen_id', 'komponen_id', 'kondisi'], 'required'],
            [['tahun_id', 'dosen_id', 'komponen_id'], 'integer'],
            [['sks'], 'number'],
            [['updated_at', 'created_at'], 'safe'],
            [['kondisi'], 'string', 'max' => 100],
            [['tahun_id', 'dosen_id', 'komponen_id', 'kondisi'], 'unique', 'targetAttribute' => ['tahun_id', 'dosen_id', 'komponen_id', 'kondisi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tahun_id' => 'Tahun ID',
            'dosen_id' => 'Dosen ID',
            'komponen_id' => 'Komponen ID',
            'sks' => 'Sks',
            'kondisi' => 'Kondisi',
            'deskripsi' => 'Deskripsi',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
