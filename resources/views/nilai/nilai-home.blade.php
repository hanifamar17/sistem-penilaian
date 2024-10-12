@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-52">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">
            <h5 class="text-2xl font-medium tracking-tight">Exam Scores</h5>

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

<!--
            <div class="py-8 flex flex-row flex-row-reverse justify-between">
                <div class="grid gap-x-0 grid-cols-2 w-64 mt-4 text-gray-900">
                    <div class="font-medium">Semester</div>
                    <div>: </div>
                    <div class="font-medium">Academic Year</div>
                    <div>: </div>
                </div>

                <div class="min-w-20 text-white text-sm text-center py-2 px-4 bg-yellow-600 rounded">
                    <span>Select Class to Display/Enter Student Scores</span>
                </div>
            </div>-->

            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-sm text-gray-700 uppercase">
                    <tr class="text-left border-b-2">
                        <th scope="col" class="px-3 py-3">No</th>
                        <th scope="col" class="px-3 py-3">Nama Kelas</th>
                        <th scope="col" class="px-3 py-3">Wali Kelas</th>
                        <th scope="col" class="px-3 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($kelas as $kelas)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $kelas->nama_kelas }}</td>
                        <td class="px-3 py-2">{{ $kelas->waliKelas ? $kelas->waliKelas->name : 'Tidak ada wali kelas' }}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-row space-x-4">
                                <div>
                                    <a href="/nilai/nilai-mapel/{{  $kelas->id }}" class="text-blue-600 hover:text-blue-900">
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