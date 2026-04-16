@extends('layouts.app')

@section('title', 'Home')
@section('page-title', 'Welcome to Management System')

@section('content')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .hero-title {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s ease-out;
    }
    
    .hero-subtitle {
        font-size: 20px;
        margin-bottom: 40px;
        opacity: 0.9;
        line-height: 1.6;
        animation: fadeInUp 0.8s ease-out 0.2s;
    }
    
    .cta-button {
        display: inline-block;
        background: white;
        color: #667eea;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 18px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease-out 0.4s;
    }
    
    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        text-decoration: none;
        color: #667eea;
    }
    
    .features-section {
        padding: 80px 0;
        background: #f8fafc;
    }
    
    .features-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .features-title {
        text-align: center;
        font-size: 36px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 50px;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }
    
    .feature-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 36px;
    }
    
    .feature-title {
        font-size: 22px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 15px;
    }
    
    .feature-description {
        font-size: 16px;
        color: #64748b;
        line-height: 1.6;
    }
    
    .stats-section {
        background: white;
        padding: 60px 0;
    }
    
    .stats-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        text-align: center;
    }
    
    .stat-item {
        padding: 20px;
    }
    
    .stat-number {
        font-size: 42px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 16px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }
        
        .hero-subtitle {
            font-size: 18px;
        }
        
        .cta-button {
            padding: 12px 30px;
            font-size: 16px;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">College Management System</h1>
        <p class="hero-subtitle">
            Streamline your educational institution with our comprehensive management solution. 
            Manage students, teachers, courses, and more with ease.
        </p>
        <a href="{{ route('students.index') }}" class="cta-button">
            Get Started →
        </a>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="features-container">
        <h2 class="features-title">Powerful Features</h2>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3 class="feature-title">Student Management</h3>
                <p class="feature-description">
                    Complete student information management with profiles, attendance, and performance tracking.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">👨‍🏫</div>
                <h3 class="feature-title">Teacher Management</h3>
                <p class="feature-description">
                    Efficient teacher administration with qualifications, specializations, and course assignments.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3 class="feature-title">Course Management</h3>
                <p class="feature-description">
                    Organize courses, track enrollments, and manage academic schedules effortlessly.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Analytics Dashboard</h3>
                <p class="feature-description">
                    Get insights into performance metrics and institutional data at your fingertips.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Students</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Teachers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100+</div>
                <div class="stat-label">Courses</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99.9%</div>
                <div class="stat-label">Uptime</div>
            </div>
        </div>
    </div>
</div>

@endsection
