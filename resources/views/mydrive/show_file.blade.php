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
            <p>Name: {{$file->name}}
                <a href="{{ route('dashboard.edit', $file->inodes_id) }}" title="{{__('edit')}}">🖉</a>
                <a href="{{route('file.download', $file->id)}}">[🠋]</a>
            </p>
            <p>Size: {{$file->size}} Bytes</p>
            <p>Type: {{$file->type}}</p>
            <p>Created at: {{$file->created_at}}</p>
            <p>Updated at: {{$file->updated_at}}</p>
            <form action="{{route('file.delete', $file->id)}}" method="POST">
                @method("DELETE")
                @csrf
                <button type="submit" title="delete">🗑</button>
            </form>


        @endisset
    </div>

</x-app-layout>
