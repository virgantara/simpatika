<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lppm_penelitian".
 *
 * @property int $id
 * @property int $lppm_skema_penelitian_id
 * @property string $judul
 * @property string $NIY
 * @property string $created
 * @property string $file_proposal
 * @property string $berita_acara
 *
 * @property LppmSkemaPenelitian $lppmSkemaPenelitian
 * @property User $nIY
 */
class LppmPenelitian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lppm_penelitian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lppm_skema_penelitian_id', 'judul', 'NIY'], 'required'],
            [['lppm_skema_penelitian_id'], 'integer'],
            [['created'], 'safe'],
            [['judul'], 'string', 'max' => 255],
            [['NIY'], 'string', 'max' => 15],
            [['file_proposal', 'berita_acara'], 'string', 'max' => 500],
            [['lppm_skema_penelitian_id'], 'exist', 'skipOnError' => true, 'targetClass' => LppmSkemaPenelitian::className(), 'targetAttribute' => ['lppm_skema_penelitian_id' => 'id']],
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
            'lppm_skema_penelitian_id' => 'Skema Penelitian',
            'judul' => 'Judul',
            'NIY' => 'Niy',
            'created' => 'Created',
            'file_proposal' => 'File Proposal',
            'berita_acara' => 'Berita Acara',
            'namaSkema' => 'Skema'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLppmSkemaPenelitian()
    {
        return $this->hasOne(LppmSkemaPenelitian::className(), ['id' => 'lppm_skema_penelitian_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNIY()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }

    public function getNamaSkema(){
        return $this->lppmSkemaPenelitian->nama;
    }
}
