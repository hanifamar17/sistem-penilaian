@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/header')
@section('container')
<div class="">
    <div class="flex justify-center items-center p-12">
        <div class="w-full p-12 bg-white border border-gray-200 rounded shadow">

            <h5 class="mb-2 py-2 text-2xl font-medium tracking-tight">Home</h5>

            @if($success = Session::get('success'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <span class="block sm:inline">{{ $success }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
            @elseif($delete = Session::get('delete'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <span class="block sm:inline">{{ $delete }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
            @elseif($updated = Session::get('updated'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <span class="block sm:inline">{{ $updated }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
            @endif

            <div class="py-8">
                <a href="{{ route('kelas-add')}}">
                    Tambah
                </a>
                <!--
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import
                </button>-->
            </div>

            <table class="border">
                <thead>
                    <tr class="border">
                        <th class="border">No</th>
                        <th class="border">Nama Kelas</th>
                        <th class="border">Tingkat</th>
                        <th class="border">Jurusan</th>
                        <th class="border">Updated at</th>
                        <th class="border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas as $kelas)
                    <tr>
                        <td class="border">{{ $loop->iteration }}</td>
                        <td class="border">{{ $kelas->nama_kelas }}</td>
                        <td class="border">{{ $kelas->tingkat }}</td>
                        <td class="border">{{ $kelas->jurusan }}</td>
                        <td class="border">{{ $kelas->updated_at->format('l, d F Y') }}</td>
                        <td class="border">
                            <div class="flex flex-row space-x-4">
                                <div>
                                    <a href="/admin/kelas-view/{{  $kelas->id }}">
                                        view
                                    </a>
                                </div>
                                <div>
                                    <a href="{{  route('kelas-update-form', $kelas->id) }}">
                                        update
                                    </a>
                                </div>
                                <div>
                                    <a href="/admin/kelas-delete/{{  $kelas->id }}">
                                        delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('template/footer-login')