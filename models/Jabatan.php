<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jabatan".
 *
 * @property integer $ID
 * @property string $NIY
 * @property string $jabatan
 * @property string $institusi
 * @property integer $tahun_awal
 * @property string $tahun_akhir
 * @property string $f_penugasan
 * @property string $update_at
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $namanya;
    
    public static function tableName()
    {
        return 'jabatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIY', 'jabatan_id', 'unker_id'], 'required'],
            [['NIY', 'jabatan_id', 'unker_id'], 'unique','on'=>'insert'],
            [['jabatan_id', 'unker_id'], 'integer'],
            [['tanggal_awal', 'tanggal_akhir', 'update_at','no_sk'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['f_penugasan'], 'string', 'max' => 255],
            [['f_penugasan'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf','maxSize' => 1024 * 1024],
            [['ver'], 'string', 'max' => 100],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatan::className(), 'targetAttribute' => ['jabatan_id' => 'id']],
            [['unker_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnitKerja::className(), 'targetAttribute' => ['unker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'NIY',
            'namanya' => 'Nama',
            'jabatan_id' => 'Jabatan',
            'no_sk' => 'Nomor SK',
            'unker_id' => 'Unit Kerja',
            'tanggal_awal' => 'Tanggal Awal Jabatan',
            'tanggal_akhir' => 'Tanggal Akhir Jabatan',
            'f_penugasan' => 'Bukti SK Penugasan',
            'update_at' => 'Update At',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(MJabatan::className(), ['id' => 'jabatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnker()
    {
        return $this->hasOne(UnitKerja::className(), ['id' => 'unker_id']);
    }

    public function getJabatanDosen(){
        return $this->hasOne(Dosen::className(),['NIY'=>'NIY']);
    }

    public function getJabatanData(){
        return $this->hasOne(DataDiri::className(),['NIY'=>'NIY']);
    }
}
