<div class="col-sm-3 col-md-3 col-lg-3">
    <div class="col-md-12 text-center mb-2">
        <div class="p-4 mb-3 bg-light">
            <h4 class="font">Bacapaja.xyz</h4>
            <p class="mb-0">
                Selamat Datang di-Bacapaja. Baca Apa Aja, Belajar Apa Aja, Pengetahuan Apa Aja.
            </p>
        </div>
    </div>

    <div class="col-md-12 text-center mb-2">
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-teal">
                <h3 class="widget-user-username m-0">Kategori</h3>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    @php $bg = 0; @endphp
                    @forelse ($categories as $item)
                    @php
                    $bg = rand(0, 10);
                    switch ($bg) {
                    case '1': $color = 'bg-indigo'; break;
                    case '2': $color = 'bg-navy'; break;
                    case '3': $color = 'bg-purple'; break;
                    case '4': $color = 'bg-fuchsia'; break;
                    case '5': $color = 'bg-pink'; break;
                    case '6': $color = 'bg-maroon'; break;
                    case '7': $color = 'bg-orange'; break;
                    case '8': $color = 'bg-lime'; break;
                    case '10': $color = 'bg-olive'; break;
                    default: $color = 'bg-light'; break;
                    }
                    @endphp
                    <li class="nav-item {{ $color }}">
                        <a href="{{ route('frontend.kategori', str_replace(' ', '-', $item->name)) }}" class="nav-link">
                            {{ $item->name }} <span
                                class="float-right badge bg-primary">{{ $item->post->count() }}</span>
                        </a>
                    </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
		</div>
		

    <div class="col-md-12 text-center mb-2">
				<img src="{{ asset('images/iklan-02.png') }}" alt="Iklan-02" class="img-fluid" style="widht: 260px;">
		</div>
</div>