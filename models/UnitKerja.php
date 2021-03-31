<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit_kerja".
 *
 * @property int $id
 * @property string $nama
 * @property int|null $pejabat_id
 *
 * @property Jabatan[] $jabatans
 * @property Tendik[] $tendiks
 * @property User $pejabat
 */
class UnitKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_kerja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['pejabat_id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['pejabat_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['pejabat_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'pejabat_id' => 'Pejabat ID',
        ];
    }

    public static function getList()
    {

       $list=UnitKerja::find()->all();
       $listData=\yii\helpers\ArrayHelper::map($list,'id','nama');
       return $listData;
    } 

    /**
     * Gets query for [[Jabatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJabatans()
    {
        return $this->hasMany(Jabatan::className(), ['unker_id' => 'id']);
    }

    /**
     * Gets query for [[Tendiks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTendiks()
    {
        return $this->hasMany(Tendik::className(), ['unit_id' => 'id']);
    }

    /**
     * Gets query for [[Pejabat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPejabat()
    {
        return $this->hasOne(User::className(), ['ID' => 'pejabat_id']);
    }
}