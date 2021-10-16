@extends('layouts.backend.app')

@section('styles')

<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

<link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
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
                        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <section class="section">
        <div class="card">
            <div class="card-header text-end">
                <div class="container">
                    <div class="btn icon btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addBlog">
                        <i data-feather="plus"></i> Add blog
                    </div>
                    @if (session()->has('success'))
                    <div class="alert mt-5 alert-success alert-dismissible fade show d-flex" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                            aria-label="Success:">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>

                        {{ session('success')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Categori</th>
                            <th>Create</th>
                            <th>Date create</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->category->name }}</td>
                            <td>{{ $blog->user->name }}</td>
                            <td>{{ $blog->created_at->diffForHumans() }}</td>
                            <td class="d-flex">
                                <a href="{{ route('editBlog',$blog->slug) }}" class="badge bg-primary">
                                    <i data-feather="edit"></i>
                                </a>
                                <a class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteBlog">
                                    <i data-feather="trash"></i>
                                </a>
                                <div class="modal fade" id="deleteBlog" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus data blog</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('deleteBlog',$blog->slug) }}" method="post">
                                                <div class="modal-body">

                                                    @csrf
                                                    @method('DELETE')
                                                    <p>Apakah anda yakin ingin menghapus data blog dengan title
                                                        {{ $blog->title }}?</p>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary btn-sm"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tidak</span>
                                                    </button>

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Ya</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <div class="modal fade" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah data blog</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('blog') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="Masukan title" value="{{ old('title') }}">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="choices form-select">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                               
                                <img alt="profile" class="img-preview img-fluid img-thumbnail w-50">
                         
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="body">Isi</label>
                            <textarea name="body" id="body" cols="30" rows="10"
                                class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                            @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Keluar</span>
                    </button>

                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.backend.footer')
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="assets/js/vendors.js"></script>
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
        // $('#body').summernote();
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
