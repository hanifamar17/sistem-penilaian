@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/header')
@section('container')
<div class="">
    <div class="flex justify-center items-center p-12">
        <div class="w-full p-12 bg-white border border-gray-200 rounded shadow">

            <h5 class="mb-2 py-2 text-2xl font-medium tracking-tight">Home</h5>

            <form action="{{ route('kelas-insert')}}" method="POST">
                @csrf
                <div>
                    <label for="tingkat">Tingkat</label>
                    <select name="tingkat" required class="border">
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div>
                    <label for="jurusan">Jurusan</label>
                    <input type="text" name="jurusan" autocomplete="jurusan" placeholder="" required class="border">
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>
</div>
@include('template/footer-login')