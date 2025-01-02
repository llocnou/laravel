<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- BREADCRUMB --}}
    @include('partials.breadcrumb')
    <div class="">
        {{-- ARCHIVO --}}
        @isset($file)
            <p>Name: {{$file->name}} <a href="{{ route('dashboard.edit', $file->inodes_id) }}" title="{{__('edit')}}>🖉</a></p>
            <p>Size: {{$file->size}}</p>
            <p>Type: {{$file->type}}</p>
            <p>Created at: {{$file->created_at}}</p>
            <button>Borrar</button>
            <button>Descargar</button>
        @endisset
    </div>

</x-app-layout>
