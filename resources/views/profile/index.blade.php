@extends('layouts.app')

@section('title')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" name="username" id="username" placeholder="Nombre de usuario"
                        class="border p-3 w-full rounded-lg" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-red-100 my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen perfil
                    </label>
                    <input type="file" name="image" id="image" class="border p-3 w-full rounded-lg" value=""
                        accept=".jpg, .png">
                </div>
                <input type="submit" value="Guadar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
