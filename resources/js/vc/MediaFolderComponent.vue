<template>
	<div class="w-1/4 px-3 mb-4">
        <a href="javascript:;" @dblclick="onFolderDblClicked(folder.id)" class="bg-indigo-500 hover:bg-indigo-400 p-3 rounded-md flex items-center">
            <div class="w-10 h-10 text-white">
                <slot name="folder-icon-sub-component"></slot>
            </div>
            <div class="mx-3 font-medium text-white">
                {{ folder.name }}
            </div>
            <div class="ml-auto relative" v-click-outside="option_away">
                <span class="w-6 h-6 text-white block" @click="onOptionClicked">
                    <slot name="folder-option-sub-component"></slot>
                </span>

                <transition>
                    <div v-show="folder_option_visibility" class="bg-white p-3 origin-top-right absolute right-0 mt-2 w-48 rounded-lg border-2 border-indigo-400 shadow-lg text-left  z-50">
                       <a href="javascript:;" class="block px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">Rename</a>
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

        props: [ 'folder' ],

        directives: {
            ClickOutside
        },

        data() {
            return {
                folder_option_visibility :  false,
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

        }
    }
</script>