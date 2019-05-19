$(window).load(function() {
    $('.masonry').each(function(k, element) {
        var $gallery = $('#blueimp-gallery');
        var borderless = true;
        var fullscreen = false;

        var $container = $('.masonry').masonry({
            container: element,
            itemSelector: '.item',
            columnWidth: ".grid-sizer"
        });

        var $itemList = $('.item', element);

        $gallery.data('fullScreen', fullscreen);
        $gallery.data('useBootstrapModal', !borderless);
        $gallery.toggleClass('blueimp-gallery-controls', borderless);

        $itemList.on('click', function (event) {
            event.preventDefault();
            var index = $(this).data('index');
            $gallery.data('index', index);
            blueimp.Gallery(
                $itemList,
                $gallery.data()
            );
        });
    });

    $('.gallery-carousel').each(function(k, element) {
        var $container = $('.blueimp-gallery-carousel', element);
        var $elements = $('.item', element);
        blueimp.Gallery(
            $elements,
            {
                container: $container,
                stretchImages: 'cover',
                carousel: true
            }
        );
        $('> a', element).hide();
    });
});