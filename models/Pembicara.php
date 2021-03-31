<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembicara".
 *
 * @property int $id
 * @property string|null $id_pembicara
 * @property int|null $id_kategori_pembicara
 * @property string|null $nama_kategori_kegiatan
 * @property string|null $judul_makalah
 * @property string|null $nama_pertemuan_ilmiah
 * @property string|null $penyelenggara_kegiatan
 * @property string|null $tanggal_pelaksanaan
 * @property string|null $sister_id
 * @property string|null $no_sk_tugas
 * @property string|null $updated_at
 * @property string|null $created_at
 * @property string|null $NIY
 *
 * @property User $nIY
 */
class Pembicara extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembicara';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kategori_pembicara'], 'integer'],
            [['tanggal_pelaksanaan', 'updated_at', 'created_at'], 'safe'],
            [['id_pembicara', 'sister_id', 'no_sk_tugas'], 'string', 'max' => 100],
            [['nama_kategori_kegiatan', 'judul_makalah', 'nama_pertemuan_ilmiah', 'penyelenggara_kegiatan'], 'string', 'max' => 255],
            [['NIY'], 'string', 'max' => 15],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pembicara' => 'Id Pembicara',
            'id_kategori_pembicara' => 'Id Kategori Pembicara',
            'nama_kategori_kegiatan' => 'Nama Kategori Kegiatan',
            'judul_makalah' => 'Judul Makalah',
            'nama_pertemuan_ilmiah' => 'Nama Pertemuan Ilmiah',
            'penyelenggara_kegiatan' => 'Penyelenggara Kegiatan',
            'tanggal_pelaksanaan' => 'Tanggal Pelaksanaan',
            'sister_id' => 'Sister ID',
            'no_sk_tugas' => 'No Sk Tugas',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'NIY' => 'Niy',
        ];
    }

    /**
     * Gets query for [[NIY]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }
}
