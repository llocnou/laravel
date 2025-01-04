<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- BREADCRUMB --}}
    @include('partials.breadcrumb')
    <div class="">
        @isset($inode)
            <form method="POST" action="{{ route('dashboard.update', $inode->id) }}">
                @csrf
                @method('PATCH')
                <fieldset>
                    <label for='name'>
                        <input type='text' name='name' value='{{ old('name', $inode->name) }}' id='name' />
                    </label>
                    <input type='submit' value='{{ __('Modificar') }}' />
                </fieldset>
                {{-- ERROR --}}
                @error('name')
                    <div class='alert alert-danger'> {{ $message }}</div>
                @enderror
            </form>
        @endisset
    </div>

</x-app-layout>
