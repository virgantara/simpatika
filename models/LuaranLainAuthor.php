<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "luaran_lain_author".
 *
 * @property int $id
 * @property string $NIY
 * @property int $luaran_lain_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $nIY
 * @property LuaranLain $luaranLain
 */
class LuaranLainAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'luaran_lain_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'luaran_lain_id'], 'required'],
            [['luaran_lain_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['NIY'], 'string', 'max' => 15],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
            [['luaran_lain_id'], 'exist', 'skipOnError' => true, 'targetClass' => LuaranLain::className(), 'targetAttribute' => ['luaran_lain_id' => 'id']],
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
            'luaran_lain_id' => 'Luaran Lain ID',
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
    public function getLuaranLain()
    {
        return $this->hasOne(LuaranLain::className(), ['id' => 'luaran_lain_id']);
    }
}
