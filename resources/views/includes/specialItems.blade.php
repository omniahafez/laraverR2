

<div id="special" class="tm-page-content">
                <div class="tm-special-items">
                    @foreach($specialBeverages as $beverage)
                        <div class="tm-black-bg tm-special-item">
                            <img src="{{ asset('assets/img/' . $beverage->image) }}" alt="Image">
                            <div class="tm-special-item-description">
                                <h2 class="tm-text-primary tm-special-item-title">{{ $beverage->title }}</h2>
                                <p class="tm-special-item-text">{{ $beverage->content }}</p>  
                            </div>
                        </div>
                    @endforeach
                </div>            
            </div>