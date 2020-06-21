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

                <div class="w-full p-6">
                    <div class="text-right mb-5">
                        <a href="{{ route('admin.page.create') }}" class="underline">create a page</a>
                    </div>

                    <div class="mb-10">
                        <ul class="list-disc pl-5">
                            @foreach ($pages as $page)
                                <li>
                                    <a href="{{ route('admin.page.show', $page->id) }}" class="text-blue-500 hover:underline">
                                        {{ $page->title }} - 
                                        <span class="text-xs">{{ $page->created_at->diffForHumans() }}</span>
                                    </a>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>

                    <div class="text-right mb-5">
                        <a href="{{ route('admin.post.create') }}" class="underline">create a post</a>
                    </div>

                    <div class="mb-10">
                        <ul class="list-disc pl-5">
                            @foreach ($posts as $post)
                                <li>
                                    <a href="{{ route('admin.post.show', $post->id) }}" class="text-blue-500 hover:underline">
                                        {{ $post->title }} - 
                                        <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="text-right mb-5">
                        <a href="{{ route('admin.form.create') }}" class="underline">create a form</a>
                    </div>

                    <div class="mb-10">
                        <ul class="list-disc pl-5">
                            @foreach ($forms as $form)
                                <li>
                                    <a href="{{ route('admin.form.show', $form->id) }}" class="text-blue-500 hover:underline">
                                        {{ $form->name }} - 
                                        <span class="text-xs">{{ $form->created_at->diffForHumans() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

