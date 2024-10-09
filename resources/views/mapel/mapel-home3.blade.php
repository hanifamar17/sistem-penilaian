@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-52">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">

            <nav class="my-4">
                @include('template/mapel-breadcrumb')
            </nav>

            <div class="mb-8 py-2">
                <h5 class="text-2xl font-medium tracking-tight">Subjects</h5>
                <span class="font-small mt-2">Display Subjects for <a class="text-yellow-600 font-medium">Class XI</a></span>
            </div>

            <!-- Flash message -->
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

            <!-- Form Filter -->
            <form action="{{ route('mapel-filtered-3') }}" method="GET">
                <div class="form-group ">
                    <label for="kelas_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih Kelas XI:</label>
                    <div class="flex flex-row space-x-4">
                        <select name="kelas_id" id="kelas_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/4 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit" class="max-w-20 min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">
                            Filter
                        </button>
                    </div>
                </div>
            </form>

            <div class="py-8 flex flex-row-reverse">
                <a href="{{ route('mapel-add')}}" class="max-w-20 min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">
                    Tambah
                </a>
                <!--
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import
                </button>-->
            </div>

            

            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-sm text-gray-700 uppercase">
                    <tr class="text-left border-b-2">
                        <th scope="col" class="px-3 py-3">No</th>
                        <th scope="col" class="px-3 py-3">Mata Pelajaran</th>
                        <th scope="col" class="px-3 py-3">Kelas</th>
                        <th scope="col" class="px-3 py-3">Guru</th>
                        <th scope="col" class="px-3 py-3">Wali Kelas</th>
                        <th scope="col" class="px-3 py-3">Updated at</th>
                        <th scope="col" class="px-3 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @if ($mapel->isEmpty())
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center text-gray-500">
                            Tidak ada data yang ditampilkan.
                        </td>
                    </tr>
                    @else
                    @foreach($mapel as $mapel)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $mapel->name }}</td>
                        <td class="px-3 py-2">{{ $mapel->kelas->nama_kelas }}</td>
                        <td class="px-3 py-2">{{ $mapel->guru->name }}</td>
                        <td class="px-3 py-2">{{ $mapel->kelas->waliKelas->name ? $mapel->kelas->waliKelas->name : 'Tidak ada wali kelas' }}</td>
                        <td class="px-3 py-2">{{ $mapel->updated_at->format('l, d F Y') }}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-row space-x-4">
                                <div>
                                    <a href="/admin/mapel-view/{{  $mapel->id }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo view &raquo
                                    </a>
                                </div>
                                <div>
                                    <a href="{{  route('mapel-update-form', $mapel->id) }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo update &raquo
                                    </a>
                                </div>
                                <div>
                                    <a href="/admin/mapel-delete/{{  $mapel->id }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo delete &raquo
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
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