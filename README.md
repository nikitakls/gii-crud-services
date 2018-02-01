nikitakls/yii2-gii-scrud
========================
Gii generator with service layer architecture

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --dev nikitakls/yii2-gii-scrud "*"
```

or add in dev section

```
"nikitakls/yii2-gii-scrud": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :

```php
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'scrud' => [
                'class' => 'nikitakls\gii\scrud\Generator',
            ]
        ],
    ];

```
