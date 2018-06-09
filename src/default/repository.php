<?php
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $generator nikitakls\gii\scrud\Generator */
echo "<?php\n";
?>
namespace <?= StringHelper::dirname(ltrim($generator->repositoryClass, '\\')) ?>;

use Yii;
use <?= ($generator->modelClass) ?>;
use yii\web\NotFoundHttpException;

/**
* <?= StringHelper::basename($generator->repositoryClass) ?> implements the store operations for <?= StringHelper::basename($generator->modelClass) ?> model.
*/
class <?= StringHelper::basename($generator->repositoryClass) ?>
{
    /**
     * @var <?= StringHelper::basename($generator->modelClass) ?>[]
     */
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
     * Get <?= StringHelper::basename($generator->modelClass) ?> by pk
     * @param integer $id task
     * @param bool $canCache can take model from cache
     * @param string $pk
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
            throw new NotFoundHttpException(<?= $generator->generateString(StringHelper::basename($generator->modelClass).' not found.') ?>);
        }
        return $model;
    }

    /**
     * Remove the current <?= StringHelper::basename($generator->modelClass) ?> in storage.
     *
     * @param <?= StringHelper::basename($generator->modelClass) ?> $model
     * meaning all attributes that are loaded from DB will be saved.
     * @throws \Throwable
     * @throws \RuntimeException
     * @throws \yii\db\StaleObjectException
     */
    public function remove(<?= StringHelper::basename($generator->modelClass) ?> $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException(<?= $generator->generateString('Deleting error.') ?>);
        }
    }

    /**
     * Clear all model from cache.
     */

    public function clearCache()
    {
        $this->_cache = [];
    }

    /**
     * Saves the current <?= StringHelper::basename($generator->modelClass) ?> in storage.
     *
     * @throws \RuntimeException
     * @param <?= StringHelper::basename($generator->modelClass) ?> $model
     * @param bool $runValidation whether to perform validation (calling [[validate()]])
     * before saving the record. Defaults to `true`. If the validation fails, the record
     * will not be saved to the database and this method will return `false`.
     * @param array $attributeNames list of attribute names that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function save(<?= StringHelper::basename($generator->modelClass) ?> $model, $runValidation = true, $attributeNames = null)
    {
			if (!$model->save($runValidation, $attributeNames)) {
				if ($model->hasErrors()) {
					throw new \RuntimeException(implode(' ', $model->getErrorSummary(false)));
				}
				throw new \RuntimeException(<?= $generator->generateString('Saving '. StringHelper::basename($generator->modelClass) .' error.') ?>);
			}
    }
}