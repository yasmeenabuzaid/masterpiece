@extends('layouts.app-user')
@section('content')
<style>
    .custom-btn {
        background-color: white;
        border: 1px solid #ccc;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-right: 30px;
        padding: 0px 10px;
    }
</style>
<section>
  <h1>The Best Salons</h1>
  <div class="container mt-3">
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn custom-btn">فلتر 1</button>
        <button type="button" class="btn custom-btn">فلتر 2</button>
        <button type="button" class="btn custom-btn">فلتر 3</button>
    </div>
</div>


  <div class="slider">
    <div class="slider-wrapper">

      <div class="slide">
        <img src="https://i.pinimg.com/564x/f3/4a/9a/f34a9aeb286b1a3a8782b7f06665476a.jpg" alt="Salon Sara">
        <div class="card-btns">
          <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50 |<i class="fa-regular fa-user"></i> 4
        </div>
        <div class="card-text">
          <h3>Salon Sara</h3>
          <p>Lorem ipsum dolor sit explicabo adipisicing elit.</p>
        </div>
        <div class="card-btn">
        <button><i class="fa-regular fa-eye"></i></button>

              </div>
      </div>
      <div class="slide">
        <img src="https://i.pinimg.com/564x/38/99/13/38991376f23fc86b1416e0042ded9980.jpg" alt="Salon Sara">
        <div class="card-btns">
          <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50 |<i class="fa-regular fa-user"></i> 4
        </div>
        <div class="card-text">
          <h3>Salon Sara</h3>
          <p>Lorem ipsum dolor sit explicabo adipisicing elit.</p>
        </div>
        <div class="card-btn">
        <button><i class="fa-regular fa-eye"></i></button>

              </div>
      </div>
      <div class="slide">
        <img src="https://i.pinimg.com/564x/de/ad/10/dead102eea9e401bb9740bcf98d8bec3.jpg" alt="Salon Sara">
        <div class="card-btns">
          <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50 |<i class="fa-regular fa-user"></i> 4
        </div>
        <div class="card-text">
          <h3>Salon Sara</h3>
          <p>Lorem ipsum dolor sit explicabo adipisicing elit.</p>
        </div>
        <div class="card-btn">
        <button><i class="fa-regular fa-eye"></i></button>

              </div>
      </div>
      <div class="slide">
        <img src="https://i.pinimg.com/564x/de/ad/10/dead102eea9e401bb9740bcf98d8bec3.jpg" alt="Salon Sara">
        <div class="card-btns">
          <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50 |<i class="fa-regular fa-user"></i> 4
        </div>
        <div class="card-text">
          <h3>Salon Sara</h3>
          <p>Lorem ipsum dolor sit explicabo adipisicing elit.</p>
        </div>
        <div class="card-btn">
        <button><i class="fa-regular fa-eye"></i></button>

              </div>
      </div>
      <div class="slide">
        <img src="https://i.pinimg.com/564x/de/ad/10/dead102eea9e401bb9740bcf98d8bec3.jpg" alt="Salon Sara">
        <div class="card-btns">
          <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50 |<i class="fa-regular fa-user"></i> 4
        </div>
        <div class="card-text">
          <h3>Salon Sara</h3>
          <p>Lorem ipsum dolor sit explicabo adipisicing elit.</p>
        </div>
        <div class="card-btn">
        <button><i class="fa-regular fa-eye"></i></button>

              </div>
      </div>
    </div>
  </div>
</section>
<section>



</section>



@endsection
