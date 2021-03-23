<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jenis_publikasi".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 *
 * @property Buku[] $bukus
 */
class JenisPublikasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_publikasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBukus()
    {
        return $this->hasMany(Buku::className(), ['jenis_publikasi_id' => 'id']);
    }

    public static function getListJenisPublikasi()
    {    
        $query=JenisPublikasi::find();
        
        $list=$query->all();
        $listData=\yii\helpers\ArrayHelper::map($list,'id','nama');
        return $listData;
    }

    
}
