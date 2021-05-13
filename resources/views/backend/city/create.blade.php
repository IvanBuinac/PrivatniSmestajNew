@extends('backend.layouts.app')

@section('content')


    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New City</div>
                    <div class="panel-body">
                        <a href="{{ route('city.index') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['route' => 'city.store', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('backend.city.form')

                        {!! Form::close() !!}

                    </div>

                    <style>
                        /* Always set the map height explicitly to define the size of the div
                         * element that contains the map. */
                        #map {
                            height: 500px;
                            width:100%;
                        }
                        /* Optional: Makes the sample page fill the window. */


                        #infowindow-content .title {
                            font-weight: bold;
                        }


                        #map #infowindow-content {
                            display: inline;
                        }



                        .pac-controls label {
                            font-family: Roboto;
                            font-size: 13px;
                            font-weight: 300;
                        }

                        #pac-input {
                            background-color: #fff;
                            font-family: Roboto;
                            font-size: 15px;
                            font-weight: 300;
                            margin-left: 12px;
                            padding: 0 11px 0 13px;
                            text-overflow: ellipsis;
                            width: 400px;
                        }

                        #pac-input:focus {
                            border-color: #4d90fe;
                        }

                    </style>
                    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                    <div id="map"></div>

                    <script>


                        // This example adds a search box to a map, using the Google Place Autocomplete
                        // feature. People can enter geographical searches. The search box will return a
                        // pick list containing a mix of places and predicted search terms.

                        // This example requires the Places library. Include the libraries=places
                        // parameter when you first load the API. For example:
                        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                        function initAutocomplete() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: -33.8688, lng: 151.2195},
                                zoom: 13,
                                mapTypeId: 'roadmap'
                            });

                            // Create the search box and link it to the UI element.
                            var input = document.getElementById('pac-input');
                            var searchBox = new google.maps.places.SearchBox(input);
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                            // Bias the SearchBox results towards current map's viewport.
                            map.addListener('bounds_changed', function() {
                                searchBox.setBounds(map.getBounds());


                            });

                            var markers = [];
                            // Listen for the event fired when the user selects a prediction and retrieve
                            // more details for that place.
                            searchBox.addListener('places_changed', function() {
                                var places = searchBox.getPlaces();

                                if (places.length == 0) {
                                    return;
                                }

                                // Clear out the old markers.
                                markers.forEach(function(marker) {
                                    marker.setMap(null);
                                });
                                markers = [];

                                // For each place, get the icon, name and location.
                                var bounds = new google.maps.LatLngBounds();
                                places.forEach(function(place) {
                                    if (!place.geometry) {
                                        console.log("Returned place contains no geometry");
                                        return;
                                    }
                                    var icon = {
                                        url: place.icon,
                                        size: new google.maps.Size(71, 71),
                                        origin: new google.maps.Point(0, 0),
                                        anchor: new google.maps.Point(17, 34),
                                        scaledSize: new google.maps.Size(25, 25)
                                    };
                                    document.getElementById("latitude").value = place.geometry.location.lat();
                                    document.getElementById("longitude").value = place.geometry.location.lng();
                                    document.getElementById("name").value = place.name;

                                    // Create a marker for each place.
                                    markers.push(new google.maps.Marker({
                                        map: map,
                                        icon: icon,
                                        title: place.name,
                                        position: place.geometry.location
                                    }));

                                    if (place.geometry.viewport) {
                                        // Only geocodes have viewport.
                                        bounds.union(place.geometry.viewport);
                                    } else {
                                        bounds.extend(place.geometry.location);
                                    }
                                });
                                map.addListener("zoom_changed",function(){
                                    document.getElementById("zoom").value = map.getZoom();
                               });
                                map.fitBounds(bounds);
                            });

                        }

                    </script>

                    <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSaaRRde7c6iewr72b5QR8ez89_F7_mQE&libraries=places&callback=initAutocomplete">
                    </script>
                </div>

            </div>
        </div>
    </div>
@endsection
