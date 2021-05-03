<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "catatan_harian".
 *
 * @property int $id
 * @property int $unsur_id
 * @property int $user_id
 * @property string $deskripsi
 * @property string|null $tanggal
 * @property string|null $is_selesai
 * @property int $approved_by
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property User $user
 * @property UnsurKegiatan $unsur
 */
class CatatanHarian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catatan_harian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unsur_id', 'user_id', 'deskripsi'], 'required'],
            [['unsur_id', 'user_id', 'approved_by'], 'integer'],
            [['deskripsi'], 'string'],
            [['tanggal', 'updated_at', 'created_at','poin','kondisi'], 'safe'],
            [['is_selesai'], 'string', 'max' => 1],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'ID']],
            [['unsur_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnsurKegiatan::className(), 'targetAttribute' => ['unsur_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unsur_id' => 'Unsur Kegiatan',
            'user_id' => 'User ID',
            'deskripsi' => 'Deskripsi',
            'tanggal' => 'Tanggal',
            'poin' => 'Poin',
            'is_selesai' => 'Is Selesai',
            'approved_by' => 'Approved By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['ID' => 'user_id']);
    }

    /**
     * Gets query for [[Unsur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnsur()
    {
        return $this->hasOne(UnsurKegiatan::className(), ['id' => 'unsur_id']);
    }

    public static function sumPoinCatatanHarian($user_id)
    {
        $query = CatatanHarian::find()->where(['user_id'=>$user_id]);
        // $query->andFilterWhere(['between','tanggal',$sd, $ed]);
        return $query->sum('poin');
    }
}
