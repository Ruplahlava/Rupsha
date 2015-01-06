<script>
    $(document).ready(function () {
        $("#nanoAlbum").nanoGallery({
            thumbnailWidth: 'auto', thumbnailHeight: 180,
            items: [
<?php foreach ($photo as $value): ?>
                    {
                        src: '<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name ?>_wm<?= $value->extension ?>', 
                        srct: '<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name ?>_thumb<?= $value->extension ?>',
                        title: '<?= $album[0]->name ?>',
                        description: '<?= $value->text ?>'
                    }<?php echo end($photo) == $value ? '': ','; ?>
<?php endforeach; ?>
            ],
            thumbnailHoverEffect: 'scale120,borderLighter',
            thumbnailLabel: {display: false},
            colorScheme: 'light',
            colorSchemeViewer: 'light',
            theme: 'light'
        });
    });
</script>