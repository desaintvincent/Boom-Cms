<footer class="footer <?=!\Boom\Helper\Auth::connected() ? 'full' : '' ?>">
    <div class="wrapper">
        <span>Made by <?php /*/ ?><a href="http://www.swith.fr/" target="_blank">Jeremy SMITH</a> & <?php /*/ ?><a href="http://www.desaintvincent.com/" target="_blank">Thomas ROBERT de SAINT VINCENT</a> pour le projet KIM TAN. © 2016 Copyright.</span>
    </div>
    <script src="<?=BASE_URL?>Apps/Admin/Static/dist/js/admin.js"></script>
    <script src="<?=BASE_URL?>Apps/Admin/Static/dist/js/tinymce/tinymce.min.js"></script>
    <script>
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
            protect: [
                /\<\/?(if|endif)\>/g, // Protect <if> & </endif>
                /\<xsl\:[^>]+\>/g, // Protect <xsl:...>
                /<\?php.*?\?>/g // Protect php code
            ],
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
                                editor.insertContent('<enhancer class="noneditable <?=$key?>" data-params="' + '<?= str_replace("\"", "'", str_replace("'", "&appostroph;", addslashes(json_encode($enhancer))))?>' + '"><?=addslashes($enhancer['name'])?></enhancer>');
                            }
                        },
                        <?php endforeach; ?>
                    ]
                });
            }
        });
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-72853064-3', 'auto');
        ga('send', 'pageview');

    </script>
</footer>
</body>