<div class="enhancer_map">

    <div id="map" style="width:100%;height:500px"></div>

    <script>
        function myMap() {
            var mapCanvas = document.getElementById("map");
            var coor = new google.maps.LatLng(<?= $map->longitude ?>, <?= $map->latitude ?>);
            var mapOptions = {
                center: coor,
                zoom: 16
            };


            var map = new google.maps.Map(mapCanvas, mapOptions);

            var marker = new google.maps.Marker({
                position: coor,
                map: map,
                title: '<?= $map->title ?>'
            });

            var contentString = '<?= $map->text ?>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
    </script>
    <?php
    d(ENV);
    ?>
    <?php if (ENV == 'dev') : ?>
        <script  async defer id="jsajax" src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
    <?php elseif (isset($map->apikey) && !empty($map->apikey)) : ?>
        <script async defer id="jsajax"
                src="https://maps.googleapis.com/maps/api/js?key=<?= $map->apikey ?>&callback=myMap">
        </script>
    <?php else : ?>
        <div class="warning" style="border: 1px solid red; padding: 10px; color: red">
            Google Map API not defined
        </div>
    <?php endif; ?>

</div>