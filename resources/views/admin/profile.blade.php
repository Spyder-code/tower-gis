<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <div class="w-3/4">
                            <img src="{{ asset('images/kominfo.png') }}" class="object-cover text-center" width="200" height="200">
                        </div>
                        <div class="w-3/4 mx-5">
                            <h4 class="font-bold text-xl relative text-blue-400" style="left: -50px">BIODATA</h4>
                            <form action="{{ route('user.update',['user'=>$user->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <label class="block my-3">
                                    <span class="text-gray-700">Name</span>
                                    <input type="text" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" name="name" value="{{ $user->name }}" />
                                </label>
                                <label class="block my-3">
                                    <span class="text-gray-700">Email</span>
                                    <input type="email" readonly class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" name="email" value="{{ $user->email }}" />
                                </label>
                                <div class="text-center">
                                    <button type="submit" class="p-2 bg-blue-400 rounded-lg text-white my-3 w-full"><i class="fas fa-plus-circle"></i> Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="w-3/4 mx-5">
                            <h4 class="font-bold text-xl relative text-green-400" style="left: -50px">CHANGE PASSWORD</h4>
                            <form action="{{ route('user.update.password',['user'=>$user->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <label class="block my-3">
                                    <span class="text-gray-700">New Password</span>
                                    <input type="password" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" name="password" />
                                </label>
                                <label class="block my-3">
                                    <span class="text-gray-700">Confirmation Password</span>
                                    <input type="password" class="mt-0 block w-full px-0.5 mx-5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-blue-400" name="password_confirmation" />
                                </label>
                                <div class="text-center">
                                    <button type="submit" class="p-2 bg-green-400 rounded-lg text-white my-3 w-full"><i class="fas fa-plus-circle"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
