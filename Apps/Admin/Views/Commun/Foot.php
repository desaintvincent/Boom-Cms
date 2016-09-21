<footer>

    <script src="<?=BASE_URL?>Apps/Admin/Static/dist/js/admin.min.js"></script>
    <script src="<?=BASE_URL?>Apps/Admin/Static/dist/js/tinymce/tinymce.min.js"></script>
    <script>
        console.log("<?=str_replace("'", "&apos;", addslashes(json_encode($enhancers['list_products_category'])))?>");
        tinymce.init({
            selector: ".wysiwyg",
            height: 200,
            content_css : '<?=BASE_URL?>Apps/Admin/Static/dist/css/wysiwyg.css',
            plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern noneditable"
            ],

            toolbar1: "styleselect | forecolor backcolor | fontselect fontsizeselect | link anchor image media code |bullist | preview | myapps",
            menubar: false,
            toolbar_items_size: 'small',
            extended_valid_elements : "~enhancer[class|data-options]",
            custom_elements: "~enhancer",
            noneditable_noneditable_class: "noneditable",
            noneditable_regexp: [/<enhancer>(.*?)<\/enhancer>/g],
            /*protect: [
                /\<\/?(if|endif)\>/g, // Protect <if> & </endif>
                /\<xsl\:[^>]+\>/g, // Protect <xsl:...>
                /<\?php.*?\?>/g // Protect php code
            ],*/
            setup: function(editor) {
                editor.addButton('myapps', {
                    type: 'menubutton',
                    text: '<?=__('Ajouter une application')?>',
                    icon: false,
                    menu: [
                        <?php foreach ($enhancers as $key => $enhancer) : ?>
                        {
                            text: "<?=addslashes($enhancer['name'])?>",
                            onclick: function() {
                                editor.insertContent('<enhancer class="noneditable <?=$key?>" data-params=\'' + '<?= str_replace("'", "&apos;", addslashes(json_encode($enhancer)))?>' + '\'><?=addslashes($enhancer['name'])?></enhancer>');
                            }
                        },
                        <?php endforeach; ?>
                    ]
                });
            }
        });
    </script>
</footer>
</body>