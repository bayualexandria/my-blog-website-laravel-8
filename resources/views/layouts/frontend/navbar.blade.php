 {{-- Navbar --}}
    <section id="header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ route('home') }}">
                    <img src="{{ url('assets/images/web/logo.png') }}" alt="" width="40" height="40" class="rounded-circle">
                    <h4 class="mt-2 me-2 color-main" style="font-weight: 500;">b@yu 4lex@ndr!4</h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ ($title=='Halaman Utama')?'active':'' }}" href="{{ route('home') }}">Halaman Utama</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($title=='Halaman Blogs')?'active':'' }}" href="{{ route('blogs') }}">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($title=='Halaman Kategori')?'active':'' }}" href="{{ route('categories') }}">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($title=='Halaman About')?'active':'' }}" href="{{ route('about') }}">Tentang</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    {{-- End Navbar --}}