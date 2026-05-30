@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
<div class="topbar">
    <h1>Kelola Artikel</h1>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">+ Tambah Artikel</a>
</div>
<div class="card">
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->category }}</td>
                <td><span class="badge {{ $article->is_published ? 'badge-green' : 'badge-gray' }}">{{ $article->is_published ? 'Published' : 'Draft' }}</span></td>
                <td>{{ $article->is_featured ? '⭐' : '-' }}</td>
                <td>
                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-sm btn-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-danger" onclick="return confirm('Hapus artikel ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection