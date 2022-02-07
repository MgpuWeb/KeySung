<?php

namespace app\controllers;

use app\models\form\Login;
use app\models\form\SignUp;
use app\models\User;
use app\services\user\contract\exception\repository\InvalidEntity;
use app\services\user\contract\exception\repository\NotFound;
use app\services\user\contract\UserServiceInterface;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use app\models\ContactForm;
use yii2mod\swagger\SwaggerUIRenderer;
use yii2mod\swagger\OpenAPIRenderer;

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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'api-docs' => [
                'class' => SwaggerUIRenderer::class,
                'restUrl' => Url::to(['site/api-json-schema']),
            ],
            'api-json-schema' => [
                'class' => OpenAPIRenderer::class,
                'cache' => null,
                'scanDir' => [
                    Yii::getAlias('@app/controllers/api/common'),
                    Yii::getAlias('@app/models/api/common/swagger'),
                ],
            ],
			'integration-api-docs' => [
				'class' => SwaggerUIRenderer::class,
				'restUrl' => Url::to(['site/integration-api-json-schema']),
			],
			'integration-api-json-schema' => [
				'class' => OpenAPIRenderer::class,
				'scanDir' => [
					Yii::getAlias('@app/controllers/api/integration'),
					Yii::getAlias('@app/models/api/integration/swagger'),
				],
			],
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

        if (Yii::$app->request->isGet) {
            $model = new Login();
            return $this->render('login', [
                'model' => $model,
            ]);
        }

        if (Yii::$app->request->isPost) {
            $model = new Login();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->login();
                $this->goHome();
            }
        }
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

    public function actionSignUp(UserServiceInterface $userService)
    {
        $model = new SignUp();
        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            Yii::$app->session->setFlash(
                'errors',
                $model->getErrorSummary(true)[0]
            );

            return $this->render('sign_up', compact('model'));
        }

        $user = new User();
        $user->email = $model->email;
        $user->password = $model->password;

        try {
            $userService->create($user);
        } catch (InvalidEntity $exception) {
            Yii::$app->session->setFlash(
                'error',
                $exception->getMessage()
            );

            return $this->render('sign_up', compact('model'));
        }

        Yii::$app->user->login($user, 3600*24*30);
        return $this->goHome();
    }

    public function confirmation($token, UserServiceInterface $userService): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        try {
            $user = $userService->confirmEmail($token);
        } catch (NotFound) {
            throw new \DomainException('User is not found.');
        }

        if (!Yii::$app->getUser()->login($user)){
            throw new \RuntimeException('Error authentication.');
        }
    }

    public function actionSignUpView()
    {
        $model = new SignUp();
        return $this->render('sign_up', compact('model'));
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
}
