<template>
	<div 
		class="w-1/5 px-2 mb-4 relative file-item overflow-hidden" 
		:class="{'w-1/5' : fileView, 'w-full' : !fileView}"
		v-click-outside="file_unselect_function">

		<div class="cursor-pointer file-control-multi absolute top-0 left-0 mt-4 ml-6 w-6 h-6 z-10 rounded-md border-2 border-indigo-600" :class="{'bg-indigo-600' : mfile_active}" @click="multi_file_select_function(file)"></div>


        <a href="javascript:;" class="block p-3 bg-gray-300 rounded-md relative h-full" :class="{'active' : file_active}"  @click="file_selected_function(file)">
            <div v-if="fileView" class="mb-3">
            	<MediaFileThumb :thumb="file"></MediaFileThumb>
            </div>
            <div class="text-center font-medium text-sm">
            	{{ file.name }}
            </div>
        </a>


        <div 
			class="fixed top-0 right-0 w-1/5 bg-white h-full z-50 transition duration-500 ease-in-out transform " 
			:class="{'translate-x-0 shadow-md' : file_active, 'translate-x-full' : !file_active}">
			
			<header class="bg-gray-300 p-10">
				<MediaFileThumb :thumb="file"></MediaFileThumb>
			</header>
			<div class="px-8 py-12">
				<form @submit.prevent="file_update">
					<div class="mb-8">
						<label for="" class="inline-block font-medium text-gray-700 text-sm">Title</label>
						<input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" v-model="file.title"  required>
					</div>

					<div class="mb-8">
						<label for="" class="inline-block font-medium text-gray-700 text-sm">Alt</label>
						<input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" v-model="file.alt" required>
					</div>
					
					<div class="mb-8">
						<label for="" class="inline-block font-medium text-gray-700 text-sm">Image URL</label>
						<input type="text" class="rounded border border-gray-500 w-full p-2 mt-1 text-sm appearance-none outline-none focus:border-indigo-700" :value="file.original" readonly="">
					</div>
					<div class="mb-8 flex justify-between">
						<button class="capitalize bg-gray-200 font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:bg-gray-300" @click="file_active = false">Cancel</button>
						<button class="bg-indigo-500 text-white font-medium inline-block py-2 px-6 min-w-20 rounded text-sm hover:bg-indigo-600" type="submit">Save</button>
					</div>
				</form>
			</div>
		</div>
    </div>
</template>

<script>
	
	import ClickOutside from 'vue-click-outside';

	export default {

		props: [ 'file', 'fileView', 'fileUpdate'],

        beforeCreate(){
        	this.$options.components.MediaFileThumb = require('./MediaFileThumbnailComponent.vue').default;

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

        mounted() {
        	

        },

		methods : {
			file_selected_function(file){
				if (file.extension === 'jpg' || file.extension === 'png' || file.extension === 'gif') {
					this.file_active = !this.file_active;
				}
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
			},

			file_update(){
				var url = this.fileUpdate;
				url = url.split('/');
				url.pop();
				url = url.toString().replace(/,/g, '/') + '/' + this.file.id;

				var dataform = new FormData();

				dataform.append('title', this.file.title);
				dataform.append('alt', this.file.alt);
				dataform.append("_method", 'PATCH');

				axios.post(url, dataform).then( response => {
					if (response.data.success) {
						this.file_active = !this.file_active;
						new Noty({
						  	type: 'twSuccess',
						  	title: 'Success',
						  	text: 'Successfully created new folder name ' + response.data.folder.name
						}).show();
					}
				});
				
			}

		}
	}
</script>