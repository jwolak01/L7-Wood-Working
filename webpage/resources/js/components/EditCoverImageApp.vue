
<template class="w-full">
    <!-- component -->
    <div class="w-full flex justify-center border-b-2 border-gray-400 pb-16">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="w-full mt-4 md:mt-0">
            <!-- Uses a File Pond component to select a new Cover Image for the Product being examined -->
            <transition name="fade">
                <div v-if="!show">
                    <button @click="this.switchShow" type="button"
                        class="w-full rounded-md bg-[#228280] lg:bg-cyan-900 hover:bg-[#228280] hover:shadow-md transition ease-out duration-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Change Cover Image
                    </button>
                </div>
            </transition>

            <transition name="fade">
                <div v-if="show">
                    <div>
                        <file-pond class="cursor-pointer" name="coverImage" ref="pond"
                            label-idle="Click to choose Cover image, or drag here ..." @init="filepondInitialized"
                            accepted-file-types="image/png, image/jpg, image/jpeg" allow-multiple="false"
                            allow-remove="true" max-files="1" @processfile="handleProcessedCoverFile"
                            @removefile="handleRemoveCoverFile" />
                    </div>

                    <div class="mt-8 mb-5">
                        <div class="justify-evenly mt-4 mx-8">
                            <div v-for="(image) in this.coverImage">
                                <img class="h-96 w-full object-cover" :src="'/storage/images/coverImage/' + image">
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <transition name="fade">
                <button v-if="showCancelButton" type="button" @click="this.switchShow"
                    class="w-full rounded-md bg-[#f41f26bb] hover:shadow-md transition ease-out duration-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Cancel
                </button>
            </transition>

            <transition name="fade">
                <div v-if="this.showSaveNotification">
                    <h5 class="font-zinc-800 text-center text-red-800">Cover Image will be replaced once
                        changes are Confirmed</h5>
                </div>
            </transition>
        </div>
    </div>
    <div>
    </div>
</template>

<script>
import { ref } from 'vue';
import vueFilePond, { setOptions } from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import axios from "axios";


setOptions({
    server: {
        process: {
            url: "./upload",
        },
        revert: {
            url: "./revert",
            onload: function (x) {

                // X - empty, why????
                console.log(x)

            },
        },
        headers: {
            "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf_token"]')
                .content,
        }
    }
});

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
    components: {
        FilePond
    },
    setup() {
        const show = ref(false)
        const showCancelButton = ref(false)
        const showSaveNotification = ref(false)

        return { show, showSaveNotification, showCancelButton }
    },
    data() {
        return {
            coverImage: [],
        }
    },
    mounted() {
        axios
            .get("/business/product/gallery/coverImage")
            .then((response) => {
                this.coverImage = response.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },

    methods: {
        filepondInitialized() {
            console.log('Filepond is ready!');
            console.log('Filepond object:', this.$refs.pond);
        },
        handleProcessedCoverFile(error, file) {
            if (error) {
                console.error(error);
            }

            // add the file to our images array
            this.coverImage.push(file.serverId);

            this.showSaveNotification = !this.showSaveNotification;
            this.showCancelButton = !this.showCancelButton;
        },
        handleRemoveCoverFile(error, file) {
            if (error) {
                console.error(error);
            }

            this.coverImage.pop(file.serverId);
            this.showCancelButton = !this.showCancelButton;
            this.showSaveNotification = !this.showSaveNotification;
        },
        switchShow() {
            this.show = !this.show
            this.showCancelButton = !this.showCancelButton
        },
    }
}
</script>

<style>
.fade-enter-from {
    opacity: 0;
}

.fade-enter-to {
    opacity: 1;
}

.fade-enter-active {
    transition: all 2s ease;
}

.fade-leave-from {
    opacity: 1;
}

.fade-leave-to {
    opacity: 0;
}
</style>