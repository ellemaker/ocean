<template>
	<div class="w-1/4 px-3 mb-4">
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
                       <a href="javascript:;" class="block px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">Delete</a>
                    </div>
                </transition>
            </div>
        </a>
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


            }

        }
    }
</script>