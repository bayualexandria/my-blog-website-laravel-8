@extends('layouts.frontend.app')

@section('content')
<section id="blogs-hero">
    <div class="container pt-5">
        <div class="jumbotron row justify-content-between mb-0 pb-0 pt-5">

            <div class="col-md-4 text-start position-relative pt-5 mb-5">
                <h1 class="display-4 mb-3 color-main fs-3" style="font-weight: 500;">Halaman Blogs </h1>
                <div class="d-flex align-items-center justify-content-start">
                    @if (request('category'))
                    <a href="{{ route('blogs') }}"
                        class="text-decoration-none badge bg-secondary color-white">Semua</a>&nbsp;&nbsp;
                    <a href="#" class="text-decoration-none badge bg-primary">{{ $name }}</a>
                    @else
                    <a href="{{ route('blogs') }}" class="text-decoration-none badge bg-primary">Semua</a>
                    @endif
                </div>
                <form action="{{ route('blogs') }}">
                    <div class="input-group mt-4">
                        @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                            placeholder="Type search...">
                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            <i data-feather="search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 text-center">
                <img src="{{ url('assets/images/web/blogs.svg') }}" alt="blogs" class="img-fluid w-50">
            </div>

        </div>
        <div class="container mt-5">
            @if ($blogs->count())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{ url('storage/'.$blogs[0]->cover) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title text-dark">{{ $blogs[0]->title }} Dasar Pemrograman Web</h4>
                                <div class="d-flex align-items-center justify-content-center color-main">
                                    <p class="card-text align-items-center" style="font-size: 12px;"> <i
                                            data-feather="user" width="10"></i>&nbsp;
                                        {{ $blogs[0]->user->name }}</p>&nbsp;&nbsp;<p class="text-dark"
                                        style="font-size: 12px;">dari
                                        <a href="{{ url('blogs?category='.$blogs[0]->category->slug) }}"
                                            class="text-decoration-none">{{ $blogs[0]->category->name }}</a>
                                    </p>&nbsp;&nbsp;
                                    <small class="text-muted"
                                        style="font-size: 12px;">{{ $blogs[0]->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('detail',$blogs[0]->slug) }}"
                                    class="btn btn-sm btn-primary mt-3">Lihat
                                    selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                @foreach ($blogs->skip(1) as $blog)
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-content">
                            <img class="card-img-top img-fluid" src="{{ url('storage/'.$blog->cover) }}"
                                alt="Card image cap">
                            <div class="card-body">
                                <h6 class="card-title text-dark">{{ $blog->title }} Dasar Pemrograman Web</h6>
                                <p class="card-text align-items-center color-main" style="font-size: 12px;"> <i
                                        data-feather="user" width="10"></i>&nbsp;
                                    {{ $blog->user->name }}</p>
                                <div class="d-flex align-items-center justify-content-between color-main">
                                    <p style="font-size: 12px;">{{ $blog->category->name }}</p>
                                    <small class="text-muted"
                                        style="font-size: 12px;">{{ $blog->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('detail',$blog->slug) }}" class="btn btn-sm btn-primary mt-3">Lihat
                                    selengkapnya</a>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            @else
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-danger fs-12 text-center" style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7);">
                        Data yang anda cari tidak ada!
                    </div>
                </div>
            </div>
            @endif

            <div class="d-flex justify-content-center align-items-center">
                {{ $blogs->links() }}
            </div>

        </div>
    </div>
</section>
{{-- Footer --}}
<footer id="footer" class="bg-white mt-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-5 mb-3 text-start color-main fs-8" style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7)">
                <p style="font-weight: 400">{{ date('Y') }}&copy; b@yu 4lex@ndr!4</p>
            </div>
            <div class="col-md-5">
                <p class="color-main fs-8 text-end"
                    style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7);font-weight: 400;">Cre@ted and
                    wr!te by
                    Bayu Wardana</p>
            </div>
        </div>
    </div>
</footer>
{{-- End Footer --}}
@endsection
