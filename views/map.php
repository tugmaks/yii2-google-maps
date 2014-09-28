<div style="width: <?= $this->context->width ?>px;height: <?= $this->context->height ?>px">
    <div id="map_canvas" style="width:100%; height:100%"></div>
</div>
<script>
    function initialize() {
        var geocoder = new google.maps.Geocoder();
        var map;
<?php if (is_array($this->context->center)): ?>
            map = new google.maps.Map(document.getElementById("map_canvas"),
                    {
                        zoom: <?= $this->context->zoom ?>,
                        mapTypeId: google.maps.MapTypeId.<?= $this->context->mapType ?>,
                        center: new google.maps.LatLng(<?= $this->context->center[0] ?>, <?= $this->context->center[1] ?>)
                    }
            );
<?php else: ?>
            geocoder.geocode({
                "address": "<?= $this->context->center ?>"
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map = new google.maps.Map(document.getElementById("map_canvas"), {
                        zoom: <?= $this->context->zoom ?>,
                        mapTypeId: google.maps.MapTypeId.<?= $this->context->mapType ?>,
                        center: results[0].geometry.location
                    });
                }
            });
<?php endif; ?>

<?php if (!empty($this->context->markers) && is_array($this->context->markers)): ?>
    <?php if ($this->context->markerFitBounds): ?>
                var bounds = new google.maps.LatLngBounds();
    <?php endif; ?>
    <?php foreach ($this->context->markers as $key => $marker): ?>
        <?php if (is_array($marker['position'])): ?>
                    var marker_<?= $key ?> = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(<?= $marker['position'][0] ?>, <?= $marker['position'][1] ?>)
                    });
            <?php if ($this->context->markerFitBounds): ?>
                        
                        bounds.extend(marker_<?= $key ?>.position);
            <?php endif; ?>
        <?php else: ?>
                    geocoder.geocode({
                        "address": "<?= $marker['position'] ?>"
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var marker_<?= $key ?> = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location
                            });
            <?php if ($this->context->markerFitBounds): ?>
                               
                                bounds.extend(marker_<?= $key ?>.position);
            <?php endif; ?>
                        }
                    });
        <?php endif; ?>
    <?php endforeach; ?>
       
            map.fitBounds(bounds);
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

