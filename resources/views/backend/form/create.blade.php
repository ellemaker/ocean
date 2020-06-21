@extends('layouts.app')

@section('content')

<style>
    .each-field>span {
        display: inline-block;
        margin: 10px;
        padding: 30px 60px;
        color: white;
        font-size: 40px;
        border-radius: 20px;
        text-shadow: 0 0 20px rgba(0,0,0,0.3);
    }
    .draggable-source--is-dragging {
        visibility: hidden;
    }
    .field-each:focus, .field-lists:focus {
        outline: none;
    }
</style>
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('flash_message'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    <a href="/home">Dashboard</a>
                </div>

                <div class="w-full p-6">
                    <form action="{{ route('admin.form.store') }}" method="post">
                        <div class="text-right mb-5">
                            <button type="submit" class="field-move cursor-move bg-indigo-600 text-white inline-block py-2 px-5 min-w-20 rounded text-sm hover:bg-indigo-800">Publish</button>
                        </div>

                        <div>
                            <div class="mb-5">
                                @csrf
                                <label for="title" class="block font-medium">Form Name</label>
                                <input class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" type="text" name="title" name="title">
                                @if($errors->has('title'))
                                    <div class="text-red-500">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div x-data="createfields()">
                                <label for="" class="block font-medium">Form Fields</label>

                                <div class="field-lists mb-5">
                                    <template x-for="field in fields" :key="field">
                                       <div class="field-each py-3">
                                            <div class="flex flex-wrap items-center -mx-3">
                                                <div class="flex-none">
                                                    <div class="px-3">
                                                        <div class="">
                                                            <button class="field-move cursor-move bg-indigo-600 text-white inline-block p-2 min-w-20 rounded-full text-sm hover:bg-indigo-800">
                                                                <span>
                                                                    <svg class="w-4 h-4 transform scale-95" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>

                                                                </span>
                                                            </button>
                                                            <button x-on:click="removeField(field.id)" class="bg-red-600 text-white inline-block p-2 min-w-20 rounded-full text-sm hover:bg-red-800">
                                                                <span>
                                                                    <svg class="w-4 h-4 transform scale-95" fill="currentColor" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="flex-1">
                                                    <div class="px-3">
                                                        <label for="label" class="block font-medium text-sm">Field Label</label>
                                                        <input class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" type="text" name="label[]" id="label">
                                                    </div>
                                                    
                                                </div>
                                                <div class="flex-1">
                                                    <div class="px-3">
                                                        <label for="name" class="block font-medium text-sm">Field Name</label>
                                                        <input class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" type="text" name="name[]" id="name">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                
                                
                                <div class="text-right">
                                    <button type="button" x-on:click="addField" class="field-move bg-indigo-600 text-white inline-block py-2 px-5 min-w-20 rounded text-sm hover:bg-indigo-800">Add Field</button>
                                </div>
                                

                            </div>

                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.js"></script>
    <script>
        function createfields() {
            
            return {
                fields: [{'id' : 1, 'label' : '', 'name': ''}],
                addField() {
                    var count_fields = this.fields.length + 1; 
                    this.fields.push({'id' : count_fields, 'label' : '', 'name': ''}) 
                },
                removeField(field){
                    this.fields = this.fields.filter(x => {
                        return x.id != field;
                    });
                }

            }
        }

        const sortable = new Draggable.Sortable(document.querySelectorAll('.field-lists'), {
            draggable: '.field-each',
            handle : '.field-move'
        });
    </script>
@endsection
