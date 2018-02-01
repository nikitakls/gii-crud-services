<?php
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $generator nikitakls\gii\servicecrud\Generator */
echo "<?php\n";
?>
namespace <?= StringHelper::dirname(ltrim($generator->repositoryClass, '\\')) ?>;

use <?= ($generator->modelClass) ?>;
use yii\web\NotFoundHttpException;

class <?= StringHelper::basename($generator->repositoryClass) ?>

{
    protected $_cache = [];

    /**
     * Get <?= StringHelper::basename($generator->modelClass) ?> by condition
     *
     * @param integer $pk
     * @throws NotFoundHttpException
     * @return <?= StringHelper::basename($generator->modelClass . PHP_EOL) ?>
     */
    public function get($pk)
    {
        return $this->getByPk($pk);
    }

    /**
     * get <?= StringHelper::basename($generator->modelClass) ?> by pk
     * @param integer $id task
     * @param bool $canCache can take model from cache
     * @throws NotFoundHttpException
     * @return <?= StringHelper::basename($generator->modelClass . PHP_EOL) ?>
     */
    protected function getByPk($id, $canCache = true, $pk = 'id')
    {
        if (!isset($this->_cache[$id]) || !$canCache) {
            $this->_cache[$id] = $this->getBy([$pk => $id]);
        }
        return $this->_cache[$id];
    }

    /**
     * Get <?= StringHelper::basename($generator->modelClass) ?> by condition
     *
     * @param array $condition
     * @throws NotFoundHttpException
     * @return <?= StringHelper::basename($generator->modelClass) . PHP_EOL ?>
     */
    protected function getBy($condition)
    {
        if (!$model = <?= StringHelper::basename($generator->modelClass) ?>::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('<?= StringHelper::basename($generator->modelClass) ?> not found.');
        }
        return $model;
    }

    /**
     * Remove the current model in storage.
     *
     * @throws \RuntimeException
     * @param <?= StringHelper::basename($generator->modelClass) ?> $model
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function remove(<?= StringHelper::basename($generator->modelClass) ?> $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }

    public function clearCache()
    {
        $this->_cache = [];
    }

    /**
     * Saves the current model in storage.
     *
     * @throws \RuntimeException
     * @param <?= StringHelper::basename($generator->modelClass) ?> $model
     * @param bool $runValidation whether to perform validation (calling [[validate()]])
     * before saving the record. Defaults to `true`. If the validation fails, the record
     * will not be saved to the database and this method will return `false`.
     * @param array $attributeNames list of attribute names that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function save(<?= StringHelper::basename($generator->modelClass) ?> $model,
                         bool $runValidation = true,
                         array $attributeNames = null)
    {
        if (!$model->save($runValidation, $attributeNames)) {
            throw new \RuntimeException('Saving <?= StringHelper::basename($generator->modelClass) ?> error.');
        }
    }

}