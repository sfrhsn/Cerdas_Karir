@extends('layouts.app')

@section('title', 'Detail Hasil - Cerdas Karir')

@section('content')
{{-- Reuse the result view --}}
@php $isBookmarked = true; @endphp
@include('quiz.result', ['result' => $result, 'isBookmarked' => $isBookmarked])
@endsection