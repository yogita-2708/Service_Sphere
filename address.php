<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <style>
        body{
            background-color: rgba(128, 128, 128, 0.4);
        }
        .form-control{
            background:rgba(128, 128, 128, 0.1)
        }
        @media (max-width: 571px){
            .w{
                width: 90%;
            }
            
        }
        #map { height: 400px; }
        a{
            text-decoration:none;
        }
        
    </style>
</head>
<body>
    <div class="container mt-2 mt-md-5 mb-3">
        <h2 class="text-center fw-bold text-warning">Address Page</h2>
        <form action="operations/address_table_insert.php" class="bg-white w p-2 p-md-5 mx-auto rounded shadow" method="post">
            <div class="mb-3 form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
            </div>
            <div class="mb-3 form-group">
                <input type="text" name="phone" class="form-control" placeholder="Enter Your Number">
            </div>
            <div class="mb-3 form-group">
                <input type="text" name="alter_phone" class="form-control" placeholder="Enter Your Alternate Number">
            </div>

            <div class="mb-3 form-group">
                <textarea class="form-control" name="address" id="" cols="30" rows="5" placeholder="Enter Your Address"></textarea>
            </div>

            <div class="mb-3 form-group">
                <input type="text" name="landmark" class="form-control" placeholder="Enter Any Landmark/Colony/Apaetment">
            </div>
            <div class="mb-3 from-group" id="long-alt">

            </div>
            
            <input type="submit" name="sub" value="Click" class="from-control btn btn-warning">
        </form>

        <div class="shadow mt-3 rounded" id="map"></div>
    </div>
    <script>
        navigator.geolocation.getCurrentPosition((position)=>{
                let {latitude, longitude} = position.coords;
                var map = L.map('map').setView([latitude, longitude], 19);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                minZoom: 1,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.marker([latitude,longitude]).addTo(map);

            var input = document.createElement("input");
            input.type = "text";
            input.name = "geo_location";
            input.value =  `${latitude},${longitude}`;
            input.className= "form-control d-none";
            let geo = document.getElementById('long-alt');
            geo.appendChild(input);
        });
    </script>
</body>
</html>
<?php include_once "include/footer.php"; ?>