(function ($) {
    function setInputName(selector, modelClass, prefixPath, postfixName){
        var fInput = $(selector);
        var fClass = fInput.val();
        if (fClass === '') {
            fClass = modelClass.split('\\').slice(0, -2).join('\\') + '\\'
                + prefixPath + '\\'
                + modelClass.split('\\').slice(-1)[0] + postfixName;
            fInput.val(fClass);
        }
    }

    $('#generator-modelclass').on('blur', function () {
        var modelClass = $(this).val();
        if (modelClass !== '') {
            setInputName('#generator-searchmodelclass', modelClass, 'models', 'Search');
            setInputName('#generator-serviceclass', modelClass, 'services', 'Service');
            setInputName('#generator-formeditclass', modelClass, 'forms', 'Form');
            setInputName('#generator-repositoryclass', modelClass, 'repository', 'Repository');
            setInputName('#generator-controllerclass', modelClass, 'controllers', 'Controller');
        }
    });
})(jQuery);
