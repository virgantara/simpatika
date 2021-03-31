<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tugas_dosen_bkd".
 *
 * @property int $id
 * @property string $tugas_dosen_id
 * @property int $unsur_id
 * @property float|null $nilai_minimal
 *
 * @property TugasDosen $tugasDosen
 * @property UnsurUtama $unsur
 */
class TugasDosenBkd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tugas_dosen_bkd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tugas_dosen_id', 'unsur_id'], 'required'],
            [['unsur_id'], 'integer'],
            [['nilai_minimal'], 'number'],
            [['tugas_dosen_id'], 'string', 'max' => 10],
            [['tugas_dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => TugasDosen::className(), 'targetAttribute' => ['tugas_dosen_id' => 'id']],
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
            'tugas_dosen_id' => 'Tugas Dosen ID',
            'unsur_id' => 'Unsur ID',
            'nilai_minimal' => 'Nilai Minimal',
        ];
    }

    /**
     * Gets query for [[TugasDosen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTugasDosen()
    {
        return $this->hasOne(TugasDosen::className(), ['id' => 'tugas_dosen_id']);
    }

    /**
     * Gets query for [[Unsur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnsur()
    {
        return $this->hasOne(UnsurUtama::className(), ['id' => 'unsur_id']);
    }
}
