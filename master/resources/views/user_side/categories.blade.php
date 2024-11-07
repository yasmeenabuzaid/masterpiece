@extends('layouts.app-user')

@section('content')
<style>
    /* CSS هنا يمكن نقله إلى ملف خارجي */
    .main {
        display: flex;
        flex-direction: column;
        margin: 50px;
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
        background-color: #fff;
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
    .selected-item {
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        background: #e9f5ff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    /* جعل العناوين الكبيرة في المنتصف */
    h1, h2, h3, h4 {
        text-align: center;
    }

    /* تخصيص ألوان الأزرار */
    .btn-primary {
        background-color: #484848;
        border-color: #484848;
    }

    .btn-primary:hover {
        background-color: #626161; /* لون أزرق داكن عند التمرير */
        border-color: #484848;
    }
    .main h1 {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }
    button{
        background-color: #626161; /* لون أزرق داكن عند التمرير */
        border-color: #484848;
        color: white;
    }
    .site-blocks-cover {
        background-attachment: fixed; /* تثبيت الصورة */
        background-size: cover; /* تغطية العنصر بالكامل بالصورة */
        background-position: center; /* تحديد مركز الصورة */
    }
    <style>
    /* CSS هنا يمكن نقله إلى ملف خارجي */
    .main {
        display: flex;
        flex-direction: column;
        margin: 50px;
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
        background-color: #fff;
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
    .selected-item {
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        background: #e9f5ff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    h1, h2, h3, h4 {
        text-align: center;
    }
    .btn-primary {
        background-color: #484848;
        border-color: #484848;
    }
    .btn-primary:hover {
        background-color: #626161;
        border-color: #484848;
    }
    .main h1 {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }
    button {
        background-color: #626161;
        border-color: #484848;
        color: white;
    }
    .site-blocks-cover {
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
    }





</style>

<div class="slide-one-item home-slider owl-carousel">
    <div class="site-blocks-cover inner-page-cover" style="background-image: url('{{ asset($subsalon->salon->image ?? 'default_image.jpg') }}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="filter-overlay"></div>
        <div class="container" style="position: relative; height: 90%; padding: 0; margin: 0;">
            <div class="text-container" style="position: absolute; bottom: 20px; left: 0; text-align: left;">
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-white font-weight-light mb-2 display-1">{{ $subsalon->salon->name }}.{{ $subsalon->address }}</h2>
                    <div class="search-section">
                        <h4>Location: {{$subsalon->location}}</h4>
                        <h4>Type of this salon: {{$subsalon->type}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

<div class="container-xxl py-5">
    <div class="text-center">
        <h1 class="m-4">All Categories in {{ $subsalon->name }}</h1>
    </div>

    <div class="container">
        <div class="categories">
            @foreach($categories as $categorie)
                <div class="card" onclick="toggleServices('{{ $categorie->id }}')">
                    <div class="text-container" style="display: flex; justify-content: space-between;">
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
                                    <img src="{{ asset($service->image ?: 'default_service_image.jpg') }}" alt="Service Image">
                                    <div>
                                        <strong>{{ $service->name }}</strong> - ${{ $service->price }}<br>
                                        <span>{{ $service->description }}</span><br>
                                        <span>Duration: {{ $service->duration }}</span>
                                    </div>
                                    <button onclick="addService('{{ $service->id }}', '{{ $service->name }}', {{ $service->price }})">+</button>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="selected-services">
            <h3>Selected Services</h3>
            <br>
            <br>

            {{-- <button onclick="clearServices()">Clear All Services</button> --}}
            <div id="selected-items"></div>
            <hr>
            <div class="total-price" id="total-price">Total Price: $0</div>
        </div>
    </div>
</div>

<div class="main">
    <h1 class="m-4">Book Now</h1>



    <form action="{{ route('bookings.store') }}" method="POST" class="p-5 bg-white" onsubmit="return validateAndSubmit()">
        @csrf
        <input type="hidden" name="services" id="services-input">
        <h6>Welcome {{ auth()->user()->name }}</h6>
        <h5>You can book here:</h5>

        @php
            $workingDays = [];
            foreach($categories as $category) {
                $days = optional($category->subsalon)->working_days;
                if (is_array($days) && count($days) > 0) {
                    $workingDays = array_merge($workingDays, $days);
                }
            }
            $workingDays = array_unique($workingDays); // إزالة التكرارات
        @endphp

        <div class="form-group">
            <label class="text-black" for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <h3>Opening Hours: {{ date('H:i', strtotime($subsalon->opening_hours_start)) }} - {{ date('H:i', strtotime($subsalon->opening_hours_end)) }}</h3>
        <div class="form-group">
            <label class="text-black" for="available_time">Available Time</label>
            <select name="time" id="available_time" class="form-control" required>
                <option value="">Select a time</option>
                <!-- سيتم إضافة الخيارات هنا بواسطة JavaScript -->
            </select>
        </div>
        <div class="form-group">
            <label class="text-black">Number of Associated Users: </label>
            <span>
                {{ $categorie->subsalon->usersCount() > 0 ? $categorie->subsalon->usersCount() : 'No associated users' }}
            </span>
        </div>



        <div class="form-group">
            <label class="text-black" for="note">Notes</label>
            <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Send" class="btn btn-primary" style="width: 170px">
        </div>
    </form>
</div>

<script>
    const selectedServices = new Set();
    let totalPrice = 0;
    const subSalonId = '{{ $subsalon->id }}';
    const workingDays = @json($workingDays); // جلب أيام العمل من PHP

    function toggleServices(categorieId) {
        const servicesDropdown = document.getElementById(`services-${categorieId}`);
        servicesDropdown.style.display = servicesDropdown.style.display === "none" || servicesDropdown.style.display === "" ? "block" : "none";
    }

    function addService(serviceId, serviceName, servicePrice) {
        if (selectedServices.has(serviceId)) {
            alert("Service already selected.");
            return;
        }

        selectedServices.add(serviceId);
        totalPrice += servicePrice;

        const selectedItemsContainer = document.getElementById('selected-items');
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('selected-item');
        itemDiv.innerHTML = `
            <span>${serviceName} - $${servicePrice}</span>
            <button onclick="removeService('${serviceId}', ${servicePrice})">Remove</button>
        `;
        selectedItemsContainer.appendChild(itemDiv);

        document.getElementById('total-price').innerText = `Total Price: $${totalPrice}`;
        updateServicesInput();
    }

    function fetchAvailableTimes(selectedDate) {
        fetch(`/available-times/${subSalonId}?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                const timeSelect = document.getElementById('available_time');
                timeSelect.innerHTML = '';

                if (data.length === 0) {
                    timeSelect.innerHTML = '<option value="">No available times</option>';
                    return;
                }

                const currentTime = new Date();
                const currentDate = currentTime.toISOString().split('T')[0];
                const currentHour = currentTime.getHours();
                const currentMinute = currentTime.getMinutes();

                let hasAvailableTime = false;

                data.forEach(time => {
                    const [hour, minute] = time.split(':').map(Number);
                    if (selectedDate === currentDate && (hour < currentHour || (hour === currentHour && minute <= currentMinute))) {
                        return;
                    }
                    hasAvailableTime = true;
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);
                });

                if (!hasAvailableTime) {
                    timeSelect.innerHTML = '<option value="">No available times</option>';
                }
            })
            .catch(error => console.error('Error fetching available times:', error));
    }

    document.getElementById('date').addEventListener('change', function() {
        const selectedDate = this.value;
        const today = new Date().toISOString().split('T')[0];
        if (selectedDate < today) {
            alert("Cannot select past dates.");
            this.value = '';
            document.getElementById('available_time').innerHTML = '';
            return;
        }

        // تحقق مما إذا كان اليوم المحدد من ضمن أيام العمل
        const selectedDay = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long' });
        if (!workingDays.includes(selectedDay)) {
            alert("The selected date is not a working day.");
            this.value = '';
            document.getElementById('available_time').innerHTML = '';
            return;
        }

        fetchAvailableTimes(selectedDate);
    });

    function removeService(serviceId, servicePrice) {
        if (!selectedServices.has(serviceId)) return;

        selectedServices.delete(serviceId);
        totalPrice -= servicePrice;
        document.getElementById('total-price').innerText = `Total Price: $${totalPrice}`;

        const selectedItemsContainer = document.getElementById('selected-items');
        selectedItemsContainer.querySelectorAll('.selected-item').forEach(item => {
            if (item.querySelector('span').innerText.includes(serviceId)) {
                selectedItemsContainer.removeChild(item);
            }
        });
        updateServicesInput();
    }

    function updateServicesInput() {
        document.getElementById('services-input').value = Array.from(selectedServices).join(',');
    }

    function clearServices() {
        selectedServices.clear();
        totalPrice = 0;
        document.getElementById('total-price').innerText = `Total Price: $0`;
        document.getElementById('selected-items').innerHTML = '';
        updateServicesInput();
    }

    function validateAndSubmit() {
        if (selectedServices.size === 0) {
            alert("Please select at least one service.");
            return false;
        }
        document.getElementById('services-input').value = Array.from(selectedServices).join(',');
        return true;
    }
</script>
@endsection
