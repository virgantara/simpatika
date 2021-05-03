<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use Yii;
use app\models\User;
use app\models\Tendik;
use app\models\JenisTendik;
use app\models\MJenjangPendidikan;
use app\models\TendikSearch;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\web\NotFoundHttpException;


/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ExpController extends Controller
{
    public function actionUpdateExp($role)
    {
        $list = User::find()->where(['access_role' => $role])->all();
        
        $transaction = Yii::$app->db->beginTransaction();
            // exit;
        $errors = '';
        try 
        {
            $counter = 0;
            foreach($list as $user)
            {
                
                $pengajaran = \app\models\Pengajaran::find()->where([
                    'NIY' => $user->NIY,
                    // 'is_claimed' => 1,
                    // 'tahun_akademik' => $tahun_akademik['tahun_id']
                ])->all();

                // print_r($tahun_akademik);exit;

                $query = \app\models\Publikasi::find()->where([
                    'NIY' => $user->NIY,
                    'is_claimed' => 1,
                ]);

                $query->andWhere(['not',['kegiatan_id' => null]]);

                $sd = null;//$tahun_akademik['kuliah_mulai'];
                $ed = null;//$tahun_akademik['nilai_selesai'];

                $totalCatatanHarian = \app\models\CatatanHarian::sumPoinCatatanHarian($user->ID);

                $query->andFilterWhere(['between','tanggal_terbit',$sd, $ed]);
                $query->orderBy(['tanggal_terbit'=>SORT_ASC]);

                $publikasi = $query->all();

                $query = \app\models\Pengabdian::find()->where([
                    'NIY' => $user->NIY,
                    'is_claimed' => 1,
                ]);

                // $sd = $tahun_akademik['kuliah_mulai'];
                // $ed = $tahun_akademik['nilai_selesai'];

                // $query->andFilterWhere(['between','tahun_kegiatan',$sd, $ed]);
                $query->orderBy(['tahun_kegiatan'=>SORT_ASC]);

                $pengabdian = $query->all();

                $query = \app\models\Organisasi::find()->where([
                    'NIY' => $user->NIY,
                    'is_claimed' => 1,
                ]);

                $organisasi = $query->all();

                $query = \app\models\PengelolaJurnal::find()->where([
                    'NIY' => $user->NIY,
                    'is_claimed' => 1,
                ]);

                $pengelolaJurnal = $query->all();
                $total_abdi = 0;
                $total_penunjang = 0;
                $total_ajar = 0;
                $total_pub = 0;
                $total_ajar = 0; 
                foreach ($pengajaran as $key => $value) 
                {
                    $total_ajar += $value->sks_bkd;
                }

                foreach ($publikasi as $key => $value) 
                {
                    $total_pub += $value->sks_bkd;
                }

                foreach ($pengabdian as $key => $value) 
                {
                    $total_abdi += $value->nilai;
                }

                foreach ($organisasi as $key => $value) 
                {
                    $total_penunjang += $value->sks_bkd;
                }
                foreach ($pengelolaJurnal as $key => $value) 
                {
                    $total_penunjang += $value->sks_bkd;
                }

                $total_bkd = $total_ajar+$total_pub+$total_abdi+$total_penunjang;

                $exp = $total_bkd * 500;
                $exp += $totalCatatanHarian;
                $level = \app\models\MasterLevel::getLevel($exp);
                $currentClass = \app\models\GameLevelClass::getCurrentClass($level);
                $nextLevel = \app\models\MasterLevel::getNextLevel($exp);
                $remainingExp = $nextLevel['nextExp'] - $exp;
                
                $user->level = $level;
                $user->class = $currentClass['class'];
                $user->rank = $currentClass['rank'];
                $user->stars = $currentClass['stars'];
                

                if($user->save())
                {

                    $counter++;
                    
                }

                else{
                    $errors .= \app\helpers\MyHelper::logError($user);
                    throw new \Exception;
                }
            }
            echo 'Data EXP updated '.$counter;
            $transaction->commit();
        }

        catch(\Exception $e)
        {
            $errors .= $e->getMessage();
            $transaction->rollBack();
            echo $errors;
        }

        echo "\n";
        return ExitCode::OK;
    }
}
