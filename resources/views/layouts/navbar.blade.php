<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- <img src="https://avatars.githubusercontent.com/u/7333731?s=80&v=4" width="30" height="30" class="d-inline-block align-top" alt=""> --}}
            <i class="fa fa-users"></i>
            Loyalty App
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">



            @if (Route::has('login'))
            
            @if (Auth::guest())
            <ul class="navbar-nav">

            </ul>
            {{-- <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}"><i
                            class="glyphicon glyphicon-user"></i> Sign Up</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}"><i
                            class="glyphicon glyphicon-log-in"></i> Login</a></li>
            </ul> --}}
            @else
                <ul class="nav navbar-nav">
                    <li class="nav-item {{ Request::is('products*') ? 'border-bottom' : '' }}">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item {{ Request::is('customers*') ? 'border-bottom' : '' }}">
                        <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                    </li>
                    <li class="nav-item {{ Request::is('customer-groups*') ? 'border-bottom' : '' }}">
                        <a class="nav-link" href="{{ route('customer-groups.index') }}">Customer Groups</a>
                    </li>
                    <li class="nav-item {{ Request::is('stock-clusters*') ? 'border-bottom' : '' }}">
                        <a class="nav-link" href="{{ route('stock-clusters.index') }}">Stock Clusters</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="{{ route('types.index') }}">Types</a></li>
                          <li><a class="dropdown-item"href="{{ route('category.index') }}">Category</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item"href="{{ route('productGroup.index') }}">Group</a></li>
                          <li><a class="dropdown-item"href="{{ route('productSubGroup.index') }}">Sub Group</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item"href="{{ route('users.index') }}">Users</a></li>
                          
                        </ul>
                      </li>
                </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    User Profile
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Sign
                                            Out</a></li>
                                </ul>
                            </form>
                        </li>
                    </ul>

                    @endunless
                
                
            
            
                
            @endif



        </div>
    </div>
</nav>
