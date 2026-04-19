<div class="sidebar">
    <div class="sidebar-header">
        <h3>Navigation</h3>
    </div>
    
    <div class="sidebar-nav">
        <a href="{{ route('students.index') }}" class="{{ request()->is('students*') ? 'active' : '' }}">
            <span class="icon">👥</span>
            <span>Students Management</span>
        </a>
        <a href="{{ route('teachers.index') }}" class="{{ request()->is('teachers*') ? 'active' : '' }}">
            <span class="icon">👨‍🏫</span>
            <span>Teachers Management</span>
        </a>
        <a href="{{ route('courses.index') }}" class="{{ request()->is('courses*') ? 'active' : '' }}">
            <span class="icon">📚</span>
            <span>Courses Management</span>
        </a>
    </div>
</div>