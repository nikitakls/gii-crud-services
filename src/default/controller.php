<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator nikitakls\gii\servicecrud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

$serviceNameVar = mb_strtolower($modelClass).'Service';
$repositoryNameVar = mb_strtolower($modelClass).'s';
echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ($generator->repositoryClass) ?>;
use <?= ($generator->serviceClass) ?>;
use <?= ($generator->formCreateClass) ?>;
use <?= ($generator->formEditClass) ?>;
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . PHP_EOL ?>
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /** @var <?= StringHelper::basename($generator->serviceClass) ?> */
    protected $<?= $serviceNameVar?>;

    /** @var <?= StringHelper::basename($generator->repositoryClass) ?> */
    protected $<?= $repositoryNameVar?>;

    public function __construct(string $id, $module, <?= StringHelper::basename($generator->repositoryClass) ?> $<?= $repositoryNameVar?>,  <?= StringHelper::basename($generator->serviceClass) ?> $<?= $serviceNameVar?>,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this-><?= $serviceNameVar?> = $<?= $serviceNameVar?>;
        $this-><?= $repositoryNameVar?> = $<?= $repositoryNameVar?>;
    }

    /**
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex()
    {
<?php if (!empty($generator->searchModelClass)): ?>
        $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
<?php else: ?>
        $dataProvider = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
<?php endif; ?>
    }

    /**
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(<?= $actionParams ?>)
    {
        return $this->render('view', [
            'model' => $this-><?= $repositoryNameVar?>->get(<?= $actionParams ?>),
        ]);
    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new <?= StringHelper::basename($generator->formCreateClass) ?>();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this-><?= $serviceNameVar?>->create($form, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', 'You puzzle saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);

    }

    /**
    * Updates an existing <?= $modelClass ?> model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate(<?= $actionParams ?>)
    {
        $model = $this-><?= $repositoryNameVar?>->get(<?= $actionParams ?>);
        $form = new <?= StringHelper::basename($generator->formEditClass) ?>($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            try {
                $model = $this-><?= $serviceNameVar?>->edit($id, $form);
                Yii::$app->session->setFlash('success', '<?= StringHelper::basename($generator->modelClass) ?> updated.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $model,
            'formModel' => $form,
        ]);
    }

    /**
     * Deletes an existing <?= $modelClass ?> model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(<?= $actionParams ?>)
    {
        try {
            $this-><?= $serviceNameVar?>->remove(<?= $actionParams ?>);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

}
