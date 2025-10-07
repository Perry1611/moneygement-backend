@extends('dashboard.layouts.layout')

@section('content')
<div class="mb-10 bg-white p-7 px-40 h-max grid justify-items-stretch">
    <div class="max-w-xl container mx-auto m-6 p-8">
        <p class="text-5xl font-bold flex justify-center">Add Your Income</p>
        <div class="max-w-xl container mx-auto mt-6 mb-3 p-8 bg-neutral rounded-lg shadow-md">
            <form action="/storeincome/{{ Auth()->user()->id }}"
                method="POST">
                @csrf
                <div class="mb-4">
                    <label for="amount" class="block text-neutral-content text-sm font-bold mb-2">Income Amount</label>
                    <input type="number" id="income" name="income" placeholder="Enter income amount" class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" required autofocus/>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add Income
                    </button>
                </div>
            </form>
        </div>
        <a href="/dashboard" class="grid mb-2"><button class="btn btn-outline btn-neutral">Back to dashboard ?</button></a>
    </div>
</div>
@endsection
