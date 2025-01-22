<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- BREADCRUMB --}}
    @include('partials.breadcrumb')
    <div class="">
        @isset($parent_id)
            <form method="POST" action="{{ route('file.upload', $parent_id) }}" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="parent_id" value="0" /> --}}
                <label for='file'>{{ __('File') }}
                    <input id="file" type="file" name="file" required />
                </label>
                <input type="submit" value="{{ __('Upload') }}" />
                @error('name')
                    <div class='alert alert-danger fade show'> {{ $message }}</div>
                @enderror
            </form>
        @endisset
    </div>

</x-app-layout>
