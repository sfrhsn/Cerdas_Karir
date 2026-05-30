@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
<div class="topbar"><h1>Kelola User</h1></div>
<div class="card">
    <table>
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge {{ $user->role === 'admin' ? 'badge-green' : 'badge-gray' }}">{{ ucfirst($user->role) }}</span></td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn-sm btn-danger" onclick="return confirm('Hapus user?')">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection