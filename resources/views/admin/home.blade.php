@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/sidebar')
@section('container')
<div class="p-4 sm:ml-56">
    <div class="p-4 rounded-md mt-14 bg-white">
        <div class="m-4">
            <h5 class="text-2xl font-medium tracking-tight">Admin</h5>

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


            <div class="py-8 flex flex-row-reverse">
                <a href="{{ route('admin-add')}}" class="max-w-20 min-w-20 text-white text-sm text-center py-2 px-4 ml-2 bg-blue-600 rounded hover:bg-blue-800">
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
                        <th scope="col" class="px-3 py-3">Role</th>
                        <th scope="col" class="px-3 py-3">Name</th>
                        <th scope="col" class="px-3 py-3">Email</th>
                        <th scope="col" class="px-3 py-3">Updated at</th>
                        <th scope="col" class="px-3 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($admin as $admin)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $admin->role }}</td>
                        <td class="px-3 py-2">{{ $admin->name }}</td>
                        <td class="px-3 py-2">{{ $admin->email }}</td>
                        <td class="px-3 py-2">{{ $admin->updated_at->format('l, d F Y') }}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-row space-x-4">
                                <div>
                                    <a href="/admin/admin-view/{{  $admin->id }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo view &raquo
                                    </a>
                                </div>
                                <div>
                                    <a href="{{  route('admin-update-form', $admin->id) }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo update &raquo
                                    </a>
                                </div>
                                <div>
                                    <a href="/admin/admin-delete/{{  $admin->id }}" class="text-blue-600 hover:text-blue-900">
                                        &laquo delete &raquo
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