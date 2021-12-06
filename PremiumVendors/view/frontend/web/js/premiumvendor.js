let map;
let markers = [];
let myPos;
let circle;
let listOfVendors = [];

function setListOfVendors(vendors){
    listOfVendors = vendors;
}


function initMap() {
    let defaultMapLocation = { lat: 44.0279099 , lng:20.912623 }

    map = new google.maps.Map(document.getElementById("map-div"), {
        zoom: 6,
        center: defaultMapLocation,
    });
    addAllMarkersForVendors();
}

function addAllMarkersForVendors(){
    setMapOnAll(null);
    markers = [];
    for(let i=0; i<listOfVendors.items.length; i++) {
        addMarker(listOfVendors.items[i]);
    }
    centerMapOnPos();
}

function getLatLongFromAddress() {
    let address = document.getElementById('address').value;
    let company = document.getElementById('company').value;
    if(address.length === 0 && company.length === 0){
        addAllMarkersForVendors();
        return;
    }
    if(address.length > 0)
    {
        let addressEncoded = encodeURI(address);
        const s = document.createElement('script');
        s.src = 'https://nominatim.openstreetmap.org/search?json_callback=cb&format=json&q='+ addressEncoded +'&addressdetails=1';
        document.getElementsByTagName('head')[0].appendChild(s);
    }
    else if (company.length > 0)
    {
        filterByName(company);
    }
}

function addMarker(vendor){
    if(vendor.premium === "0")
        return;
    const marker = new google.maps.Marker({
        position: { lat: Number(vendor.lat), lng: Number(vendor.long) },
        map: map,
    });

    marker.addListener('click', () => {
        let elementVendorInfo = document.getElementById("vendor-info-div");
        if(vendor.premium === "1") {
            elementVendorInfo.innerText = '';
            elementVendorInfo.appendChild(createTable(vendor));
        } else {
            elementVendorInfo.innerText = "";
        }
    });
    markers.push(marker);
}

function filterByName(companyName){
    setMapOnAll(null);
    markers = [];
    for(let i=0; i<listOfVendors.items.length; i++){
        if(listOfVendors.items[i].name.toLowerCase().includes(companyName.toLowerCase())) {
            addMarker(listOfVendors.items[i]);
        }
    }
    centerMapOnPos();
}

function centerMapOnPos() {
    if(myPos){
        map.setCenter(myPos);
    }
    else {
        var bounds = new google.maps.LatLngBounds();
        console.log(markers);
        for (let i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].getPosition());
        }
        map.fitBounds(bounds);
    }
}

function cb(data) {
    if(data.size === 0)
        return;
    const image = "https://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    myPos = { lat: Number(data[0].lat), lng: Number(data[0].lon) };
    setMapOnAll(null);
    markers = [];
    myPositionMarker = new google.maps.Marker({
        position: myPos,
        map: map,
        icon: image
    });
    markers.push(myPositionMarker);
    filterVendorsOnMap();
}

function drawCircle(radius){
    circle = new google.maps.Circle({
        strokeColor: "#000000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
        map,
        center: myPos,
        radius: radius
    })
}

function filterVendorsOnMap() {
    let inputSelectDistance = document.getElementById('distance');
    let distanceInKm = inputSelectDistance.value;
    // let company = document.getElementById('company').value;
    let markerPos;
    for (let i = 0; i < listOfVendors.items.length; i++) {
        markerPos = {lat: Number(listOfVendors.items[i].lat), lng: Number(listOfVendors.items[i].long)};
        if (getDistance(myPos, markerPos) < distanceInKm * 1000) {
            addMarker(listOfVendors.items[i]);
        }

    }
    drawCircle(distanceInKm * 1000);
    centerMapOnPos();
}

function createTable(vendorDetails) {
    let tbl = document.createElement('table');
    tbl.id = 'info-table';
    tbl.style.width = '500px';
    tbl.style.border = '1px solid black';
    let tbdy = document.createElement('tbody');
    let trName = document.createElement('tr');
    let tdLblName = document.createElement('td');
    let tdName = document.createElement('td');
    tdName.innerText = vendorDetails.name;
    tdLblName.innerText ='Vendor name: ';
    trName.appendChild(tdLblName);
    trName.appendChild(tdName);

    let trAddress = document.createElement('tr');
    let tdLblAddress = document.createElement('td');
    let tdAddress = document.createElement('td')
    tdAddress.innerText = vendorDetails.street;
    tdLblAddress.innerText ='Street : ';
    trAddress.appendChild(tdLblAddress);
    trAddress.appendChild(tdAddress);

    let trPostalCode = document.createElement('tr');
    let tdLblPostalCode = document.createElement('td');
    let tdPostalCode = document.createElement('td')
    tdPostalCode.innerText = vendorDetails.postal_code + ' ' + vendorDetails.city;
    tdLblPostalCode.innerText ='Postal code & city : ';
    trPostalCode.appendChild(tdLblPostalCode);
    trPostalCode.appendChild(tdPostalCode);

    let trCountry = document.createElement('tr');
    let tdLblCountry = document.createElement('td');
    let tdCountry = document.createElement('td')
    tdCountry.innerText = vendorDetails.country;
    tdLblCountry.innerText ='Country : ';
    trCountry.appendChild(tdLblCountry);
    trCountry.appendChild(tdCountry);

    tbdy.appendChild(trName);
    tbdy.appendChild(trAddress);
    tbdy.appendChild(trPostalCode);
    tbdy.appendChild(trCountry);
    tbl.appendChild(tbdy);
    return tbl;
}

function setMapOnAll(map) {
    for (let i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
    if(circle)
        circle.setMap(map);
}
function rad(x) {
    return x * Math.PI / 180;
}
function getDistance(p1, p2) {
    let R = 6378137;
    let dLat = rad(p2.lat - p1.lat);
    let dLong = rad(p2.lng - p1.lng);
    let a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat)) *
        Math.sin(dLong / 2) * Math.sin(dLong / 2);
    let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}
