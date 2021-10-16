@extends('layouts.backend.app')

@section('styles')
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
            <div class="card-header">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <form action="{{ route('category') }}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search..." name="search"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i data-feather="search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="btn icon btn-outline-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addBlog">
                                <i data-feather="plus"></i> Add category
                            </div>
                        </div>
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
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Date create</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count())
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td> <i class="{{ $category->icon }} {{ $category->color }}"></i></td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                            <td class="d-flex">
                                <a href="{{ route('editCategory',$category->slug) }}" class="badge bg-primary">
                                    <i data-feather="edit"></i>
                                </a>
                                <a class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteCategory">
                                    <i data-feather="trash"></i>
                                </a>
                                <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus data category
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('deleteCategory',$category->slug) }}" method="post">
                                                <div class="modal-body">

                                                    @csrf
                                                    @method('DELETE')
                                                    <p>Apakah anda yakin ingin menghapus data category dengan nama
                                                        {{ $category->name }}?</p>

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
                        @else
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="alert alert-danger" role="alert">Not Found</div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="float-end">
                        {{ $categories->links() }}
                </div>
            </div>
        </div>

    </section>
    <div class="modal fade" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah data category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('category') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Masukan nama kategori" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon">Nama icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                                name="icon" placeholder="Masukan nama kategori" value="{{ old('icon') }}">
                            @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input bg-danger" type="radio" name="color"
                                        value="text-danger">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-primary" type="radio" name="color"
                                        value="text-primary">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-info" type="radio" name="color" value="text-info">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-warning" type="radio" name="color"
                                        value="text-warning">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-success" type="radio" name="color"
                                        value="text-success">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-dark" type="radio" name="color" value="text-dark">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-secondary" type="radio" name="color"
                                        value="text-secondary">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-light" type="radio" name="color"
                                        value="text-light">
                                </div>
                            </div>
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

<!-- include summernote css/js -->
<link href="assets/vendors/summernote/summernote-lite.min.css" rel="stylesheet">
<script src="assets/vendors/summernote/summernote-lite.min.js"></script>
<script>
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
