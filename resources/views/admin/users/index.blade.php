@extends('admin.layouts.admin')

@section('title', 'Gestionare Utilizatori')

@section('content')
<div class="users-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Toți utilizatorii</h2>
    <div class="user-stats" style="background: white; padding: 10px 20px; border-radius: 5px;">
        <span>Total utilizatori: <strong>{{ $users->total() }}</strong></span>
    </div>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nume</th>
            <th>Email</th>
            <th>Telefon</th>
            <th>Status</th>
            <th>Data înregistrării</th>
            <th>Acțiuni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>
                {{ $user->name }}
                @if($user->is_admin)
                    <span style="background: #764ba2; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; margin-left: 5px;">Admin</span>
                @endif
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone ?? '—' }}</td>
            <td>
                @if($user->is_admin)
                    <span class="badge" style="background: #764ba2; color: white;">Admin</span>
                @else
                    <span class="badge" style="background: #28a745; color: white;">Utilizator</span>
                @endif
            </td>
            <td>{{ $user->created_at->format('d.m.Y') }}</td>
            <td>
                <a href="{{ route('admin.users.show', $user) }}" class="btn-action btn-view">Vezi</a>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit">Editează</a>

                @if(!$user->is_admin && $user->id !== Auth::id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('Ești sigur că vrei să ștergi acest utilizator?')">Șterge</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination" style="margin-top: 30px;">
    {{ $users->links() }}
</div>
@endsection
