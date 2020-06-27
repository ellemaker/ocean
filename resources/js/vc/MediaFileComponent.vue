<template>
	<div 
		class="w-1/5 px-2 mb-4 relative file-item overflow-hidden" 
		:class="{'w-1/5' : fileView, 'w-full' : !fileView}"
		v-click-outside="file_unselect_function">

		<div class="cursor-pointer file-control-multi absolute top-0 left-0 mt-4 ml-6 w-6 h-6 z-10 rounded-md border-2 border-indigo-600" :class="{'bg-indigo-600' : mfile_active}" @click="multi_file_select_function(file)"></div>


        <a href="javascript:;" class="block p-3 bg-gray-300 rounded-md relative" :class="{'active' : file_active}"  @click="file_selected_function(file)">
            <div v-if="fileView" class="mb-3">
            	<img :src="file.thumbnail" :alt="file.name" :title="file.name" class="max-w-full mx-auto">
            </div>
            <div class="text-center font-medium">{{ file.name }} - {{ file.media[0].file_name.split('.')[file.media[0].file_name.split('.').length - 1] }}</div>
        </a>


        <div 
			class="fixed top-0 right-0 w-1/5 bg-white h-full z-50 transition duration-500 ease-in-out transform " 
			:class="{'translate-x-0 shadow-md' : file_active, 'translate-x-full' : !file_active}">
			
			<header class="bg-gray-300 p-10">
				<img :src="file.thumbnail" :alt="file.name" :title="file.name" class="max-w-full mx-auto">
			</header>
			<div class="px-10 py-12">
				<div class="mb-8">
					<label for="" class="inline-block font-medium text-gray-700">Alt</label>
					<input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" :value="file.alt">
				</div>
				<div class="mb-8">
					<label for="" class="inline-block font-medium text-gray-700">Title</label>
					<input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" :value="file.title">
				</div>
				<div class="mb-8">
					<label for="" class="inline-block font-medium text-gray-700">Image URL</label>
					<input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" :value="file.original">
				</div>
				<div class="mb-8">
					<button @click="file_active = false">Cancel</button>
					<button class="bg-indigo-500 text-white font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:bg-indigo-600">Save</button>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
	
	import ClickOutside from 'vue-click-outside';

	export default {

		props: [ 'file', 'fileView' ],

        mounted() {

        },

        directives: {
		    ClickOutside
		},

        data() {
        	return {
        		file_active : false,
        		mfile_active : false
        	}
        },

		methods : {
			file_selected_function(file){
				this.file_active = !this.file_active;
			},

			file_unselect_function(){
				// click away function
				this.file_active = false; 
			},

			multi_file_select_function(file){
				this.mfile_active = !this.mfile_active;
				this.$emit("fileLists", file);
			},

			cancel_file_selected(files){
				this.mfile_active = false;
			}

		}
	}
</script>