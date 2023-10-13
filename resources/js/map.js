import * as L from "leaflet";
import * as L1 from "leaflet.markercluster";

export default class Map{
    constructor() {
        if(document.getElementById('map')){

            const TILE_LAYER1 = 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png';
            const TILE_LAYER2 = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            const TILE_LAYER3 = 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
            const TILE_LAYER4 = 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';
            const TILE_LAYER5 = 'http://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png';
            const TILE_LAYER6 = 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png';
            const TILE_LAYER7 = 'https://map1.vis.earthdata.nasa.gov/wmts-webmerc/VIIRS_CityLights_2012/default/{time}/{tilematrixset}{maxZoom}/{z}/{y}/{x}.{format}';
            const TILE_LAYER8 = 'https://wxs.ign.fr/{apikey}/geoportail/wmts?REQUEST=GetTile&SERVICE=WMTS&VERSION=1.0.0&STYLE={style}&TILEMATRIXSET=PM&FORMAT={format}&LAYER=ORTHOIMAGERY.ORTHOPHOTOS&TILEMATRIX={z}&TILEROW={y}&TILECOL={x}';

            this.TILE_LAYER1_layers = L.tileLayer(TILE_LAYER1, {id: '1',noWrap: true, minZoom: 2, maxZoom: 20, attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'});
            this.TILE_LAYER2_layers = L.tileLayer(TILE_LAYER2, {id: '2',noWrap: true, minZoom: 2, maxZoom: 19, attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'});
            this.TILE_LAYER3_layers = L.tileLayer(TILE_LAYER3, {id: '3',noWrap: true, minZoom: 2, maxZoom: 20, attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'});
            this.TILE_LAYER4_layers = L.tileLayer(TILE_LAYER4, {id: '4',noWrap: true, minZoom: 2, maxZoom: 20, attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'});
            this.TILE_LAYER5_layers = L.tileLayer(TILE_LAYER5, {id: '5',noWrap: true, minZoom: 2, maxZoom: 20, attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>'});
            this.TILE_LAYER6_layers = L.tileLayer(TILE_LAYER6, {id: '6',noWrap: true, minZoom: 2, maxZoom: 17, attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'});
            this.TILE_LAYER7_layers = L.tileLayer(TILE_LAYER7, {id: '7',noWrap: true, minZoom: 2, maxZoom: 8, attribution: 'Imagery provided by services from the Global Imagery Browse Services (GIBS), operated by the NASA/GSFC/Earth Science Data and Information System (<a href="https://earthdata.nasa.gov">ESDIS</a>) with funding provided by NASA/HQ.', format: 'jpg', time: '', tilematrixset: 'GoogleMapsCompatible_Level'});
            this.TILE_LAYER8_layers = L.tileLayer(TILE_LAYER8, {id: '8',noWrap: true, minZoom: 2, maxZoom: 18, attribution: '<a target="_blank" href="https://www.geoportail.gouv.fr/">Geoportail France</a>',apikey: 'choisirgeoportail', format: 'image/jpeg', style: 'normal'});

            this.baseMaps = {
                "<span style='color: gray'>Dark Edition</span>": this.TILE_LAYER1_layers,
                "<span style='color: gray'>Negative Edition</span>": this.TILE_LAYER5_layers,
                "<span style='color: gray'>Light Smooth 1</span>": this.TILE_LAYER3_layers,
                "<span style='color: gray'>Light Smooth 2</span>": this.TILE_LAYER4_layers,
                "<span style='color: gray'>Light Smooth 3</span>": this.TILE_LAYER2_layers,
                "<span style='color: gray'>Night</span>": this.TILE_LAYER7_layers,
                "<span style='color: gray'>Geographic flat</span>": this.TILE_LAYER6_layers,
                "<span style='color: gray'>Geographic</span>": this.TILE_LAYER8_layers,
            };

            this.domain_url = window.location.origin;

            let img = this.domain_url+'/img/icon_map/marker-icon-';
            let shadow = this.domain_url+'/img/icon_map/marker-shadow.png';

            /*         Default           */
            this.IconWhite = L.icon({
                iconUrl: img+'white.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconGrey = L.icon({
                iconUrl: img+'grey.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconBlack = L.icon({
                iconUrl: img+'black.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconBlue = L.icon({
                iconUrl: img+'blue.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconRed = L.icon({
                iconUrl: img+'red.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconGreen = L.icon({
                iconUrl: img+'green.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconLightBlue = L.icon({
                iconUrl: img+'light-blue.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconOrange = L.icon({
                iconUrl: img+'orange.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconPink = L.icon({
                iconUrl: img+'pink.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconPurple = L.icon({
                iconUrl: img+'purple.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconYellow = L.icon({
                iconUrl: img+'yellow.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });
            this.IconNAN = L.icon({
                iconUrl: img+'nan.png',
                shadowUrl: shadow,
                iconSize: [25, 41],
                iconAnchor: [11.5, 41]
            });

            this.Lat = '44.55962000171788';
            this.Lng = '6.079823238576286';
            this.Zoom = '5';
            //this.Tile = TILE_LAYER2;
            this.Object = new Array();

            this.macarte = null;
            this.markers = null

            this.makerUse = [];

            this.Def_pos = {
                _northEast:{
                    lat: 54.29088164657006,
                    lng: 26.235351562500004
                },
                _southWest: {
                    lat: 32.91648534731439,
                    lng: -14.106445312500002 }
            };
            //this.changeSelect();

            this.init();

            /*alert('zerzre');
            window.addEventListener("beforeunload", function (event) {
                //your code goes here on location change
                alert('yolo');
            });*/
        }

    }
    init() {
        //console.log('Creation Map');

        //console.log(document.querySelector('.container').scrollWidth);
        //console.log(document.querySelector('.container').scrollWidth);

        this.macarte = L.map('map', {center: [this.Lat, this.Lng], zoom: this.Zoom, layers: [this.TILE_LAYER2_layers]});
        this.macarte.setMaxBounds([[-90,-180],[90,180]])

        // vielle carte sans le layers des tuilles
        /*this.macarte = L.map('map').setView([this.Lat, this.Lng], this.Zoom);
        L.tileLayer(this.Tile, {
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(this.macarte);*/

        L.control.layers(this.baseMaps).addTo(this.macarte);

        this.marker_remove();
        this.NewPoints(this.Def_pos);

        this.macarte.on('moveend', () => {
            //console.log(this.macarte.getZoom());
            //console.log(this.macarte.getBounds());
            this.NewPoints(this.macarte.getBounds());
        });

    }
    NewPoints(posMap) {
        //console.log('Nouveau Marker');
        this.marker_remove();

        this.Fetch(posMap);
    }
    marker_remove(){
        //console.log('Destruction Marker');
        //console.log(this.markers);
        if(this.markers){

            //this.markers.remove();
            //delete this.markers;
            this.markers.clearLayers();
            this.macarte.removeLayer(this.markers);
            if(document.querySelector('div.leaflet-pane.leaflet-shadow-pane')){
                document.querySelector('div.leaflet-pane.leaflet-shadow-pane').innerHTML = '';
            }
            if(document.querySelector('div.leaflet-pane.leaflet-marker-pane')){
                document.querySelector('div.leaflet-pane.leaflet-marker-pane').innerHTML = '';
            }
            document.getElementById('listRightShop').innerHTML = '';

            this.Object.remove;
            delete this.Object;
            this.Object = new Array();
        }
    }
    marker_add(){
        //console.log('Creation Marker');
        this.markers = new L1.MarkerClusterGroup();
        this.markers.clearLayers();
        this.macarte.removeLayer(this.markers);
        if(this.Object.length == 0){
            let NewList = '';
            NewList += '<li class="list-group-item">';
            NewList += '<strong><a href="#">Aucun commerce</a></strong>';
            NewList += '</li>';

            document.getElementById('listRightShop').innerHTML += NewList;
        } else {
            this.Object.map((Item) => {
                //console.log(Item.detail);
                let type = Item.detail['subcategorie_id'];
                let libelle = Item.detail['subcategorie_lib'];
                let adresse = Item.detail['adresse'];
                let id = Item.detail['id'];
                let nom = Item.detail['nom'];
                let nomVille = Item.detail['nomVille'];

                let data = '';
                let marker;
                let Loc = [Item.coord['Lat'], Item.coord['Lng']];
                let icone = null;
                let color = null;

                data += '<p style="font-weight:bold; font-size:18px;">'+Item.detail['nom']+'</p>';
                if(Item.detail['nomVille']){
                    data += '<p style="font-size:14px;" class="adresse">Adresse : '+Item.detail['adresse']+' - '+Item.detail['nomVille']+' ('+Item.detail['cp']+')</p>';
                } else {
                    data += '<p style="font-size:14px;" class="adresse">Adresse : '+Item.detail['adresse']+' ('+Item.detail['cp']+')</p>';
                }

                //console.log(typeof Item.detail['desc']);
                /*if(typeof Item.detail['desc'] === "string") {
                    Item.detail['desc'] = Item.detail['desc'].split('.');
                    for (let j = 0; j < Item.detail['desc'].length - 1; j++) {
                        data += '<p style="font-size:12px;">' + Item.detail['desc'][j] + '.</p>';
                    }
                } else {
                    //data += '<p style="font-size:12px;">' + Item.detail['desc'] + '.</p>';
                }*/
                data += '<div class="d-flex justify-content-center"><a class="btn btn-outline-danger btn-sm" href="'+this.domain_url+'/shop/'+Item.detail['id']+'" role="button">Voir la page</a></div>';
                //console.log(data);

                //marker = L.marker([Item.coord['Lat'], Item.coord['Lng']],/* {icon: IconWhite}*/).bindPopup(data);

                switch (type){
                    case 1: icone = {icon: this.IconBlue};color = '#2B82CB' ; break;
                    case 2: icone = {icon: this.IconRed};color = '#F80B17' ; break;
                    case 3: icone = {icon: this.IconGreen};color = '#0AF92A' ; break;
                    case 4: icone = {icon: this.IconOrange};color = '#F87D10' ; break;
                    case 5: icone = {icon: this.IconPurple};color = '#9E0DF7' ; break;
                    case 6: icone = {icon: this.IconYellow};color = '#F8F008' ; break;
                    case 7: icone = {icon: this.IconPink};color = '#F810B3' ; break;
                    case 8: icone = {icon: this.IconLightBlue};color = '#0DF7EC' ; break;

                    case 9: icone = {icon: this.IconWhite};color = '#E2E2E2' ; break;
                    case 10: icone = {icon: this.IconGrey};color = '#888888' ; break;
                    case 11: icone = {icon: this.IconBlack};color = '#2B2B2B' ; break;

                    default: icone = {icon: this.IconBlue};color = '#2B82CB' ; break;
                    //default: icone = {icon: this.IconNAN};color = 'NaN' ; break;
                }

                //if(typeof libelle === 'undefined') libelle = 'tout';
                //console.log(libelle)
                //this.VerificationDejaDansTableau(libelle,this.makerUse,color);
                /*if(!()){

                    this.makerUse.push({type: libelle, color: color});
                }*/

                //Map.flyTTo(Loc, 15);


                //marker = L.marker(Loc,icone).bindTooltip(data, {sticky: true,elevation: 260.0});
                //marker = L.marker(Loc,icone).bindTooltip(data, {elevation: 260.0,direction: 'top', permanent: false, offset: [10,0]});

                let popup = L.popup({offset: [0, -32]}).setLatLng(Loc).setContent(data);
                marker = L.marker(Loc,icone);
                marker.bindPopup(popup);

                let NewList = '';
                NewList += '<li class="list-group-item">';
                NewList += '<strong><a class="MonFlyTo" data-loc="'+Loc+'">'+nom+'</a></strong>';
                NewList += '<p>'+Item.detail['adresse']+' - '+Item.detail['nomVille']+' ('+Item.detail['cp']+')</p>';
                NewList += '<a class="btn btn-outline-danger btn-sm" href="'+this.domain_url+'/shop/'+id+'" role="button">Voir la page</a>';
                NewList += '</li>';

                document.getElementById('listRightShop').innerHTML += NewList;

                /*console.log('shop_'+id);

                document.getElementById('shop_'+id).addEventListener('click',function(ev){
                    console.log(ev.target.attributes.id);
                    console.log(marker);
                    marker.openPopup();
                })*/

                this.markers.addLayer(marker);
            });
        }
        //console.log(this.makerUse);
        //this.legende(labels, grades);

        document.querySelectorAll('.MonFlyTo').forEach((a) => {
            a.addEventListener('click', (ev) =>{
                let loc = ev.currentTarget.getAttribute('data-loc');
                loc = loc.split(',');
                this.macarte.flyTo(loc,14, {
                    animate: false,
                    duration: 2
                });
            })
        });

        /*document.getElementById('listRightShop').innerHTML = '';
        document.getElementById('listRightShop').innerHTML = this.NewList;*/

        //console.log(this.makerUse);
        this.macarte.addLayer(this.markers);

    }
    Fetch(posMap){
        //console.log('Recherche Marker');
        let url = this.domain_url+'/API/get_marker';
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let dataPost = JSON.stringify(this.get_data(this.Def_pos))
        //console.log(test);

        let ResTo = fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": token
            },
            method: "post",
            credentials: "same-origin",
            body: dataPost
        }).then(response => {
            return response.json();
        }).then(objected => {
            this.marker_remove();
            //console.log(objected);
            for (const [key1, value1] of Object.entries(objected)) {
                //console.log(value1);
                if (value1 != null) {
                    if(value1.cp){
                        this.Object.push({
                            'detail': {
                                'id': value1.id,
                                'nom': value1.nom,
                                'desc': value1.descriptif,
                                'adresse': value1.adresse,
                                'cp': value1.cp,
                                'nomVille': value1.nomVille,
                                'categorie_id': value1.category_id,
                                'subcategorie_id': value1.subcategory_id,
                                'subcategorie_lib': value1.libelle,
                            },
                            'coord': {
                                'Lat': value1.lat,
                                'Lng': value1.lng,
                            }
                        });
                    } else {
                        this.Object.push({
                            'detail': {
                                'id': value1.id,
                                'nom': value1.nom,
                                'desc': value1.descriptif,
                                'adresse': value1.adresse,
                                'cp': value1.cp,
                                'categorie_id': value1.category_id,
                                'subcategorie_id': value1.subcategory_id,
                                'subcategorie_lib': value1.libelle,
                            },
                            'coord': {
                                'Lat': value1.lat,
                                'Lng': value1.lng,
                            }
                        });
                    }
                }
            }
            //console.log(this.Object);
            this.marker_add();
        }).catch(error => console.log("Erreur : " + error));
        //console.log(ResTo);
    }
    get_data(posMap){
        //console.log('Récupération Data Map');
        let Url = window.location.href.split('/');
        let VariableGet = Url[3].indexOf('?search=');
        let search = 'default';
        let test;

        //categorie
        Url[4] = parseInt(Url[4]);
        //subcategorie
        Url[5] = parseInt(Url[5]);

        //console.log(Url[4]+' '+Url[5]);

        //si il y a pas de categorie
        if(isNaN(Url[4])){
            Url[4] = "All";
            //console.log('----// '+VariableGet);

            // si il y a ?q=
            if (VariableGet != -1){
                //alert('--- Dans le ?');
                search = Url[3].split('?search=');
            }
        }

        //si il y a pas de subcategorie
        if(isNaN(Url[5])){
            Url[5] = "All";
        }

        //si il y a un search
        if(search !== 'default'){
            //alert('--- Dans le search');
            test = [{
                northEast: posMap._northEast,
                sudOuest: posMap._southWest,
                search: search[1]
            }];
        }
        else{
            test = [{
                northEast: posMap._northEast,
                sudOuest: posMap._southWest,
                categories: [Url[4]],
                subcategories: [Url[5]]
            }];
        }
        return test;
    }
}
