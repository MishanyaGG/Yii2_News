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
use yii\db\Exception;
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
    // ГЛАВНАЯ СТРАНИЦА
    public function actionIndex()
    {
        // Получение из модели всех категорий
        $select = Kategori::find()->asArray()->all();

        // Проверяем на наличие авторизованного пользователя
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] != [] || $_SESSION['id'] != null)
                $user = LoginTable::find()->where(['id' => $_SESSION['id']])->all();
        } else
            $user = null;

        // Запрос на получение новоствей с соответствующей им категорий
        $news_row = (new Query())
            ->select(['news.*', 'kategori.nasvanie'])
            ->from('news')
            ->innerJoin('kategori', 'news.id_kategori = kategori.id')
            ->all();

        if ($user == null)
            return $this->render('index', ['pols' => $user, 'news_row' => compact('news_row'), 'select' => compact('select')]);
        else
            return $this->render('index', ['pols' => compact('user'), 'news_row' => compact('news_row'), 'select' => compact('select')]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */

    // ЛОГИН
    public function actionLogin()
    {
        // МОДЕЛЬ С ФОРМОЙ
        $model = new LoginForm();

        // ПОЛУЧЕНИЕ POST ЗАПРОСА
        $model->load(Yii::$app->request->post());

        // Условие на получение значений
        if ($model->login != null && $model->pass != null) {

            // Проверяем на соответствие логина и пароля с записью в бд
            $pols = LoginTable::find()->asArray()->where(['login' => $model->login, 'pass' => $model->pass])->all();

            // Запускаем
            Yii::$app->session->open();

            // Проверяем на количество записей в бд
            if (count($pols) == 0)
                return $this->render('login', ['status' => false, 'model' => $model]);

            // Записываем в суперглобальную переменную айдишник пользователя
            $_SESSION['id'] = $pols[0]['id'];

            // Получаем все категории из модели
            $select = Kategori::find()->asArray()->all();

            // Запрос на получение новостей с соответствующей им категорий
            $news_row =  (new Query())
                ->select(['news.*', 'kategori.nasvanie'])
                ->from('news')
                ->innerJoin('kategori', 'news.id_kategori = kategori.id')
                ->all();

            return $this->render(\yii\helpers\Url::to('index'), ['select' => compact('select'), 'pols' => compact('pols'), 'news_row' => compact('news_row')]);
        }

        return $this->render('login', compact('model'));
    }

    // Обработка фильтрации новостей
    public function actionForm()
    {

        // Получаем форму с категориями
        $row = Yii::$app->request->post();

        // Сразу же получаем все категории из модели
        $select = Kategori::find()->asArray()->all();

        // Проверяем на наличие авторизованного пользователя
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] != [] || $_SESSION['id'] != null) {
                $user = LoginTable::find()->where(['id' => $_SESSION['id']])->all();
            }
        } else
            $user = null;

        // Если была выбрана категория
        if (isset($row['categori_name'])) {

            // Запрос на получение новоствей с соответствующей им категорий
            $news = (new Query())
                ->select(['news.*', 'kategori.nasvanie'])
                ->from('news')
                ->innerJoin('kategori', 'news.id_kategori = kategori.id')
                ->where('news.id_kategori = ' . $row['categori_name'])
                ->all();

            if ($user == null)
                return $this->render('index', ['pols' => $user, 'news_row' => compact('news'), 'select' => compact('select')]);
            else
                return $this->render('index', ['pols' => compact('user'), 'news_row' => compact('news'), 'select' => compact('select')]);
        } else {

            // Запрос на получение новоствей с соответствующей им категорий
            $news = (new Query())
                ->select(['news.*', 'kategori.nasvanie'])
                ->from('news')
                ->innerJoin('kategori', 'news.id_kategori = kategori.id')
                ->all();

            if ($user == null)
                return $this->render('index', ['pols' => compact('user'), 'news_row' => compact('news'), 'select' => compact('select')]);
            else
                return $this->render('index', ['pols' => compact('user'), 'news_row' => compact('news'), 'select' => compact('select')]);
        }
    }

    public function actionInfo()
    {
        $rq = Yii::$app->request->post();

        // Запрос на получение новоствей с соответствующей им категорий
        $select = (new Query())
            ->select(['news.*', 'kategori.nasvanie'])
            ->from('news')
            ->innerJoin('kategori', 'news.id_kategori = kategori.id')
            ->where(['news.id' => $rq['id_news']])
            ->all();

        // Проверяем на наличие авторизованного пользователя
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] != [] || $_SESSION['id'] != null) {
                $user = LoginTable::find()->where(['id' => $_SESSION['id']])->all();
            }
        } else
            $user = null;

        if ($user == null)
            return $this->render('info', ['info' => compact('select')]);
        else
            return $this->render('info', ['pols' => compact('user'), 'info' => compact('select')]);
    }

    public function actionCreate_news(){

        $post = Yii::$app->request->post();

        if ($post == []){
            $kategory = Kategori::find()->all();

            $user = LoginTable::find()->where(['id' => $_SESSION['id']])->all();

            return $this->render('create_news',['kategory'=>compact('kategory'),'pols'=>compact('user')]);
        } else {
            $news = new News;

            $news->sagolovok = $post['sagolovok'];
            $news->id_kategori = $post['kategory'];
            $news->info_news = $post['info'];
            $news->date = date('Y-m-d');

            $news->save();

            return $this->redirect('index');
        }

    }

    public function actionRead_news(){
        $rq = Yii::$app->request->post();

        if(count($rq) == 2){
            $kategory = Kategori::find()->all();

            $user = LoginTable::find()->where(['id' => $_SESSION['id']])->all();

            $news = News::find()->where(['id'=>$rq['id_news']])->all();

            return $this->render('read_news',['kategory'=>compact('kategory'),'pols'=>compact('user'),'news'=>compact('news')]);
        } else{
            $news = News::findOne($rq['id_news']);

            $news->sagolovok = $rq['sagolovok'];
            $news->id_kategori = $rq['kategory'];
            $news->info_news = $rq['info'];

            $news->update();

            $this->redirect('index');
        }
    }

    public function actionDel_news(){
        $rq = Yii::$app->request->post();

        News::findOne($rq['id_news'])->delete();

        return $this->redirect('index');
    }

    // ВЫХОД ИЗ АККА
    public function actionOut()
    {

        $_SESSION['id'] = null;

        return $this->redirect('index');
    }
}
