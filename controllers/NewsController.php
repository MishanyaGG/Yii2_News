<?php

namespace app\controllers;

use app\models\Categories;
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex()
    {

        // Создаём новый экземпляр класса, необходимый для вывода значений в представлении
        $dataProvider = new ActiveDataProvider([
            // Запрос
            'query' => News::find(),

            // Параметры пагинации
            'pagination' => [
                'pageSize' => 3
            ],

            // Сортировка (по убыванию)
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ]
            ],

        ]);

        // Выводим представление и добавляем переменные для вывода в представлении
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'=>Categories::find()->asArray()->all()
        ]);
    }

    /**
     * Главная страница отсортированная с начала старые новости
     * @return string
     */
    public function actionOld()
    {
        // Создаём новый экземпляр класса, необходимый для вывода значений в представлении
        $dataProvider = new ActiveDataProvider([
            // Запрос
            'query' => News::find(),
            // Параметры пагинации
            'pagination' => [
                'pageSize' => 3
            ],

            // Сортировка (по возрастанию)
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_ASC,
                ]
            ],

        ]);

        // Выводим представление и добавляем переменные для вывода в представлении
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'=>Categories::find()->asArray()->all()
        ]);
    }

    /**
     * Подробная информация о новости
     * @param $id - идентификатор новости
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        // Создаём новый экземпляр класса, необходимый для вывода значений в представлении
        $model = new ActiveDataProvider([
            'query'=>News::find()->where('id = '.$id)
        ]);

        // Выводим представление и добавляем переменные для вывода в представлении
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$model
        ]);
    }

    /**
     * Создание новости
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Создаём экземпляр модели News
        $model = new News();

        // Записываем в поле модели значение
        $model->date = date('Y-m-d');

        // Если POST запрос
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        // Выводим представление и добавляем переменные для вывода в представлении
        return $this->render('create', [
            'model' => $model,
            'categories'=>Categories::find()->all()
        ]);
    }

    /**
     * Изменение значений новости
     * @param $id - идентификатор новости
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        // Создаём новый экземпляр класса, необходимый для вывода значений в представлении
        $dataProvider = new ActiveDataProvider([
            'query'=>News::find()->where('id = '.$id)
        ]);

        // Находим одну запись из модели News и записываем в переменную
        $model = News::findOne(['id'=>$id]);

        // Если POST запрос
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // Выводим представление и добавляем переменные для вывода в представлении
        return $this->render('update', [
            'model' => $model,
            'dataProvider'=>$dataProvider
        ]);
    }

    /**
     * Удаление новости
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete()
    {
        // Записываем в переменную POST значения из представления
        $post = Yii::$app->request->post();

        // Находим одно значение в модели News и его в дальнейшем удаляем
        News::findOne(['id'=>$post['IdNews']])->delete();

        // Перенаправление на контроллер представления news/index
        return $this->redirect(['index']);
    }

    /**
     * Фильтрация новостей
     * @return string
     */
    public function actionFilter(){

        // Записываем в переменную POST значения из представления
        $query = Yii::$app->request->post();

        // Создаём новый экземпляр класса, необходимый для вывода значений в представлении
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['id_categories'=>$query['id_categories']]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        // Выводим представление и добавляем переменные для вывода в представлении
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category'=>Categories::find()->asArray()->all()
        ]);
    }

    protected function findModel($id)
    {
        if (($model = News::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
