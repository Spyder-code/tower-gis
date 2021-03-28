<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <ul class="flex text-gray-500 text-sm lg:text-base">
                <li class="inline-flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="inline-flex items-center">
                    <x-nav-link :href="route('data')" :active="request()->routeIs('data')">
                        {{ __('Data Management') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="inline-flex items-center">
                    <x-nav-link :href="$tipe==1?route('pemilik.edit',['pemilik'=>$data->id]):route('kecamatan.edit',['kecamatan'=>$data->id])" :active="request()->routeIs($tipe==1?'pemilik.*':'kecamatan.*')">
                        {{ __('Edit Data') }}
                    </x-nav-link>
                    <svg class="h-5 w-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
            </ul>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4 text-center" :errors="$errors" />
                    <form action="{{ $tipe==1?route('pemilik.update',['pemilik'=>$data->id]):route('kecamatan.update',['kecamatan'=>$data->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label class="block my-3">
                            <input type="text" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" value="{{ $data->name }}" name="name" placeholder="Click here to add pemilik"/>
                        </label>
                        <button type="submit" class=" inline-block m-2 md:m-5 border border-green-300 bg-green-400 text-white md:py-1 md:px-5 p-1 rounded w-full text-center">
                            <i class="fas fa-plus-circle"></i> Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
