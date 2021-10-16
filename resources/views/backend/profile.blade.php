@extends('layouts.backend.app')

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
                        <li class="breadcrumb-item"><a href="index.html"></a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    <section class="section">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center my-auto">
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                                role="img" aria-label="Success:">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>

                            {{ session('success')}}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <img src="{{ auth()->user()->avatar }}" alt="profile"
                            class="img-fluid rounded-circle shadow border border-1 w-50">
                        <h3 class="mt-2">{{ auth()->user()->name }}</h3>
                        <h6>{{ auth()->user()->email }}</h6>
                    </div>
                    <div class="col-md-6">

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                    role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab"
                                    aria-controls="password" aria-selected="false">Password</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="oldImage" value="{{ auth()->user()->avatar }}">
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" value="{{ auth()->user()->email }}"
                                            readonly>
                                        <div class="form-control-icon">
                                            <i data-feather="mail"></i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group position-relative has-icon-left mb-0">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukan nama" value="{{ auth()->user()->name }}"
                                                name="name">
                                            <div class="form-control-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                        </div>
                                        @error('name')
                                        <small class="text-danger mt-0">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                    @if (auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="profile"
                                        class="img-preview img-fluid img-thumbnail w-50">
                                    @else
                                    <img alt="profile" class="img-preview img-fluid img-thumbnail w-50">
                                    @endif

                                    <div>
                                        <div class="input-group mt-2 ">
                                            <input type="file"
                                                class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                                                onchange="previewImage()" id="image">
                                        </div>
                                        @error('avatar')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn icon icon-left btn-primary"><i
                                                data-feather="edit"></i>
                                            Ubah profile</button>
                                    </div>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <form action="{{ route('password') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-group position-relative has-icon-left mb-0">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password baru">
                                            <div class="form-control-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                        @error('password')
                                        <small class="text-danger mt-0">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group position-relative has-icon-left mb-0">
                                            <input type="password" name="conf_password"
                                                class="form-control @error('conf_password') is-invalid @enderror"
                                                placeholder="Konfirmasi password baru">
                                            <div class="form-control-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                        @error('conf_password')
                                        <small class="text-danger mt-0">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn icon icon-left btn-warning"><i
                                                data-feather="key"></i>
                                            Ubah password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.backend.footer')
@endsection

@section('scripts')
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

</script>
@endsection
