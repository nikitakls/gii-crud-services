<?php
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $generator nikitakls\gii\scrud\Generator */
echo "<?php\n";
$repositoryNameVar = mb_strtolower(StringHelper::basename($generator->modelClass)) .'s';
?>
namespace <?= StringHelper::dirname(ltrim($generator->serviceClass, '\\')) ?>;

use <?= ($generator->formEditClass) ?>;
use <?= ($generator->modelClass) ?>;
use <?= ($generator->repositoryClass) ?>;

/**
* <?= StringHelper::basename($generator->serviceClass) ?> implements the operations for <?= StringHelper::basename($generator->modelClass) ?> model.
*/
class <?= StringHelper::basename($generator->serviceClass) ?>
{
    protected $<?= $repositoryNameVar ?>;

    public function __construct(<?= StringHelper::basename($generator->repositoryClass) ?> $<?= $repositoryNameVar ?>)
    {
        $this-><?= $repositoryNameVar ?> = $<?= $repositoryNameVar ?>;
    }

    public function create(<?= StringHelper::basename($generator->formEditClass) ?> $form)
    {
        $model = new <?= StringHelper::basename($generator->modelClass) ?>();
        $model->setAttributes($form->getAttributes());
        $this-><?= $repositoryNameVar ?>->save($model);
        return $model;
    }

    public function edit(int $id, <?= StringHelper::basename($generator->formEditClass) ?> $form)
    {
        $model = $this-><?= $repositoryNameVar ?>->get($id);
        $model->setAttributes($form->getAttributes());
        $this-><?= $repositoryNameVar ?>->save($model);
        return $model;
    }

    public function remove(int $id)
    {
        $model = $this-><?= $repositoryNameVar ?>->get($id);
        $this-><?= $repositoryNameVar ?>->remove($model);
    }
}