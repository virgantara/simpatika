<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inpassing".
 *
 * @property int $id
 * @property string|null $sister_id
 * @property string $nama_golongan
 * @property string $nomor_sk_inpassing
 * @property string|null $tanggal_sk
 * @property string|null $sk_inpassing_terhitung_mulai_tanggal
 * @property string|null $NIY
 */
class Inpassing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inpassing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_golongan', 'nomor_sk_inpassing'], 'required'],
            [['tanggal_sk', 'sk_inpassing_terhitung_mulai_tanggal'], 'safe'],
            [['sister_id', 'nama_golongan', 'nomor_sk_inpassing'], 'string', 'max' => 100],
            [['NIY'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sister_id' => 'Sister ID',
            'nama_golongan' => 'Nama Golongan',
            'nomor_sk_inpassing' => 'Nomor Sk Inpassing',
            'tanggal_sk' => 'Tanggal Sk',
            'sk_inpassing_terhitung_mulai_tanggal' => 'Sk Inpassing Terhitung Mulai Tanggal',
            'NIY' => 'Niy',
        ];
    }
}
