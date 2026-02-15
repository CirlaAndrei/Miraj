@extends('admin.layouts.admin')

@section('title', 'Editează Utilizator')

@section('content')
<div class="admin-form" style="max-width: 600px;">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nume</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Telefon</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror">
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="checkbox-label" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }} {{ $user->id === Auth::id() ? 'disabled' : '' }}>
                <span>Administrator (are acces la panoul de administrare)</span>
            </label>
            @if($user->id === Auth::id())
                <small style="color: #666;">Nu poți schimba propriul status de administrator.</small>
            @endif
        </div>

        <div class="form-actions" style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn-primary" style="width: auto; padding: 12px 30px;">Actualizează utilizator</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary" style="background: #f0f0f0; color: #333; padding: 12px 30px; border-radius: 5px; text-decoration: none;">Anulează</a>
        </div>
    </form>
</div>
@endsection
