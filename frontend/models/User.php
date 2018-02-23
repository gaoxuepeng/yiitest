<?php
namespace frontend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * user Model
 *
 * @property integer $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $status  用户状态
 * @property integer $created 创建时间
 * @property integer $updated 更新时间
 */

class User extends ActiveRecord {
    public static function tableName() {
        return "{{%user}}";
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function init(){
        $this->setScenario('user');
    }

    public function rules(){
        return [
            [['username,password,status'],'required','on' => ['user']]
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        //各个场景的活动属性
        $scenarios['user'] = ['username', 'password','status'];

        return $scenarios;

    }
}