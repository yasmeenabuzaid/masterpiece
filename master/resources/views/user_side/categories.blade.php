@extends('layouts.app-user')

@section('content')
<style>
    .container {
        display: flex;
        justify-content: space-between;
    }
    .categories {
        width: 60%;
    }
    .selected-services {
        width: 35%;
        border-left: 1px solid #ddd;
        padding-left: 20px;
    }
    .card {
        background-color: rgb(255, 255, 255);
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin: 10px 0;
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
        width: 80px;
        height: 80px;
        border-radius: 5px;
        margin-right: 10px;
    }
    .selected-item {
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .no-services {
        color: #666;
        font-style: italic;
    }
    .total-price {
        font-weight: bold;
        margin-top: 15px;
    }
</style>

<div class="container-xxl py-5">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h1 class="mb-5">All Categories in {{ $subsalon->name }}</h1>
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
                <div class="services-dropdown" id="services-{{ $categorie->id }}">
                    @if($categorie->services->isEmpty())
                        <p class="no-services">No services are currently available.</p>
                    @else
                        <ul>
                            @foreach($categorie->services as $service)
                                <li class="service-item">
                                    <div style="display: flex; align-items: center;">
                                        <img src="{{ asset($service->image ? $service->image : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQZUYP1nWYaAFpSvhTYPwzO91_T6Sbdiysw-juuJQ5daDmBCjKm3oA_oP2toTI4Ni8Y98&usqp=CAU') }}" alt="Service Image">
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
            <div id="selected-items"></div>
            <div class="total-price" id="total-price">Total Price: $0</div>
            <a href="{{ route('user-booking') }}" id="book-button" style="padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; text-decoration: none; display: inline-block;" disabled>
                Book Now
            </a>
        </div>
    </div>
</div>

<script>
    let selectedServices = [];
    let totalPrice = 0;

    function toggleServices(categorieId) {
        const dropdown = document.getElementById('services-' + categorieId);
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    function addService(serviceId, serviceName, price) {
        // Check if service is already selected
        const serviceExists = selectedServices.some(service => service.id === serviceId);
        if (serviceExists) {
            alert(`Service "${serviceName}" is already selected.`);
            return; // Exit if service already exists
        }

        // Add service to selected items
        selectedServices.push({ id: serviceId, name: serviceName, price: price });
        totalPrice += price;

        updateSelectedServices();
    }

    function removeService(serviceId, price) {
        // Remove service from selected items
        selectedServices = selectedServices.filter(service => service.id !== serviceId);
        totalPrice -= price;

        updateSelectedServices();
    }

    function updateSelectedServices() {
        const selectedItemsDiv = document.getElementById('selected-items');
        selectedItemsDiv.innerHTML = ''; // Clear current items

        selectedServices.forEach(service => {
            const item = document.createElement('div');
            item.className = 'selected-item';
            item.innerHTML = `${service.name} - $${service.price} <button onclick="removeService('${service.id}', ${service.price})" style="margin-left: 10px; padding: 5px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">Remove</button>`;
            selectedItemsDiv.appendChild(item);
        });

        document.getElementById('total-price').innerText = `Total Price: $${totalPrice}`;
        document.getElementById('book-button').disabled = selectedServices.length === 0;
    }
</script>

@endsection
