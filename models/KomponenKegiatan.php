<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "komponen_kegiatan".
 *
 * @property int $id
 * @property int $unsur_id
 * @property string $nama
 * @property double $angka_kredit
 *
 * @property UnsurUtama $unsur
 */
class KomponenKegiatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'komponen_kegiatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unsur_id', 'nama', 'angka_kredit'], 'required'],
            [['unsur_id'], 'integer'],
            [['nama','subunsur','unsur_id'],'unique','message'=>'Data {attribute} sudah dipakai','on'=>'insert'],
            [['angka_kredit'], 'number'],
            [['subunsur','kondisi'],'safe'],
            [['unsur_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnsurUtama::className(), 'targetAttribute' => ['unsur_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unsur_id' => 'Unsur',
            'nama' => 'Komponen',
            'subunsur' => 'Sub Komponen',
            'angka_kredit' => 'Angka Kredit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnsur()
    {
        return $this->hasOne(UnsurUtama::className(), ['id' => 'unsur_id']);
    }
}
