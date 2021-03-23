<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penelitian_anggota".
 *
 * @property int $id
 * @property string $NIY
 * @property string $status_anggota
 * @property double $beban_kerja
 * @property int $penelitian_id
 * @property string $created
 *
 * @property Penelitian $penelitian
 */
class PenelitianAnggota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penelitian_anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'status_anggota', 'penelitian_id'], 'required'],
            [['beban_kerja'], 'number'],
            [['penelitian_id'], 'integer'],
            [['created'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['status_anggota'], 'string', 'max' => 100],
            [['penelitian_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penelitian::className(), 'targetAttribute' => ['penelitian_id' => 'ID']],
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
            'NIY' => 'NIY',
            'status_anggota' => 'Status Anggota',
            'beban_kerja' => 'Beban Kerja (Jam/Minggu)',
            'penelitian_id' => 'Penelitian ID',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenelitian()
    {
        return $this->hasOne(Penelitian::className(), ['ID' => 'penelitian_id']);
    }

    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }
}
