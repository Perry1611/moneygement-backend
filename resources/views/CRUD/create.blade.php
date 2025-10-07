@extends('CRUD.layouts.layout')

@section('content')
<div class="mb-10 bg-white p-6 px-60 h-max grid justify-items-stretch">
    <h2 class="text-3xl font-bold mb-2 flex items-center justify-center">Add new cost</h2>
    <form action="/create" method="POST">
        @csrf
        <label class="form-control w-full max-w-xs">
            <div class="label">
            <span class="label-text font-bold">Cost title</span>
            </div>
            <input name="title" type="text" placeholder="Type here" id="title" class="input input-bordered w-full max-w-xs" required value="{{ old('title') }}"/>
            @error('title')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="label">
            </div>
        </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
            <span class="label-text font-bold">What kind of cost?</span>
            </div>
            <select class="select select-bordered" name="category_id" required >
                <option disabled selected>Pick one</option>
                @foreach ($categories as $category)
                    @if(old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
            @error('category_id')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="label">
            </div>
        </label>
        <label class="form-control">
            <div class="label">
                <span class="label-text font-bold">Descript it for more detail</span>
            </div>
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
            @error('body')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="label">
            </div>
        </label>
        <label class="form-control w-full max-w-xs">
            <div class="label">
            <span class="label-text font-bold">How much money you spent on it</span>
            </div>
            <input name="cost" type="number" placeholder="Type here" id="cost" class="input input-bordered w-full max-w-xs" required value="{{ old('cost') }}"/>
            @error('cost')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="label">
            </div>
        </label>
        <div class="grid justify-items-stretch">
            <button class="btn btn-outline btn-primary my-2">Add</button>
        </div>
    </form>
    <a href="/dashboard" class="grid"><button class="btn btn-neutral">Back to dashboard</button></a>
</div>
@endsection
