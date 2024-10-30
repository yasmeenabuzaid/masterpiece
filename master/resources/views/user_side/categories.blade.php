@extends('layouts.app-user')

@section('content')
<style>
    .main {
        display: flex;
        flex-direction: column;
        margin-left: 50px;
        margin-right: 50px;
        margin-bottom: 50px;
    }
    .container {
        display: flex;
        align-items: flex-start;
    }
    .categories {
        flex: 2;
        margin-right: 20px;
    }
    .selected-services {
        flex: 1;
        border-left: 1px solid #ddd;
        padding-left: 20px;
    }
    .card {
        background-color: rgb(255, 255, 255);
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin: 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
    .card h3 {
        margin: 0;
        font-size: 1.5em;
    }
    .services-dropdown {
        display: none;
        margin-top: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .service-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        justify-content: space-between;
    }
    .service-item img {
        width: 70px;
        height: 80px;
        border-radius: 5px;
        margin-right: 10px;
    }
    .selected-item {
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #e9f5ff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }
    .no-services {
        color: #666;
        font-style: italic;
    }
    .total-price {
        font-weight: bold;
        margin-top: 15px;
    }
    input[type="date"], input[type="time"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1em;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    input[type="date"]:invalid, input[type="time"]:invalid {
        background-color: #fbfbfb;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }
</style>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

<div class="slide-one-item home-slider owl-carousel" style="height: 30%;">
    <div class="site-blocks-cover inner-page-cover" style="background-image: url('{{ asset($subsalon->salon->image ?? 'default_image.jpg') }}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="filter-overlay"></div>
        <div class="container" style="position: relative; height: 90%; padding: 0; margin: 0;">
            <div class="text-container" style="position: absolute; bottom: 20px; left: 0; text-align: left;">
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-white font-weight-light mb-2 display-1">{{ $subsalon->name }}</h2>
                    <div class="search-section">
                        <h3>All Categories</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h1 class="m-4">All Categories in {{ $subsalon->name }}</h1>
    </div>

    <div class="container">
        <div class="categories">
            @foreach($categories as $categorie)
                <div class="card" onclick="toggleServices('{{ $categorie->id }}')">
                    <div class="text-container" style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h3>{{ $categorie->name }} <span>({{ $categorie->services->count() }})</span></h3>
                            <p>{{ $categorie->description }}</p>
                        </div>
                        @if($categorie->services->isNotEmpty())
                            <span style="font-size: 1.5rem;">▼</span>
                        @endif
                    </div>
                </div>
                <div class="services-dropdown" id="services-{{ $categorie->id }}" style="display: none;">
                    @if($categorie->services->isEmpty())
                        <p class="no-services">No services are currently available.</p>
                    @else
                        <ul>
                            @foreach($categorie->services as $service)
                                <li class="service-item">
                                    <div style="display: flex; align-items: center;">
                                        <img src="{{ asset($service->image ? $service->image : 'default_service_image.jpg') }}" alt="Service Image">
                                        <div>
                                            <strong>{{ $service->name }}</strong> - ${{ $service->price }}<br>
                                            <span>{{ $service->description }}</span><br>
                                            <span>Duration: {{ $service->duration }}</span>
                                        </div>
                                    </div>
                                    <button onclick="addService('{{ $service->id }}', '{{ $service->name }}', {{ $service->price }})" style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        +
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="selected-services">
            <h3>Selected Services</h3>
            <button onclick="clearServices()" style="margin: 10px; padding: 5px; background-color: #dc3545; color: white; border: none; border-radius: 5px;">Clear All Services</button>
            <div id="selected-items"></div>
            <hr>
            <div class="total-price" id="total-price">Total Price: $0</div>
        </div>
    </div>
</div>
<br>
<br>
<br>

<div class="main">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h1 class="mb-5">Book Now</h1>
    </div>

    <form action="{{ route('bookings.store') }}" method="POST" class="p-5 bg-white">
        @csrf
        <input type="hidden" name="services" id="services-input">
        <h6>Welcome {{ auth()->user()->name }}</h6>
        <h5>You can book here:</h5>
        <div class="row form-group">
            @if(auth()->user()->isOwner())
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">Your Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
            </div>
            @endif
        </div>

        <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="text-black" for="time">Time</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>
        </div>

        <div class="row form-group">
            @if(auth()->user()->isOwner())
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="email">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
            </div>
            @endif

            <div class="col-md-6">
                <label class="text-black" for="note">Notes</label>
                <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <input type="submit" value="Send" class="btn btn-primary py-2 px-4 text-white" onclick="validateAndSubmit()">
            </div>
        </div>
    </form>
</div>

<script>
     document.addEventListener('DOMContentLoaded', (event) => {
        // ضبط الحد الأدنى للتاريخ ليكون اليوم الحالي
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);

        const dateInput = document.getElementById('date');
        const timeInput = document.getElementById('time');

        function updateMinTime() {
            const now = new Date();
            const selectedDate = new Date(dateInput.value);

            // إذا كان التاريخ المختار هو اليوم، اجعل الحد الأدنى للوقت هو الآن
            if (selectedDate.toDateString() === now.toDateString()) {
                const hours = now.getHours();
                const minutes = now.getMinutes();
                const minTime = `${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
                timeInput.setAttribute('min', minTime);
            } else {
                // إذا كان تاريخ الحجز بعد اليوم، قم بإعادة تعيين الحد الأدنى للوقت إلى منتصف الليل
                timeInput.removeAttribute('min');
            }
        }

        // عند تغيير التاريخ، تأكد من تحديث الحد الأدنى للوقت
        dateInput.addEventListener('change', updateMinTime);

        // استدعاء الدالة لضبط الحد الأدنى للوقت عند التحميل
        updateMinTime();
    });
    const selectedServices = new Set();

    function toggleServices(categorieId) {
        const servicesDropdown = document.getElementById(`services-${categorieId}`);
        if (servicesDropdown) {
            servicesDropdown.style.display = (servicesDropdown.style.display === "none" || servicesDropdown.style.display === "") ? "block" : "none";
        } else {
            console.error("Dropdown not found");
        }
    }

    function addService(serviceId, serviceName, servicePrice) {
        const selectedItemsContainer = document.getElementById('selected-items');
        const totalPriceElement = document.getElementById('total-price');
        const servicesInput = document.getElementById('services-input');

        if (selectedServices.has(serviceId)) {
            alert("This service is already added.");
            return;
        }
        selectedServices.add(serviceId);

        const item = document.createElement('div');
        item.className = 'selected-item';
        item.innerHTML = `<span>${serviceName} - $${servicePrice}</span> <button onclick="removeService('${serviceId}', ${servicePrice})" style="background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">✖</button>`;
        selectedItemsContainer.appendChild(item);

        updateTotalPrice(servicePrice);
        servicesInput.value = Array.from(selectedServices).join(',');
    }

    function removeService(serviceId, servicePrice) {
        const selectedItemsContainer = document.getElementById('selected-items');
        const items = Array.from(selectedItemsContainer.children);
        items.forEach(item => {
            if (item.innerHTML.includes(serviceId)) {
                selectedItemsContainer.removeChild(item);
                selectedServices.delete(serviceId);
                updateTotalPrice(-servicePrice);
            }
        });
    }

    function clearServices() {
        const selectedItemsContainer = document.getElementById('selected-items');
        selectedItemsContainer.innerHTML = '';
        selectedServices.clear();
        updateTotalPrice(-parseFloat(document.getElementById('total-price').innerText.replace('Total Price: $', '')));
    }

    function updateTotalPrice(priceChange) {
        const totalPriceElement = document.getElementById('total-price');
        let currentTotal = parseFloat(totalPriceElement.innerText.replace('Total Price: $', ''));
        currentTotal += priceChange;
        totalPriceElement.innerText = `Total Price: $${currentTotal.toFixed(2)}`;
    }

    function validateAndSubmit() {
        const servicesInput = document.getElementById('services-input');
        if (selectedServices.size === 0) {
            alert("Please select at least one service before submitting.");
            return false;
        }
        servicesInput.value = Array.from(selectedServices).join(',');
        return true;
    }
</script>

@endsection
