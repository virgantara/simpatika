<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "makalah_author".
 *
 * @property int $id
 * @property string $NIY
 * @property int $makalah_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $nIY
 * @property Makalah $makalah
 */
class KonferensiAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konferensi_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'konferensi_id'], 'required'],
            [['konferensi_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['konferensi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Konferensi::className(), 'targetAttribute' => ['konferensi_id' => 'ID']],
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
            'konferensi_id' => 'Konferensi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['NIY' => 'NIY']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKonferensi()
    {
        return $this->hasOne(Konferensi::className(), ['ID' => 'konferensi_id']);
    }
}
