<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publikasi".
 *
 * @property int $id
 * @property int|null $kegiatan_id
 * @property string|null $judul_publikasi_paten
 * @property string|null $nama_jenis_publikasi
 * @property string|null $tanggal_terbit
 * @property string|null $sister_id
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class Publikasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publikasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kegiatan_id'], 'integer'],
            [['tanggal_terbit', 'updated_at', 'created_at','tautan','volume','nomor','halaman','penerbit','doi','issn','tautan_laman_jurnal','is_claimed'], 'safe'],
            [['judul_publikasi_paten', 'nama_jenis_publikasi'], 'string', 'max' => 255],
            [['sister_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kegiatan_id' => 'Kegiatan ID',
            'judul_publikasi_paten' => 'Judul Publikasi Paten',
            'nama_jenis_publikasi' => 'Nama Jenis Publikasi',
            'tanggal_terbit' => 'Tanggal Terbit',
            'sister_id' => 'Sister ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
