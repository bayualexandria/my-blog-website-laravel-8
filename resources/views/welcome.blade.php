@extends('layouts.frontend.app')

@section('content')
{{-- Hero --}}
<section id="hero">

    <div class="container">

        <div class="jumbotron row justify-content-between mb-0 pb-0">

            <div class="col-md-6">
                <h1 class="display-4 color-main mb-3" style="font-weight: 500;">Tech. Programming Development</h1>
                <p class="lead color-main mb-5">Jadikan ngoding sebagai hobi untuk berimajinasi.</p>
                <a class="btn btn-main btn-sm" href="{{ route('blogs') }}" role="button">Selengkapnya</a>
            </div>

            <div class="col-md-6">
                <img src="assets/images/web/programming.png" alt="hero" class="img-fluid">
            </div>

        </div>

    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099FF" fill-opacity="1"
            d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>

</section>
{{-- End Hero --}}

{{-- About --}}
<section id="about">

    <div class="container">

        <div class="row pt-5 pb-5 title">
            <div class="border-bottom border-2 w-auto text-white">
                <h2 class="display-4 text-white fs-2" style="font-weight: 500;">Ho To Coding</h2>
            </div>
        </div>

        <div class="row justify-content-center mt-2 ">
            <div class="col-md-4 align-items-center mt-5 text-center">
                <img src="assets/images/web/about.svg" alt="enjoy"
                    class="img-fluid img-thumbnail img-bg text-center w-75">
                <div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="smile" data-bs-toggle="pill" href="#smile" role="tab" aria-controls="smile"
                        aria-selected="true">
                        <div class="btn active-btn-circle btn-light btn-circle d-flex align-items-center">
                            <i data-feather="smile"></i>
                        </div>
                    </a>
                    <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                        role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <div class="btn btn-light btn-circle d-flex align-items-center">
                            <i data-feather="clock"></i>
                        </div>
                    </a>
                    <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages"
                        role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <div class="btn btn-light btn-circle d-flex align-items-center">
                            <i data-feather="monitor"></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="smile" role="tabpanel" aria-labelledby="smile">

                        <p>Jadikan ngoding sebagai hobby mu sehari hari agar dirimu mampu bisa untuk meningkatkan
                            kualitas dalam mengasah kemampuanmu dalam belajar.</p>
                        <p>Banyak hal yang harus dipelajari untuk dalam meningkatkan pembelajaranmu sebagai
                            programmer dan selalu up to date ilmu dalam dunia IT.</p>

                        <p>Dan jangan lupa untuk selalu berdoa dalam setiap pembelajaranmu maupun membuat project
                            agar diberikan kemudahan.</p>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <p> Waktu yang digunakan harus dibatasi dalam belajar maupun membuat sebuah project, kadang
                            ngoding itu seperti "drugs" akan kecanduan dalam mempelajarinya, tanpa disadari akan
                            terus terlena dalam belajar, membuat sebuah program yang bagus dan baik maupun mencari
                            "error" dalam waktu berjam jam.</p>
                        <p>
                            Jangan lupa untuk beribadah ketika asyik dalam mengoding, ibadah itu wajib untuk
                            dilaksanakan maka dari itu batasi waktu dalam mengoding.</p>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">
                        <p> Gunakan perangkat yang digunakan untuk melakukan ngoding yaitu sebuah perangkat PC atau
                            Leptop yang sesuai spesifikasinya.</p>
                        <p>
                            Banyak bahasa pemrograman dan freamwork yang digunakan untuk belajar ngoding, tetapi
                            setiap media untuk belajar pemrograman (Web, Mobile App, IOT, Data Science dan
                            lain-lain) memiliki spesifikasi PC atau Leptop masing masing untuk menggunakannya.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1"
            d="M0,128L40,117.3C80,107,160,85,240,80C320,75,400,85,480,101.3C560,117,640,139,720,154.7C800,171,880,181,960,165.3C1040,149,1120,107,1200,101.3C1280,96,1360,128,1400,144L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
</section>
{{-- End About --}}

{{-- Content --}}
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($blogs->take(4) as $blog)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ url('storage/'.$blog->cover) }}" class="card-img-top" alt="...">
                    <div class="card-body color-main">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text"><i data-feather="user" width="15"></i> {{ $blog->user->name }}</p>
                        <div class="d-flex justify-content-between mb-0">
                            <p class="color-main" style="font-size: 12px;">{{ $blog->category->name }}</p>
                            <p class="text-muted mb-3" style="font-size: 12px">
                                <i data-feather="clock" width="10"></i> {{ $blog->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <a href="#" class="btn btn-primary btn-sm">Baca selengkapya</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099FF" fill-opacity="1"
            d="M0,96L40,90.7C80,85,160,75,240,106.7C320,139,400,213,480,218.7C560,224,640,160,720,138.7C800,117,880,139,960,176C1040,213,1120,267,1200,256C1280,245,1360,171,1400,133.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
</section>
{{-- End Content --}}

{{-- Profile --}}
<section id="profile">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <img src="{{ $user->avatar }}" alt="profile" class="img-fluid rounded-circle border shadow text-bold"
                    style="width: 40%">
                <div class="pt-2">
                    <h2 class="text-white font-weight-bold">{{ $user->name }}</h2>
                    <h6>Web Programming & Computer Networking</h6>

                    <a href="https://api.whatsapp.com/send?phone=6281316146399" target="blank" class="btn btn-circle"
                        style="padding-top:10px;background-color: springgreen;color:white">
                        <i data-feather="message-circle"></i>
                    </a>
                    <a href="https://www.instagram.com/bayualexandria13/" target="blank"
                        class="btn btn-danger btn-sm btn-circle" style="padding-top:10px;">
                        <i data-feather="instagram"></i>
                    </a>
                    <a href="https://github.com/bayualexandria" target="blank" class="btn btn-secondary btn-circle"
                        style="padding-top:10px;">
                        <i data-feather="github"></i>
                    </a>
                    <div class="mt-3">
                        <a href="{{ url('user') }}" class="badge rounded-pill bg-primary text-decoration-none text-white">Look me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#0099FF" fill-opacity="1"
            d="M0,96L40,90.7C80,85,160,75,240,106.7C320,139,400,213,480,218.7C560,224,640,160,720,138.7C800,117,880,139,960,176C1040,213,1120,267,1200,256C1280,245,1360,171,1400,133.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
</section>
{{-- End Profile --}}

{{-- Footer --}}
<section id="footer">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-5 mb-3 text-start text-white fs-8" style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7)">
                <p>{{ date('Y') }}&copy; b@yu 4lex@ndr!4</p>
            </div>
            <div class="col-md-5">
                <p class="text-white fs-8 text-end" style="text-shadow: 1px 1px 1px 1px rgba(0,0,0,0.7)">Cre@ted and
                    wr!te by
                    Bayu Wardana</p>
            </div>
        </div>
    </div>
</section>
{{-- End Footer --}}
@endsection
