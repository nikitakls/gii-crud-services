<?php
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $generator nikitakls\gii\scrud\Generator */
echo "<?php\n";
?>
namespace <?= StringHelper::dirname(ltrim($generator->serviceClass, '\\')) ?>;

use <?= ($generator->formCreateClass) ?>;
use <?= ($generator->formEditClass) ?>;
use <?= ($generator->modelClass) ?>;
use <?= ($generator->repositoryClass) ?>;

class <?= StringHelper::basename($generator->serviceClass) ?>
{
    protected $repo;

    public function __construct(<?= StringHelper::basename($generator->repositoryClass) ?> $repo)
    {
        $this->repo = $repo;
    }

    public function create(<?= StringHelper::basename($generator->formCreateClass) ?> $form)
    {
        $model = new <?= StringHelper::basename($generator->modelClass) ?>();
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    public function edit($id, <?= StringHelper::basename($generator->formEditClass) ?> $form)
    {
        $model = $this->repo->get($id);
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    public function remove($id): void
    {
        $model = $this->repo->get($id);
        $this->repo->remove($model);
    }
}