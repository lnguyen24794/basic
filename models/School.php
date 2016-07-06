<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $status
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['status'], 'integer'],
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
            'status' => 'Status',
        ];
    }

    public function list_School(){
        return School::find()->where(['status'=>1])->all();
    }

    public function findByName($name){
        return School::find($name);
    }

    public function searchModel($params){
        $query= School::find();
        $dataProvider= new ActiveDataProvider([
            'query'=>$query,
        ]);
        if(!($this->load($params))){
            return $dataProvider;
        }
        $query->andFilterWhere([
            'name'=>$this->name,
            'address'=>$this->address,
            'status'=>$this->status,
        ]);
        $query
            ->andFilterWhere(['like','name',$this->name])
            ->andFilterWhere(['like','address',$this->address])
            ->andFilterWhere(['like','status',$this->status]);
        return $dataProvider;
    }
}
