<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property int $ID
 * @property string $Kategori
 * @property string $base
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kategori', 'base'], 'required'],
            [['Kategori'], 'string', 'max' => 100],
            [['base'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Kategori' => 'Kategori',
            'base' => 'Base',
        ];
    }
    
    public function getKategoriVerify(){
        return $this->hasMany(Verify::className(),['kategori'=>'ID']);
    }
    
}
