<script>
    $(document).ready(function () {
        $("#nanoAlbum").nanoGallery({
            thumbnailWidth: 100, thumbnailHeight: 100,
            items: [
<?php foreach ($photo as $value): ?>
                    {
                        src: '<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name ?>_wm<?= $value->extension ?>', // image url
                        srct: '<?= base_url() ?>img/user/<?= $user[0]->login ?>/<?= $album[0]->id ?>/<?= $value->name ?>_thumb<?= $value->extension ?>', // thumbnail url
                        title: '<?= $album[0]->name ?>', // thumbnail title
                        description: '<?= $value->text ?>'		// thumbnail description
                    }<?php echo end($photo) == $value ? '': ','; ?>
<?php endforeach; ?>
            ]
        });
    });
</script>
<img src="">