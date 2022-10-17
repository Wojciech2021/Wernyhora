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
        newForm = newForm.replace(/__name__/g, indexCriteries);

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
        newForm = newForm.replace(/__name__/g, indexVariants);

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

    function addVariantsValuesFromVariants() {
        var indexCriteries = $wrapperCriteries.data('index');
        var indexVariants = $wrapperVariants.data('index');
        var prototypeVariantValue = $wrapperVariantsValues.data('prototype');
        var newForm = prototypeVariantValue;

        for (var i = 1; i <= indexCriteries; i++)
        {
            newForm = newForm.replace(/__name__/g, i);
            //var className = '.tr'+i;

            $('.tr-'+i).children()[indexVariants-2].after($.parseHTML(newForm)[0]);
            console.log($('.tr-'+i).children()[indexVariants-2]);
            //newForm.insertAfter($('.tr-'+i).children()[indexVariants-2].attr('class'));
            //console.log($('.tr-'+i).children()[indexVariants-2])
            //console.log($.parseHTML(newForm)[0]);
        }
    }

    function addVariantsValuesFromCriteries() {
        var indexCriteries = $wrapperCriteries.data('index');
        var indexVariants = $wrapperVariants.data('index');
        var prototypeVariantValue = $wrapperVariantsValues.data('prototype');
        var newForm = '';

        for (var i = 1; i <= indexVariants; i++)
        {
            newForm +=prototypeVariantValue;
        }

        //var className = 'tr-' + indexCriteries;
        newForm = "<tr class='tr-" + indexCriteries + "'>" + newForm + "</tr>"
        console.log($.parseHTML(newForm)[0]);
        $('.tr-' + (indexCriteries - 1)).after($.parseHTML(newForm)[0]);
    }

});


