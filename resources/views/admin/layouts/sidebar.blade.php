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
            <a href="#">
                <i class="fas fa-images"></i>
                <span>Manage Slider</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-concierge-bell"></i>
                <span>Manage Services</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-users"></i>
                <span>Manage Team/Chef</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-mobile-alt"></i>
                <span>Manage Platform</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-chart-line"></i>
                <span>Counter Data</span>
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
        <li>
            <a href="#">
                <i class="fas fa-shopping-cart"></i>
                <span>Manage Orders</span>
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
