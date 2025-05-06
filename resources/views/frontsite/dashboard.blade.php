@extends('layouts.frontsite')

@section('title', 'Dashboard Masyarakat')

@section('content')
    <h1>Selamat Datang, {{ Auth::guard('masyarakat')->user()->name }}</h1>
    <p>Ini adalah dashboard khusus untuk masyarakat.</p>
@endsection
