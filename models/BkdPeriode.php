<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bkd_periode".
 *
 * @property int $tahun_id
 * @property string $nama_periode
 * @property string|null $tanggal_bkd_awal
 * @property string|null $tanggal_bkd_akhir
 * @property string|null $buka
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class BkdPeriode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bkd_periode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun_id', 'nama_periode'], 'required'],
            [['tahun_id'], 'integer'],
            [['tanggal_bkd_awal', 'tanggal_bkd_akhir', 'updated_at', 'created_at'], 'safe'],
            [['nama_periode'], 'string', 'max' => 255],
            [['buka'], 'string', 'max' => 1],
            [['tahun_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tahun_id' => 'Tahun ID',
            'nama_periode' => 'Nama Periode',
            'tanggal_bkd_awal' => 'Tanggal Bkd Awal',
            'tanggal_bkd_akhir' => 'Tanggal Bkd Akhir',
            'buka' => 'Buka',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
