@extends('layouts.app')

@section('content')

    <div class="bg-white py-10 shadow-md">
        <div class="container mx-auto">
            <div class="flex">
                <div>
                    <h1 class="text-2xl font-bold text-gray-700 uppercase sm:text-3xl sm:leading-9 sm:truncate">New Pag<span class="italic">e_</span></h1>
                </div>
                
                <div class="ml-auto">
                    <a href="{{ route('admin.page.index') }}" class="ml-3 border border-indigo-500 text-indigo-500 font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:border-indigo-600 hover:bg-gray-100">
                        Cancel
                    </a>
                    <a href="javascript:;" data-form="#createForm" class="btn-publish ml-3 bg-indigo-500 text-white font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:bg-indigo-600">
                        Publish
                    </a>
                </div>
                
            </div>
            
        </div>
    </div>


    <div class="container mx-auto pt-10">
        <div class="flex items-start">
            <div class="md:w-3/4 md:mx-auto h-full">

                <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md h-full">

                    <div class="font-semibold bg-indigo-600 text-white py-3 px-6 mb-0 flex items-center">
                        <div>Page Content</div>

                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-plus /></a>
                            </div>
                        </div>
                    </div>

                    <div class="w-full p-6">
                        <form id="createForm" action="{{ route('admin.page.store') }}" method="post">
                            

                            <div>
                                @csrf
                                <div class="mb-5">
                                    <label for="title" class="inline-block font-medium text-gray-700">Page Title</label>
                                    <input class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" type="text" name="title" name="title">
                                    @if($errors->has('title'))
                                        <div class="text-red-500">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="mb-5">
                                    <label for="content" class="inline-block font-medium text-gray-700">Page Content</label>
                                    <textarea class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" name="content" id="content" cols="30" rows="10"></textarea>
                                    
                                    <div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-1/4 pl-5">
                <div class="panel mb-5">
                    <header class="block bg-indigo-600 flex p-3 text-white">
                        <div class="font-bold text-sm pb-1">Status and Visibility</div>
                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-cheveron-down /></a>
                            </div>
                        </div>
                    </header>
                    <div class="bg-white p-3 shadow rounded text-sm  text-gray-700 font-medium">
                        <div class="py-3 flex">
                            <div class="mr-auto">Visibility</div>
                            <div><a href="#" class="underline text-indigo-500 text-xs">Public</a></div>
                        </div>
                        <div class="py-3 flex">
                            <div class="mr-auto">Publish</div>
                            <div><a href="#" class="underline text-indigo-500 text-xs">May 6, 2020 6:19 pm</a></div>
                        </div>
                    </div>
                </div>


                <div class="panel mb-5">
                    <header class="block bg-indigo-600 flex p-3 text-white">
                        <div class="font-bold text-sm pb-1">Permalink</div>
                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-cheveron-down /></a>
                            </div>
                        </div>
                    </header>
                    <div class="bg-white p-3 shadow rounded text-sm  text-gray-700 font-medium">
                        <div class="py-3 flex">
                            <div class="mr-auto">Page URL</div>
                            <div><a href="#" class="underline text-indigo-500 text-xs">/contact-us</a></div>
                        </div>
                        <div class="py-3 flex">
                            <div class="mr-auto">View Page</div>
                            <div><a href="#" class="underline text-indigo-500 text-xs block w-5 h-5"> <x-heroicon-s-eye /></a></div>
                        </div>
                    </div>
                </div>


                 <div class="panel mb-5">
                    <header class="block bg-indigo-600 flex p-3 text-white">
                        <div class="font-bold text-sm pb-1">Featured Image</div>
                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-cheveron-down /></a>
                            </div>
                        </div>
                    </header>
                    <div class="bg-white p-3 shadow rounded text-sm  text-gray-700 font-medium">
                        <div class="border-2 border-gray-300 bg-gray-100 h-32 rounded border-dashed"></div>
                    </div>
                </div>

                 <div class="panel mb-5">
                    <header class="block bg-indigo-600 flex p-3 text-white">
                        <div class="font-bold text-sm pb-1">Featured Image</div>
                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-cheveron-down /></a>
                            </div>
                        </div>
                    </header>
                    <div class="bg-white p-3 shadow rounded text-sm  text-gray-700 font-medium">
                        <ul>
                            <li class="py-2">
                                <label class="md:w-2/3 block text-gray-500 font-bold">
                                    <input class="mr-2 leading-tight" type="checkbox">
                                    <span class="text-sm">
                                        Category 1
                                    </span>
                                </label>
                            </li>
                            <li class="py-2">
                                <label class="md:w-2/3 block text-gray-500 font-bold">
                                    <input class="mr-2 leading-tight" type="checkbox">
                                    <span class="text-sm">
                                        Category 2
                                    </span>
                                </label>
                            </li>
                            <li class="py-2">
                                <label class="md:w-2/3 block text-gray-500 font-bold">
                                    <input class="mr-2 leading-tight" type="checkbox">
                                    <span class="text-sm">
                                        Category 3
                                    </span>
                                </label>
                            </li>
                            <li class="py-2">
                                <label class="md:w-2/3 block text-gray-500 font-bold">
                                    <input class="mr-2 leading-tight" type="checkbox">
                                    <span class="text-sm">
                                        Category 4
                                    </span>
                                </label>
                            </li>
                        </ul>
                        <div>
                            <div class="my-3">
                                <a href="#" class="underline text-indigo-500 text-xs">Add New Category</a>
                            </div>
                            <div class="border-t pt-2">
                                <div class="mb-3">
                                    <label for="" class="mb-1 block">Category Name</label>
                                    <input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-xs appearance-none outline-none focus:border-indigo-700">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="mb-1 block">Parent Category</label>
                                    <select class="block appearance-none w-full rounded border border-gray-500 p-2 leading-tight focus:border-indigo-700" id="grid-state">
                                        <option>New Mexico</option>
                                        <option>Missouri</option>
                                        <option>Texas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="bg-indigo-600 text-white inline-block py-2 px-5 min-w-20 rounded text-xs hover:bg-indigo-800">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel mb-5">
                    <header class="block bg-indigo-600 flex p-3 text-white">
                        <div class="font-bold text-sm pb-1">Featured Image</div>
                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-cheveron-down /></a>
                            </div>
                        </div>
                    </header>

                    <div class="bg-white p-3 shadow rounded text-sm  text-gray-700 font-medium">
                        <textarea name="" placeholder="write your tags here..." class="tagify rounded border border-gray-500 w-full p-2 mt-1 text-xs appearance-none outline-none focus:border-indigo-700" id="" cols="30" rows="1"></textarea>
                    </div>
                </div>

                <div class="panel mb-5">
                    <header class="block bg-indigo-600 flex p-3 text-white">
                        <div class="font-bold text-sm pb-1">Exerpt</div>
                        <div class="ml-auto">
                            <div class="w-5 h-5">
                                <a href="#"><x-heroicon-s-cheveron-down /></a>
                            </div>
                        </div>
                    </header>

                    <div class="bg-white p-3 shadow rounded text-sm  text-gray-700 font-medium">
                        <textarea name="" class="rounded border border-gray-500 w-full p-2 mt-1 text-xs appearance-none outline-none focus:border-indigo-700" id="" cols="10" rows="4"></textarea>
                    </div>
                </div>

                
                

            </div>
        </div>
    </div>

    
@endsection
