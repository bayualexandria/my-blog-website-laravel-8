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
                        <li class="breadcrumb-item active" aria-current="page">Edit blog</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('editBlog',$blog->slug) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="{{ $blog->title??old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ ($category->name==$blog->category->name)?'selected':'' }}>
                                            {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="cover">Cover</label>
                            <div class="col-md-6">
                                <div class="input-group mt-2">
                                    <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                        name="cover" onchange="previewImage()" id="image">
                                </div>
                                @error('cover')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                @if ($blog->cover)
                                <img src="{{ url('storage/'.$blog->cover) }}" alt="cover"
                                    class="img-preview img-fluid img-thumbnail w-50">
                                @else
                                <img alt="cover" class="img-preview img-fluid img-thumbnail w-50">
                                @endif
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" cols="30" rows="10"
                                class="form-control">{!! $blog->body??old('body') !!}</textarea>
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
<link href="{{ url('assets/vendors/summernote/summernote-lite.min.css') }}" rel="stylesheet">
<script src="{{ url('assets/vendors/summernote/summernote-lite.min.js') }}"></script>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

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
