mapboxgl.accessToken = '';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/outdoors-v11',
    center: [-74.12609490031389, 4.631174843212949],
    zoom: 9.7
});

map.on('load', function () {
    map.addSource('route', {
        'type': 'geojson',
        'data': 'map.geojson'
    });

    map.addLayer({
        'id': 'route',
        'type': 'fill',
        'source': 'route',
        'paint': {
            'fill-color': '#06d6a0',
            'fill-outline-color': '#000',
            'fill-opacity': 0.3
        }
    });

    map.on('mouseenter', 'route', function () {
        map.getCanvas().style.cursor = 'pointer';
    });

    // Change it back to a pointer when it leaves.
    map.on('mouseleave', 'route', function () {
        map.getCanvas().style.cursor = '';
    });

    map.on('click', 'route', function (e) {
        console.log(e.features[0].properties.name);
        new mapboxgl.Popup()
            .setLngLat(e.lngLat)
            .setHTML(e.features[0].properties.name)
            .addTo(map);
        window.location.href = 'index.php?localidad=' + e.features[0].properties.name;
    });
});