<!-- Breadcrumb -->
<nav class="flex justify-between" aria-label="Breadcrumb" class="breadcrumb">
    <ol class="inline-flex items-center mb-3 sm:mb-0">
        <li>
        <li aria-current="page">
            <div class="flex items-center">
                <a href="{{ route('mapel-home-1') }}" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 rounded-md hover:bg-gray-50">
                    <span>Subjects</span>
                </a>
            </div>
        </li>
        <span class="mx-2 text-gray-400">/</span>
        @foreach ($kelas as $kelas)
        <li aria-current="page">
            <div class="flex items-center">
                <a href="{{ route('kelas.show', $item->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 rounded-md hover:bg-gray-50">
                    <span>Class {{ $kelas->nama_kelas }}</span>
                </a>
            </div>
        </li>
        @if (!$loop->last)
            <span class="mx-2 text-gray-400">/</span>
        @endif
        @endforeach
    </ol>
</nav>