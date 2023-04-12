$(document).ready(function () {
    $('.humberger__menu__widget .header__top__right__language span').click(function (e) {
        e.preventDefault();
        $(this).siblings('ul').toggleClass('active');

    });

    $('.hero__search__categories').click(function (e) {
        e.preventDefault();
        $(this).children('span').toggleClass('active');
        $('.categories_list ul').toggleClass('active');

    });
    $('.categories_list ul li').click(function (e) {
        e.preventDefault();
        $('.categories_list ul').removeClass('active');
        $('.hero__search__categories b').text($(this).text())
        // console.log($(this).attr('data-id'));
        // console.log($("#search_cat"));
        $("#search_cat").attr("value", $(this).attr('data-id'));
    });

    $(".price-range").on(
        "slidechange",
        function (event, ui) {
            var path = $(location).attr('href').split('?')[0];
            var params = {}; location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (s, k, v) { params[k] = v });
            params['minPrice'] = ui.values[0];
            params['maxPrice'] = ui.values[1];
            var param_list = '';
            for (const key in params) {
                if (Object.hasOwnProperty.call(params, key)) {
                    const element = params[key];
                    param_list += key + '=' + element + '&';
                }
            }
            var newUrl = path + '?' + param_list;
            setTimeout(() => {
                window.location.href = newUrl;
            }, 1000);
        }
    );
    if (parseInt($($('.fa-shopping-bag').siblings('span')[0]).text()) > 0) {
        setInterval(() => {
            $('.fa-shopping-bag').effect('shake', {
                distance: 4,
            });
        }, 5000);
    };

});