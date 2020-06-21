@extends('layouts.app')

@section('content')
    <div class="bg-white py-10 shadow-md">
        <div class="container mx-auto">
            <div class="flex">
                <div>
                    <h1 class="text-2xl font-bold uppercase text-gray-700 sm:text-3xl sm:leading-9 sm:truncate">Page<span class="italic">s_</span></h1>
                </div>
                
                
                <div class="ml-auto">
                    <a href="{{ route('admin.page.create') }}" class="ml-3 bg-indigo-500 text-white font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:bg-indigo-600">
                        Create New Page
                    </a>
                </div>
                
            </div>
            
        </div>
    </div>


    <div class="container mx-auto pt-10">
        <div class="flex flex-col">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full table-fixed">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-indigo-400 text-left text-sm leading-4 font-medium text-white font-bold uppercase tracking-wider">
                                    Page Title
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-indigo-400 text-left text-sm leading-4 font-medium text-white font-bold uppercase tracking-wider">
                                    Template
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-indigo-400 text-left text-sm leading-4 font-medium text-white font-bold uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-indigo-400 text-left text-sm leading-4 font-medium text-white font-bold uppercase tracking-wider">
                                    Last Update
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-indigo-400"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($pages as $page)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 text-indigo-500">
                                                <x-heroicon-s-document/>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900 hover:text-indigo-500">
                                                    <a href="{{ route('admin.page.show', $page->id) }}">{{ $page->title }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">Default Template</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                        {{ $page->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                        <a href="" class="text-indigo-600 hover:text-indigo-900">Edit </a>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @if (isset($pages->links))
                        {{ $pages->links() }}
                    @endif
                    
                </div>
            </div>
        </div>

    </div>
@endsection
