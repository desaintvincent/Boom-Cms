<footer>
    <script src="<?=BASE_URL?>Apps/Admin/Static/dist/js/admin.min.js"></script>
    <script src="<?=BASE_URL?>Apps/Admin/Static/dist/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: ".wysiwyg",
            height: 200,
            plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
            ],

            toolbar1: "styleselect | forecolor backcolor | fontselect fontsizeselect | link anchor image media code |bullist | preview",
            menubar: false,
            toolbar_items_size: 'small'
        });
    </script>
</footer>
</body>