<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buku".
 *
 * @property integer $ID
 * @property string $NIY
 * @property integer $tahun
 * @property string $judul
 * @property string $penerbit
 * @property string $f_karya
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun', 'judul', 'penerbit', 'jenis_publikasi_id'], 'required'],
            [['tahun'], 'integer'],
            [['NIY'], 'string', 'max' => 15],
            [['judul','namanya'], 'string', 'max' => 500],
            [['penerbit','ISBN','ver','vol'], 'string', 'max' => 50],
            [['f_karya','link'], 'string', 'max' => 200],
            [['f_karya'], 'file', 'extensions' => 'pdf,jpg,jpeg,png','maxSize' => 1024 * 1024 * 1 ],
            [['jenis_publikasi_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisPublikasi::className(), 'targetAttribute' => ['jenis_publikasi_id' => 'id']],
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
            'tahun' => 'Tahun',
            'judul' => 'Judul',
            'namanya' => 'Nama',
            'penerbit' => 'Penerbit',
            'f_karya' => 'File Karya',
            'ISBN' => 'Nomor ISBN',
            'vol' => 'Volume & Number',
            'link' => 'Shared Link Google Drive',
            'ver' => 'Status Verifikasi',
            'jenis_publikasi_id' => 'Jenis Publikasi'
        ];
    }
    public function getBukuDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }
     public function getBukuData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }

    public function getJenisPublikasi()
    {
        return $this->hasOne(JenisPublikasi::className(), ['id' => 'jenis_publikasi_id']);
    }

    public function getNamaJenisPublikasi(){
        return $this->jenisPublikasi->nama;
    }

    public function getBukuAuthors()
    {
        return $this->hasMany(BukuAuthor::className(), ['buku_id' => 'ID']);
    }


}
