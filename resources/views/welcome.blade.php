@extends('layouts.app')

@section('title', 'Welcome to To-Do List App')

@section('content')
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to the To-Do List App</h1>
        <p class="lead">Manage your tasks efficiently and never miss a deadline!</p>
        <hr class="my-4">
        <p>Our application helps you keep track of your tasks, organize your day, and improve your productivity.</p>
        <div class="mt-4">
            @if(auth()->check())
                <a class="btn btn-primary btn-lg" href="{{ route('dashboard') }}" role="button">Go to Dashboard</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
                <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
            @endif
        </div>
    </div>

    <!-- Полезная информация -->
    <div class="row">
        <div class="col-md-4">
            <h3>Why use To-Do List App?</h3>
            <p>Our app is designed to help you stay on top of your tasks. Whether it's for work, study, or personal projects, To-Do List App keeps you organized and productive.</p>
        </div>
        <div class="col-md-4">
            <h3>Features</h3>
            <ul class="list-unstyled">
                <li><i class="fa fa-check"></i> Simple task management</li>
                <li><i class="fa fa-check"></i> Track progress in real-time</li>
                <li><i class="fa fa-check"></i> Secure user authentication</li>
                <li><i class="fa fa-check"></i> Mobile-friendly design</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h3>How it works</h3>
            <p>To start using the To-Do List App, simply register or log in, create tasks, and track your progress as you complete them. Our intuitive interface ensures ease of use.</p>
        </div>
    </div>
@endsection
