var municipios_data = {
    'Forma_1': 'Usaquen',
    'Forma_2': 'Suba',
    'Forma_3': 'Engativa',
    'Forma_4': 'Barrios unidos',
    'Forma_5': 'Teusaquillo',
    'Forma_6': 'Martires',
    'Forma_7': 'Chapinero',
    'Forma_8': 'Puente aranda',
    'Forma_9': 'Fontibon',
    'Forma_10': 'Kennedy',
    'Forma_11': 'Santafé',
    'Forma_12': 'La candelaria',
    'Forma_13': 'Antonio Nariño',
    'Forma_14': 'Rafael uribe',
    'Forma_15': 'Tunjuelito',
    'Forma_16': 'Bosa',
    'Forma_17': 'San Cristobal',
    'Forma_18': 'Sumapaz',
    'Forma_19': 'Usme',
    'Forma_20': 'Ciudad Bolivar'};

var default_attributes = {
    fill: '#06d6a0',
    stroke: '#fff',
    'stroke-width': 2,
};

var $munictxt = $('#municipiotxt');

$.ajax({
    url: 'img/mapa.svg',
    type: 'GET',
    dataType: 'xml',
    success: function (xml) {
        var rjs = Raphael('lienzo', 906, 604);
        var corr = "";
        $(xml).find('svg > path').each(function () {
            var path = $(this).attr('d');
            var pid = $(this).attr('id');
            var munic = rjs.path(path);

            munic.attr(default_attributes);
            munic.hover(function () {
                this.animate({ fill: '#ffd166' });
                var text = "Localidad: ";
                if (typeof (municipios_data[pid]) != 'undefined'){
                    text += municipios_data[pid];
                }else{
                    text += "Sin nombre";
                }//text += "(" + $(this).attr('id') + ")";

                $munictxt.html(text);
            }, function () {
                this.animate({ fill: default_attributes.fill });
                $munictxt.html("Selecciona una localidad");
            }).click(function () {
                console.log(municipios_data[pid]);
                window.location.href = 'index.php?localidad='+municipios_data[pid];
            });
        });
        $('#loadingicon').hide();
    }
});