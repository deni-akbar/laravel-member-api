@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Password (kosongkan jika tidak ingin ubah)</label>
            <input type="password" name="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Hobbies</label>
            @foreach($user->hobbies as $index => $hobby)
            <input
                type="text"
                name="hobbies[]"
                class="form-control mb-2"
                value="{{ old('hobbies.' . $index, $hobby->name) }}">
            @endforeach

            {{-- Tambah input kosong agar bisa menambah hobi baru --}}
            <input type="text" name="hobbies[]" class="form-control mb-2" placeholder="New hobby...">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection