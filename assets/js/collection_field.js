'use strict';

jQuery(document).ready(function () {
    var $wrapperCriteries = $('.js-criteries-wrapper');
    var $wrapperVariants = $('.js-variants-wrapper');
    var $wrapperVariantsValues = $('.js-variants-values-wrapper');

    $wrapperCriteries.on('click', '.js-criterry-add', function(e) {
        e.preventDefault();

        // Get the data-prototype explained earlier
        var prototype = $wrapperCriteries.data('prototype');

        // get the new index
        var indexCriteries = $wrapperCriteries.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, indexCriteries + 1);

        // increase the index with one for the next item
        $wrapperCriteries.data('index', indexCriteries + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        $(this).before(newForm);

        addVariantsValuesFromCriteries();
    });

    $wrapperVariants.on('click', '.js-variant-add', function(e) {
        e.preventDefault();

        // Get the data-prototype explained earlier
        var prototype = $wrapperVariants.data('prototype');

        // get the new index
        var indexVariants = $wrapperVariants.data('index');

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, indexVariants + 1);

        // increase the index with one for the next item
        $wrapperVariants.data('index', indexVariants + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        $(this).parent().before(newForm);

        addVariantsValuesFromVariants();
    });

    $wrapperCriteries.on('click', '.js-criterry-remove', function (e) {
        e.preventDefault();

        var index = $wrapperCriteries.data('index');

        if (index > 1)
        {
            var idCritery =  $(this).closest('.js-critery-item').attr('id');

            $wrapperCriteries.data('index', index - 1);
            $(this).closest('.js-critery-item')
                .remove();

            $('.tr-'+idCritery)
                .remove();
        }
    });

    $wrapperVariants.on('click', '.js-variant-remove', function (e) {
        e.preventDefault();

        var indexVariant = $wrapperVariants.data('index');
        var indexCriteries = $wrapperCriteries.data('index');

        if (indexVariant > 1)
        {
            $wrapperVariants.data('index', indexVariant - 1);
            var idVariant =  $(this).closest('.js-variant-item').attr('id');

            $(this).closest('.js-variant-item')
                .remove();

            for (var i=1; i<= indexCriteries; i++)
            {
                $('.js-variant-value-item-'+i+idVariant)
                    .remove();
            }
        }
    });

    function addVariantsValuesFromVariants() {

        var indexCriteries = $wrapperCriteries.data('index');
        var indexVariants = $wrapperVariants.data('index');
        var prototypeVariantValue = $wrapperVariantsValues.data('prototype');
        var newForm = '';

        for (var i = 1; i <= indexCriteries; i++)
        {
            newForm = prototypeVariantValue;
            newForm = newForm.replace(/__name__/g, i.toString()+indexVariants.toString());
            $('.tr-'+i).children()[indexVariants-2].after($.parseHTML(newForm)[0]);
        }
    }

    function addVariantsValuesFromCriteries() {

        var indexCriteries = $wrapperCriteries.data('index');
        var indexVariants = $wrapperVariants.data('index');
        var prototypeVariantValue = $wrapperVariantsValues.data('prototype');
        var newForm = '';
        var prototype = '';

        for (var i = 1; i <= indexVariants; i++)
        {
            prototype = prototypeVariantValue;
            prototype = prototype.replace(/__name__/g, indexCriteries.toString()+i.toString());
            newForm +=prototype;
        }

        newForm = "<tr class='tr-" + indexCriteries + "'>" + newForm + "</tr>"
        $('.tr-' + (indexCriteries - 1)).after($.parseHTML(newForm)[0]);
    }

});


