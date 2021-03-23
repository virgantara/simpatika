<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "makalah".
 *
 * @property int $ID
 * @property string $NIY
 * @property int $tahun
 * @property string $judul
 * @property string $penyelenggara
 * @property string $nama_forum
 * @property string $tingkat_forum
 * @property string $waktu_pelaksanaan_mulai
 * @property string $waktu_pelaksanaan_selesai
 * @property string $ISBN
 * @property string $kontribusi
 * @property string $sumber_dana
 * @property string $shared_link
 * @property string $created_at
 * @property string $updated_at
 * @property string $f_makalah
 * @property string $ver
 *
 * @property User $nIY
 * @property MakalahAuthor[] $makalahAuthors
 */
class Makalah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'makalah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NIY', 'tahun', 'judul', 'penyelenggara'], 'required'],
            [['tahun'], 'integer'],
            [['waktu_pelaksanaan_mulai', 'waktu_pelaksanaan_selesai', 'created_at', 'updated_at'], 'safe'],
            [['ver'], 'string'],
            [['NIY'], 'string', 'max' => 15],
            [['judul', 'penyelenggara'], 'string', 'max' => 100],
            [['nama_forum', 'tingkat_forum', 'ISBN', 'kontribusi', 'sumber_dana', 'shared_link'], 'string', 'max' => 255],
            [['f_makalah'], 'string', 'max' => 200],
            [['NIY'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['NIY' => 'NIY']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NIY' => 'Niy',
            'tahun' => 'Tahun',
            'judul' => 'Judul',
            'penyelenggara' => 'Penyelenggara',
            'nama_forum' => 'Nama Forum',
            'tingkat_forum' => 'Tingkat Forum',
            'waktu_pelaksanaan_mulai' => 'Waktu Pelaksanaan Mulai',
            'waktu_pelaksanaan_selesai' => 'Waktu Pelaksanaan Selesai',
            'ISBN' => 'Isbn',
            'kontribusi' => 'Kontribusi',
            'sumber_dana' => 'Sumber Dana',
            'shared_link' => 'Shared Link',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'f_makalah' => 'F Makalah',
            'ver' => 'Ver',
        ];
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
    public function getMakalahAuthors()
    {
        return $this->hasMany(MakalahAuthor::className(), ['makalah_id' => 'ID']);
    }
}
