<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lppm_penelitian_anggota".
 *
 * @property int $id
 * @property string $NIY
 * @property int $anggota_id
 * @property double $beban_kerja
 * @property int $lppm_penelitian_id
 * @property string $created
 *
 * @property LppmPenelitian $lppmPenelitian
 * @property User $nIY
 * @property LppmAnggota $anggota
 */
class LppmPenelitianAnggota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lppm_penelitian_anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'anggota_id', 'lppm_penelitian_id'], 'required'],
            [['anggota_id', 'lppm_penelitian_id'], 'integer'],
            [['beban_kerja'], 'number'],
            [['created'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['lppm_penelitian_id'], 'exist', 'skipOnError' => true, 'targetClass' => LppmPenelitian::className(), 'targetAttribute' => ['lppm_penelitian_id' => 'id']],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['anggota_id'], 'exist', 'skipOnError' => true, 'targetClass' => LppmAnggota::className(), 'targetAttribute' => ['anggota_id' => 'id']],
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
            'anggota_id' => 'Anggota ID',
            'beban_kerja' => 'Beban Kerja',
            'lppm_penelitian_id' => 'Lppm Penelitian ID',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLppmPenelitian()
    {
        return $this->hasOne(LppmPenelitian::className(), ['id' => 'lppm_penelitian_id']);
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
    public function getAnggota()
    {
        return $this->hasOne(LppmAnggota::className(), ['id' => 'anggota_id']);
    }
}
