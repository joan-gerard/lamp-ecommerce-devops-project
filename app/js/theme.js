;(function ($) {
    'use strict';

    function searchFrom() {
        if (!$('.nav_searchFrom').length) {
            return;
        }

        $('.nav_searchFrom').on('click', function () {
            $('.searchForm').toggleClass('show');
            return false;
        });

        $('.form_hide').on('click', function () {
            $('.searchForm').removeClass('show');
        });
    }

    function initWow() {
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
    }

    searchFrom();
    initWow();
})(jQuery);
