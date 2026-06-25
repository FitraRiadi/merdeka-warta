@extends('admin.layouts.admin')

@section('title', 'Profil - Panel Admin')
@section('page_title', 'Profil')
@section('page_description', 'Kelola informasi akun anda')

@section('content')
    <div class="space-y-6 max-w-2xl">
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')

        @include('profile.partials.delete-user-form')
    </div>
@endsection
