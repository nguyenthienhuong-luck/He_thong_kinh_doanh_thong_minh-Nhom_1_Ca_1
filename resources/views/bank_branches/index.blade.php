@extends('layouts.master')

@section('title', 'Tìm kiếm ATM/Bank')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
        #map {
            height: 720px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <section class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tìm kiếm ATM/Bank</h1>
                </div>
                {{-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Widgets</li>
              </ol>
          </div> --}}
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <form method="POST" action="{{ route('bank-branches.search') }}">
            @csrf
            <div class="d-flex gap-3 align-items-center justify-content-center w-50">
                <label for="text" class="h5 form-label text-nowrap">Tên ngân hàng</label>
                <input class="form-control form-control-lg" type="text" name="query" placeholder="Tìm kiếm ATM/Bank"
                    value="{{ old('query', $query) }}">
                <button class="btn btn-lg btn-primary-color text-nowrap" type="submit">Tìm kiếm</button>
            </div>
            <input type="hidden" name="latitude" value="21.007118"> <!-- Đại học Thủy Lợi -->
            <input type="hidden" name="longitude" value="105.825195"> <!-- Đại học Thủy Lợi -->
        </form>
        <!-- Bản đồ -->
        <div id="map" class="mt-2"></div>
    </div>
@endsection

@push('js')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            const branches = @json($branches);

            // Default coordinates (TLU University)
            const defaultLatitude = 21.007118;
            const defaultLongitude = 105.825195;

            function initMap(lat, lon) {
                const map = L.map('map').setView([lat, lon], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                // Custom red marker for current location
                const currentLocationIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                });

                // Add current location marker
                const currentLocationMarker = L.marker([lat, lon], {
                    icon: currentLocationIcon
                }).addTo(map);
                currentLocationMarker.bindPopup('<strong>Vị trí hiện tại của bạn</strong>').openPopup();

                // Add branch markers
                $.each(branches, function(index, branch) {
                    const marker = L.marker([branch.latitude, branch.longitude]).addTo(map);
                    marker.bindPopup(`<strong>${branch.name}</strong>`);
                });
            }

            // Get user location
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        initMap(21.01308565807955, 105.85670971630577);
                        // initMap(defaultLatitude, defaultLongitude);
                    },
                    function(error) {
                        $.error("Lỗi khi lấy vị trí: " + error.message);
                        initMap(defaultLatitude, defaultLongitude);
                    }
                );
            } else {
                $.error("Trình duyệt của bạn không hỗ trợ Geolocation.");
                initMap(defaultLatitude, defaultLongitude);
            }
        });
    </script>
@endpush
