<?php

namespace app\controllers;

use app\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
//    /**
//     * @inheritDoc
//     */
//    public function behaviors()
//    {
//        return array_merge(
//            parent::behaviors(),
//            [
//                'verbs' => [
//                    'class' => VerbFilter::className(),
//                    'actions' => [
//                        'delete' => ['POST'],
//                    ],
//                ],
//            ]
//        );
//    }

    /**
     * Создание категори
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Создаём экземпляр модели
        $model = new Categories();

        // Если POST запрос
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect('../news/index');
            }
        } else {
            $model->loadDefaultValues();
        }

        // Выводим представление и добавляем переменную для вывода в представлении
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Изменение названия категории
     * @param $id - идентификатор категории
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        // Получаем одно значение из модели Categories
        $model = $this->findModel($id);

        // Если POST запрос
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect('../news/index');
        }

        // Выводим представление и добавляем переменную для вывода в представлении
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удаление категории
     * @param $id - идентификатор категории
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        // Поиск записи в модели Categories и её дальнейшее удаление
        Categories::findOne($id)->delete();

        // Перенаправление на контроллер представления news/index
        return $this->redirect(['news/index']);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
