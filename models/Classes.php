<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "classes".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $id_school
 * @property integer $id_block
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_school', 'id_block'], 'required'],
            [['status', 'id_school', 'id_block'], 'integer'],
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
            'status' => 'Status',
            'id_school' => 'Id School',
            'id_block' => 'Id Block',
        ];
    }
    public function getlist_School(){
        $model = new School();

        $listData=ArrayHelper::map( $model->list_School(),'id','name');

        return $listData;

    }

    public function getlist_Block($id_school){
        $model = new Block();

        $listData=ArrayHelper::map( $model->list_Block($id_school),'id','name');

        return $listData;

    }
    public function list_Class(){
        return Classes::find()->where(['status'=>1])->all();
    }
    public function searchModel($params){
        $query= Classes::find();
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
        ]);
        $query
            ->andFilterWhere(['like','name',$this->name])
            ->andFilterWhere(['like','id_school',$this->id_school])
            ->andFilterWhere(['like','id_block',$this->id_block])
            ->andFilterWhere(['like','status',$this->status]);
        return $dataProvider;
    }
}
