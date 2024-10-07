@extends('template/theme')
@section('Selamat Datang','Selamat Datang, Sistem Penilaian')
@include('template/header')
@section('container')
<div class="">
    <div class="flex justify-center items-center p-12">
        <div class="w-full p-12 bg-white border border-gray-200 rounded shadow">

            <h5 class="mb-2 py-2 text-2xl font-medium tracking-tight">Home</h5>
                @csrf
                @foreach($kelas as $kelas)
                <input type="hidden" name="id" value="{{ $kelas->id }}">
                <div>
                    <label for="tingkat">Tingkat</label>
                    <input type="text" name="tingkat" value="{{ $kelas->tingkat }}" class="border">
                </div>
                <div>
                    <label for="jurusan">Jurusan</label>
                    <input type="jurusan" name="jurusan" value="{{ $kelas->jurusan }}" class="border">
                </div>
                
                @endforeach
            </form>

        </div>
    </div>
</div>
@include('template/footer-login')