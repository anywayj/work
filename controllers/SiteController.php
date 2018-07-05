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
use app\models\Form1;
use app\models\Bids;
use app\models\Events;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
        return $this->render('index');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        $model->created_at = date("Y-m-d");
        $model->updated_at = date("Y-m-d");
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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->username = 'admin';
        $model->password = 'admin';
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


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionTasks()
    {
        $modelf = new Form1();
        $modelf->students = '28';
        $modelf->sport = '75';

        $onequery = "SELECT * FROM bids 
        INNER JOIN events ON bids.id_event = events.id_event
        WHERE bids.price = (SELECT MAX(price) FROM bids)
        ";

        $twoquery = "SELECT * FROM events
        WHERE events.id_event NOT IN (SELECT id_event FROM bids)
        ";

        $threequery = "SELECT events.caption, count(bids.id_event) as kol FROM events
        INNER JOIN bids ON bids.id_event = events.id_event
        GROUP BY events.caption";

        $fourquery = "SELECT events.caption, count(bids.id_event) as kol FROM events
        INNER JOIN bids ON bids.id_event = events.id_event
        GROUP BY events.caption";


        $bids1 = Bids::findBySql($onequery)->all();
        $bids2 = Events::findBySql($twoquery)->all();
        $bids3 = Events::findBySql($threequery)->all();
        $bids4 = Events::findBySql($fourquery)->all();

        if ($modelf->load(Yii::$app->request->post()) && $modelf->validate()) {

        return $this->render('tasks',[
                'modelf' => $modelf,
                'bids1' => $bids1,
                'bids2' => $bids2,
                'bids3' => $bids3,
                'bids4' => $bids4,
            ]);
        } else {
            return $this->render('tasks',[
                'modelf' => $modelf,
                'bids1' => $bids1,
                'bids2' => $bids2,
                'bids3' => $bids3,
                'bids4' => $bids4,
            ]);
        }
    }
}
