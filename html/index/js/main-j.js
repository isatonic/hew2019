jQuery(document).ready(function (event) {
    let isAnimating = false,
        newLocation = '',
        firstLoad = false;

    $('main').on('click', '[data-type="page-transition"]', function (event) {
        event.preventDefault();
        let newPage = $(this).attr('href');
        if (!isAnimating) {
            changePage(newPage, true);
        }
        firstLoad = true;
    });

    $(window).on('popstate', function () {
        if (firstLoad) {
            let newPageArray = location.pathname.split('/'),
                newPage = newPageArray[newPageArray.length - 1];

            if (!isAnimating && newLocation !== newPage) {
                changePage(newPage, false);
            }
        } else {
            firstLoad = true;
        }
    });

    function changePage(url, bool) {
        isAnimating = true;
        $('body').addClass('page-is-changing');
        $('.cd-loading-bar').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
            loadNewContent(url, bool);
            newLocation = url;
            $('.cd-loading-bar').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
        });
        if (!transitionsSupported()) {
            loadNewContent(url, bool);
            newLocation = url;
        }
    }

    function loadNewContent(url, bool) {
        if (url === '') {
            url = 'index.html';
        }
        let newSection = 'cd-' + url.replace('.html', '');
        let section = $('<div class="cd-main-content ' + newSection + '"></div>');

        section.load(url + ' .cd-main-content > *', function (event) {
            $('main').html(section);
            let delay = (transitionsSupported()) ? 1200 : 0;
            setTimeout(function () {
                (section.hasClass('cd-about')) ? $('body').addClass('cd-about') : $('body').removeClass('cd-about');
                $('body').removeClass('page-is-changing');
                $('.cd-loading-bar').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                    isAnimating = false;
                    $('.cd-loading-bar').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
                });

                if (!transitionsSupported()) {
                    isAnimating = false;
                }
            }, delay);

            if (url !== window.location && bool) {
                window.history.pushState({path: url}, '', url);
            }
        });
    }

    function transitionsSupported() {
        return $('html').hasClass('csstransitions');
    }
});