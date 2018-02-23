<?php
namespace frontend\controllers;

use frontend\models\User;
use yii\rest\ActiveController;
use yii\web\Controller;
use frontend\models\User2;
use yii;

//class UserController extends ActiveController {
class UserController extends Controller{
    public $modelClass = 'frontend\models\User';

    public function actionIndex2() {
        //$transposion = yii::$app->db->beginTransaction();
        $transposion = User::getDb()->beginTransaction();
        $user = new User();
        $user->username = 'gxp';
        $user->password = '2';
        $user->status = 1;
        $user->save();
        //Yii::$app->db->createCommand();
       // $transposion->rollBack();
        try{
            if($user->save()){
                $user2 = new User2();
                $user2->username = 'gxp2';
                $user2->status = '2333';
                $user2->save();
                if(!$user2->save()) {
                    throw new \Exception('error22');
                    $transposion->rollBack();
                }

            } else {
                $transposion->rollBack();
                echo 'failed';exit;
            }
            $transposion->commit();

        }
        catch(\Exception $e){
            echo $e->getMessage();
            $transposion->rollBack();
        }

        echo 'sucess';exit;



    }
}