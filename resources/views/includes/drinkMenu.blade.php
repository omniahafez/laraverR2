<nav class="tm-black-bg tm-drinks-nav">
    <ul>
        @foreach($taqs as $taq)
            <li>
                <a href="#" class="tm-tab-link {{ $loop->first ? 'active' : '' }}" data-id="{{ $taq->id }}">{{ $taq->taqName }}</a>
            </li>
        @endforeach
    </ul>
</nav>

@foreach($taqs as $taq)
    <div id="{{ $taq->id }}" class="tm-tab-content {{ $loop->first ? 'active' : '' }}">
        <!-- <h2>{{ $taq->taqName }}</h2> -->
        <div class="tm-list">
            @foreach($taq->beverages as $beverage)
                <div class="tm-list-item">
                    <img src="{{ asset('assets/img/' . $beverage->image) }}" alt="Image" class="tm-list-item-img">
                    <div class="tm-black-bg tm-list-item-text">
                        <h3 class="tm-list-item-name">
                            {{ $beverage->title }}
                            <span class="tm-list-item-price">${{ $beverage->price }}</span>
                        </h3>
                        <p class="tm-list-item-description">{{ $beverage->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
            