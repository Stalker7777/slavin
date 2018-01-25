<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;

use app\models\Points;
use app\models\Books;
use app\models\User;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        return $this->redirect(['site/points', 'current_page' => 1]);

        //return $this->render('index');
    }

    public function actionPoints($current_page)
    {
        $model = Points::find()->all();

        return $this->render('points', ['model' => $model, 'current_page' => $current_page]);
    }

    public function actionBooks($point_id)
    {
        $find_book = "";

        if(Yii::$app->request->post()) {

            $find_book = Yii::$app->request->post('find_book');

        }

        $point = Points::findOne($point_id);
        $books = Books::find()->where(['points_id' => $point_id])->andWhere("name like '%" . $find_book . "%'")->all();

        return $this->render('books', ['point' => $point, 'books' => $books, 'find_book' => $find_book]);
    }

    public function actionDetail($book_id)
    {
        $book = Books::findOne($book_id);

        $book_count = 0;

        if (!Yii::$app->user->isGuest) {

            $user = User::findOne(Yii::$app->user->id);

            $model = Books::find()->where(['use_user_id' => $user->id])->all();

            $book_count = count($model);

        }

        return $this->render('detail', ['book' => $book, 'book_count' => $book_count]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin($book_id = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if($book_id == null)
                return $this->goBack();
            else
                return $this->redirect(['site/detail', 'book_id' => $book_id]);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }




    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }



    public function actionSetStatus($status, $book_id)
    {

        if(Yii::$app->user->isGuest) return "USER_IS_GUEST";

        $user = User::findOne(Yii::$app->user->id);

        if($status == "free") {

            if (\Yii::$app->request->isAjax) {

                $model = Books::findOne($book_id);

                $model->status = "free";
                $model->use_user_id = null;

                if($model->save()) {
                    return 'SUCCESSFUL_SET_FREE';
                }
                else {
                    return 'ERROR_SET_STATUS';
                }

            }
        }

        if($status == "busy") {

            if (\Yii::$app->request->isAjax) {

                $model = Books::findOne($book_id);

                $model->status = "busy";
                $model->use_user_id = $user->id;

                if($model->save()) {
                    return 'SUCCESSFUL_SET_BUSY';
                }
                else {
                    return 'ERROR_SET_STATUS';
                }
            }
        }

        return 'ERROR_SET_STATUS';
    }



}
