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

    <script id="jsajax" src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>

</div>