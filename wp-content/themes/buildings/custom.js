jQuery(function ($) {
    function handleForm() {
        let $list = $('.page-loop.with-filter');
        let $form = $('#page-filter');
        $list.addClass('loading');
        $.post(buildings.ajax_url, $form.serialize()).then(function (data) {
            $list.removeClass('loading');
            $list.html(data.items);
            let $button = $('.show-more__button');

            $button
                .data('page', 1)
                .data('limit', data.limit);

            if (data.has_more_posts) {
                $button.parent().show();
            } else {
                $button.parent().hide();
            }
        });
    }

    $(document).on('submit', '#page-filter', function (e) {
        e.preventDefault();
        handleForm();
    });
    $(document).on('click', '#reset_filter', function (e) {
        $('#page-filter')[0].reset()
        handleForm();
    });
    $(document).on('click', '.show-more__button', function (e) {
        let $list = $('.page-loop.with-filter');
        e.preventDefault();
        let page = $(this).data('page');
        let limit = $(this).data('limit');
        if (page < limit) {

            $(this).data('page', page + 1);

            let filterData = $('#page-filter').serializeArray();
            filterData.push({name: 'page', value: page + 1});
            $list.addClass('loading');
            $.post(buildings.ajax_url, filterData).then((data) => {
                $list.removeClass('loading');
                $list.append(data.items);

                if (!data.has_more_posts) {
                    $(this).parent().hide();
                }
            });
        }
    });
});
