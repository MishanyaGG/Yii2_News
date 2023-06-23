<?php

namespace app\controllers;

use app\models\CategoriForm;
use app\models\Kategori;
use app\models\LoginTable;
use app\models\News;
use app\models\Users;
use app\models\UsersForm;
use http\Url;
use Yii;
use yii\db\Query;
use yii\debug\models\search\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use function PHPUnit\Framework\identicalTo;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $select = Kategori::find()->asArray()->all();

        $news_row = (new Query())
            ->select(['news.*','kategori.nasvanie'])
            ->from('news')
            ->innerJoin('kategori','news.id_kategori = kategori.id')
            ->all();

        return $this->render(\yii\helpers\Url::to('index'),['select'=>compact('select'),'news_row'=>compact('news_row')]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        $model->load(Yii::$app->request->post());

        if ($model->login !=null && $model->pass!=null){

            $pols = LoginTable::find()->asArray()->where(['login'=>$model->login,'pass'=>$model->pass])->all();

            if (count($pols) == 0)
                return $this->render('login',['status'=>false,'model'=>$model]);

            $select = Kategori::find()->asArray()->all();
            $news_row =  (new Query())
                ->select(['news.*','kategori.nasvanie'])
                ->from('news')
                ->innerJoin('kategori','news.id_kategori = kategori.id')
                ->all();

            return $this->render(\yii\helpers\Url::to('index'),['select'=>compact('select'),'pols'=>compact('pols'),'news_row'=>compact('news_row')]);
        }



//        if(!$model->load(Yii::$app->request->post()) && $model->login !=null && $model->pass != null){
//            return $this->render('login',['status'=>false,'model'=>$model]);
//        }
//        else{
//            $pols = LoginTableForm::find()->asArray()->where(['login'=>$model->login,'pass'=>$model->pass])->all();
//
//            return $this->render('index',compact('pols'));
//        }

        return $this->render('login',compact('model'));
    }


    public function actionForm(){

        $row = Yii::$app->request->post();

        $select = Kategori::find()->asArray()->all();$select = Kategori::find()->asArray()->all();

        if(isset($row['categori_name'])){

        $news = (new Query())
            ->select(['news.*','kategori.nasvanie'])
            ->from('news')
            ->innerJoin('kategori','news.id_kategori = kategori.id')
            ->where('news.id_kategori = '.$row['categori_name'])
            ->all();

        return $this->render('index',['news_row'=>compact('news'),'select'=>compact('select')]);

        } else {
            $news = (new Query())
            ->select(['news.*','kategori.nasvanie'])
            ->from('news')
            ->innerJoin('kategori','news.id_kategori = kategori.id')
            ->all();

            return $this->render('index',['news_row'=>compact('news'),'select'=>compact('select')]);
        }

    }
}
