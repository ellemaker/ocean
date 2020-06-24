<style>
	@import '../../../node_modules/dropzone/dist/min/dropzone.min.css';

    .dropzone{border: 4px dashed #e2e8f0; min-height: auto}
    .dropzone .dz-message .dz-button{ font-weight: bold; color: #a9aeb8; text-transform: uppercase; }
    .folder-crumbs li{position: relative;}
    .folder-crumbs li + li{padding-left: 15px;}
    .folder-crumbs li + li:before{content: '»'; position: absolute; top: 0; left: 5px; line-height: 19px;}
    .file-lists .active:before{
    	content: '';
    	position: absolute;
    	top:0;
    	left:0;
    	width: 100%;
    	height: 100%;
    	border: 4px solid #667eea;
		border-radius: 0.375rem;
    }
</style>
<template>
	<div>
		<div class="container mx-auto pt-10 mb-5">
			<div id="dropzone" class="dropzone shadow rounded bg-white"></div>
	    </div>

	    <div 
	    	class="fixed w-1/5 h-full bg-white top-0 right-0 z-50 transition duration-500 ease-in-out transform px-5 pt-10 overflow-y-scroll"
	    	:class="{'translate-x-0 shadow-md' : file_lists_selected.length > 0, 'translate-x-full' : file_lists_selected.length == 0}">
	    	<h3 class="font-medium text-lg mb-5">Selected Files</h3>
	    	<ul>
	    		<li v-for="file in file_lists_selected" :key="file.id" class="flex flex-wrap items-center rounded border-2 border-indigo-300 py-3 px-2 mb-5">
	    			<div><img :src="file.thumbnail" :alt="file.name" :title="file.name" class="w-10"></div>
	    			<div class="ml-3 font-medium text-sm">{{ file.name }}</div>
	    			
	    		</li>
	    	</ul>
	    	<div>
	    		<button type="button" @click="cancel_file_lists_selected">cancel</button>
	    		<button type="button" @click="media_files_destroy_function">delete all files</button>
	    	</div>
	    	
	    </div>

	    <div class="container mx-auto">
	        <div class="bg-white shadow-md rounded-md p-5">
	            <header class="flex items-center">
	                <nav class="folder-crumbs">
	                     <ul class="text-sm flex items-center font-medium">
	                        <li class="relative" v-for="folder in folder_breadcrumbs">
	                        	<a class="hover:underline" href="javascript:;" @click="get_media_function(folder.id)">{{ folder.name == 'default' ? 'root' : folder.name }}</a>
	                        </li>
	                    </ul>
	                </nav>
	                <div class="ml-auto relative flex align-items-center" >
	                	<div>
	                		<button @click="media_view_function" class="text-indigo-600 focus:border-indigo-700 focus:outline-none appearance-none outline border-0">
		                		<span class="block w-6 h-6" v-if="media.current_view">
		                			<slot name="view-list-icon"></slot>
		                		</span>
		                		<span class="block w-6 h-6" v-if="!media.current_view">
		                			<slot name="view-grid-icon"></slot>
		                		</span>
		                	</button>
	                	</div>
	                	<div v-click-outside="hide_folder_form_away" class="ml-3">

		                	<button @click="create_folder_form.form_visibility = true" class="text-indigo-600 focus:border-indigo-700 focus:outline-none appearance-none outline border-0">
		                        <span class="block w-6 h-6">
		                        	<slot name="folder-add-icon"></slot>
		                        </span>
		                    </button>
		                    <transition>
			                    <div v-show="create_folder_form.form_visibility" class="bg-white p-3 origin-top-right absolute right-0 mt-2 w-48 rounded-lg border-2 border-indigo-400 shadow-lg text-left">
			                        <form @submit.prevent="create_folder_form_submit" class="form-content">
			                        	<label for="FolderName" class="font-medium text-sm">Folder Name</label>
			                            <input v-model="create_folder_form.form_fields.name" type="text" name="FolderName" id="FolderName" class="rounded border border-gray-500 w-full p-2 mt-1 text-xs appearance-none outline-none focus:border-indigo-200" required>

			                        </form>
			                    </div>
		                    </transition>
	                	</div>
	                    
	                </div>
	            </header>

	            <div>
	                <div class="folder-lists flex flex-wrap -mx-3 my-5">
	                    <MediaFolder v-for="folder in media.folders" :folder="folder" :updateFolder="media_rename_folder" :key="folder.id" @insideDblClick="on_folder_dblclicked">
	                    	<template #folder-icon-sub-component>
	                    		<slot name="folder-icon"></slot>
	                    	</template>
	                    	<template #folder-option-sub-component>
	                    		<slot name="folder-icon-options"></slot>
	                    	</template>
	                    </MediaFolder>
	                </div>

	                <div class="file-lists flex flex-wrap items-baseline -mx-2">
	                    <MediaFile v-for="file in media.files" :key="file.id" :file="file" :fileView="media.current_view" @fileLists="file_lists_selected_function" ref="myMediaFile">	                    	
	                    </MediaFile>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	
</template>


<script>
	import Dropzone from 'dropzone';

	import MediaFile from './MediaFileComponent';
	import MediaFolder from './MediaFolderComponent';

	import ClickOutside from 'vue-click-outside';

	

	export default {

	 	props: [
            'media_dz_upload_url',
            'media_contents',
            'media_remove_selected_files',
            'media_store_folder',
            'media_rename_folder'
        ],

        components : {
            MediaFile,
            MediaFolder
        },

        directives: {
		    ClickOutside
		},

        

	 	mounted() {
	 		Dropzone.autoDiscover = false;
	 		var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            var dz = new Dropzone("#dropzone", {
            	paramName: "file",
                url : this.media_dz_upload_url,
                method : 'post'
            });

            dz.on("complete", function(file) {
                dz.removeFile(file);
            });

            dz.on("sending", function(file, xhr, formData) {
            	console.log(this.media.current_directory.slug);
                formData.append("_token", CSRF_TOKEN);
                formData.append("collection", this.media.current_directory.slug);
                formData.append("category", this.media.current_directory.id);
            }.bind(this)); 

            dz.on("success", function(){
                this.get_media_function(this.media.current_directory.id);
            }.bind(this));

            this.get_media_function(this.media.current_directory.id);
	 	},

	 	data() {
	 		return {
	 			media : {
	 				current_directory : {
	 					id : 1,
	 					slug : 'default'
	 				},
	 				folders : [],
	 				files : [],
	 				current_view : true
	 			},
	 			
	 			create_folder_form : {
	 				form_visibility : false,
	 				form_fields : {
		 				name : ''
		 			},
	 			},

	 			folder_breadcrumbs : [],
	 			

	 			file_lists_selected : [],

	 		}
	 	},

	 	methods : {
	 		get_media_function(cd){

	 			this.media.current_directory.id = cd;

	 			const mc = this.media_contents + '/' + cd;

                axios.get(mc).then( response => {

                	this.media.folders = response.data.folderLists;
                	this.media.files = response.data.folderFiles;

                	// console.log(response.data.folderCurrent);

                	const fc = response.data.folderCurrent.slice().reverse();
                    this.directory_breadcrumbs_function(fc);

                    this.media.current_directory.slug = fc[fc.length - 1].slug;
                    this.media.current_directory.id = fc[fc.length - 1].id;

                });
	 		},

	 		directory_breadcrumbs_function(arr){
                this.folder_breadcrumbs.splice(0, this.folder_breadcrumbs.length);
                this.folder_breadcrumbs.push(... arr);
            },

	 		file_lists_selected_function(file){
	 			var init = 1;
	 			if (this.file_lists_selected.length == 0) {
	 				this.file_lists_selected.push(file);
	 			}else{
	 				this.file_lists_selected.forEach((item, idx) => {
		 				if (item.id == file.id) {
		 					this.file_lists_selected.splice(idx, 1);
		 					init = 0;
		 				}
		 			});

		 			if (init == 1) {
		 				this.file_lists_selected.push(file);
		 			}
	 			}
	 		},

	 		cancel_file_lists_selected(){

	 			this.media.files.forEach((itm, idx) => {
	 				this.file_lists_selected.forEach((s_itm, s_idx) => {
	 					if (itm.id == s_itm.id) {
	 						this.$refs.myMediaFile[idx].cancel_file_selected();
	 					}
	 				});
	 			});
	 			this.file_lists_selected = [];

	 		},

	 		media_view_function(){
	 			this.media.current_view = !this.media.current_view
	 		},



	 		media_files_destroy_function(){
	 			const dataform = new FormData();
	 			const fileList = JSON.stringify(this.file_lists_selected);

                dataform.append('files', fileList);

	 			axios.post(this.media_remove_selected_files, dataform).then( response => {

                   	if (response.data.success) {
                   		this.get_media_function(this.media.current_directory.id);
                   		this.file_lists_selected = [];
                   	}
                });
	 		},

	 		hide_folder_form_away(){
				this.create_folder_form.form_visibility = false;
			},

			create_folder_form_submit(){
				const dataform = new FormData();



				dataform.append('name', this.create_folder_form.form_fields.name)
				dataform.append('parent', this.media.current_directory.id)

				axios.post(this.media_store_folder, dataform).then( response => {
                   	if (response.data.success) {
                   		this.create_folder_form.form_fields.name = "";
                   		this.create_folder_form.form_visibility = false;

                   		this.media.folders.push(response.data.folder)

                   		new Noty({
						  	type: 'twSuccess',
						  	title: 'Success',
						  	text: 'Successfully created new folder name ' + response.data.folder.name
						}).show();
                   	}

                   	console.log(response)
                }).catch(error => {
				    var getError = error.response.data.errors;
				    new Noty({
					  	type: 'twDanger',
					  	title: 'Error',
					  	text: getError.name
					}).show();
				});
			},

			on_folder_dblclicked (folderID){
				this.get_media_function(folderID);

			}
	 	}
	 }



</script>