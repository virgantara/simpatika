<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembicara_files".
 *
 * @property string $id_dokumen
 * @property string|null $nama_dokumen
 * @property string|null $nama_file
 * @property string|null $jenis_file
 * @property string|null $tanggal_upload
 * @property string|null $nama_jenis_dokumen
 * @property string|null $tautan
 * @property string|null $keterangan_dokumen
 * @property string|null $updated_at
 * @property string|null $created_at
 */
class SisterFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sister_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dokumen','parent_id'], 'required'],
            [['tanggal_upload', 'updated_at', 'created_at'], 'safe'],
            [['id_dokumen', 'jenis_file'], 'string', 'max' => 100],
            [['nama_dokumen', 'nama_file', 'nama_jenis_dokumen', 'tautan', 'keterangan_dokumen'], 'string', 'max' => 255],
            [['id_dokumen'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dokumen' => 'Id Dokumen',
            'nama_dokumen' => 'Nama Dokumen',
            'nama_file' => 'Nama File',
            'jenis_file' => 'Jenis File',
            'tanggal_upload' => 'Tanggal Upload',
            'nama_jenis_dokumen' => 'Nama Jenis Dokumen',
            'tautan' => 'Tautan',
            'keterangan_dokumen' => 'Keterangan Dokumen',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
