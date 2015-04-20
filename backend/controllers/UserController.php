<?php
/**
 * User: kuw
 */

namespace backend\controllers;


use Yii;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        $d = \Yii::$app->request->bodyParams;
        if (isset($d['username']) && $d['username'] == 'kuw' && isset($d['password']) && $d['password'] == 'wuk')
        {

            return [
                'result' => 'ok',
                'data' => [
                    'token'=> 'xxx',
                ],

            ];
        }
        Yii::$app->response->statusCode = 409;
        return ['result' => 'error'];
    }
}