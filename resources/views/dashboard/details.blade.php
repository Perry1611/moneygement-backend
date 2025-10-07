@extends('dashboard.layouts.layout')

@section('content')
<div class="mb-10 bg-white p-7 px-40 h-max grid justify-items-stretch">
    <div class="max-w-xl container mx-auto m-6 p-8">
        <p class="text-5xl font-bold flex justify-center">About this Cost</p>
        <div class="glass max-w-xl container mx-auto mt-6 mb-2 p-8 bg-slate-400 rounded-lg shadow-md">
            <header class="mb-5">
                <h1 class="text-4xl font-bold  mb-2">{!! $post->title !!}</h1>
                <p><span class="font-semibold">{!! $post->created_at->format('M d, Y')  !!}</span></p>
            </header>
                <p class="mb-4">{!! $post->body !!}</p>
            <div class="bg-success rounded-lg px-3 py-2 mt-3">
                <p class="text-xl text-neutral-content flex justify-center font-bold">Rp.{!! $post->cost !!}</p>
            </div>
        </div>
        <a href="/edit/{{ $post->id }}" class="grid mb-2"><button class="btn btn-outline btn-warning">Edit this cost!</button></a>
        <form action="/delete/{{ $post->id }}" method="POST" class="inline">
            @csrf
            @method('delete')
            <a href="/" class="grid mb-2"><button class="btn btn-outline btn-error" onclick="return confirm('Are you sure you want to delete this?')">Delete this cost!</button></a>
        </form>
        <a href="/dashboard" class="grid mb-2"><button class="btn btn-outline btn-neutral">Back to dashboard</button></a>
    </div>
</div>
@endsection
