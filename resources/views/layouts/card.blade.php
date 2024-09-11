<div class="cars-item">
    <a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code])
         }}">
        <div class="img" style="background-image: url({{ Storage::url($product->image) }})"></div>
    </a>
    <div class="text-wrap">
        <h4>{{ $product->title }}</h4>
        <div class="charac">
            <ul>
                <li>Год выпуска: {{ $product->year }}</li>
                <li>Вид топлива: {{ $product->oil }}</li>
                <li>Расположение руля: {{ $product->steer }}</li>
                <li>Объем: {{ $product->volume }}</li>
                <li>Номер паркинга: {{ $product->parking }}</li>
                <li>Стартовая цена: {{ number_format($product->price) }} сом</li>
            </ul>
        </div>
        <div class="btn-wrap">
            <ul>
                <li><a href="{{ route('product', [isset($category) ? $category->code : $product->category->code, $product->code])
         }}" class="more">Узнать подробнее</a></li>
                <li><a href="#" class="more buy product-item">Купить
                        <div class="hidden">
                            <div class="book-popup">
                                <form action="{{ route('orderform') }}" id="callback" class="form-callback"
                                      method="post">
                                    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
                                    @csrf
                                    <input type="hidden" name="product_title" value="{{ $product->title}}">
                                    <input type="hidden" name="product_price" value="{{ $product->price_sale}}">
                                    <div class="img">
                                        <img src="{{ Storage::url($product->image) }}" alt="">
                                    </div>
                                    <h3>Купить {{ $product->title }}</h3>
                                    <div class="form-group">
                                        <label for="">Ваше имя</label>
                                        <input type="text" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Номер телефона</label>
                                        <input type="number" id="phone" name="phone">
                                    </div>
                                    <button class="more" id="send">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </a></li>
            </ul>
        </div>
    </div>
    <div class="wishlist">
        @if (Auth::check())
            @if(\App\Models\Wishlist::where('product_id', $product->id)->where('user_id', Auth::id())->exists())
                <a href="{{ route('wishlist') }}">
                    <div class="added">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             xmlns:serif="http://www.serif.com/" viewBox="0 0 32 40" version="1.1" xml:space="preserve"
                             style="" x="0px" y="0px" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round"
                             stroke-miterlimit="2"><g transform="matrix(1.2433,0,0,1.2433,-214.644,-2.18133)">
                                <path d="M195.696,16.572C198.023,12.835 197.503,8.361 194.946,6.237C192.162,3.925 187.731,4.353 185.563,7.658C183.305,4.109 178.792,3.881 176.017,6.24C173.145,8.681 173.363,13.152 175.192,16.347C178.404,21.959 185.344,24.531 185.344,24.531C185.439,24.566 185.544,24.564 185.637,24.526C185.637,24.526 192.528,21.66 195.696,16.572ZM195.014,16.146C192.234,20.611 186.467,23.284 185.476,23.72C184.479,23.322 178.696,20.85 175.89,15.947C174.245,13.074 173.956,9.048 176.538,6.853C179.101,4.674 183.358,5.024 185.2,8.645C185.269,8.779 185.407,8.864 185.558,8.864C185.708,8.865 185.847,8.781 185.916,8.647C187.662,5.269 191.854,4.715 194.432,6.856C196.73,8.764 197.104,12.79 195.014,16.146Z"/>
                            </g></svg>
                    </div>
                </a>
            @else
                <form action="{{ route('wishlist-add', $product) }}" method="POST">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             xmlns:serif="http://www.serif.com/" viewBox="0 0 32 40" version="1.1" xml:space="preserve"
                             style="" x="0px" y="0px" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round"
                             stroke-miterlimit="2"><g transform="matrix(1.2433,0,0,1.2433,-214.644,-2.18133)">
                                <path d="M195.696,16.572C198.023,12.835 197.503,8.361 194.946,6.237C192.162,3.925 187.731,4.353 185.563,7.658C183.305,4.109 178.792,3.881 176.017,6.24C173.145,8.681 173.363,13.152 175.192,16.347C178.404,21.959 185.344,24.531 185.344,24.531C185.439,24.566 185.544,24.564 185.637,24.526C185.637,24.526 192.528,21.66 195.696,16.572ZM195.014,16.146C192.234,20.611 186.467,23.284 185.476,23.72C184.479,23.322 178.696,20.85 175.89,15.947C174.245,13.074 173.956,9.048 176.538,6.853C179.101,4.674 183.358,5.024 185.2,8.645C185.269,8.779 185.407,8.864 185.558,8.864C185.708,8.865 185.847,8.781 185.916,8.647C187.662,5.269 191.854,4.715 194.432,6.856C196.73,8.764 197.104,12.79 195.014,16.146Z"/>
                            </g></svg>
                    </button>
                    @csrf
                </form>
            @endif
        @else
            <form action="{{ route('login') }}">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         xmlns:serif="http://www.serif.com/" viewBox="0 0 32 40" version="1.1" xml:space="preserve"
                         style="" x="0px" y="0px" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round"
                         stroke-miterlimit="2"><g transform="matrix(1.2433,0,0,1.2433,-214.644,-2.18133)">
                            <path d="M195.696,16.572C198.023,12.835 197.503,8.361 194.946,6.237C192.162,3.925 187.731,4.353 185.563,7.658C183.305,4.109 178.792,3.881 176.017,6.24C173.145,8.681 173.363,13.152 175.192,16.347C178.404,21.959 185.344,24.531 185.344,24.531C185.439,24.566 185.544,24.564 185.637,24.526C185.637,24.526 192.528,21.66 195.696,16.572ZM195.014,16.146C192.234,20.611 186.467,23.284 185.476,23.72C184.479,23.322 178.696,20.85 175.89,15.947C174.245,13.074 173.956,9.048 176.538,6.853C179.101,4.674 183.358,5.024 185.2,8.645C185.269,8.779 185.407,8.864 185.558,8.864C185.708,8.865 185.847,8.781 185.916,8.647C187.662,5.269 191.854,4.715 194.432,6.856C196.73,8.764 197.104,12.79 195.014,16.146Z"/>
                        </g></svg>
                </button>
            </form>
        @endif
    </div>
</div>


