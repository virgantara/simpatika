<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_pangkat".
 *
 * @property int $id
 * @property int $jabatan_id
 * @property string $nama
 * @property string $golongan
 * @property double $kredit
 *
 * @property MJabatanAkademik $jabatan
 */
class MPangkat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_pangkat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jabatan_id', 'nama', 'golongan'], 'required'],
            [['jabatan_id'], 'integer'],
            [['kredit'], 'number'],
            [['nama'], 'string', 'max' => 100],
            [['golongan'], 'string', 'max' => 10],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatanAkademik::className(), 'targetAttribute' => ['jabatan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jabatan_id' => 'Jabatan ID',
            'nama' => 'Nama',
            'golongan' => 'Golongan',
            'kredit' => 'Kredit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(MJabatanAkademik::className(), ['id' => 'jabatan_id']);
    }
}
