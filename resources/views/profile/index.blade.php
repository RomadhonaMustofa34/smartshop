@extends('layouts.app')

@section('content')

<style>
    /* Profil Section */
    .profile-card {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .profile-info {
        margin-top: 20px;
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        text-align: left;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-info strong {
        display: inline-block;
        width: 110px;
    }

    /* Tombol Edit */
    .btn-edit {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
        margin-top: 25px;
    }

    .btn-edit:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #6610f2, #007bff);
    }

    .btn-edit i {
        margin-right: 5px;
    }
</style>

<div class="container mt-5">
    <!-- Profil Section -->
    <div class="card profile-card text-center">
        <div class="card-body">
            <!-- Foto Profil -->
            <div class="mb-4">
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                        alt="Foto Profil" 
                        class="rounded-circle profile-picture">
                @else
                    <img src="https://via.placeholder.com/150" 
                        alt="Foto Default" 
                        class="rounded-circle profile-picture">
                @endif
            </div>

            <!-- Username -->
            <h3 class="profile-name">{{ $user->name }}</h3>

            <!-- Info Profil -->
            <div class="profile-info">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Alamat:</strong> {{ $user->alamat ?? 'Belum ada alamat.' }}</p>
                <p><strong>No HP:</strong> {{ $user->no_hp ?? 'Belum ada nomor HP.' }}</p>
                <p><strong>Bergabung sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
            </div>

            <!-- Tombol Edit -->
            <a href="{{ route('profile.edit') }}" class="btn btn-edit btn-lg px-4">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
        </div>
    </div>
</div>

@endsection
