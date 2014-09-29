<div style="width: <?= $this->context->width ?>px;height: <?= $this->context->height ?>px">
    <div id="map_canvas" style="width:100%; height:100%"></div>
</div>
<script>
    var map;
    function initialize() {
        var geocoder = new google.maps.Geocoder();
        window.map = new google.maps.Map(document.getElementById("map_canvas"),
                {
                    zoom: <?= $this->context->zoom ?>,
                    mapTypeId: google.maps.MapTypeId.<?= $this->context->mapType ?>,
                    center: new google.maps.LatLng(0, 0)
                }
        );
<?php if (is_array($this->context->center)): ?>
            window.map.setCenter(new google.maps.LatLng(<?= $this->context->center[0] ?>, <?= $this->context->center[1] ?>));
<?php else: ?>
            geocoder.geocode({
                "address": "<?= $this->context->center ?>"
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    window.map.setCenter(results[0].geometry.location);
                }
            });
<?php endif; ?>

<?php if (!empty($this->context->markers) && is_array($this->context->markers)): ?>
    <?php if ($this->context->markerFitBounds): ?>
                var bounds = new google.maps.LatLngBounds();
    <?php endif; ?>
    <?php foreach ($this->context->markers as $key => $marker): ?>
                var marker_<?= $key ?> = new google.maps.Marker({
                    map: window.map
                });
        <?php if (is_array($marker['position'])): ?>
                    marker_<?= $key ?>.setPosition(new google.maps.LatLng(<?= $marker['position'][0] ?>, <?= $marker['position'][1] ?>));
            <?php if ($this->context->markerFitBounds): ?>
                        bounds.extend(marker_<?= $key ?>.position);
                        window.map.fitBounds(bounds);
            <?php endif; ?>
        <?php else: ?>
                    geocoder.geocode({
                        "address": "<?= $marker['position'] ?>"
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            marker_<?= $key ?>.setPosition(results[0].geometry.location));
            <?php if ($this->context->markerFitBounds): ?>
                                bounds.extend(results[0].geometry.location);
                                window.map.fitBounds(bounds);
            <?php endif; ?>
                        }
                    });
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>


    }
    function loadScript() {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://maps.googleapis.com/maps/api/js?key=<?= $this->context->apiKey ?>&sensor=<?= $this->context->sensor ?>&callback=initialize";
        document.body.appendChild(script);
    }
    window.onload = loadScript;
</script>

