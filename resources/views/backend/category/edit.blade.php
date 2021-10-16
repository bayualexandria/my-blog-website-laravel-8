@extends('layouts.backend.app')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
@endsection

@section('content')
@include('layouts.backend.sidebar')
@include('layouts.backend.navbar')
<div class="main-content container-fluid">
    <div class="page-title mb-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            Master
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit category</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('editCategory',$category->slug) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama kategori</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Masukan nama kategori"
                                        value="{{ $category->name??old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Nama icon</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                        id="icon" name="icon" placeholder="Masukan nama kategori"
                                        value="{{ $category->icon??old('icon') }}">
                                    @error('icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input bg-danger" type="radio" name="color"
                                        value="text-danger" {{ ($category->color=='text-danger')?'checked':'' }}>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-primary" type="radio" name="color"
                                        value="text-primary" {{ ($category->color=='text-primary')?'checked':'' }}>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-info" type="radio" name="color" value="text-info"
                                        {{ ($category->color=='text-info')?'checked':'' }}>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-warning" type="radio" name="color"
                                        value="text-warning">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-success" type="radio" name="color"
                                        value="text-success" {{ ($category->color=='text-success')?'checked':'' }}>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-dark" type="radio" name="color" value="text-dark"
                                        {{ ($category->color=='text-dark')?'checked':'' }}>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="color"
                                        value="text-secondary" {{ ($category->color=='text-secondary')?'checked':'' }}>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-light" type="radio" name="color"
                                        value="text-light" {{ ($category->color=='text-light')?'checked':'' }}>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-primary btn-sm"> <i data-feather="edit"></i>
                                Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
@include('layouts.backend.footer')
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="assets/vendors/summernote/summernote-lite.min.css" rel="stylesheet">
<script src="assets/vendors/summernote/summernote-lite.min.js"></script>

<script>
    $(document).ready(function () {
        $('#body').summernote({
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

</script>
@endsection
