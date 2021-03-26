<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_jabatan".
 *
 * @property int $id
 * @property string $nama
 * @property string|null $access_role
 *
 * @property Jabatan[] $jabatans
 * @property AuthItem $accessRole
 */
class MJabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_jabatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 255],
            [['access_role'], 'string', 'max' => 64],
            [['access_role'], 'exist', 'skipOnError' => true, 'targetClass' => \app\rbac\models\AuthItem::className(), 'targetAttribute' => ['access_role' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'access_role' => 'Access Role',
        ];
    }

    /**
     * Gets query for [[Jabatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJabatans()
    {
        return $this->hasMany(Jabatan::className(), ['jabatan_id' => 'id']);
    }

    /**
     * Gets query for [[AccessRole]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccessRole()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'access_role']);
    }
}
