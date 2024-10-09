<!-- Breadcrumb -->
<nav class="flex justify-between" aria-label="Breadcrumb" class="breadcrumb">
    <ol class="inline-flex items-center mb-3 sm:mb-0">
        <li>
        <li aria-current="page">
            <div class="flex items-center">
                <a href="{{ route('mapel-home') }}" 
                class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 rounded-md hover:text-yellow-600
                {{ Request::route()->named('mapel-home') ? 'text-yellow-600' : '' }}">
                    <span>Subjects</span>
                </a>
            </div>
        </li>
        <span class="mx-2 text-gray-400">/</span>
        <li aria-current="page">
            <div class="flex items-center">
                <a href="{{ route('mapel-home-1') }}" 
                class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 rounded-md hover:text-yellow-600
                {{ Request::route()->named('mapel-home-1') ? 'text-yellow-600' : '' }}">
                    <span>Class X</span>
                </a>
            </div>
        </li>
        <span class="mx-2 text-gray-400">/</span>
        <li aria-current="page">
            <div class="flex items-center">
                <a href="{{ route('mapel-home-2') }}" 
                class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 rounded-md hover:text-yellow-600
                {{ Request::route()->named('mapel-home-2') ? 'text-yellow-600' : '' }}">
                    <span>Class XI</span>
                </a>
            </div>
        </li>
        <span class="mx-2 text-gray-400">/</span>
        <li aria-current="page">
            <div class="flex items-center">
                <a href="{{ route('mapel-home-3') }}" 
                class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-900 rounded-md hover:text-yellow-600
                {{ Request::route()->named('mapel-home-3') ? 'text-yellow-600' : '' }}">
                    <span>Class XII</span>
                </a>
            </div>
        </li>        
    </ol>
</nav>