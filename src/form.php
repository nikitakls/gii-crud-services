<?php
use nikitakls\gii\scrud\CrudAsset;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\crud\Generator */

CrudAsset::register($this);

echo $form->field($generator, 'modelClass');

echo $form->field($generator, 'searchModelClass');

echo $form->field($generator, 'serviceClass');
echo $form->field($generator, 'formEditClass');
echo $form->field($generator, 'repositoryClass');

echo $form->field($generator, 'controllerClass');
echo $form->field($generator, 'viewPath');
echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'indexWidgetType')->dropDownList([
    'grid' => 'GridView',
    'list' => 'ListView',
]);
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'enablePjax')->checkbox();
echo $form->field($generator, 'messageCategory');
