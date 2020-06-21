@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    <a href="/home">Dashboard</a>
                </div>

                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif

                <div class="w-full p-6">
                    <form action="{{ route('admin.post.update', $post->id) }}" method="post">
                        <div class="text-right mb-5">
                            <button type="submit">Save</button>
                        </div>
                        

                        <div>
                            @csrf
                            @method('put')

                            <div class="mb-5">
                                <label for="title" class="inline-block font-medium">Page Title</label>
                                <input class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" type="text" name="title" name="title" value="{{ $post->title }}">
                                @if($errors->has('title'))
                                    <div class="text-red-500">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="mb-5">
                                <label for="content" class="inline-block font-medium">Page Content</label>
                                <textarea class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
                                @if($errors->has('content'))
                                    <div class="text-red-500">{{ $errors->first('content') }}</div>
                                @endif
                            </div>
                            
                        </div>
                    </form>

                    <div class="border-t pt-3 text-right">

                        <form action="{{ route('admin.post.destroy', $post->id) }}" id="deletePage" method="post">
                            @csrf
                            @method('delete')
                            <button class="font-medium text-red-500 bg-red-200 py-2 px-5">Delete Page</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
