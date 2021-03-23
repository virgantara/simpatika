<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hki_author".
 *
 * @property int $id
 * @property string $NIY
 * @property int $hki_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $nIY
 * @property Hki $hki
 */
class HkiAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hki_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'hki_id'], 'required'],
            [['hki_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['hki_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hki::className(), 'targetAttribute' => ['hki_id' => 'id']],
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
            'hki_id' => 'Hki ID',
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
    public function getHki()
    {
        return $this->hasOne(Hki::className(), ['id' => 'hki_id']);
    }
}
