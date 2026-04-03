<nav class="navbar navbar-expand-lg navbar-future">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">MidtermeLibrary</a>

        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                @auth
                    @if(auth()->user()->role === 'member')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('member.profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('my-borrows') }}">My Borrowed Books</a>
                        </li>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'librarian']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('members.index') }}">Members</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.create') }}">Add Book</a>
                        </li>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.roles') }}">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('librarians.index') }}">Librarians</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.create-librarian') }}">Create Librarian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.analysis') }}">Analysis</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>