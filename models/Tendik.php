<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tendik".
 *
 * @property int $ID
 * @property string $NIY
 * @property string $nama
 * @property string $gender
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $status_kawin
 * @property string $agama
 * @property int $pangkat
 * @property string $jenjang_kode
 * @property string $perguruan_tinggi
 * @property string $alamat_kampus
 * @property string $telp_kampus
 * @property string $fax_kampus
 * @property string $alamat_rumah
 * @property string $telp_hp
 * @property int $unit_id
 * @property int $jabatan_id
 *
 * @property MJenjangPendidikan $jenjangKode
 * @property MJabatanTendik $jabatan
 * @property UnitKerja $unit
 */
class Tendik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tendik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'unit_id', 'jabatan_id','jenjang_kode','gender','jenis_tendik_id'], 'required'],
            [['unit_id', 'jabatan_id'], 'integer'],
            [['gender', 'status_kawin', 'alamat_kampus', 'alamat_rumah'], 'string'],
            [['tanggal_lahir'], 'safe'],
            [['NIY', 'telp_kampus', 'fax_kampus', 'telp_hp'], 'string', 'max' => 15],
            [['nama', 'perguruan_tinggi'], 'string', 'max' => 50],
            [['tempat_lahir'], 'string', 'max' => 30],
            [['agama'], 'string', 'max' => 20],
            [['jenjang_kode'], 'string', 'max' => 5],
            [['NIY'], 'unique'],
            [['jenis_tendik_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisTendik::className(), 'targetAttribute' => ['jenis_tendik_id' => 'kode']],
            [['jenjang_kode'], 'exist', 'skipOnError' => true, 'targetClass' => MJenjangPendidikan::className(), 'targetAttribute' => ['jenjang_kode' => 'kode']],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatanTendik::className(), 'targetAttribute' => ['jabatan_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnitKerja::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NIY' => 'NIY',
            'nama' => 'Nama',
            'gender' => 'Gender',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'status_kawin' => 'Status Kawin',
            'agama' => 'Agama',
            'jenis_tendik_id'=>'Jenis Tendik',
            'jenjang_kode' => 'Jenjang Pendidikan',
            'perguruan_tinggi' => 'Perguruan Tinggi',
            'alamat_kampus' => 'Alamat Kampus',
            'telp_kampus' => 'Telp Kampus',
            'fax_kampus' => 'Fax Kampus',
            'alamat_rumah' => 'Alamat Rumah',
            'telp_hp' => 'Telp Hp',
            'unit_id' => 'Unit',
            'jabatan_id' => 'Jabatan',
            'namaJenjang' => 'Pendidikan',
            'namaJenis' => 'Pekerjaan'
        ];
    }

     public function beforeSave($insert){
        if (parent::beforeSave($insert)) {

            $this->tanggal_lahir = date('Y-m-d',strtotime($this->tanggal_lahir));

            return true;
        } else {
            return false;
        }

        
    }

    public function afterFind(){
        parent::afterFind();

        $this->tanggal_lahir = date('d-m-Y',strtotime($this->tanggal_lahir));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenjangKode()
    {
        return $this->hasOne(MJenjangPendidikan::className(), ['kode' => 'jenjang_kode']);
    }

    public function getJenisTendik()
    {
        return $this->hasOne(JenisTendik::className(), ['kode' => 'jenis_tendik_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(MJabatanTendik::className(), ['id' => 'jabatan_id']);
    }

    public function getNamaJenjang(){
        return $this->jenjangKode->nama;
    }

    public function getNamaJenis(){
        return $this->jenisTendik->nama;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(UnitKerja::className(), ['id' => 'unit_id']);
    }

    public static function countData($jenjang, $jenis){
        // $jf = JenisTendik::find()->where(['kode'=>$jenis])->one();
        $total = Tendik::find()->where([
            'jenjang_kode' => $jenjang,
            'jenis_tendik_id' => $jenis,
            
        ])->count();

        return $total;
    }
}
