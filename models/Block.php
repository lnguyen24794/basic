<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "block".
 *
 * @property integer $id
 * @property string $name
 * @property integer $id_school
 * @property integer $status
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_school'], 'required'],
            [['id_school', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'id_school' => 'Id School',
            'status' => 'Status',
        ];
    }

    public function getlist_School(){
        $model = new School();

        $listData=ArrayHelper::map( $model->list_School(),'id','name');

        return $listData;

    }
    public function list_Block($id_school){
        return Block::find($id_school)->where(['status'=>'1'])->all();
    }
    public function searchModel($params){
        $query= Block::find();
        $dataProvider= new ActiveDataProvider([
            'query'=>$query,
        ]);
        if(!($this->load($params))){
            return $dataProvider;
        }
        $query->andFilterWhere([
            'name'=>$this->name,
            'id_school'=>$this->id_school,
            'status'=>$this->status,
        ]);
        $query
            ->andFilterWhere(['like','name',$this->name])
            ->andFilterWhere(['like','id_school',$this->id_school])
            ->andFilterWhere(['like','status',$this->status]);
        return $dataProvider;
    }

}
