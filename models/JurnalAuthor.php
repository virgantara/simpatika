<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jurnal_author".
 *
 * @property int $id
 * @property string $NIY
 * @property int $jurnal_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $nIY
 * @property Jurnal $jurnal
 */
class JurnalAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jurnal_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'jurnal_id'], 'required'],
            [['jurnal_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['jurnal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jurnal::className(), 'targetAttribute' => ['jurnal_id' => 'id']],
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
            'jurnal_id' => 'Jurnal ID',
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
    public function getJurnal()
    {
        return $this->hasOne(Jurnal::className(), ['id' => 'jurnal_id']);
    }
}
