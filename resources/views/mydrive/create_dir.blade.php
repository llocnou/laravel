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
            <form method="POST" action="{{ route('dashboard.store.dir')}}" class='form'>
                @csrf
                {{-- ID DEL NODO PADRE --}}
                <input type="hidden" name="parent_id" value="{{$parent_id}}" />
                {{-- NOMBRE DEL NUEVO DIRECTORIO--}}
                <fieldset>
                    <label for='name'>{{__('New folder')}}
                        <input type='text' name='name' value='{{old('name')}}' id='name' {{-- required --}}/>
                    </label>
                    <input type='submit' value='{{__('Create')}}'/>
                </fieldset>
                @error('name')
                    <div class='alert alert-danger fade show'> {{ $message }}</div>
                @enderror

            </form>
        @endisset
    </div>

</x-app-layout>
