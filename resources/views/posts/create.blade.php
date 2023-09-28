@extends('layouts.app')

@section('title')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form id="dropzone" action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Título
                    </label>
                    <input type="text" name="title" id="title" placeholder="Título de la publicación"
                        class="border p-3 w-full rounded-lg @error('title')
                        border-red-500 @enderror"
                        value="{{ old('title') }}">
                    @error('title')
                        <p class="bg-red-500 text-red-100 my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea name="description" id="description" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg @error('description')
                        border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-red-100 my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="hidden" name="image" id="image" value="{{ old('image') }}">
                </div>
                @error('image')
                    <p class="bg-red-500 text-red-100 my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
                <input type="submit" value="Publicar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
