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
class MakalahAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'makalah_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'makalah_id'], 'required'],
            [['makalah_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['makalah_id'], 'exist', 'skipOnError' => true, 'targetClass' => Makalah::className(), 'targetAttribute' => ['makalah_id' => 'ID']],
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
            'makalah_id' => 'Makalah ID',
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
    public function getMakalah()
    {
        return $this->hasOne(Makalah::className(), ['ID' => 'makalah_id']);
    }
}
