@extends('layouts.app')

@section('title', 'Privacy Policy - Cerdas Karir')

@push('styles')
<style>
    .privacy-hero {
        background: var(--beige);
        padding: 4rem 64px 3rem;
        border-bottom: 1px solid var(--sky);
        text-align: center;
    }

    .privacy-badge {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--teal);
        margin-bottom: 1rem;
    }

    .privacy-hero h1 {
        font-size: 2.5rem;
        color: var(--navy);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .privacy-hero p {
        max-width: 650px;
        margin: 0 auto;
        color: var(--muted);
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .privacy-container {
        max-width: 1100px;
        margin: 3rem auto 5rem;
        padding: 0 64px;
        box-sizing: border-box;
    }

    .privacy-card {
        background: white;
        border: 1px solid rgba(61,99,116,0.12);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(24,43,63,0.05);
    }

    .privacy-topbar {
        padding: 1.2rem 2rem;
        background: var(--navy);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.8rem;
    }

    .privacy-topbar span {
        font-size: 0.85rem;
        opacity: 0.85;
    }

    .privacy-content {
        padding: 2.5rem;
    }

    .privacy-section {
        padding-bottom: 2rem;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(61,99,116,0.08);
    }

    .privacy-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .privacy-section h2 {
        font-size: 1.3rem;
        color: var(--navy);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .privacy-number {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--sky);
        color: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .privacy-section p {
        color: var(--muted);
        line-height: 1.9;
        font-size: 0.95rem;
    }

    .privacy-highlight {
        background: rgba(200,217,230,0.18);
        border-left: 4px solid var(--teal);
        padding: 1rem 1.2rem;
        border-radius: 10px;
        margin-top: 1rem;
    }

    .privacy-highlight strong {
        color: var(--navy);
    }

    .privacy-contact {
        margin-top: 3rem;
        background: var(--navy);
        border-radius: 18px;
        padding: 2rem;
        text-align: center;
        color: white;
    }

    .privacy-contact h3 {
        font-size: 1.5rem;
        margin-bottom: 0.8rem;
    }

    .privacy-contact p {
        opacity: 0.8;
        max-width: 550px;
        margin: 0 auto 1.5rem;
        line-height: 1.7;
    }

    .privacy-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.85rem 1.4rem;
        border-radius: 10px;
        background: white;
        color: var(--navy);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s;
    }

    .privacy-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
        color: var(--navy);
    }

    @media(max-width: 768px) {

        .privacy-hero,
        .privacy-container {
            padding-left: 20px;
            padding-right: 20px;
        }

        .privacy-hero h1 {
            font-size: 2rem;
        }

        .privacy-content {
            padding: 1.5rem;
        }

        .privacy-topbar {
            padding: 1rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="privacy-hero">

    <div class="privacy-badge">
        LEGAL & SECURITY
    </div>

    <h1>
        Privacy Policy
    </h1>

    <p>
        Kami menghargai privasi setiap pengguna Cerdas Karir. 
        Halaman ini menjelaskan bagaimana informasi dikumpulkan, 
        digunakan, dan dilindungi selama Anda menggunakan platform kami.
    </p>

</section>

{{-- CONTENT --}}
<div class="privacy-container">

    <div class="privacy-card">

        <div class="privacy-topbar">
            <strong>Cerdas Karir Privacy Policy</strong>
            <span>Terakhir diperbarui: Mei 2026</span>
        </div>

        <div class="privacy-content">

            <div class="privacy-section">
                <h2>
                    <div class="privacy-number">1</div>
                    Informasi yang Kami Kumpulkan
                </h2>

                <p>
                    Kami dapat mengumpulkan informasi seperti nama, email,
                    hasil quiz, preferensi karir, dan aktivitas penggunaan platform.
                    Informasi ini digunakan untuk memberikan pengalaman yang lebih
                    personal dan relevan bagi pengguna.
                </p>

                <div class="privacy-highlight">
                    <strong>Contoh data:</strong> nama pengguna, email, histori quiz,
                    serta progress roadmap karir.
                </div>
            </div>

            <div class="privacy-section">
                <h2>
                    <div class="privacy-number">2</div>
                    Penggunaan Informasi
                </h2>

                <p>
                    Data digunakan untuk memberikan rekomendasi karir,
                    menyimpan progres pengguna, meningkatkan kualitas layanan,
                    serta membantu pengembangan fitur baru pada platform
                    Cerdas Karir.
                </p>
            </div>

            <div class="privacy-section">
                <h2>
                    <div class="privacy-number">3</div>
                    Keamanan Data
                </h2>

                <p>
                    Kami berupaya menjaga keamanan data pengguna dengan
                    sistem perlindungan yang sesuai dan membatasi akses
                    hanya kepada pihak yang berkepentingan dalam pengelolaan layanan.
                </p>

                <div class="privacy-highlight">
                    <strong>Catatan:</strong> Kami tidak menjual data pribadi
                    pengguna kepada pihak ketiga.
                </div>
            </div>

            <div class="privacy-section">
                <h2>
                    <div class="privacy-number">4</div>
                    Hak Pengguna
                </h2>

                <p>
                    Pengguna memiliki hak untuk memperbarui informasi akun,
                    menghapus data tertentu, serta meminta bantuan terkait
                    privasi dan keamanan akun mereka kapan saja.
                </p>
            </div>

            <div class="privacy-section">
                <h2>
                    <div class="privacy-number">5</div>
                    Perubahan Kebijakan
                </h2>

                <p>
                    Kebijakan privasi dapat diperbarui sewaktu-waktu
                    untuk menyesuaikan perkembangan layanan dan regulasi.
                    Pengguna disarankan untuk meninjau halaman ini secara berkala.
                </p>
            </div>

        </div>
    </div>

    {{-- CONTACT --}}
    <div class="privacy-contact">

        <h3>Punya Pertanyaan Terkait Privasi?</h3>

        <p>
            Jika Anda memiliki pertanyaan mengenai kebijakan privasi
            atau penggunaan data di Cerdas Karir, silakan hubungi tim support kami.
        </p>

        <a href="https://wa.me/6281234567890" target="_blank" class="privacy-btn">
            Hubungi Support
        </a>

    </div>

</div>

@endsection