@extends('layouts.admin')

@section('title', 'Kelola Quiz')

@section('content')
<div class="topbar">
    <h1>Kelola Quiz</h1>

    <a href="{{ route('admin.quizzes.create') }}" class="btn btn-primary">
        + Tambah Quiz
    </a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Durasi</th>
                <th>Status</th>
                <th width="320">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($quizzes as $quiz)
            <tr>
                <td>
                    <strong>{{ $quiz->title }}</strong>
                </td>

                <td>
                    {{ $quiz->category }}
                </td>

                <td>
                    {{ $quiz->duration_minutes }} menit
                </td>

                <td>
                    <span class="badge {{ $quiz->is_active ? 'badge-green' : 'badge-gray' }}">
                        {{ $quiz->is_active ? 'Aktif' : 'Non-aktif' }}
                    </span>
                </td>

                <td style="display:flex; gap:8px; flex-wrap:wrap;">

                    {{-- Preview Quiz --}}
                    <a href="{{ route('admin.quizzes.show', $quiz->id) }}"
                       class="btn-sm btn-teal">
                        Preview
                    </a>

                    {{-- Kelola Soal --}}
                    <a href="{{ route('admin.quizzes.questions', $quiz->id) }}"
                       class="btn-sm"
                       style="background:var(--sky); color:var(--navy);">
                         Soal
                    </a>

                    {{-- Edit Quiz --}}
                    <a href="{{ route('admin.quizzes.edit', $quiz->id) }}"
                       class="btn-sm btn-primary">
                        Edit
                    </a>

                    {{-- Hapus Quiz --}}
                    <form method="POST"
                          action="{{ route('admin.quizzes.destroy', $quiz->id) }}"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn-sm btn-danger"
                                onclick="return confirm('Hapus quiz ini?')">

                            Hapus
                        </button>
                    </form>

                </td>
            </tr>

            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px;">
                    Belum ada data quiz.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection