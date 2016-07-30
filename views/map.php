<?php
$divId = $this->context->id == null ? 'map_canvas' : $this->context->id;
?>

<div style="width: <?= $this->context->width . $this->context->widthUnits ?>;
    height: <?= $this->context->height . $this->context->heightUnits ?>">
    <div id="<?= $divId ?>"
         style="width:100%; height:100%"></div>
</div>
<script>
    var map;
    var bounds;
    function initialize_<?=md5($divId)?>() {
        var geocoder = new google.maps.Geocoder();
        window.map = new google.maps.Map(document.getElementById("<?=$divId?>"),
            {
                zoom: <?= $this->context->zoom ?>,
                mapTypeId: google.maps.MapTypeId.<?= $this->context->mapType ?>,
                center: new google.maps.LatLng(0, 0),
                scrollwheel:<?=($this->context->scrollwheel) ? 'true' : 'false'?>
            }
        );
        <?php if ($this->context->markerFitBounds): ?>
        window.bounds = new google.maps.LatLngBounds();
        <?php elseif (is_array($this->context->center)): ?>
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
        <?php foreach ($this->context->markers as $key => $marker): ?>
        var marker_<?= $key ?> = new google.maps.Marker({
            map: window.map
        });
        <?php if (isset($marker['title'])): ?>
        marker_<?= $key ?>.setTitle("<?= $marker['title'] ?>");
        <?php endif; ?>
        <?php if (is_array($marker['position'])): ?>
        marker_<?= $key ?>.setPosition(new google.maps.LatLng(<?= $marker['position'][0] ?>, <?= $marker['position'][1] ?>));
        <?php if ($this->context->markerFitBounds): ?>
        window.bounds.extend(marker_<?= $key ?>.position);
        window.map.fitBounds(bounds);
        <?php endif; ?>
        <?php else: ?>
        geocoder.geocode({
            "address": "<?= $marker['position'] ?>"
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                marker_<?= $key ?>.setPosition(results[0].geometry.location);
                <?php if ($this->context->markerFitBounds): ?>
                window.bounds.extend(results[0].geometry.location);
                window.map.fitBounds(bounds);
                <?php endif; ?>
            }
        });
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>

    }
    google.maps.event.addDomListener(window, 'load', initialize_<?=md5($divId)?>);

</script>