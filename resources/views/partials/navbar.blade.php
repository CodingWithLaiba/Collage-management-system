<div class="navbar">
    <div>
        <strong>🏫 School Management System</strong>
        <a href="/">Home</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            @elseif(auth()->user()->isTeacher())
                <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('student.dashboard') }}">Dashboard</a>
            @endif
        @endauth
    </div>
    
    <div>
        @auth
            <span style="margin-right: 15px;">👋 {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</div>
