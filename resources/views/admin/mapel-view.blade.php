@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('title','Admin')
@section('container')
<div class="p-4 sm:ml-52">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">

            @csrf
            @foreach($mapel as $mapel)
            <div class="mb-2 py-2">
                <h5 class="text-2xl font-medium tracking-tight">View <a class="text-yellow-600">Subject</a> Information</h5>
                <span class="font-small">for the classroom</span>
            </div>

            <input type="hidden" name="id" value="{{ $mapel->id }}">
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="name" class="self-center text-gray-600">Nama</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $mapel->name }}</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="kelas_id" class="self-center text-gray-600">Kelas</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $mapel->kelas->nama_kelas }}</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="guru_id" class="self-center text-gray-600">Guru</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $mapel->guru->name }}</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="name" class="self-center text-gray-600">Wali Kelas</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $mapel->kelas->waliKelas->name }}</label>
                </div>
            </div>
            <div class="flex flex-row-reverse mt-8">
                <a href="{{ route('mapel-home') }}"
                    class="min-w-20 text-sm text-center py-2 px-6 rounded border hover:shadow-md transition duration-500">
                    <i class="fa-solid fa-chevron-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </div>
            @endforeach
        </div>

        <!--Footer-->
        <div class="py-4 rounded-md mt-8">
            <div class="mx-4">
                @include('template/footer-login')
            </div>
        </div>

    </div>
</div>