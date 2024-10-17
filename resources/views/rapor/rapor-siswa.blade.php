@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-56">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">
            <nav class="mb-8">
                <a href="{{ route('rapor-home') }}"
                    class="min-w-20 text-sm text-center py-2 px-6 rounded border hover:shadow-md transition duration-500">
                    <i class="fa-solid fa-chevron-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </nav>

            <h5 class="text-2xl font-medium tracking-tight">Report</h5>
            <h1>for All Students in Class <a class="text-yellow-600">{{ $kelas->nama_kelas }}</a></h1>

            @if($success = Session::get('success'))
            <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ $success }}.
            </div>
            @elseif($delete = Session::get('delete'))
            <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ $delete }}.
            </div>
            @elseif($updated = Session::get('updated'))
            <div class="p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success!</span> {{ $updated }}.
            </div>
            @endif


            <div class="py-8 flex">
                <!--
                <a href="{{ route('kelas-add')}}" class="max-w-20 min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">
                    Tambah
                </a>-->

                <div class="min-w-20 text-white text-sm text-center py-2 px-4 bg-yellow-600 rounded">
                    <span>Select Student to Display Report</span>
                </div>
            </div>

            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-sm text-gray-700 uppercase">
                    <tr class="text-left border-b-2">
                        <th scope="col" class="px-3 py-3">No</th>
                        <th scope="col" class="px-3 py-3">NIS</th>
                        <th scope="col" class="px-3 py-3">Nama Siswa</th>
                        <th scope="col" class="px-3 py-3">Status</th>
                        <th scope="col" class="px-3 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($siswaStatus as $siswa)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $siswa['siswa']->nis }}</td>
                        <td class="px-3 py-2">{{ $siswa['siswa']->name }}</td>
                        <td class="px-3 py-2">
                            @if($siswa['status'] === 'Completed')
                            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                Completed
                            </span>
                            @else
                            <span class="inline-flex items-center bg-yellow-100 text-orange-900 text-xs font-medium px-2.5 py-1 rounded-full">
                                <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                In-Progress
                            </span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex flex-row space-x-4">
                                <div>
                                    <a href="{{ route('rapor-view', ['kelas_id' => $siswa['siswa']->kelas_id, 'siswa_id' => $siswa['siswa']->id]) }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo Choose &raquo
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="py-4 rounded-md mt-8">
            <div class="mx-4">
                @include('template/footer-login')
            </div>
        </div>

    </div>
</div>