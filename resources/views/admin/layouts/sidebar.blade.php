<div class="admin-sidebar">
    <div class="sidebar-brand">
        FOOD <span class="text-[#F8B803]">PARK</span>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-comments"></i>
                <span>Live Chat</span>
            </a>
        </li>

        <li class="menu-header">Content</li>
        <li>
            <a href="{{ route('admin.sliders.index') }}">
                <i class="fas fa-images"></i>
                <span>Manage Slider</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.why-choose-us.index') }}">
                <i class="fas fa-concierge-bell"></i>
                <span>Why Choose Us</span>
            </a>
        </li>
        <li class="has-dropdown">
            <a href="javascript:void(0);" class="has-dropdown">
                <i class="fas fa-columns"></i>
                <span>Manage Restaurant</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.categories.index') }}">Product Categories</a></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a></li>
            </ul>
        </li>

        <li class="has-dropdown {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="has-dropdown {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i>
                <span>Manage Orders</span>
            </a>
            <ul class="dropdown-menu {{ request()->routeIs('admin.orders.*') ? 'show' : '' }}">
                <li>
                    <a class="{{ request()->routeIs('admin.orders.all') ? 'active' : '' }}" href="{{ route('admin.orders.all') }}">All Orders</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.orders.pending') ? 'active' : '' }}" href="{{ route('admin.orders.pending') }}">Pending Orders</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.orders.processing') ? 'active' : '' }}" href="{{ route('admin.orders.processing') }}">In Process Orders</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.orders.delivered') ? 'active' : '' }}" href="{{ route('admin.orders.delivered') }}">Delivered Orders</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.orders.canceled') ? 'active' : '' }}" href="{{ route('admin.orders.canceled') }}">Cancelled Orders</a>
                </li>
            </ul>        </li>

        <li class="{{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.reservations.index') }}">
                <i class="fas fa-calendar-check"></i> <span>Table Reservations</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.coupons.index') }}">
                <i class="fas fa-tags"></i>
                <span>Manage Coupons</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-star"></i>
                <span>Testimonial</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-ad"></i>
                <span>Advertisement</span>
            </a>
        </li>        <li class="has-dropdown {{ request()->routeIs('admin.blog-*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="has-dropdown {{ request()->routeIs('admin.blog-*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i>
                <span>Manage Blog</span>
            </a>
            <ul class="dropdown-menu {{ request()->routeIs('admin.blog-*') ? 'show' : '' }}">
                <li>
                    <a class="{{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}" href="{{ route('admin.blog-categories.index') }}">Categories</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.blog-posts.index') ? 'active' : '' }}" href="{{ route('admin.blog-posts.index') }}">All Articles</a>
                </li>
                <li>
                    <a class="{{ request()->routeIs('admin.blog-posts.create') ? 'active' : '' }}" href="{{ route('admin.blog-posts.create') }}">Create Article</a>
                </li>
            </ul>
        </li>


        <li class="menu-header">Restaurant</li>
        <li>
            <a href="#">
                <i class="fas fa-ticket-alt"></i>
                <span>Restaurant Coupon</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-th-large"></i>
                <span>Restaurant Category</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-utensils"></i>
                <span>Manage Product</span>
            </a>
        </li>

        <li class="menu-header">Blog</li>
        <li>
            <a href="#">
                <i class="fas fa-folder"></i>
                <span>Blog Category</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-blog"></i>
                <span>Blog Post</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-tags"></i>
                <span>Blog Tag</span>
            </a>
        </li>

        <li class="menu-header">Settings</li>
        <li>
            <a href="#">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </li>
    </ul>
</div>
