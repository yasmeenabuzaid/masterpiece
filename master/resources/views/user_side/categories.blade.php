@extends('layouts.app-user')

@section('content')
<style>
    /* تنسيق عام */
    .main {
        display: flex;
        flex-direction: column;
        margin: 50px 0;
    }

    .container {
        display: flex;
        justify-content: space-between;
        gap: 30px;
    }

    .categories {
        flex: 2;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .selected-services {
        flex: 1;
        border-left: 1px solid #ddd;
        padding-left: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .service-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        justify-content: space-between;
        border-bottom: 1px solid #f1f1f1;
        padding-bottom: 15px;
    }

    .service-item img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .service-item button {
        background-color: #626161;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .service-item button:hover {
        background-color: #484848;
    }

    .service-details {
        flex: 1;
        margin-left: 15px;
    }

    .service-details strong {
        font-size: 1.1em;
    }

    .service-details span {
        font-size: 0.9em;
        color: #777;
    }

 /* Filter Form Styles */
 .filter-form {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        align-items: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .filter-form select,
    .filter-form input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 200px;
        transition: all 0.3s ease;
    }

    .filter-form select:focus,
    .filter-form input:focus {
        border-color: #007bff;
        outline: none;
    }

    .filter-form button {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .filter-form button:hover {
        background-color: #0056b3;
    }

    .btn-group .btn {
        margin: 5px;
        border-radius: 5px;
        padding: 10px 20px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        font-size: 14px;
        color: #333;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-group .btn:hover,
    .btn-group .btn.active {
        background-color: #007bff;
        color: #fff;
    }

    .selected-item {
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        background: #e9f5ff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .selected-services .total-price {
        font-weight: bold;
        margin-top: 15px;
        font-size: 1.2em;
    }

    .no-services {
        text-align: center;
        color: #999;
        font-size: 1.1em;
    }

    .categories h3 {
        font-size: 1.3em;
        margin-bottom: 20px;
        color: #484848;
    }
    /* تنسيق عام */
.main {
    display: flex;
    flex-direction: column;
    margin: 50px 0;
}

.container {
    display: flex;
    justify-content: space-between;
    gap: 30px;
}

.categories {
    flex: 2;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.selected-services {
    flex: 1;
    border-left: 1px solid #ddd;
    padding-left: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}

.service-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    justify-content: space-between;
    border-bottom: 1px solid #f1f1f1;
    padding: 15px;
    transition: all 0.3s ease; /* إضافة انسيابية */
}

/* تأثير hover عند التمرير */
.service-item:hover {
    background-color: #f0f0f0; /* تغيير الخلفية عند التمرير فوق الخدمة */
    cursor: pointer; /* تغيير المؤشر إلى يد */
    transform: translateY(-5px); /* رفع العنصر قليلاً */
}

/* تأثير عند النقر */
.service-item:active {
    border: 2px solid #007bff; /* إضافة حدود أزرق */
    box-shadow: 0 0 2px #007bff; /* تأثير الظل الأزرق */
}

/* تأثير الزر عند hover */
.service-item button:hover {
    background-color: #007bffc3; /* تغيير اللون إلى الأزرق */
    color: white; /* تغيير النص إلى الأبيض */
}

/* تأثير الزر عند النقر */
.service-item button:active {
    background-color: #007bff; /* تغيير اللون إلى الأزرق الداكن */
}

/* الكلاس النشط عند إضافة الخدمة */
.service-item.active {
    border: 2px solid #007bff;
    box-shadow: 0 0 2px #007bff; /* تأثير الظل الأزرق */
}

.selected-item {
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    background: #e9f5ff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0px 2px rgba(0, 0, 0, 0.2);
}

.selected-services .total-price {
    font-weight: bold;
    margin-top: 15px;
    font-size: 1.2em;
}

.no-services {
    text-align: center;
    color: #999;
    font-size: 1.1em;
}

.categories h3 {
    font-size: 1.3em;
    margin-bottom: 20px;
    color: #484848;
}

.filter-form {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 0px;  /* تقليص المسافة تحت الفلتر */
    flex-wrap: wrap;
}

.filter-form select,
.filter-form input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    width: 200px;
    transition: all 0.3s ease;
}

.filter-form select:focus,
.filter-form input:focus {
    border-color: #007bff;
    outline: none;
}

.filter-form button {
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.filter-form button:hover {
    background-color: #007bff;
}

.btn-group .btn {
    margin: 5px;
    border-radius: 5px;
    padding: 10px 20px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    font-size: 14px;
    color: #333;
    transition: background-color 0.3s, color 0.3s;
}

.btn-group .btn:hover,
.btn-group .btn.active {
    background-color: #007bff;
    color: #fff;
}
/* تقليص المسافة بين العنوان والفلتر */
.row.justify-content-center.align-items-center {
    margin-bottom: 20px; /* تقليل المسافة أسفل العنوان والفلتر */
}

/* تقليص المسافة بين الفلتر وسكشن الخدمات */
.filter-form {
    margin-top: 10px; /* تقليص المسافة العليا */
    margin-bottom: 20px; /* تقليص المسافة السفلية */
}

/* تقليص المسافة بين سكشن الخدمات وسكشن الخدمات المحددة */
.container {
    gap: 20px; /* تقليص المسافة بين سكشن الفئات والخدمات المحددة */
}

/* إضافة بعض التنسيق لمراعاة الهوامش */
.categories, .selected-services {
    margin-top: 0;
    margin-bottom: 0px;
}

</style>

{{-- ---------------------------------------------Success/Error Alert Section --------------------------------- --}}

        <!-- Title and Filter Form in the same row -->
        <div class="row justify-content-center align-items-center" style="display: flex; flex-direction: column; align-items: center;margin-top:50px">
            <!-- Title -->
            <div class="col-md-8 text-center">
                <h2 class="text-uppercase heading border-bottom mb-4 ">Services</h2>
                <p class="mb-0 lead">You can easily browse through our diverse range of services. Choose the service that suits your needs, then select a convenient time to complete your booking. The process is quick and easy, with flexible options that allow you to choose times that fit your schedule</p>

            </div>
 <!-- Steps Section -->
                <div class="steps mt-5">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h5>Choose a Service</h5>
                        </div>
                    </div>
                    <!-- Arrow between steps -->
                    <div class="arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h5>Book Your Appointment</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom CSS for Step Design -->
            <style>
                .steps {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 40px;
                    text-align: left;
                }

                .step-item {
                    width: 90px;
                    text-align: center;
                }

                .step-number {
                    background-color: #007bff;
                    color: white;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    margin: 0 auto 10px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 18px;
                }

                .step-content h5 {
                    font-size: 16px;
                    font-weight: bold;
                    margin-bottom: 0px;
                }

                .step-content p {
                    font-size: 14px;
                    color: #555;
                }

                .arrow {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .arrow i {
                    font-size: 24px;
                    color: #007bff;
                }

                .step-item:hover .step-number {
                    background-color: #0056b3;
                }

                /* Styling for the arrows between steps */
                .arrow i {
                    margin: 0 20px;
                }

                /* Add a little space between text and the number */
                .step-item + .step-item {
                    margin-left: 10px;
                }
            </style>

            <!-- Add Font Awesome for Arrow Icons -->
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<section class="section bg-light py-5">

<div class="container">
    <div class="categories">
        <h3>Choose a category</h3>
        <div class="filter-form">
            <form method="GET" action="{{ route('more_subsalons') }}" class="d-flex justify-content-between w-100 gap-3">
                <!-- Category Filter -->
                <div class="btn-group filter-btn-group w-100" role="group" aria-label="Category Filter">
                    <button type="button" onclick="filterByCategory('all')" class="btn {{ request('category') == 'all' ? 'active' : '' }}">All Services</button>
                    @foreach($categories as $categorie)
                        @if($categorie->services->isNotEmpty()) <!-- إذا كانت الفئة تحتوي على خدمات -->
                            <button type="button" onclick="filterByCategory('{{ $categorie->id }}')" class="btn {{ request('category') == $categorie->id ? 'active' : '' }}">
                                {{ $categorie->name }} ({{ $categorie->services->count() }})
                            </button>
                        @endif
                    @endforeach
                </div>
            </form>
        </div>
        @foreach($categories as $categorie)
            @if($categorie->services->isNotEmpty()) <!-- عرض الفئة فقط إذا كانت تحتوي على خدمات -->
                <div class="services-list" id="services-{{ $categorie->id }}" style="display: none;">
                    <ul>
                        @foreach($categorie->services as $service)
                        <li class="service-item" id="service-{{ $service->id }}">
                            {{-- <img src="{{ asset($service->image ?: 'default_service_image.jpg') }}" alt="Service Image"> --}}
                            <div class="service-details">
                                <strong>{{ $service->name }}</strong> - ${{ $service->price }}<br>
                                <span>{{ $service->description }}</span><br>
                                <span>Duration: {{ $service->duration }}</span>
                            </div>
                            <button onclick="addService('{{ $service->id }}', '{{ $service->name }}', {{ $service->price }})">+</button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>

    <div class="selected-services">
        <h3>Selected Services</h3>
        <div id="selected-items"></div>
        <hr>
        <div class="total-price" id="total-price">Total Price: $0</div>
        <button class="btn btn-primary mt-4" id="continue-btn" onclick="showModal()">Continue</button>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Confirm Your Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.history.back()"></button>
      </div>
      <div class="modal-body">
        <h6>Selected Services</h6>
        <div id="modal-selected-items"></div>
        <div id="modal-total-price">Total Price: $0</div>
        <form action="{{ route('bookings.store') }}" method="POST" id="booking-form">
            @csrf
            <input type="hidden" name="services" id="modal-services-input">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="modal-date" class="form-control" required min="{{ now()->toDateString() }}">
            </div>
            <div class="form-group">
                <label class="text-black" for="available_time">Available Time</label>
                <select name="time" id="available_time" class="form-control" required>
                    <option value="">Select a time</option>
                </select>
            </div>
            <input type="hidden" name="sub_salons_id" value="{{ $subsalon->id }}">

            <div class="form-group">
                <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
            </div>
            <div class="form-group">
                {{-- <input type="submit" value="Book Now" class="btn btn-primary" style="width: 170px"> --}}
            </div>
        </form>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" onclick="window.history.back()">Close</button> --}}
        <button type="button" class="btn btn-primary" onclick="submitBooking()">Confirm Booking</button>
      </div>
    </div>
  </div>
</div>

<script>
const selectedServices = new Set();
const selectedServicesData = {};
let totalPrice = 0;

function addService(serviceId, serviceName, servicePrice) {
    if (selectedServices.has(serviceId)) {
        alert("Service already selected.");
        return;
    }

    selectedServices.add(serviceId);
    selectedServicesData[serviceId] = { name: serviceName, price: servicePrice };
    totalPrice += servicePrice;

    // إضافة الكلاس active لتحديد العنصر
    const serviceItem = document.querySelector(`#service-${serviceId}`);
    serviceItem.classList.add('active');

    const selectedItemsContainer = document.getElementById('selected-items');
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('selected-item');
    itemDiv.setAttribute('data-service-id', serviceId); // إضافة معرّف الخدمة كـ data attribute
    itemDiv.innerHTML = `
        <span>${serviceName} - $${servicePrice}</span>
        <button onclick="removeService('${serviceId}', ${servicePrice})">Remove</button>
    `;
    selectedItemsContainer.appendChild(itemDiv);

    document.getElementById('total-price').innerText = `Total Price: $${totalPrice}`;
}
function showModal() {
    var myModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    myModal.show();  // عرض الموديل
}
function removeService(serviceId, servicePrice) {
    selectedServices.delete(serviceId);
    totalPrice -= servicePrice;

    // إزالة الكلاس active عند إزالة الخدمة
    const serviceItem = document.querySelector(`#service-${serviceId}`);
    if (serviceItem) {
        serviceItem.classList.remove('active');
    }

    const selectedItemsContainer = document.getElementById('selected-items');
    const itemDiv = document.querySelector(`.selected-item[data-service-id="${serviceId}"]`); // استخدام data attribute للبحث عن العنصر
    if (itemDiv) {
        selectedItemsContainer.removeChild(itemDiv);
    }

    document.getElementById('total-price').innerText = `Total Price: $${totalPrice}`;
}

function showModal() {
    if (selectedServices.size === 0) {
        alert("Please select at least one service.");
        return;
    }

    const modalSelectedItems = document.getElementById('modal-selected-items');
    modalSelectedItems.innerHTML = '';

    selectedServices.forEach(serviceId => {
        const serviceName = selectedServicesData[serviceId].name;
        const servicePrice = selectedServicesData[serviceId].price;

        const itemDiv = document.createElement('div');
        itemDiv.classList.add('selected-item');
        itemDiv.innerHTML = `${serviceName} - $${servicePrice}`;
        modalSelectedItems.appendChild(itemDiv);
    });

    document.getElementById('modal-total-price').innerText = `Total Price: $${totalPrice}`;
    document.getElementById('modal-services-input').value = Array.from(selectedServices).join(',');

    const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    bookingModal.show();
}

function submitBooking() {
    const selectedDate = document.getElementById('modal-date').value;
    const selectedTime = document.getElementById('available_time').value;

    if (!selectedDate || !selectedTime) {
        alert("Please select a date and time.");
        return;
    }

    document.getElementById('booking-form').submit();
}

function filterByCategory(categoryId) {
    const allCategories = document.querySelectorAll('.services-list');

    // إخفاء جميع الفئات
    allCategories.forEach(category => {
        // إظهار الفئات التي تحتوي على خدمات فقط
        if (category.id === `services-${categoryId}` || categoryId === 'all') {
            category.style.display = 'block';
        } else {
            category.style.display = 'none';
        }
    });

    // تمييز الزر النشط
    const buttons = document.querySelectorAll('.filter-btn-group button');
    buttons.forEach(button => button.classList.remove('active'));
    const selectedButton = document.querySelector(`.filter-btn-group button[onclick="filterByCategory('${categoryId}')"]`);
    selectedButton.classList.add('active');
}

// استدعاء الفلترة عند تحميل الصفحة
window.onload = function() {
    filterByCategory('all');
}

document.getElementById('modal-date').addEventListener('change', function () {
    const selectedDate = this.value;

    if (!selectedDate) return;

    const availableTimeSelect = document.getElementById('available_time');
    availableTimeSelect.innerHTML = `<option>Loading...</option>`;

    const subSalonId = "{{ $subsalon->id }}";
    fetch(`/subsalon/${subSalonId}/available-times?date=${selectedDate}`)
        .then(response => response.json())
        .then(data => {
            availableTimeSelect.innerHTML = `<option value="">Select a time</option>`;

            if (data.length === 0) {
                availableTimeSelect.innerHTML += `<option>No available times</option>`;
            } else {
                data.forEach(time => {
                    availableTimeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                });
            }
        })
        .catch(error => {
            console.error('Error fetching available times:', error);
            availableTimeSelect.innerHTML = `<option>Error loading times</option>`;
        });
});

</script>
@push('scripts')
    <script>
        // SweetAlert success/error logic
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endpush

@endsection
