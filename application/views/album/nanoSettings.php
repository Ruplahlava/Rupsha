<script>
    $(document).ready(function () {
        function myImgToolbarCustInit(elementName) {
                return '<div class="fb-like" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>';
                return 'asd';
        }
        function changeFileUrl(filename, album, baseUrl){
            if (window.history.replaceState) {
                //prevents browser from storing history with each change:
                var noExtension =  filename.slice(0,-7);
                var newUrl = baseUrl+'s/'+album+'/'+noExtension+'/';
                window.history.replaceState('', $(document).find("title").text(), newUrl);
            }
        }
        function addViewed(filename){
            $.post("<?= base_url() ?>hits/", {album: <?= $album[0]->id ?>, photo: filename});
        }
        function viewerClosed(){
            if (window.history.replaceState) {
                var newUrl = '<?= base_url().$album[0]->hash ?>' ;
                window.history.replaceState('', $(document).find("title").text(), newUrl);
            }
        }

        function imageViewed($elements, item, data) {
            var filename = item.src.substring(item.src.lastIndexOf('/') + 1);
            var album = '<?= $album[0]->hash ?>';
            var baseUrl = '<?= base_url() ?>';
            changeFileUrl(filename, album, baseUrl);
            addViewed(filename);
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
            fnImgToolbarCustDisplay: imageViewed,
            fnImgToolbarCustClose: viewerClosed
        });
    });
</script>