<?php
 namespace app\controllers;
 use yii\web\Controller;
 use yii\filters\AccessControl;

 class BaseController extends Controller{
     public function behaviors()
     {
         return [
             'access' => [
                 'class' =>AccessControl::className(),
                 //'only'=>['Create'],
                 'rules' => [
                     // allow authenticated users
                     [
                         'actions' => ['login','create'],
                         'allow' => true,
                     ],
                     [

                         'allow' => true,
                         'roles' => ['@'],
                     ],
                     // everything else is denied
                 ],
             ],
         ];
     }
 }

