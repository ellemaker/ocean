@extends('layouts.app')


@section('content')
    <div class="bg-white py-10 shadow-md">
        <div class="container mx-auto">
            <div class="flex">
                <div>
                    <h1 class="text-2xl font-bold uppercase text-gray-700 sm:text-3xl sm:leading-9 sm:truncate">Medi<span class="italic">a_</span></h1>
                </div>
                
            </div>
        </div>
    </div>
    
    <div id="vueApp">
        <vc-media-component 
            media_dz_upload_url="{{ route('admin.media-file.store') }}"
            media_contents="{{ route('admin.media.contents') }}"
            media_remove_selected_files="{{ route('admin.media.destroy.files') }}"
            media_store_folder = "{{ route('admin.media-folder.store') }}">
            <template #folder-add-icon><x-zondicon-folder-outline-add/></template>
            <template #folder-icon><x-heroicon-s-folder /></template>
            <template #view-list-icon><x-zondicon-list-bullet /></template>
            <template #view-grid-icon><x-zondicon-view-tile /></template>
            <template #folder-icon-options><x-zondicon-dots-horizontal-triple /></template>
        </vc-media-component>
    </div>
    
@endsection

