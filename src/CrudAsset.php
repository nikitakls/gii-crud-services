<?php
/**
 * @author nikitakls
 */

namespace nikitakls\gii\scrud;

use yii\web\AssetBundle;

class CrudAsset extends AssetBundle
{
    public $sourcePath = '@nikitakls/gii/scrud/assets';
    public $js = [
        'generator.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}

