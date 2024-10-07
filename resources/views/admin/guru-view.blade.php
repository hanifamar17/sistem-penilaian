@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('title','Admin')
@section('container')
<div class="p-4 sm:ml-52">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">

            @csrf
            @foreach($guru as $guru)
            <div class="mb-2 py-2">
                <h5 class="text-2xl font-medium tracking-tight">View <a class="text-yellow-600">{{ $guru->name }}</a> Information</h5>
                <span class="font-small">as a Teacher</span>
            </div>

            <input type="hidden" name="id" value="{{ $guru->id }}">
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="nip" class="self-center text-gray-600">NIP</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $guru->nip }}</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="name" class="self-center text-gray-600">Nama</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $guru->name }}</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="email" class="self-center text-gray-600">Email</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $guru->email }}</label>
                </div>
            </div>
            <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                <label for="password" class="self-center text-gray-600">Password</label>
                <div class="relative z-0 w-full mb-5">
                    <label class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">{{ $guru->password }}</label>
                </div>
            </div>

            <div class="flex flex-row-reverse mt-8">
                <a href="{{ route('guru-home') }}"
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