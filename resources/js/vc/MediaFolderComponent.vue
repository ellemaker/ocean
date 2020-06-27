<template>
	<div class="w-1/4 px-3 mb-4" :id="`folder-container-${folder.id}`">
        <a href="javascript:;" @dblclick="onFolderDblClicked(folder.id)" class="bg-indigo-500 hover:bg-indigo-400 p-3 rounded-md flex items-center">
            <div class="w-10 h-10 text-white">
                <slot name="folder-icon-sub-component"></slot>
            </div>
            <div class="mx-3 font-medium text-white">
                <span v-if="!folder_item_editable">{{ folder.name }}</span>

                <div v-if="folder_item_editable">
                    <form @submit.prevent="onRenameSubmit(folder.id)">
                        <input ref="name" type="text" v-model="folder_name_alt" class="rounded border border-gray-500 w-full p-2 font-bold text-xs appearance-none outline-none focus:border-indigo-200 text-gray-700">
                    </form>
                </div>

            </div>
            <div class="ml-auto relative" v-click-outside="option_away">
                <span class="w-6 h-6 text-white block" @click="onOptionClicked">
                    <slot name="folder-option-sub-component"></slot>
                </span>

                <transition>
                    <div v-show="folder_option_visibility" class="bg-white p-3 origin-top-right absolute right-0 mt-2 w-48 rounded-lg border-2 border-indigo-400 shadow-lg text-left  z-50">
                       <a @click="onRenameClicked" href="javascript:;" class="block px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">Rename</a>
                       <a @click="onDeleteFolder" href="javascript:;" class="block px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">Delete</a>
                    </div>
                </transition>
            </div>
        </a>
        
        <div :id="`folder-pop-${folder.id}`" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full" style="display: none">
             <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">You are about to delete this folder</h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-700">Once you delete a folder, there is no going back. Please be certain.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="confirmDeleteFolder" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">Delete Folder</button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button data-fancybox-close type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">Cancel</button>
                </span>
            </div>
        </div>
    </div>
</template>


<script>

    import ClickOutside from 'vue-click-outside';

    export default {

        props: [ 'folder', 'updateFolder' ],

        directives: {
            ClickOutside
        },

        data() {
            return {
                folder_option_visibility : false,
                folder_item_editable : false,
                folder_name_alt : this.folder.name
            }
        },

        methods : {
            onFolderDblClicked (folderID){
                this.$emit("insideDblClick", folderID);
            },

            onOptionClicked (){
                this.folder_option_visibility = true;
            },

            option_away(){
                // click away function
                this.folder_option_visibility = false; 
            },

            onRenameClicked() {
                this.folder_item_editable = true;
                this.folder_option_visibility = false;

                this.$nextTick(() => {
                    this.$refs.name.focus()
                });
            },

            onRenameSubmit(folderID) {
                var raw_updateLink = this.updateFolder;
                var updateLink = raw_updateLink.substring(0, raw_updateLink.lastIndexOf("/") + 1) + folderID;

                const dataform = new FormData();
                dataform.append("_method", 'PATCH');
                dataform.append('name', this.folder_name_alt);
                dataform.append('parent', this.folder.parent);
                // dataform.append('method', 'PUT');

                axios.post(updateLink, dataform).then( response => {
                    if (response.data.success) {
                        new Noty({
                            type: 'twSuccess',
                            title: 'Success',
                            text: 'Successfully created new folder name ' + response.data.folder.name
                        }).show();
                        this.folder_item_editable = false;
                        this.folder.name = this.folder_name_alt;
                    }

                    
                }).catch(error => {
                   var getError = error.response.data.errors;
                    new Noty({
                        type: 'twDanger',
                        title: 'Error',
                        text: getError.name
                    }).show();
                    this.folder_item_editable = false;
                    this.folder_name_alt = this.folder.name;
                });


            },


            onDeleteFolder(){

                this.folder_option_visibility = false;

                $.fancybox.open({
                    src  : '#folder-pop-'+ this.folder.id,
                    type : 'inline',
                    parentEl: '#folder-container-'+this.folder.id,
                    opts : {
                        afterShow : function( instance, current ) {
                            console.info( 'done!' );
                        }
                    }
                });
            },

            confirmDeleteFolder(){
               this.$emit("deleteFolder", this.folder);
            }

        }
    }
</script>