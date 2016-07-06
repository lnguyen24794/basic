<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $birthday
 * @property integer $status
 * @property integer $id_school
 * @property integer $id_block
 * @property integer $id_class
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'birthday', 'id_school', 'id_block', 'id_class'], 'required'],
            [['birthday'], 'safe'],
            [['status', 'id_school', 'id_block', 'id_class'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'birthday' => 'Birthday',
            'status' => 'Status',
            'id_school' => 'Id School',
            'id_block' => 'Id Block',
            'id_class' => 'Id Class',
        ];
    }
    public function getlist_School(){
        $model = new School();

        $listData=ArrayHelper::map( $model->list_School(),'id','name');

        return $listData;

    }

    public function getlist_Block(){
        $model = new Block();

        $listData=ArrayHelper::map( $model->list_Block(),'id','name');

        return $listData;

    }
    public function getlist_Class(){
        $model = new Classes();

        $listData=ArrayHelper::map( $model->list_Class(),'id','name');

        return $listData;

    }
    public function searchModel($params){
        $query= Student::find();
        $dataProvider= new ActiveDataProvider([
            'query'=>$query,
        ]);
        if(!($this->load($params))){
            return $dataProvider;
        }
        $query->andFilterWhere([
            'name'=>$this->name,
            'id_school'=>$this->id_school,
            'id_block'=>$this->id_block,
            'status'=>$this->status,
            'address'=>$this->address,
        ]);
        $query
            ->andFilterWhere(['like','name',$this->name])
            ->andFilterWhere(['like','id_school',$this->id_school])
            ->andFilterWhere(['like','id_block',$this->id_block])
            ->andFilterWhere(['like','address',$this->address])
            ->andFilterWhere(['like','status',$this->status]);
        return $dataProvider;
    }
}
