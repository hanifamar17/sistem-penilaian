@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-52">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">

            <h5 class="mb-2 py-2 text-2xl font-medium tracking-tight">Update Students Information</h5>

            @if ($errors->any())
            <div class="alert alert-danger my-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                        <span class="font-medium">Warning alert!</span> {{ $error }}
                    </div>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('siswa-update', $siswa->id)}}" method="POST">
                @csrf            
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                    <label for="name" class="self-center text-gray-600">Nama</label>
                    <div class="relative z-0 w-full mb-5">
                    <input type="text" name="name" value="{{ old('name', $siswa->name) }}" required class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                    <label for="nis" class="self-center text-gray-600">NIS</label>
                    <div class="relative z-0 w-full mb-5">
                        <input type="number" name="nis" value="{{ old('nis', $siswa->nis) }}" autocomplete="nis" placeholder="" required class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                    <label for="kelas_id" class="self-center text-gray-600">Kelas</label>
                    <div class="relative z-0 w-full mb-5">
                        <select name="kelas_id" class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                            @foreach ($kelas as $kelas)
                            <option value="{{ old('id', $kelas->id) }}">{{ old('id', $kelas->nama_kelas) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                    <label for="tanggal_lahir" class="self-center text-gray-600">Tanggal Lahir</label>
                    <div class="relative z-0 w-full mb-5">
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" autocomplete="tanggal_lahir" placeholder="" required class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 px-4 py-2 space-y-1">
                    <label for="alamat" class="self-center text-gray-600">Alamat</label>
                    <div class="relative z-0 w-full mb-5">
                        <input type="text" name="alamat" value="{{ old('alamat', $siswa->alamat) }}" autocomplete="alamat" placeholder="" required class="pt-3 pb-2 px-3 block w-full mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200">
                    </div>
                </div>

                <div class="flex flex-row-reverse space-x-reverse space-x-4 mt-8">
                    <button type="submit" class="max-w-20 min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">Submit</button>
                    <a href="{{ route('siswa-home') }}"
                        class="min-w-20 text-sm text-center py-2 px-6 rounded border hover:shadow-md transition duration-500">
                        <i class="fa-solid fa-chevron-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>
                
            </form>
        </div>

        <div class="py-4 rounded-md mt-8">
            <div class="mx-4">
                @include('template/footer-login')
            </div>
        </div>
        
    </div>
</div>