<script>
    $(document).ready(function () {
        function myImgToolbarCustInit(elementName) {
                return '';
        }
        function setHit($elements, item, data) {
            var filename = item.src.substring(item.src.lastIndexOf('/')+1);
            $.post( "<?= base_url() ?>hits/", { album: <?= $album[0]->id ?>, photo: filename } );
        }
        $("#nanoAlbum").nanoGallery({
            thumbnailWidth: 'auto', 
            thumbnailHeight: 180,
            items: [
                <?php foreach ($photo as $value): ?>{
                        src: '<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name ?>_wm<?= $value->extension ?>',
                        srct: '<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name ?>_thumb<?= $value->extension ?>',
                        title: '<?= $album[0]->name ?>',
                        description: '<?= $value->text ?>'
                    }<?php echo end($photo) == $value ? '' : ','; ?>
                <?php endforeach; ?>
                    ],
            thumbnailHoverEffect: 'scale120,borderLighter',
            viewerToolbar: {
                autoMinimize: 0,
                standard: 'closeButton,previousButton,nextButton,label,custom1'
            },
            thumbnailLabel: {
            display: false
            },
            colorScheme: 'light',
            colorSchemeViewer: 'light',
            theme: 'light',
            fnImgToolbarCustInit: myImgToolbarCustInit,
            fnImgToolbarCustDisplay: setHit
        });
    });
</script>