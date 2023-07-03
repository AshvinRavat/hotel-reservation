<nav class="navbar navbar-expand-lg bg-body-tertiary float-left">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="#">Owner-Dashboard</a>
        <button class="navbar-toggler bg-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  list-group text-primary">
                <li class="nav-item">
                    <a class="nav-link active text-primary" aria-current="page"
                        href="{{ route('owner.hotel_index') }}">
                        Hotel-Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-primary" aria-current="page" href="">
                        Rooms
                    </a>
                </li>
            </ul>
            @auth
                <a class="me-2 btn btn-primary" href="{{ '/' }}">
                    Switch to Customer
                </a>
                <li class="nav-item dropdown me-3 list-group">
                    <a class="nav-link dropdown-toggle text-primary"
                        href="#" role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Welcome, {{ auth()->user()->first_name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item" href="">
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('password.update_index') }}" class="dropdown-item" >
                                Update Password
                            </a>
                        </li>
                    </ul>
                </li>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                    class="rounded-circle me-5"
                    height="45"/>
            @endauth
        </div>
        @guest
            <li class="nav-item dropdown me-3 list-group">
                <a class="nav-link dropdown-toggle "
                    href="#" role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    My Account
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </li>
        @endguest
    </div>
</nav>