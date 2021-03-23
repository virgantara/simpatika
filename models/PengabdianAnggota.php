<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengabdian_anggota".
 *
 * @property int $id
 * @property string $NIY
 * @property string $status_anggota
 * @property int $pengabdian_id
 * @property string $created
 * @property double $beban_kerja
 *
 * @property Pengabdian $pengabdian
 */
class PengabdianAnggota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengabdian_anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'status_anggota', 'pengabdian_id'], 'required'],
            [['pengabdian_id'], 'integer'],
            [['created'], 'safe'],
            [['beban_kerja'], 'number'],
            [['NIY'], 'string', 'max' => 15],
            [['status_anggota'], 'string', 'max' => 100],
            [['pengabdian_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pengabdian::className(), 'targetAttribute' => ['pengabdian_id' => 'ID']],
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
            'NIY' => 'Niy',
            'status_anggota' => 'Status Anggota',
            'pengabdian_id' => 'Pengabdian ID',
            'created' => 'Created',
            'beban_kerja' => 'Beban Kerja(Jam/Minggu)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengabdian()
    {
        return $this->hasOne(Pengabdian::className(), ['ID' => 'pengabdian_id']);
    }

     public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }
}
