<?php
/**
 * Page Template
 *
 * Template Name:  Demo Font Awesome
 *
 * @file           demo-awesome.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2013 Two Impulse
 * @license        license.txt
 * @version        Release: 1.0
 */

get_header(); ?>

<div class="container">

<header class="entry-header">
    <?php if (has_post_thumbnail() && !post_password_required()) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>

    <?php endif; ?>

    <h1 class="entry-title"><?php the_title(); ?></h1>
</header>
<!-- .entry-header -->


<!--NAVBAR===DEFAULT==================================-->

<div class="row">
<div class="col-lg-4">
    <h3>Font Awesome</h3>
<p>Includes the set of 361 icons in Font Awesome</p>
    <p><i class="icon-compass icon-4x"></i> icon-compass</p>

    <p><i class="icon-collapse icon-4x"></i> icon-collapse</p>

    <p><i class="icon-collapse-top icon-4x"></i> icon-collapse-top</p>

    <p><i class="icon-expand icon-4x"></i> icon-expand</p>

    <p><i class="icon-eur icon-4x"></i> icon-eur</p>

    <p><i class="icon-euro icon-4x"></i> icon-euro <span class="muted">(alias)</span></p>

    <p><i class="icon-gbp icon-4x"></i> icon-gbp</p>

    <p><i class="icon-usd icon-4x"></i> icon-usd</p>

    <p><i class="icon-dollar icon-4x"></i> icon-dollar <span class="muted">(alias)</span></p>

    <p><i class="icon-inr icon-4x"></i> icon-inr</p>

    <p><i class="icon-rupee icon-4x"></i> icon-rupee <span class="muted">(alias)</span></p>

    <p><i class="icon-jpy icon-4x"></i> icon-jpy</p>

    <p><i class="icon-yen icon-4x"></i> icon-yen <span class="muted">(alias)</span></p>

    <p><i class="icon-cny icon-4x"></i> icon-cny</p>

    <p><i class="icon-renminbi icon-4x"></i> icon-renminbi <span class="muted">(alias)</span></p>

    <p><i class="icon-krw icon-4x"></i> icon-krw</p>

    <p><i class="icon-won icon-4x"></i> icon-won <span class="muted">(alias)</span></p>

    <p><i class="icon-btc icon-4x"></i> icon-btc</p>

    <p><i class="icon-bitcoin icon-4x"></i> icon-bitcoin <span class="muted">(alias)</span></p>

    <p><i class="icon-file icon-4x"></i> icon-file</p>

    <p><i class="icon-file-text icon-4x"></i> icon-file-text</p>

    <p><i class="icon-sort-by-alphabet icon-4x"></i> icon-sort-by-alphabet</p>

    <p><i class="icon-sort-by-alphabet-alt icon-4x"></i> icon-sort-by-alphabet-alt</p>

    <p><i class="icon-sort-by-attributes icon-4x"></i> icon-sort-by-attributes</p>

    <p><i class="icon-sort-by-attributes-alt icon-4x"></i> icon-sort-by-attributes-alt</p>

    <p><i class="icon-sort-by-order icon-4x"></i> icon-sort-by-order</p>

    <p><i class="icon-sort-by-order-alt icon-4x"></i> icon-sort-by-order-alt</p>

    <p><i class="icon-thumbs-up icon-4x"></i> icon-thumbs-up</p>

    <p><i class="icon-thumbs-down icon-4x"></i> icon-thumbs-down</p>

    <p><i class="icon-youtube-sign icon-4x"></i> icon-youtube-sign</p>

    <p><i class="icon-youtube icon-4x"></i> icon-youtube</p>

    <p><i class="icon-xing icon-4x"></i> icon-xing</p>

    <p><i class="icon-xing-sign icon-4x"></i> icon-xing-sign</p>

    <p><i class="icon-youtube-play icon-4x"></i> icon-youtube-play</p>

    <p><i class="icon-dropbox icon-4x"></i> icon-dropbox</p>

    <p><i class="icon-stackexchange icon-4x"></i> icon-stackexchange</p>

    <p><i class="icon-instagram icon-4x"></i> icon-instagram</p>

    <p><i class="icon-flickr icon-4x"></i> icon-flickr</p>

    <p><i class="icon-adn icon-4x"></i> icon-adn</p>

    <p><i class="icon-bitbucket icon-4x"></i> icon-bitbucket</p>

    <p><i class="icon-bitbucket-sign icon-4x"></i> icon-bitbucket-sign</p>

    <p><i class="icon-tumblr icon-4x"></i> icon-tumblr</p>

    <p><i class="icon-tumblr-sign icon-4x"></i> icon-tumblr-sign</p>

    <p><i class="icon-long-arrow-down icon-4x"></i> icon-long-arrow-down</p>

    <p><i class="icon-long-arrow-up icon-4x"></i> icon-long-arrow-up</p>

    <p><i class="icon-long-arrow-left icon-4x"></i> icon-long-arrow-left</p>

    <p><i class="icon-long-arrow-right icon-4x"></i> icon-long-arrow-right</p>

    <p><i class="icon-apple icon-4x"></i> icon-apple</p>

    <p><i class="icon-windows icon-4x"></i> icon-windows</p>

    <p><i class="icon-android icon-4x"></i> icon-android</p>

    <p><i class="icon-linux icon-4x"></i> icon-linux</p>

    <p><i class="icon-dribbble icon-4x"></i> icon-dribbble</p>

    <p><i class="icon-skype icon-4x"></i> icon-skype</p>

    <p><i class="icon-foursquare icon-4x"></i> icon-foursquare</p>

    <p><i class="icon-trello icon-4x"></i> icon-trello</p>

    <p><i class="icon-female icon-4x"></i> icon-female</p>

    <p><i class="icon-male icon-4x"></i> icon-male</p>

    <p><i class="icon-gittip icon-4x"></i> icon-gittip</p>

    <p><i class="icon-sun icon-4x"></i> icon-sun</p>

    <p><i class="icon-moon icon-4x"></i> icon-moon</p>

    <p><i class="icon-archive icon-4x"></i> icon-archive</p>

    <p><i class="icon-bug icon-4x"></i> icon-bug</p>

    <p><i class="icon-vk icon-4x"></i> icon-vk</p>

    <p><i class="icon-weibo icon-4x"></i> icon-weibo</p>

    <p><i class="icon-renren icon-4x"></i> icon-renren</p>
</div>
<div class="col-lg-8">
<h3>Glyphicons</h3>

<p>Includes 180 glyphs in font format from the Glyphicon Halflings set. <a href="http://glyphicons.com/">Glyphicons</a>
    Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost.
    As a thank you, we only ask that you to include a link back to <a href="http://glyphicons.com/">Glyphicons</a>
    whenever possible.</p>
<ul class="bs-glyphicons">
<li><span class="glyphicon glyphicon-adjust"></span> .glyphicon .glyphicon-adjust</li>
<li><span class="glyphicon glyphicon-align-center"></span> .glyphicon .glyphicon-align-center</li>
<li><span class="glyphicon glyphicon-align-justify"></span> .glyphicon .glyphicon-align-justify</li>
<li><span class="glyphicon glyphicon-align-left"></span> .glyphicon .glyphicon-align-left</li>
<li><span class="glyphicon glyphicon-align-right"></span> .glyphicon .glyphicon-align-right</li>
<li><span class="glyphicon glyphicon-arrow-down"></span> .glyphicon .glyphicon-arrow-down</li>
<li><span class="glyphicon glyphicon-arrow-left"></span> .glyphicon .glyphicon-arrow-left</li>
<li><span class="glyphicon glyphicon-arrow-right"></span> .glyphicon .glyphicon-arrow-right</li>
<li><span class="glyphicon glyphicon-arrow-up"></span> .glyphicon .glyphicon-arrow-up</li>
<li><span class="glyphicon glyphicon-asterisk"></span> .glyphicon .glyphicon-asterisk</li>
<li><span class="glyphicon glyphicon-backward"></span> .glyphicon .glyphicon-backward</li>
<li><span class="glyphicon glyphicon-ban-circle"></span> .glyphicon .glyphicon-ban-circle</li>
<li><span class="glyphicon glyphicon-barcode"></span> .glyphicon .glyphicon-barcode</li>
<li><span class="glyphicon glyphicon-bell"></span> .glyphicon .glyphicon-bell</li>
<li><span class="glyphicon glyphicon-bold"></span> .glyphicon .glyphicon-bold</li>
<li><span class="glyphicon glyphicon-book"></span> .glyphicon .glyphicon-book</li>
<li><span class="glyphicon glyphicon-bookmark"></span> .glyphicon .glyphicon-bookmark</li>
<li><span class="glyphicon glyphicon-briefcase"></span> .glyphicon .glyphicon-briefcase</li>
<li><span class="glyphicon glyphicon-bullhorn"></span> .glyphicon .glyphicon-bullhorn</li>
<li><span class="glyphicon glyphicon-calendar"></span> .glyphicon .glyphicon-calendar</li>
<li><span class="glyphicon glyphicon-camera"></span> .glyphicon .glyphicon-camera</li>
<li><span class="glyphicon glyphicon-certificate"></span> .glyphicon .glyphicon-certificate</li>
<li><span class="glyphicon glyphicon-check"></span> .glyphicon .glyphicon-check</li>
<li><span class="glyphicon glyphicon-chevron-down"></span> .glyphicon .glyphicon-chevron-down</li>
<li><span class="glyphicon glyphicon-chevron-left"></span> .glyphicon .glyphicon-chevron-left</li>
<li><span class="glyphicon glyphicon-chevron-right"></span> .glyphicon .glyphicon-chevron-right</li>
<li><span class="glyphicon glyphicon-chevron-up"></span> .glyphicon .glyphicon-chevron-up</li>
<li><span class="glyphicon glyphicon-circle-arrow-down"></span> .glyphicon .glyphicon-circle-arrow-down</li>
<li><span class="glyphicon glyphicon-circle-arrow-left"></span> .glyphicon .glyphicon-circle-arrow-left</li>
<li><span class="glyphicon glyphicon-circle-arrow-right"></span> .glyphicon .glyphicon-circle-arrow-right</li>
<li><span class="glyphicon glyphicon-circle-arrow-up"></span> .glyphicon .glyphicon-circle-arrow-up</li>
<li><span class="glyphicon glyphicon-cloud"></span> .glyphicon .glyphicon-cloud</li>
<li><span class="glyphicon glyphicon-cloud-download"></span> .glyphicon .glyphicon-cloud-download</li>
<li><span class="glyphicon glyphicon-cloud-upload"></span> .glyphicon .glyphicon-cloud-upload</li>
<li><span class="glyphicon glyphicon-cog"></span> .glyphicon .glyphicon-cog</li>
<li><span class="glyphicon glyphicon-collapse-down"></span> .glyphicon .glyphicon-collapse-down</li>
<li><span class="glyphicon glyphicon-collapse-up"></span> .glyphicon .glyphicon-collapse-up</li>
<li><span class="glyphicon glyphicon-comment"></span> .glyphicon .glyphicon-comment</li>
<li><span class="glyphicon glyphicon-compressed"></span> .glyphicon .glyphicon-compressed</li>
<li><span class="glyphicon glyphicon-copyright-mark"></span> .glyphicon .glyphicon-copyright-mark</li>
<li><span class="glyphicon glyphicon-credit-card"></span> .glyphicon .glyphicon-credit-card</li>
<li><span class="glyphicon glyphicon-cutlery"></span> .glyphicon .glyphicon-cutlery</li>
<li><span class="glyphicon glyphicon-dashboard"></span> .glyphicon .glyphicon-dashboard</li>
<li><span class="glyphicon glyphicon-download"></span> .glyphicon .glyphicon-download</li>
<li><span class="glyphicon glyphicon-download-alt"></span> .glyphicon .glyphicon-download-alt</li>
<li><span class="glyphicon glyphicon-earphone"></span> .glyphicon .glyphicon-earphone</li>
<li><span class="glyphicon glyphicon-edit"></span> .glyphicon .glyphicon-edit</li>
<li><span class="glyphicon glyphicon-eject"></span> .glyphicon .glyphicon-eject</li>
<li><span class="glyphicon glyphicon-envelope"></span> .glyphicon .glyphicon-envelope</li>
<li><span class="glyphicon glyphicon-euro"></span> .glyphicon .glyphicon-euro</li>
<li><span class="glyphicon glyphicon-exclamation-sign"></span> .glyphicon .glyphicon-exclamation-sign</li>
<li><span class="glyphicon glyphicon-expand"></span> .glyphicon .glyphicon-expand</li>
<li><span class="glyphicon glyphicon-export"></span> .glyphicon .glyphicon-export</li>
<li><span class="glyphicon glyphicon-eye-close"></span> .glyphicon .glyphicon-eye-close</li>
<li><span class="glyphicon glyphicon-eye-open"></span> .glyphicon .glyphicon-eye-open</li>
<li><span class="glyphicon glyphicon-facetime-video"></span> .glyphicon .glyphicon-facetime-video</li>
<li><span class="glyphicon glyphicon-fast-backward"></span> .glyphicon .glyphicon-fast-backward</li>
<li><span class="glyphicon glyphicon-fast-forward"></span> .glyphicon .glyphicon-fast-forward</li>
<li><span class="glyphicon glyphicon-file"></span> .glyphicon .glyphicon-file</li>
<li><span class="glyphicon glyphicon-film"></span> .glyphicon .glyphicon-film</li>
<li><span class="glyphicon glyphicon-filter"></span> .glyphicon .glyphicon-filter</li>
<li><span class="glyphicon glyphicon-fire"></span> .glyphicon .glyphicon-fire</li>
<li><span class="glyphicon glyphicon-flag"></span> .glyphicon .glyphicon-flag</li>
<li><span class="glyphicon glyphicon-flash"></span> .glyphicon .glyphicon-flash</li>
<li><span class="glyphicon glyphicon-floppy-disk"></span> .glyphicon .glyphicon-floppy-disk</li>
<li><span class="glyphicon glyphicon-floppy-open"></span> .glyphicon .glyphicon-floppy-open</li>
<li><span class="glyphicon glyphicon-floppy-remove"></span> .glyphicon .glyphicon-floppy-remove</li>
<li><span class="glyphicon glyphicon-floppy-save"></span> .glyphicon .glyphicon-floppy-save</li>
<li><span class="glyphicon glyphicon-floppy-saved"></span> .glyphicon .glyphicon-floppy-saved</li>
<li><span class="glyphicon glyphicon-folder-close"></span> .glyphicon .glyphicon-folder-close</li>
<li><span class="glyphicon glyphicon-folder-open"></span> .glyphicon .glyphicon-folder-open</li>
<li><span class="glyphicon glyphicon-font"></span> .glyphicon .glyphicon-font</li>
<li><span class="glyphicon glyphicon-forward"></span> .glyphicon .glyphicon-forward</li>
<li><span class="glyphicon glyphicon-fullscreen"></span> .glyphicon .glyphicon-fullscreen</li>
<li><span class="glyphicon glyphicon-gbp"></span> .glyphicon .glyphicon-gbp</li>
<li><span class="glyphicon glyphicon-gift"></span> .glyphicon .glyphicon-gift</li>
<li><span class="glyphicon glyphicon-glass"></span> .glyphicon .glyphicon-glass</li>
<li><span class="glyphicon glyphicon-globe"></span> .glyphicon .glyphicon-globe</li>
<li><span class="glyphicon glyphicon-hand-down"></span> .glyphicon .glyphicon-hand-down</li>
<li><span class="glyphicon glyphicon-hand-left"></span> .glyphicon .glyphicon-hand-left</li>
<li><span class="glyphicon glyphicon-hand-right"></span> .glyphicon .glyphicon-hand-right</li>
<li><span class="glyphicon glyphicon-hand-up"></span> .glyphicon .glyphicon-hand-up</li>
<li><span class="glyphicon glyphicon-hd-video"></span> .glyphicon .glyphicon-hd-video</li>
<li><span class="glyphicon glyphicon-hdd"></span> .glyphicon .glyphicon-hdd</li>
<li><span class="glyphicon glyphicon-header"></span> .glyphicon .glyphicon-header</li>
<li><span class="glyphicon glyphicon-headphones"></span> .glyphicon .glyphicon-headphones</li>
<li><span class="glyphicon glyphicon-heart"></span> .glyphicon .glyphicon-heart</li>
<li><span class="glyphicon glyphicon-heart-empty"></span> .glyphicon .glyphicon-heart-empty</li>
<li><span class="glyphicon glyphicon-home"></span> .glyphicon .glyphicon-home</li>
<li><span class="glyphicon glyphicon-import"></span> .glyphicon .glyphicon-import</li>
<li><span class="glyphicon glyphicon-inbox"></span> .glyphicon .glyphicon-inbox</li>
<li><span class="glyphicon glyphicon-indent-left"></span> .glyphicon .glyphicon-indent-left</li>
<li><span class="glyphicon glyphicon-indent-right"></span> .glyphicon .glyphicon-indent-right</li>
<li><span class="glyphicon glyphicon-info-sign"></span> .glyphicon .glyphicon-info-sign</li>
<li><span class="glyphicon glyphicon-italic"></span> .glyphicon .glyphicon-italic</li>
<li><span class="glyphicon glyphicon-leaf"></span> .glyphicon .glyphicon-leaf</li>
<li><span class="glyphicon glyphicon-link"></span> .glyphicon .glyphicon-link</li>
<li><span class="glyphicon glyphicon-list"></span> .glyphicon .glyphicon-list</li>
<li><span class="glyphicon glyphicon-list-alt"></span> .glyphicon .glyphicon-list-alt</li>
<li><span class="glyphicon glyphicon-lock"></span> .glyphicon .glyphicon-lock</li>
<li><span class="glyphicon glyphicon-log-in"></span> .glyphicon .glyphicon-log-in</li>
<li><span class="glyphicon glyphicon-log-out"></span> .glyphicon .glyphicon-log-out</li>
<li><span class="glyphicon glyphicon-magnet"></span> .glyphicon .glyphicon-magnet</li>
<li><span class="glyphicon glyphicon-map-marker"></span> .glyphicon .glyphicon-map-marker</li>
<li><span class="glyphicon glyphicon-minus"></span> .glyphicon .glyphicon-minus</li>
<li><span class="glyphicon glyphicon-minus-sign"></span> .glyphicon .glyphicon-minus-sign</li>
<li><span class="glyphicon glyphicon-move"></span> .glyphicon .glyphicon-move</li>
<li><span class="glyphicon glyphicon-music"></span> .glyphicon .glyphicon-music</li>
<li><span class="glyphicon glyphicon-new-window"></span> .glyphicon .glyphicon-new-window</li>
<li><span class="glyphicon glyphicon-off"></span> .glyphicon .glyphicon-off</li>
<li><span class="glyphicon glyphicon-ok"></span> .glyphicon .glyphicon-ok</li>
<li><span class="glyphicon glyphicon-ok-circle"></span> .glyphicon .glyphicon-ok-circle</li>
<li><span class="glyphicon glyphicon-ok-sign"></span> .glyphicon .glyphicon-ok-sign</li>
<li><span class="glyphicon glyphicon-open"></span> .glyphicon .glyphicon-open</li>
<li><span class="glyphicon glyphicon-paperclip"></span> .glyphicon .glyphicon-paperclip</li>
<li><span class="glyphicon glyphicon-pause"></span> .glyphicon .glyphicon-pause</li>
<li><span class="glyphicon glyphicon-pencil"></span> .glyphicon .glyphicon-pencil</li>
<li><span class="glyphicon glyphicon-phone"></span> .glyphicon .glyphicon-phone</li>
<li><span class="glyphicon glyphicon-phone-alt"></span> .glyphicon .glyphicon-phone-alt</li>
<li><span class="glyphicon glyphicon-picture"></span> .glyphicon .glyphicon-picture</li>
<li><span class="glyphicon glyphicon-plane"></span> .glyphicon .glyphicon-plane</li>
<li><span class="glyphicon glyphicon-play"></span> .glyphicon .glyphicon-play</li>
<li><span class="glyphicon glyphicon-play-circle"></span> .glyphicon .glyphicon-play-circle</li>
<li><span class="glyphicon glyphicon-plus"></span> .glyphicon .glyphicon-plus</li>
<li><span class="glyphicon glyphicon-plus-sign"></span> .glyphicon .glyphicon-plus-sign</li>
<li><span class="glyphicon glyphicon-print"></span> .glyphicon .glyphicon-print</li>
<li><span class="glyphicon glyphicon-pushpin"></span> .glyphicon .glyphicon-pushpin</li>
<li><span class="glyphicon glyphicon-qrcode"></span> .glyphicon .glyphicon-qrcode</li>
<li><span class="glyphicon glyphicon-question-sign"></span> .glyphicon .glyphicon-question-sign</li>
<li><span class="glyphicon glyphicon-random"></span> .glyphicon .glyphicon-random</li>
<li><span class="glyphicon glyphicon-record"></span> .glyphicon .glyphicon-record</li>
<li><span class="glyphicon glyphicon-refresh"></span> .glyphicon .glyphicon-refresh</li>
<li><span class="glyphicon glyphicon-registration-mark"></span> .glyphicon .glyphicon-registration-mark</li>
<li><span class="glyphicon glyphicon-remove"></span> .glyphicon .glyphicon-remove</li>
<li><span class="glyphicon glyphicon-remove-circle"></span> .glyphicon .glyphicon-remove-circle</li>
<li><span class="glyphicon glyphicon-remove-sign"></span> .glyphicon .glyphicon-remove-sign</li>
<li><span class="glyphicon glyphicon-repeat"></span> .glyphicon .glyphicon-repeat</li>
<li><span class="glyphicon glyphicon-resize-full"></span> .glyphicon .glyphicon-resize-full</li>
<li><span class="glyphicon glyphicon-resize-horizontal"></span> .glyphicon .glyphicon-resize-horizontal</li>
<li><span class="glyphicon glyphicon-resize-small"></span> .glyphicon .glyphicon-resize-small</li>
<li><span class="glyphicon glyphicon-resize-vertical"></span> .glyphicon .glyphicon-resize-vertical</li>
<li><span class="glyphicon glyphicon-retweet"></span> .glyphicon .glyphicon-retweet</li>
<li><span class="glyphicon glyphicon-road"></span> .glyphicon .glyphicon-road</li>
<li><span class="glyphicon glyphicon-save"></span> .glyphicon .glyphicon-save</li>
<li><span class="glyphicon glyphicon-saved"></span> .glyphicon .glyphicon-saved</li>
<li><span class="glyphicon glyphicon-screenshot"></span> .glyphicon .glyphicon-screenshot</li>
<li><span class="glyphicon glyphicon-sd-video"></span> .glyphicon .glyphicon-sd-video</li>
<li><span class="glyphicon glyphicon-search"></span> .glyphicon .glyphicon-search</li>
<li><span class="glyphicon glyphicon-send"></span> .glyphicon .glyphicon-send</li>
<li><span class="glyphicon glyphicon-share"></span> .glyphicon .glyphicon-share</li>
<li><span class="glyphicon glyphicon-share-alt"></span> .glyphicon .glyphicon-share-alt</li>
<li><span class="glyphicon glyphicon-shopping-cart"></span> .glyphicon .glyphicon-shopping-cart</li>
<li><span class="glyphicon glyphicon-signal"></span> .glyphicon .glyphicon-signal</li>
<li><span class="glyphicon glyphicon-sort"></span> .glyphicon .glyphicon-sort</li>
<li><span class="glyphicon glyphicon-sort-by-alphabet"></span> .glyphicon .glyphicon-sort-by-alphabet</li>
<li><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span> .glyphicon .glyphicon-sort-by-alphabet-alt</li>
<li><span class="glyphicon glyphicon-sort-by-attributes"></span> .glyphicon .glyphicon-sort-by-attributes</li>
<li><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> .glyphicon .glyphicon-sort-by-attributes-alt</li>
<li><span class="glyphicon glyphicon-sort-by-order"></span> .glyphicon .glyphicon-sort-by-order</li>
<li><span class="glyphicon glyphicon-sort-by-order-alt"></span> .glyphicon .glyphicon-sort-by-order-alt</li>
<li><span class="glyphicon glyphicon-sound-5-1"></span> .glyphicon .glyphicon-sound-5-1</li>
<li><span class="glyphicon glyphicon-sound-6-1"></span> .glyphicon .glyphicon-sound-6-1</li>
<li><span class="glyphicon glyphicon-sound-7-1"></span> .glyphicon .glyphicon-sound-7-1</li>
<li><span class="glyphicon glyphicon-sound-dolby"></span> .glyphicon .glyphicon-sound-dolby</li>
<li><span class="glyphicon glyphicon-sound-stereo"></span> .glyphicon .glyphicon-sound-stereo</li>
<li><span class="glyphicon glyphicon-star"></span> .glyphicon .glyphicon-star</li>
<li><span class="glyphicon glyphicon-star-empty"></span> .glyphicon .glyphicon-star-empty</li>
<li><span class="glyphicon glyphicon-stats"></span> .glyphicon .glyphicon-stats</li>
<li><span class="glyphicon glyphicon-step-backward"></span> .glyphicon .glyphicon-step-backward</li>
<li><span class="glyphicon glyphicon-step-forward"></span> .glyphicon .glyphicon-step-forward</li>
<li><span class="glyphicon glyphicon-stop"></span> .glyphicon .glyphicon-stop</li>
<li><span class="glyphicon glyphicon-subtitles"></span> .glyphicon .glyphicon-subtitles</li>
<li><span class="glyphicon glyphicon-tag"></span> .glyphicon .glyphicon-tag</li>
<li><span class="glyphicon glyphicon-tags"></span> .glyphicon .glyphicon-tags</li>
<li><span class="glyphicon glyphicon-tasks"></span> .glyphicon .glyphicon-tasks</li>
<li><span class="glyphicon glyphicon-text-height"></span> .glyphicon .glyphicon-text-height</li>
<li><span class="glyphicon glyphicon-text-width"></span> .glyphicon .glyphicon-text-width</li>
<li><span class="glyphicon glyphicon-th"></span> .glyphicon .glyphicon-th</li>
<li><span class="glyphicon glyphicon-th-large"></span> .glyphicon .glyphicon-th-large</li>
<li><span class="glyphicon glyphicon-th-list"></span> .glyphicon .glyphicon-th-list</li>
<li><span class="glyphicon glyphicon-thumbs-down"></span> .glyphicon .glyphicon-thumbs-down</li>
<li><span class="glyphicon glyphicon-thumbs-up"></span> .glyphicon .glyphicon-thumbs-up</li>
<li><span class="glyphicon glyphicon-time"></span> .glyphicon .glyphicon-time</li>
<li><span class="glyphicon glyphicon-tint"></span> .glyphicon .glyphicon-tint</li>
<li><span class="glyphicon glyphicon-tower"></span> .glyphicon .glyphicon-tower</li>
<li><span class="glyphicon glyphicon-transfer"></span> .glyphicon .glyphicon-transfer</li>
<li><span class="glyphicon glyphicon-trash"></span> .glyphicon .glyphicon-trash</li>
<li><span class="glyphicon glyphicon-tree-conifer"></span> .glyphicon .glyphicon-tree-conifer</li>
<li><span class="glyphicon glyphicon-tree-deciduous"></span> .glyphicon .glyphicon-tree-deciduous</li>
<li><span class="glyphicon glyphicon-unchecked"></span> .glyphicon .glyphicon-unchecked</li>
<li><span class="glyphicon glyphicon-upload"></span> .glyphicon .glyphicon-upload</li>
<li><span class="glyphicon glyphicon-usd"></span> .glyphicon .glyphicon-usd</li>
<li><span class="glyphicon glyphicon-user"></span> .glyphicon .glyphicon-user</li>
<li><span class="glyphicon glyphicon-volume-down"></span> .glyphicon .glyphicon-volume-down</li>
<li><span class="glyphicon glyphicon-volume-off"></span> .glyphicon .glyphicon-volume-off</li>
<li><span class="glyphicon glyphicon-volume-up"></span> .glyphicon .glyphicon-volume-up</li>
<li><span class="glyphicon glyphicon-warning-sign"></span> .glyphicon .glyphicon-warning-sign</li>
<li><span class="glyphicon glyphicon-wrench"></span> .glyphicon .glyphicon-wrench</li>
<li><span class="glyphicon glyphicon-zoom-in"></span> .glyphicon .glyphicon-zoom-in</li>
<li><span class="glyphicon glyphicon-zoom-out"></span> .glyphicon .glyphicon-zoom-out</li>
</ul>

</div>
</div>
</div>
<!-- /.container -->

<?php get_footer(); ?>