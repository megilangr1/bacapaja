<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background-color: #c1e6f8;">
    <div class="container">
        <a href="{{ route('frontend.main') }}" class="navbar-brand">
            {{-- <img src="{{ asset('') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">Bacapaja.xyz</span>
        </a>

        <button class="navbar-toggler order-3" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('frontend.main') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('frontend.kategori') }}" class="nav-link">Kategori</a>
                </li>
            </ul>
        </div>

        {{-- <div class="collapse navbar-collapse order-4" id="navbarCollapse2">
            <!-- SEARCH FORM -->
            <form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div> --}}
        <ul class="order-2 order-md-3 navbar-nav navbar-no-expand ml-auto">

        </ul>
    </div>
</nav>