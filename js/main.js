mapboxgl.accessToken = 'pk.eyJ1IjoicHJveWVjdG9hcHBzd2ViMTIiLCJhIjoiY2tvYzN4YWJ0MGYwMzJ2dWh2Ymk5OW9neiJ9.-4p25j9qimxlym1l6S-ulg';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/outdoors-v11',
    //center: [-74.12609490031389, 4.631174843212949],
    center: [-74.097519, 4.650337],
    zoom: 9.7
});

var hoveredStateId = null;

map.on('load', function () {
    map.addSource('route', {
        'type': 'geojson',
        'data': 'map.geojson'
    });

    map.addLayer({
        'id': 'route',
        'type': 'fill',
        'source': 'route',
        'layout': {},
        'paint': {
            'fill-color': '#06d6a0',
            'fill-opacity': [
                'case',
                ['boolean', ['feature-state', 'hover'], false],
                1,
                0.3
            ]
        }
    });

    map.on('mousemove', 'route', function (e) {
        if (e.features.length > 0) {
            if (hoveredStateId !== null) {
                map.setFeatureState(
                    { source: 'route', id: hoveredStateId },
                    { hover: false }
                );
            }
            hoveredStateId = e.features[0].id;
            map.setFeatureState(
                { source: 'route', id: hoveredStateId },
                { hover: true }
            );
        }
    });

    map.on('mouseleave', 'route', function () {
        if (hoveredStateId !== null) {
            map.setFeatureState(
                { source: 'route', id: hoveredStateId },
                { hover: false }
            );
        }
        hoveredStateId = null;
    });

    map.addLayer({
        'id': 'delineado',
        'type': 'line',
        'source': 'route',
        'paint': {
            'line-color': '#555555',
            'line-width': 2
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