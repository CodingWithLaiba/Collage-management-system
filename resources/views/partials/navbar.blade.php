<div class="navbar">
    <div class="navbar-brand">
        <div class="logo">🏫</div>
        <span>College Management System</span>
    </div>
    
    <div class="navbar-nav">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="/students" class="{{ request()->is('students*') ? 'active' : '' }}">Students</a>
        <a href="/teachers" class="{{ request()->is('teachers*') ? 'active' : '' }}">Teachers</a>
        <a href="/courses" class="{{ request()->is('courses*') ? 'active' : '' }}">Courses</a>
        <a href="#">Logout</a>
    </div>
</div>

