mapboxgl.accessToken = 'pk.eyJ1IjoiYWx1a2FjaCIsImEiOiJ3US1JLXJnIn0.xrpBHCwvzsX76YlO-08kjg'

const map1 = new mapboxgl.Map({
  container: 'map1',
  style: 'mapbox://styles/mapbox/streets-v9',
  zoom: 3,
  center: [-97, 39],
  attributionControl: false
})

map1.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map1.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map1.addControl(new mapboxgl.GeolocateControl(), 'top-left')

const layerList = document.getElementById('menu')
const inputs = layerList.getElementsByTagName('input')

function switchLayer(layer) {
  const layerId = layer.target.id
  map1.setStyle('mapbox://styles/mapbox/' + layerId)
  map1.setProjection('mercator')
}

for (let i = 0; i < inputs.length; i++) {
  inputs[i].onclick = switchLayer
}

// map two
const map2 = new mapboxgl.Map({
  container: 'map2',
  style: 'mapbox://styles/mapbox/light-v11',
  zoom: 4.5,
  projection: 'mercator',
  center: [-110, 32],
  attributionControl: false
})

const marker1 = new mapboxgl.Marker().setLngLat([-130, 24]).addTo(map2)
const marker2 = new mapboxgl.Marker().setLngLat([-125, 28]).addTo(map2)
const marker3 = new mapboxgl.Marker().setLngLat([-115, 30]).addTo(map2)
const marker4 = new mapboxgl.Marker().setLngLat([-110, 28]).addTo(map2)
const marker5 = new mapboxgl.Marker().setLngLat([-105, 32]).addTo(map2)
const marker6 = new mapboxgl.Marker().setLngLat([-102, 31]).addTo(map2)
map2.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map2.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map2.addControl(new mapboxgl.GeolocateControl(), 'top-left')

// map three
const map3 = new mapboxgl.Map({
  container: 'map3',
  style: 'mapbox://styles/mapbox/light-v11',
  zoom: 4.5,
  projection: 'mercator',
  center: [-110, 32],
  attributionControl: false
})

const markerDraggable = new mapboxgl.Marker({ draggable: true }).setLngLat([-115, 34]).addTo(map3)
function onDragStart() {
  const lngLat = markerDraggable.getLngLat()
  document.getElementById('ondragstart').innerHTML = `${lngLat.lng.toFixed(4)}, ${lngLat.lat.toFixed(4)}`
}
function onDrag() {
  const lngLat = markerDraggable.getLngLat()
  document.getElementById('ondrag').innerHTML = `${lngLat.lng.toFixed(4)}, ${lngLat.lat.toFixed(4)}`
}
function onDragEnd() {
  const lngLat = markerDraggable.getLngLat()
  document.getElementById('ondragend').innerHTML = `${lngLat.lng.toFixed(4)}, ${lngLat.lat.toFixed(4)}`
}

markerDraggable.on('dragstart', onDragStart)
markerDraggable.on('drag', onDrag)
markerDraggable.on('dragend', onDragEnd)

map3.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map3.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map3.addControl(new mapboxgl.GeolocateControl(), 'top-left')

// map Four
const map4 = new mapboxgl.Map({
  container: 'map4',
  style: 'mapbox://styles/mapbox/dark-v11',
  zoom: 3,
  projection: 'mercator',
  center: [4.18, 1.7],
  attributionControl: false
})

map4.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map4.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map4.addControl(new mapboxgl.GeolocateControl(), 'top-left')

const radius = 20

function pointOnCircle(angle) {
  return {
    type: 'Point',
    coordinates: [Math.cos(angle) * radius, Math.sin(angle) * radius]
  }
}

map4.on('load', () => {
  // Add a source and layer displaying a point which will be animated in a circle.
  map4.addSource('point', {
    type: 'geojson',
    data: pointOnCircle(0)
  })

  map4.addLayer({
    id: 'point',
    source: 'point',
    type: 'circle',
    paint: {
      'circle-radius': 10,
      'circle-color': '#FF5630'
    }
  })
  map4.on('click', (e) => {
    console.log(`A click event has occurred at ${e.lngLat}`)
  })
  function animateMarker(timestamp) {
    // Update the data to a new position based on the animation timestamp. The
    // divisor in the expression `timestamp / 1000` controls the animation speed.
    map4.getSource('point').setData(pointOnCircle(timestamp / 1000))

    // Request the next frame of the animation.
    requestAnimationFrame(animateMarker)
  }

  // Start the animation.
  animateMarker(0)
})

// map five

const map5 = new mapboxgl.Map({
  container: 'map5',
  style: 'mapbox://styles/mapbox/light-v11',
  zoom: 4.5,
  projection: 'mercator',
  center: [-103.5917, 40.6699],
  attributionControl: false
})

map5.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map5.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map5.addControl(new mapboxgl.GeolocateControl(), 'top-left')

map5.on('load', () => {
  // Add a new source from our GeoJSON data and
  // set the 'cluster' option to true. GL-JS will
  // add the point_count property to your source data.
  map5.addSource('earthquakes', {
    type: 'geojson',
    // Point to GeoJSON data. This example visualizes all M1.0+ earthquakes
    // from 12/22/15 to 1/21/16 as logged by USGS' Earthquake hazards program.
    data: 'https://docs.mapbox.com/mapbox-gl-js/assets/earthquakes.geojson',
    cluster: true,
    clusterMaxZoom: 14, // Max zoom to cluster points on
    clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
  })

  map5.addLayer({
    id: 'clusters',
    type: 'circle',
    source: 'earthquakes',
    filter: ['has', 'point_count'],
    paint: {
      // Use step expressions (https://docs.mapbox.com/style-spec/reference/expressions/#step)
      // with three steps to implement three types of circles:
      //   * Blue, 20px circles when point count is less than 100
      //   * Yellow, 30px circles when point count is between 100 and 750
      //   * Pink, 40px circles when point count is greater than or equal to 750
      'circle-color': ['step', ['get', 'point_count'], '#00B8D9', 100, '#00A76F', 750, '#FFAB00'],
      'circle-radius': ['step', ['get', 'point_count'], 20, 100, 30, 750, 40]
    }
  })

  map5.addLayer({
    id: 'cluster-count',
    type: 'symbol',
    source: 'earthquakes',
    filter: ['has', 'point_count'],
    layout: {
      'text-field': ['get', 'point_count_abbreviated'],
      'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
      'text-size': 12
    }
  })

  map5.addLayer({
    id: 'unclustered-point',
    type: 'circle',
    source: 'earthquakes',
    filter: ['!', ['has', 'point_count']],
    paint: {
      'circle-color': '#11b4da',
      'circle-radius': 4,
      'circle-stroke-width': 1,
      'circle-stroke-color': '#fff'
    }
  })

  // inspect a cluster on click
  map5.on('click', 'clusters', (e) => {
    const features = map5.queryRenderedFeatures(e.point, {
      layers: ['clusters']
    })
    const clusterId = features[0].properties.cluster_id
    map5.getSource('earthquakes').getClusterExpansionZoom(clusterId, (err, zoom) => {
      if (err) return

      map5.easeTo({
        center: features[0].geometry.coordinates,
        zoom: zoom
      })
    })
  })

  // When a click event occurs on a feature in
  // the unclustered-point layer, open a popup at
  // the location of the feature, with
  // description HTML from its properties.
  map5.on('click', 'unclustered-point', (e) => {
    const coordinates = e.features[0].geometry.coordinates.slice()
    const mag = e.features[0].properties.mag
    const tsunami = e.features[0].properties.tsunami === 1 ? 'yes' : 'no'

    // Ensure that if the map is zoomed out such that
    // multiple copies of the feature are visible, the
    // popup appears over the copy being pointed to.
    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
      coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360
    }

    new mapboxgl.Popup().setLngLat(coordinates).setHTML(`magnitude: ${mag}<br>Was there a tsunami?: ${tsunami}`).addTo(map)
  })

  map5.on('mouseenter', 'clusters', () => {
    map5.getCanvas().style.cursor = 'pointer'
  })
  map5.on('mouseleave', 'clusters', () => {
    map5.getCanvas().style.cursor = ''
  })
})

// map six
const map6 = new mapboxgl.Map({
  container: 'map6',
  style: 'mapbox://styles/mapbox/light-v11',
  zoom: 4.5,
  projection: 'mercator',
  center: [-103.5917, 40.6699],
  attributionControl: false
})
document.getElementById('listing-group').addEventListener('change', (e) => {
  if (e.target.type == 'number') {
    const handler = e.target.id
    console.log(e.target.value)
    if (handler == 'maxZoom') {
      map6.setMaxZoom(e.target.value)
    } else if (handler == 'minZoom') {
      map6.setMinZoom(e.target.value)
    } else if (handler == 'maxPitch') {
      map6.setMaxPitch(e.target.value)
    } else if (handler == 'minPitch') {
      map6.setMinPitch(e.target.value)
    }
  } else {
    const handler = e.target.id
    if (e.target.checked) {
      map6[handler].enable()
    } else {
      map6[handler].disable()
    }
  }
})
map6.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map6.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map6.addControl(new mapboxgl.GeolocateControl(), 'top-left')

// map seven
const map7 = new mapboxgl.Map({
  container: 'map7',
  style: 'mapbox://styles/mapbox/streets-v12',
  zoom: 3,
  projection: 'mercator',
  center: [-97, 39],
  attributionControl: false
})
map7.on('click', (e) => {
  console.log(`A click event has occurred at ${e.lngLat}`)
})

map7.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map7.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map7.addControl(new mapboxgl.GeolocateControl(), 'top-left')
const placeArr = [
  [-95.29, 29.73],
  [-98.49, 29.42],
  [-96.79, 32.77],
  [-97.74, 30.27],
  [-97.33, 32.75],
  [90.34, 25.12]
]
const placeList = document.getElementById('places')
const placeInputs = placeList.getElementsByTagName('input')

function switchPosition(layer) {
  const layerId = layer.target.id
  map7.easeTo({
    center: placeArr[Number(layerId)],
    zoom: 9,
    speed: 0.2,
    duration: 2000,
    easing(t) {
      return t
    }
  })
  map7.setProjection('mercator')
}

for (let i = 0; i < placeInputs.length; i++) {
  placeInputs[i].onclick = switchPosition
}

// map eight
const map8 = new mapboxgl.Map({
  container: 'map8',
  style: 'mapbox://styles/mapbox/light-v11',
  zoom: 3,
  center: [-97, 39],
  projection: 'mercator',
  attributionControl: false
})

map8.addControl(new mapboxgl.NavigationControl(), 'bottom-left')
map8.addControl(new mapboxgl.FullscreenControl(), 'top-left')
map8.addControl(new mapboxgl.GeolocateControl(), 'top-left')

const overlay = document.getElementById('map-overlay')

// Create a popup, but don't add it to the map yet.
const popup = new mapboxgl.Popup({
  closeButton: false
})

// Because features come from tiled vector data,
// feature geometries may be split
// or duplicated across tile boundaries.
// As a result, features may appear
// multiple times in query results.
function getUniqueFeatures(features, comparatorProperty) {
  const uniqueIds = new Set()
  const uniqueFeatures = []
  for (const feature of features) {
    const id = feature.properties[comparatorProperty]
    if (!uniqueIds.has(id)) {
      uniqueIds.add(id)
      uniqueFeatures.push(feature)
    }
  }
  return uniqueFeatures
}

map8.on('load', () => {
  // Add a custom vector tileset source. The tileset used in
  // this example contains a feature for every county in the U.S.
  // Each county contains four properties. For example:
  // {
  //     COUNTY: "Uintah County",
  //     FIPS: 49047,
  //     median-income: 62363,
  //     population: 34576
  // }
  map8.addSource('counties', {
    type: 'vector',
    url: 'mapbox://mapbox.82pkq93d'
  })
  // Add transparent county polygons
  // for default display.
  map8.addLayer(
    {
      id: 'counties',
      type: 'fill',
      source: 'counties',
      'source-layer': 'original',
      paint: {
        'fill-outline-color': 'rgba(0,0,0,0.1)',
        'fill-color': 'rgba(0,0,0,0.1)'
      }
    },
    // Place polygons under labels, roads and buildings.
    'building'
  )

  // Add filled county polygons
  // for highlighted display.
  map8.addLayer(
    {
      id: 'counties-highlighted',
      type: 'fill',
      source: 'counties',
      'source-layer': 'original',
      paint: {
        'fill-outline-color': '#FF5630',
        'fill-color': '#FF5630',
        'fill-opacity': 0.75
      },
      // Display none by adding a
      // filter with an empty string.
      filter: ['in', 'COUNTY', '']
    },
    // Place polygons under labels, roads and buildings.
    'building'
  )

  map8.on('mousemove', 'counties', (e) => {
    // Change the cursor style as a UI indicator.
    map8.getCanvas().style.cursor = 'pointer'

    // Use the first found feature.
    const feature = e.features[0]

    // Query the counties layer visible in the map8.
    // Only onscreen features are returned.
    // Use filter to collect only results
    // with the same county name.
    const relatedCounties = map8.querySourceFeatures('counties', {
      sourceLayer: 'original',
      filter: ['in', 'COUNTY', feature.properties.COUNTY]
    })

    // Remove duplicates by checking for matching FIPS county ID.
    const uniqueCounties = getUniqueFeatures(relatedCounties, 'FIPS')

    // Total the populations of all features.
    const populationSum = uniqueCounties.reduce((memo, feature) => {
      return memo + feature.properties.population
    }, 0)

    // Render found features in an overlay.
    const title = document.createElement('strong')
    title.textContent = feature.properties.COUNTY + ' (' + uniqueCounties.length + ' found)'

    const population = document.createElement('div')
    population.textContent = 'Total population: ' + populationSum.toLocaleString()

    overlay.innerHTML = ''
    overlay.style.display = 'block'

    overlay.appendChild(title)
    overlay.appendChild(population)

    // Add features with the same county name
    // to the highlighted layer.
    map8.setFilter('counties-highlighted', ['in', 'COUNTY', feature.properties.COUNTY])

    // Display a popup with the name of the county.
    popup.setLngLat(e.lngLat).setText(feature.properties.COUNTY).addTo(map)
  })

  map8.on('mouseleave', 'counties', () => {
    map8.getCanvas().style.cursor = ''
    popup.remove()
    map8.setFilter('counties-highlighted', ['in', 'COUNTY', ''])
    overlay.style.display = 'none'
  })
})

// map nine
const map9 = new mapboxgl.Map({
  container: 'map9',
  // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
  style: 'mapbox://styles/mapbox/light-v11',
  center: [-120, 50],
  projection: 'mercator',
  zoom: 3,
  attributionControl: false
})

map9.on('load', () => {
  // Add a geojson point source.
  // Heatmap layers also work with a vector tile source.
  map9.addSource('earthquakes', {
    type: 'geojson',
    data: 'https://docs.mapbox.com/mapbox-gl-js/assets/earthquakes.geojson'
  })

  map9.addLayer(
    {
      id: 'earthquakes-heat',
      type: 'heatmap',
      source: 'earthquakes',
      maxzoom: 9,
      paint: {
        // Increase the heatmap weight based on frequency and property magnitude
        'heatmap-weight': ['interpolate', ['linear'], ['get', 'mag'], 0, 0, 6, 1],
        // Increase the heatmap color weight weight by zoom level
        // heatmap-intensity is a multiplier on top of heatmap-weight
        'heatmap-intensity': ['interpolate', ['linear'], ['zoom'], 0, 1, 9, 3],
        // Color ramp for heatmap9.  Domain is 0 (low) to 1 (high).
        // Begin color ramp at 0-stop with a 0-transparancy color
        // to create a blur-like effect.
        'heatmap-color': ['interpolate', ['linear'], ['heatmap-density'], 0, 'rgba(33,102,172,0)', 0.2, 'rgb(103,169,207)', 0.4, 'rgb(209,229,240)', 0.6, 'rgb(253,219,199)', 0.8, 'rgb(239,138,98)', 1, 'rgb(178,24,43)'],
        // Adjust the heatmap radius by zoom level
        'heatmap-radius': ['interpolate', ['linear'], ['zoom'], 0, 2, 9, 20],
        // Transition from heatmap to circle layer by zoom level
        'heatmap-opacity': ['interpolate', ['linear'], ['zoom'], 7, 1, 9, 0]
      }
    },
    'waterway-label'
  )

  map9.addLayer(
    {
      id: 'earthquakes-point',
      type: 'circle',
      source: 'earthquakes',
      minzoom: 7,
      paint: {
        // Size circle radius by earthquake magnitude and zoom level
        'circle-radius': ['interpolate', ['linear'], ['zoom'], 7, ['interpolate', ['linear'], ['get', 'mag'], 1, 1, 6, 4], 16, ['interpolate', ['linear'], ['get', 'mag'], 1, 5, 6, 50]],
        // Color circle by earthquake magnitude
        'circle-color': ['interpolate', ['linear'], ['get', 'mag'], 1, 'rgba(33,102,172,0)', 2, 'rgb(103,169,207)', 3, 'rgb(209,229,240)', 4, 'rgb(253,219,199)', 5, 'rgb(239,138,98)', 6, 'rgb(178,24,43)'],
        'circle-stroke-color': 'white',
        'circle-stroke-width': 1,
        // Transition from heatmap to circle layer by zoom level
        'circle-opacity': ['interpolate', ['linear'], ['zoom'], 7, 0, 8, 1]
      }
    },
    'waterway-label'
  )
})

// map ten
const beforeMap = new mapboxgl.Map({
  container: 'before',
  // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
  style: 'mapbox://styles/mapbox/light-v11',
  center: [-120, 50],
  zoom: 6,
  attributionControl: false
})

const afterMap = new mapboxgl.Map({
  container: 'after',
  style: 'mapbox://styles/mapbox/dark-v11',
  center: [-120, 50],
  zoom: 6,
  attributionControl: false
})

// A selector or reference to HTML element
const containerComparison = '#comparison-container'

const mapComparison = new mapboxgl.Compare(beforeMap, afterMap, containerComparison, {
  // Set this to enable comparing two maps by mouse movement:
  // mousemove: true
})
