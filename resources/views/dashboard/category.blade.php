@extends('dashboard.layouts.layout')

@section('content')
<div class="hero min-h-64" style="background-image: url(../assets/{{ $category->image }});">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">{{ $category->name }}</h1>
            <p class="mb-5">Your {{ $category->description }} will displayed here</p>
        </div>
    </div>
</div>

<div class="grid gap-6 mb-7">
    <div class="bg-white p-6 rounded shadow @if($posts->count() == 0) shadow-none h-60 @endif h-max">
        <div class="grid place-content-start mb-2">
            <a class="btn btn-outline btn-success" href="/dashboard">Back to Dashboard</a>
        </div>
        <h2 class="text-3xl font-bold mb-7 flex items-center justify-center">list of your {{ $category->name }} cost</h2>
        <div class="m-4">{{ $posts->links() }}</div>
        <div class="overflow-x-auto px-10 mr-4">
            @if($posts->count() == 0)
                <h2 class="text-2xl font-bold my-5 flex items-center justify-center text-error">There is nothing here, add new cost first!</h2>
            @else
            <table class="table">
            <!-- head -->
            <thead>
                <tr>
                <th>No.</th>
                <th>Cost title</th>
                <th>Cost Category</th>
                <th>Cost</th>
                <th>Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ 'Rp ' . number_format($post->cost, 0, ',', '.') }}</td>
                <td>{{ $post->created_at->format('M d, Y | h:i:s A') }}</td>
                <td class="max-w-28">
                    <div class="flex justify-center">
                    <a class="btn btn-outline btn-primary right-5" href='/detail/{{ $post->id }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                    </svg>
                    </a>
                    <a class="btn btn-outline btn-warning mx-5" href='/edit/{{ $post->id }}'>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                    </a>
                    <form action="/delete/{{ $post->id }}"  method="POST" class="inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-outline btn-error right-5" onclick="return confirm('Are you sure you want to delete this?')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                    </div>
                </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            </table>
            <a href="/create" class="fixed bottom-20 right-4 bg-success text-white px-6 py-4 rounded-full shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>
    </div>
</div>

@endsection
