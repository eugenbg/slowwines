<?php
?>
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides">


    </div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">&lsaquo;</a>
    <a class="next">&rsaquo;</a>
    <a class="close"><i class="glyphicon glyphicon-remove"></i></a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(window).load(function() {
        var $container = $('.masonry').masonry({
            itemSelector: '.item',
            columnWidth: ".grid-sizer"
        });

        var borderless = true;
        var fullscreen = false;

        var $gallery = $('#blueimp-gallery');

        $gallery.data('fullScreen', fullscreen);
        $gallery.data('useBootstrapModal', !borderless);


        $gallery.toggleClass('blueimp-gallery-controls', borderless);

        var $itemList = $('.item');
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


</script>

