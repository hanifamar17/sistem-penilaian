@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-56">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">
            <nav class="mb-8">
                <a href="{{ route('rapor-siswa', ['kelas_id' => $kelas_id]) }}"
                    class="min-w-20 text-sm text-center py-2 px-6 rounded border hover:shadow-md transition duration-500">
                    <i class="fa-solid fa-chevron-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </nav>

            <h5 class="text-2xl font-medium tracking-tight">Show Report</h5>

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
                <div class="grid gap-x-0 grid-cols-2 w-64 mt-4 text-gray-900">
                    <div class="font-medium">Student</div>
                    <div>: {{ $siswa->name }}</div>
                    <div class="font-medium">Class</div>
                    <div>: {{ $kelas->nama_kelas }}</div>
                    <div class="font-medium">Homeroom T</div>
                    <div>: {{ $kelas->waliKelas ? $kelas->waliKelas->name : '-' }}</div>
                </div>
            </div>

            <form action="{{ route('rapor-insert') }}" method="POST">
                @csrf
                <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-sm text-gray-700 uppercase">
                        <tr class="text-left border-b-2">
                            <th scope="col" class="px-3 py-3">No</th>
                            <th scope="col" class="px-3 py-3">Mata Pelajaran</th>
                            <th scope="col" class="px-3 py-3">Guru</th>
                            <th scope="col" class="px-3 py-3">Nilai Rapor</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($mapels as $mapel)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2">{{ $mapel->name }}</td>
                            <td class="px-3 py-2">{{ $mapel->guru ? $mapel->guru->name : '-' }}</td>
                            <td class="px-3 py-2">{{ $nilai->has($mapel->id) ? $nilai->get($mapel->id)->nilai : '-' }}</td>
                            <input type="hidden" name="mapel_id[]" value="{{ $mapel->id }}">
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Tampilkan nilai rata-rata rapor -->
                <div class="flex gap-8 pt-8">
                    <div class="w-1/2">
                        <label class="font-medium">Rata-rata Nilai Rapor</label>
                        <p class="py-2">Nilai rata-rata rapor dari semua mata pelajaran yang diikuti oleh siswa.</p>
                    </div>
                    <div class="w-1/2">
                        <label for="rapor" class="font-medium">Nilai</label>
                        <div class="mb-5 relative w-full pt-2">
                            <input type="text" id="rapor" name="rapor" value="{{ $rapor ? number_format($rapor->rapor, 2) : '-' }}" readonly class="block w-full p-2 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm">
                        </div>
                    </div>
                </div>

                <!-- Input untuk catatan -->
                <div class="flex gap-8 pt-6">
                    <div class="w-1/2">
                        <label class="font-medium">Catatan Pembelajaran</label>
                        <p class="py-2">Tulis catatan untuk siswa.</p>
                    </div>
                    <div class="w-1/2">
                        <label for="catatan" class="font-medium">Catatan</label>
                        <div class="mb-5 relative w-full pt-2">
                            <textarea name="catatan" id="catatan" rows="3" class="block p-2 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm">
                            {{ old('catatan', isset($rapor) ? $rapor->catatan : '') }}
                            </textarea>
                        </div>
                        <div class="border-b"></div>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="mt-4 flex flex-row-reverse">
                    <button type="submit" class="min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">
                        Simpan Rapor
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