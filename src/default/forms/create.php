<?php
use yii\helpers\StringHelper;
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator nikitakls\gii\scrud\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $queryClassName string query class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $properties array list of properties (property => [type, name. comment]) */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

echo "<?php\n";
$rules = $generator->generateRules();
?>

namespace <?= StringHelper::dirname(ltrim($generator->formCreateClass, '\\')) ?>;

use Yii;
use yii\base\Model;

/**
* This is the model class for active record model "<?= StringHelper::basename($generator->modelClass) ?>".
*
<?php foreach ($generator->generateProperties() as $property => $data): ?>
* @property <?= "{$data['type']} \${$property}"  . ($data['comment'] ? ' ' . strtr($data['comment'], ["\n" => ' ']) : '') . "\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
*
    <?php foreach ($relations as $name => $relation): ?>
* @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
    <?php endforeach; ?>
<?php endif; ?>
*/
class <?= StringHelper::basename($generator->formCreateClass) ?> extends Model
{
<?php foreach ($generator->generateProperties() as $name => $attr): ?>
    public $<?= $name ?>;
<?php endforeach; ?>

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [<?= empty($rules) ? '' : ("\n            " . implode(",\n            ", $rules) . ",\n        ") ?>];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
    <?php foreach ($generator->generateSearchLabels() as $name => $label): ?>
            <?= "'$label' => " . $generator->generateString($label) . ",\n" ?>
    <?php endforeach; ?>
        ];
    }

}
