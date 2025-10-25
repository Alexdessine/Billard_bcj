// resources/js/maps.js

window.initMap = async () => {
    // Charge les libs nécessaires (ok avec v=weekly sur le script)
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
        const markerView = new AdvancedMarkerElement({
            map,
            content: buildContent(property),
            position: property.position,
            title: property.description,
        });

        markerView.addListener("click", () => {
            toggleHighlight(markerView, property);
        });
    }
};

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
          <i aria-hidden="true" class="bed" title="billard américain"><img src="/img/icon/pool-8-ball-regular.svg"></i>
          <span class="fa-sr-only">billard américain</span>
          <span>${property.bed}</span>
        </div>
        <div>
          <i aria-hidden="true" class="bath" title="carambole"><img src="/img/icon/carambole-regular.svg"></i>
          <span class="fa-sr-only">carambole</span>
          <span>${property.bath}</span>
        </div>
        <div>
          <i aria-hidden="true" class="size" title="snooker"><img src="/img/icon/snooker-regular.svg"></i>
          <span class="fa-sr-only">snooker</span>
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
        price: "Billard Club de Joué-Lès-Tours",
        type: "building",
        bed: "5 pools",
        bath: "5 caramboles",
        size: "1 snooker",
        position: { lat: 47.341811344805635, lng: 0.6309143289699515 },
    },
];

// IMPORTANT : ne pas appeler initMap() ici.
// Google appellera window.initMap quand l'API aura fini de charger
