<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "luaran_lain".
 *
 * @property int $id
 * @property int $jenis_luaran_id
 * @property string $judul
 * @property string $deskripsi
 * @property int $tahun_pelaksanaan
 * @property string $berkas
 * @property string $shared_link
 * @property string $sumber_dana
 * @property string $created_at
 * @property string $updated_at
 * @property string $ver
 *
 * @property JenisLuaran $jenisLuaran
 * @property LuaranLainAuthor[] $luaranLainAuthors
 */
class LuaranLain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'luaran_lain';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_luaran_id', 'judul', 'deskripsi', 'tahun_pelaksanaan'], 'required'],
            [['jenis_luaran_id', 'tahun_pelaksanaan'], 'integer'],
            [['judul', 'berkas'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['deskripsi', 'shared_link', 'sumber_dana', 'ver'], 'string', 'max' => 255],
            [['jenis_luaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => JenisLuaran::className(), 'targetAttribute' => ['jenis_luaran_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_luaran_id' => 'Jenis Luaran ID',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'tahun_pelaksanaan' => 'Tahun Pelaksanaan',
            'berkas' => 'Berkas',
            'shared_link' => 'Shared Link',
            'sumber_dana' => 'Sumber Dana',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ver' => 'Ver',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisLuaran()
    {
        return $this->hasOne(JenisLuaran::className(), ['id' => 'jenis_luaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLuaranLainAuthors()
    {
        return $this->hasMany(LuaranLainAuthor::className(), ['luaran_lain_id' => 'id']);
    }
}
