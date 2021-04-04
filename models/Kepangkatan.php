<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kepangkatan".
 *
 * @property int $id
 * @property string|null $NIY
 * @property string|null $sister_id
 * @property string $kode_golongan
 * @property string $nama_golongan
 * @property string $no_sk_pangkat
 * @property string|null $terhitung_mulai_tanggal_sk_pangkat
 * @property string|null $tanggal_sk_pengangkatan
 * @property int|null $masa_kerja_golongan_tahun
 * @property int|null $masa_kerja_golongan_bulan
 * @property int|null $id_pangkat_golongan
 */
class Kepangkatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kepangkatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_golongan', 'nama_golongan', 'no_sk_pangkat'], 'required'],
            [['terhitung_mulai_tanggal_sk_pangkat', 'tanggal_sk_pengangkatan'], 'safe'],
            [['masa_kerja_golongan_tahun', 'masa_kerja_golongan_bulan', 'id_pangkat_golongan'], 'integer'],
            [['NIY'], 'string', 'max' => 15],
            [['sister_id', 'kode_golongan', 'nama_golongan', 'no_sk_pangkat'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'NIY' => 'Niy',
            'sister_id' => 'Sister ID',
            'kode_golongan' => 'Kode Golongan',
            'nama_golongan' => 'Nama Golongan',
            'no_sk_pangkat' => 'No Sk Pangkat',
            'terhitung_mulai_tanggal_sk_pangkat' => 'Terhitung Mulai Tanggal Sk Pangkat',
            'tanggal_sk_pengangkatan' => 'Tanggal Sk Pengangkatan',
            'masa_kerja_golongan_tahun' => 'Masa Kerja Golongan Tahun',
            'masa_kerja_golongan_bulan' => 'Masa Kerja Golongan Bulan',
            'id_pangkat_golongan' => 'Id Pangkat Golongan',
        ];
    }
}
