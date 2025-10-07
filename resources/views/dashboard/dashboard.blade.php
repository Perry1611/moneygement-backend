@extends('dashboard.layouts.layout')

@section('content')
        <!-- Content -->
        <div class="w-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-center p-4 bg-white shadow">
                <div class="text-2xl font-bold mb-2">
                    Welcome {{ auth()->user()->name }}, Have a nice day
                </div>
            </div>
            <!-- Main Content -->
            <div class="flex-grow p-6">
                <div class="grid gap-5">
                    <div class="gap-7 mx-auto flex justify-around">
                        <div class="bg-white p-6 mt-4 px-10 rounded shadow-md">
                            <div class="stats bg-neutral text-primary-content flex card-body px-6">
                                <h2 class="text-3xl font-bold grid justify-items-center">Your total cost this month</h2>
                                <div class="stat py-7">
                                    <div class="stat-value grid justify-items-center text-5xl">{{ 'Rp ' . number_format($amount, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-around">
                                <form action="/done/{{ Auth()->user()->id }}"  method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline btn-success" onclick="return confirm('Delete all cost? Once you click OK, all cost will be deleted!')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                        </svg>I'm done with all cost
                                </button>
                                </form>
                            </div>
                        </div>
                        <div class="bg-white p-6 mt-4 px-10 rounded shadow-md">
                            <div class="stats bg-neutral text-primary-content flex card-body px-6">
                                <h2 class="text-3xl font-bold grid justify-items-center">Your total income this month</h2>
                                <div class="stat py-7">
                                    <div class="stat-value grid justify-items-center text-5xl">{{ 'Rp ' . number_format($income, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-3">
                                <div>
                                    <a href="/income" class="btn btn-outline btn-success"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                        </svg>Add income
                                    </a>
                                </div>
                                <div>
                                    <a href="/incomeEdit" class="btn btn-outline btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>Edit income
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <div role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    @elseif(session()->has('error'))
                    <div role="alert" class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    @endif
                    <div class="bg-white mt-5 mb-7 p-6 rounded shadow-md h-max">
                        <h2 class="text-3xl font-bold mb-7 flex items-center justify-center">Category of cost</h2>
                        <div class="flex flex-row my-10">
                            @foreach ($categories as $category)
                            <div class="card w-96 overflow-auto bg-neutral shadow-xl mx-auto sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                                <figure class="px-10 pt-10">
                                <img src="../assets/{{ $category->image }}" alt="image" class="rounded-xl" />
                                </figure>
                                <div class="card-body items-center text-center">
                                <h2 class="card-title text-neutral-content">{{ $category->name }}</h2>
                                <p class="text-neutral-content">{{ $category->description }}</p>
                                <div class="card-actions">
                                <a href="/category/{{ $category->id }}" class="btn btn-primary mt-2">Here</a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="grid gap-6 mb-5">
                        <div class="bg-white mb-6 p-6 rounded shadow-md @if($posts->count() == 0) h-60 @endif h-max">
                            <h2 class="text-3xl font-bold mb-7 flex items-center justify-center">All your recently cost</h2>
                            <div class="m-4">{{ $posts->links() }}</div>
                            <div class="overflow-x-auto px-10 mt-4">
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
                                    <td>{!! $post->title !!}</td>
                                    <td>{!! $post->category->name !!}</td>
                                    <td>{{ 'Rp ' . number_format($post->cost, 0, ',', '.') }}</td>
                                    <td>{!! $post->created_at->format('M d, Y | h:i:s A') !!}</td>
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
                </div>
            </div>
        </div>
@endsection
