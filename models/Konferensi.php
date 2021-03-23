<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "konferensi".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun
 * @property string $judul
 * @property string $penyelenggara
 * @property string $status_kehadiran
 * @property string $f_konferensi
 */
class Konferensi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $namanya;
    public static function tableName()
    {
        return 'konferensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun', 'judul', 'penyelenggara', 'status_kehadiran','tingkat_forum','sumber_dana','lokasi','tanggal_mulai','tanggal_selesai','lokasi','nama_forum'], 'required'],
            [['nama_forum','ISBN','link'], 'safe'],
            [['tahun'], 'integer'],
            [['NIY', 'status_kehadiran'], 'string', 'max' => 15],
            [['judul','namanya'], 'string', 'max' => 100],
            [['penyelenggara','ver'], 'string', 'max' => 50],
            [['f_konferensi','link'], 'string', 'max' => 250],
            [['f_konferensi'], 'file', 'extensions' => 'pdf, jpg, jpeg, png','maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'Niy',
            'namanya' => 'Nama',
            'tahun' => 'Tahun',
            'judul' => 'Judul',
            'penyelenggara' => 'Penyelenggara',
            'status_kehadiran' => 'Status Kehadiran',
            'f_konferensi' => 'Sertifikat Konferensi dkk',
            'ver' => 'Status Verifikasi',
            'link' => 'Link Konferensi',
        ];
    }
    public function getKonferensiDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }

    public function getKonferensiData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }

    public function getKonferensiAuthors()
    {
        return $this->hasMany(KonferensiAuthor::className(), ['konferensi_id' => 'ID']);
    }
}
