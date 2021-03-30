<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publikasi_author".
 *
 * @property int $id
 * @property string|null $author_id
 * @property string|null $author_nama
 * @property int|null $urutan
 * @property string|null $afiliasi
 * @property string|null $peran_id
 * @property string|null $peran_nama
 * @property string|null $corresponding_author
 * @property string|null $publikasi_id
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class PublikasiAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publikasi_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['urutan'], 'integer'],
            [['updated_at', 'created_at','jenis_peranan'], 'safe'],
            [['author_id', 'publikasi_id'], 'string', 'max' => 100],
            [['author_nama', 'afiliasi'], 'string', 'max' => 255],
            [['peran_id'], 'string', 'max' => 5],
            [['peran_nama'], 'string', 'max' => 50],
            [['corresponding_author'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'author_nama' => 'Author Nama',
            'urutan' => 'Urutan',
            'afiliasi' => 'Afiliasi',
            'peran_id' => 'Peran ID',
            'peran_nama' => 'Peran Nama',
            'corresponding_author' => 'Corresponding Author',
            'publikasi_id' => 'Publikasi ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
