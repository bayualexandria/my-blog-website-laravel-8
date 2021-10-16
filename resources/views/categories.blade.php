@extends('layouts.frontend.app')

@section('content')
<section id="blogs-hero">
    <div class="container pt-5">
        <div class="jumbotron row justify-content-between mb-0 pb-0 pt-5">

            <div class="col-md-4 text-start position-relative pt-5 mb-5">
                <h1 class="display-4 mb-3 color-main fs-3" style="font-weight: 500;">Halaman Kategori </h1>
                <div class="d-flex align-items-center justify-content-start">
                    <a href="#" class="text-decoration-none badge bg-primary">Semua</a>
                </div>
                <form action="{{ route('categories') }}">
                    <div class="input-group mt-4">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                            placeholder="Type search...">
                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i data-feather="search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 text-center">
                <img src="assets/images/web/kategori.svg" alt="blogs" class="img-fluid w-50">
            </div>

        </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099ff" fill-opacity="1" d="M0,64L720,192L1440,64L1440,320L720,320L0,320Z"></path>
    </svg>
</section>

<section id="kategori">
    <div class="container">
        <div class="row justify-content-center">
            @if ($categories->count())
            @foreach ($categories as $category)
            <div class="col-md-3 mb-5">
                <div class="category text-center">
                    <a href="{{ url('blogs?category='.$category->slug) }}" class="icon-category {{ $category->color }}">
                        <i class="{{ $category->icon }} icon"></i>
                    </a>
                    <h6 class="category-text">{{ $category->name }}</h6>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-md-6 text-center">
                <h4 class="text-white font-weight-bold">Kategori yang kamu cari tidak ada</h4>
            </div>
            @endif
        </div>
    </div>
</section>
{{-- Footer --}}
<section id="footer" class="bg-main">
    <div class="container pt-5">
        <div class="row justify-content-between ">
            <div class="col-md-5 mb-3 text-start text-white fs-8" style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7)">
                <p style="font-weight: 400">{{ date('Y') }}&copy; b@yu 4lex@ndr!4</p>
            </div>
            <div class="col-md-5">
                <p class="text-white fs-8 text-end"
                    style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7);font-weight: 400;">Cre@ted and
                    wr!te by
                    Bayu Wardana</p>
            </div>
        </div>
    </div>
</section>
{{-- End Footer --}}
@endsection
