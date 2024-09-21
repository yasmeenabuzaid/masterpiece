<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>Laravel</title> --}}
    @extends('layouts.app-user')
    @section('content')
        <main>
            <img src="../img/home.jpg" alt="صورة خلفية">
            <div class="overlay"></div>
            <div class="content">
                <div class="welcome_text">
                    <h3>WELCOME TO</h3>
                    <h1>Beauty Connect</h1>
                </div>
                <a href="index2.html">
                    <button class="start-btn">
                        explore more
                        <div class="star-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-3">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-4">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-6">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </button>
                </a>
            </div>
        </main>
        <section>
            <h1>The Best Salons</h1>
            <div class="slider">
                    <div class="slider-wrapper">

                        @foreach ($salons->slice(0, 4) as $salon)
                        <div class="slide">
                                <img src="{{ asset($salon->image) }}" alt="Salon Image">
                            <div class="card-btns">
                                <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50
                                |<i class="fa-regular fa-user"></i> 4
                            </div>
                            <div class="card-text">
                                <h3>{{ $salon->name }}</h3>
                                <span>{{ $salon->description }}</span>
                            </div>
                            <div class="card-btn">
                                <button class="see-more-btn"><i class="fa-regular fa-eye"></i> see more</button>

                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="slide">
                            <img src="https://i.pinimg.com/564x/38/99/13/38991376f23fc86b1416e0042ded9980.jpg"
                                alt="Salon Sara">
                            <div class="card-btns">
                                <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50
                                |<i class="fa-regular fa-user"></i> 4
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
                            <img src="https://i.pinimg.com/564x/de/ad/10/dead102eea9e401bb9740bcf98d8bec3.jpg"
                                alt="Salon Sara">
                            <div class="card-btns">
                                <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50
                                |<i class="fa-regular fa-user"></i> 4
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
                            <img src="https://i.pinimg.com/564x/de/ad/10/dead102eea9e401bb9740bcf98d8bec3.jpg"
                                alt="Salon Sara">
                            <div class="card-btns">
                                <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50
                                |<i class="fa-regular fa-user"></i> 4
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
                            <img src="https://i.pinimg.com/564x/de/ad/10/dead102eea9e401bb9740bcf98d8bec3.jpg"
                                alt="Salon Sara">
                            <div class="card-btns">
                                <i class="fa-regular fa-comment-dots"></i> 200 |<i class="fa-regular fa-bookmark"></i> 50
                                |<i class="fa-regular fa-user"></i> 4
                            </div>
                            <div class="card-text">
                                <h3>Salon Sara</h3>
                                <p>Lorem ipsum dolor sit explicabo adipisicing elit.</p>
                            </div>
                            <div class="card-btn">
                                <button><i class="fa-regular fa-eye"></i></button>

                            </div>
                        </div> --}}
                    </div>
            </div>
        </section>
        <section>



        </section>
    @endsection


</head>


</div>
</div>
</div>
</body>

</html>
