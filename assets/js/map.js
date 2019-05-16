import L from 'leaflet';

export default class Map{

    static init(){
        var map = L.map('map').setView([48.5420141, 6.140137], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            maxZoom: 18,
            minZoom: 2,
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        }).addTo(map);

        L.marker([48.5420141, 6.140137]).addTo(map);
    }

}