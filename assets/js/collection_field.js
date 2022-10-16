jQuery(document).ready(function () {
    var $wrapperCriteries = $('.js-criteries-wrapper');
    var $wrapperVariants = $('.js-variants-wrapper');
    var $wrapperVariantsValues = $('.js-variants-values-wrapper');

    $wrapperCriteries.on('click', '.js-criterry-add', function(e) {
        e.preventDefault();

        // Get the data-prototype explained earlier
        var prototype = $wrapperCriteries.data('prototype');

        // get the new index
        var index = $wrapperCriteries.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $wrapperCriteries.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        $(this).before(newForm);
    });

    $wrapperVariants.on('click', '.js-variant-add', function(e) {
        e.preventDefault();

        // Get the data-prototype explained earlier
        var prototype = $wrapperVariants.data('prototype');

        // get the new index
        var index = $wrapperVariants.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $wrapperVariants.data('index', index + 1);

        //$(this).closest('.js-variant-item').after(newForm)
        // var closest = $(this).closest('.js-variant-item');
        // closest.after(newForm);
        // Display the form in the page in an li, before the "Add a tag" link li
        // var child = $(this).parentNode;
        // //var parent = $(this).parentNode.parentNode;
        //
        // $(this).parentNode.parentNodeinsertBefore(newForm, child);
        console.log( $(this).parent());
        $(this).parent().before(newForm);
    });

    $wrapperCriteries.on('click', '.js-criterry-remove', function (e) {
        e.preventDefault();

        var index = $wrapperCriteries.data('index');

        if (index > 1)
        {
            $wrapperCriteries.data('index', index - 1);
            $(this).closest('.js-critery-item')
                .remove();
        }
    });

    $wrapperVariants.on('click', '.js-variant-remove', function (e) {
        e.preventDefault();

        var index = $wrapperVariants.data('index');

        if (index > 1)
        {
            $wrapperVariants.data('index', index - 1);
            $(this).closest('.js-variant-item')
                .remove();
        }
    });

});


