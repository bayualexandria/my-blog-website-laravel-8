@extends('layouts.frontend.app')

@section('content')
<section id="blogs-hero">
    <div class="container pt-5">
        <div class="jumbotron row justify-content-between mb-0 pb-0 pt-5">

            <div class="col-md-4 text-start position-relative pt-5 mb-5">
                <h1 class="display-4 mb-3 color-main fs-3" style="font-weight: 500;">Halaman Detail Blog </h1>
                <div class="d-flex align-items-center justify-content-start">
                    <h6 class="color-main">{{ $blog->title }}</h6>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <img src="{{ url('assets/images/web/read_detail.svg') }}" alt="blogs" class="img-fluid w-50">
            </div>

        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="d-flex justify-content-center">
                    <img src="{{ url('storage/'.$blog->cover) }}" class="img-thumbnail img-fluid">
                </div>
                <h1 class="mt-3">{{ $blog->title }}</h1>
                <div class="d-flex align-content-center text-muted">
                    <i data-feather="clock" width="15"></i> &nbsp;
                    <p style="font-size: 15px;">{{ $blog->created_at->diffForHumans() }}</p>
                </div>
                <p class="color-main" style="font-size: 15px;">Penulis:
                    <a class="text-decoration-none" href="">{{ $blog->user->name }}</a>
                </p>
                <div class="mt-4 text-justify">

                    {!! $blog->body !!}

                </div>
            </div>
        </div>
    </div>
</section>
{{-- Footer --}}
<footer id="footer" class="bg-white mt-5">
    <div class="container">
        <div class="row justify-content-between mt-5">
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
