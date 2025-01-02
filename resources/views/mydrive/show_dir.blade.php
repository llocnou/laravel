<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- BREADCRUMB --}}
    @include('partials.breadcrumb')
    <div class="">
        {{-- DIRECTORIO --}}
        @isset($dir)
            <p>{{ $dir->name }} <a href="{{ route('dashboard.edit', $dir->id) }}" title="{{__('edit')}}">🖉</a></p>
            <p> Creado: {{ $dir->created_at }}</p>
            <p> Modificado: {{ $dir->updated_at }}</p>
            <button>Nueva carpeta</button>
            <button>Subir archivo</button>
            <button>Borrar</button>
            {{-- Mostrar contenido de la carpeta ? --}}
            <address>Mostrar contenido de la carpeta ?</address>
        @endisset

    </div>

</x-app-layout>
