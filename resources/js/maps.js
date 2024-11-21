async function initMap() {
    // Request needed libraries.
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    const { LatLng } = await google.maps.importLibrary("core");
    const center = new LatLng(47.341811344805635, 0.6309143289699515);
    const map = new Map(document.getElementById("map"), {
        zoom: 15,
        center,
        mapId: "4504f8b37365c3d0",
    });

    for (const property of properties) {
        const AdvancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
            map,
            content: buildContent(property),
            position: property.position,
            title: property.description,
        });

        AdvancedMarkerElement.addListener("click", () => {
            toggleHighlight(AdvancedMarkerElement, property);
        });
    }
}

function toggleHighlight(markerView, property) {
    if (markerView.content.classList.contains("highlight")) {
        markerView.content.classList.remove("highlight");
        markerView.zIndex = null;
    } else {
        markerView.content.classList.add("highlight");
        markerView.zIndex = 1;
    }
}

function buildContent(property) {
    const content = document.createElement("div");

    content.classList.add("property");
    content.innerHTML = `
    <div class="icon">
        <i aria-hidden="true" class="fa fa-icon fa-${property.type}" title="${property.type}"></i>
        <span class="fa-sr-only">${property.type}</span>
    </div>
    <div class="details">
        <div class="price">${property.price}</div>
        <div class="address">${property.address}</div>
        <div class="features">
        <div>
            <i aria-hidden="true" class="bed" title="bedroom"><img src="img/icon/pool-8-ball-regular.svg"></i>
            <span class="fa-sr-only">bedroom</span>
            <span>${property.bed}</span>
        </div>
        <div>
            <i aria-hidden="true" class="bath" title="bathroom"><img src="img/icon/carambole-regular.svg"></i>
            <span class="fa-sr-only">bathroom</span>
            <span>${property.bath}</span>
        </div>
        <div>
            <i aria-hidden="true" class="size" title="size"><img src="img/icon/snooker-regular.svg"></i>
            <span class="fa-sr-only">size</span>
            <span>${property.size}</span>
        </div>
        </div>
    </div>
    `;
    return content;
}

const properties = [
    {
        address: "28 Rue Joseph Cugnot, 37300 Joué-lès-Tours",
        description: "Salle de billard",
        price: "Billard club Joué-Les-Tours",
        type: "building",
        bed: "5 pools",
        bath: "5 caramboles",
        size: "1 snooker",
        position: {
            lat: 47.341811344805635,
            lng: 0.6309143289699515,
             
        },
    },
];

initMap();