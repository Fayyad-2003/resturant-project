<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="FoodPark" alt="FoodPark" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about*') ? 'active' : '' }}"
                        href="{{ route('about') }}">about</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                        href="{{ route('shop') }}">menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('chefs*') ? 'active' : '' }}"
                        href="{{ route('chefs') }}">chefs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}"
                        href="{{ route('blog') }}">blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">contact</a>
                </li>
            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a class="menu_search"><i class="fas fa-search"></i></a>
                    <div class="fp__search_form">
                        <form>
                            <span class="close_search"><i class="fas fa-times"></i></span>
                            <input type="text" name="search_title" id="search_title" class="search_title"
                                placeholder="Search . . .">
                            <button type="button" class="search_btn_product" id="search_btn_product">search</button>
                        </form>
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <div class="search_product_holder" id="search_product_holder"
                                    style="position: relative;left: 1px; top: 416px; transition: none;">
                                </div>
                                <hr class="my-0">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="cart_icon"><i class="fas fa-shopping-basket"></i> <span class="cart_count">0</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#reservationModal">
                        <i class="far fa-calendar-alt me-1"></i> Book a Table
                    </a>
                </li>
                <li>

                    <a><i class="fas fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>