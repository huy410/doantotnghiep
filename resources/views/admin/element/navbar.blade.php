
<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?_nc_cat=1&ccb=1-5&_nc_sid=7206a8&_nc_ohc=JnDLo_5PpjYAX_VnnZf&_nc_ht=scontent.fhan4-1.fna&oh=00_AT9J-fsnnxiNb2yPTHs55bKlgcoHhv81YlBSYCEyd_odaQ&oe=62970D78" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="https://scontent.fhan4-1.fna.fbcdn.net/v/t1.30497-1/143086968_2856368904622192_1959732218791162458_n.png?_nc_cat=1&ccb=1-5&_nc_sid=7206a8&_nc_ohc=JnDLo_5PpjYAX_VnnZf&_nc_ht=scontent.fhan4-1.fna&oh=00_AT9J-fsnnxiNb2yPTHs55bKlgcoHhv81YlBSYCEyd_odaQ&oe=62970D78" alt="">
                        </div>
                        <div class="info text-center">
                            @if (!empty(Auth::user()))
                                <p class="name font-weight-bold mb-0"><?php echo Auth::user()->name;  ?></p>
                                <p class="email text-muted mb-3"><?php echo Auth::user()->email; ?></p>
                            @endif
                           
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{ route('LoginController.logout') }}" class="nav-link">
                                    <i data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>