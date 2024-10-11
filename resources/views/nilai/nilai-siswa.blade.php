@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-52">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">
            <nav class="mb-8">
                <a href="{{ route('nilai-mapel', [$kelas->id]) }}"
                    class="min-w-20 text-sm text-center py-2 px-6 rounded border hover:shadow-md transition duration-500">
                    <i class="fa-solid fa-chevron-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </nav>

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


            <div class="py-8 flex flex-row flex-row-reverse justify-between">
                <div class="grid gap-x-0 grid-cols-2 w-64 mt-4 font-medium text-gray-900">
                    <div>Subject</div>
                    <div>: {{ $mapel->name }}</div>
                    <div>Class</div>
                    <div>: {{ $kelas->nama_kelas }}</div>
                    <div>Homeroom T</div>
                    <div>: {{ $kelas->nama_kelas }}</div>
                </div>

                <div class="min-w-20 text-white text-sm text-center py-2 px-4 bg-yellow-600 rounded self-end">
                    <span>Enter Student Scores</span>
                </div>
            </div>

            <form action="{{ route('nilai-insert', [$kelas->id, $mapel->id]) }}" method="POST">
                @csrf
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-sm text-gray-700 uppercase">
                        <tr class="text-left border-b-2">
                            <th scope="col" class="px-3 py-3">No</th>
                            <th scope="col" class="px-3 py-3">Nama Siswa</th>
                            @foreach ($ujian as $u)
                            <th scope="col" class="px-3 py-3">{{ $u->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($siswa as $s)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">{{ $s->name }}</td>
                            @foreach ($ujian as $u)
                            @php
                            // Cari nilai lama dari database atau nilai yang di-submit sebelumnya
                            $existingValue = isset($nilai_existing[$s->id . '-' . $u->id])
                            ? $nilai_existing[$s->id . '-' . $u->id]->nilai
                            : old("nilai.{$s->id}.{$u->id}");
                            @endphp
                            <td class="px-3 py-2">
                                <input type="hidden" name="siswa_ids[]" value="{{ $s->id }}">
                                <input type="number" name="nilai[ {{ $s->id }} ][ {{ $u->id }} ]" value="{{ $existingValue }}" placeholder="Nilai {{ $u->name }}" class="px-2 py-2 max-w-36">
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="py-8 flex flex-row-reverse">
                    <button type="submit" class="max-w-20 min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">
                        Simpan
                    </button>
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