<?php
/*

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <?php if (isset($params['crud'])) : ?>
            <form class="form-signin" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?= \Apps\Admin\Ctrl\Admin::view_static('crud', ['crud' => $params['crud']]); ?>
                <button class="btn btn-primary" type="submit">Enregistrer les informations</button>
            </form>
            <?php endif ?>
        </div>
    </div>
</div>

 */
?>
<?php if (isset($config->apikey) && !empty($config->apikey)) : ?>
<div id="embed-api-auth-container" style="    border-bottom: 1px solid #FC5050;
    margin-bottom: 1em;
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 1.5em;
    padding: 0.5em 25px 0.5em 0;"></div>
<div id="chart-container"></div>
<div id="view-selector-container"></div>
<script>
    (function(w,d,s,g,js,fs){
        g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
        js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
        js.src='https://apis.google.com/js/platform.js';
        fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    }(window,document,'script'));
</script>
<script>
    var CLIENT_ID = '<?=$config->apikey?>';
    gapi.analytics.ready(function() {

        /**
         * Authorize the user immediately if the user has already granted access.
         * If no access has been created, render an authorize button inside the
         * element with the ID "embed-api-auth-container".
         */
        gapi.analytics.auth.authorize({
            container: 'embed-api-auth-container',
            clientid: CLIENT_ID
        });


        /**
         * Create a new ViewSelector instance to be rendered inside of an
         * element with the id "view-selector-container".
         */
        var viewSelector = new gapi.analytics.ViewSelector({
            container: 'view-selector-container'
        });

        // Render the view selector to the page.
        viewSelector.execute();


        /**
         * Create a new DataChart instance with the given query parameters
         * and Google chart options. It will be rendered inside an element
         * with the id "chart-container".
         */
        var dataChart = new gapi.analytics.googleCharts.DataChart({
            query: {
                metrics: 'ga:sessions',
                dimensions: 'ga:date',
                'start-date': '30daysAgo',
                'end-date': 'yesterday'
            },
            chart: {
                container: 'chart-container',
                type: 'LINE',
                options: {
                    width: '100%'
                }
            }
        });

        gapi.analytics.auth.on('success', function(response) {
            //hide the auth-button
            document.querySelector("#view-selector-container").style.display='none';

            timeline.execute();

        });
        /**
         * Render the dataChart on the page whenever a new view is selected.
         */
        viewSelector.on('change', function(ids) {
            dataChart.set({query: {ids: ids}}).execute();
        });

    });
</script>
<?php else : ?>
    <h1><?= __('La clé d\'API Google Analytics n\'est pas définie') ?></h1>
<?php endif ?>
