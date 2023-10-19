<template class="'w-full">
    <!-- component -->
    <div class="w-full flex justify-center">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="w-full">
            <h1 class="text-zinc-800 text-center font-redHatDisplay mb-5 md:mb-8 text2xl md:text-3xl">Add
                Image(s)</h1>

            <div class="mx-10">
                <file-pond class="cursor-pointer" name="image" ref="pond"
                    label-idle="Click to choose more images, or drag here ..." @init="filepondInitialized"
                    accepted-file-types="image/png, image/jpg, image/jpeg" allow-multiple="true" allow-remove="true"
                    @processfile="handleProcessedFile" @removefile="handleRemoveFile" />
            </div>

            <div class="mt-8 mb-24">
                <div class="grid grid-cols-2 gap-2 justify-evenly mt-4 mx-8">
                    <div v-for="(image) in this.images">
                        <img class="h-36 md:h-48 w-full object-cover" :src="'/storage/images/' + image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vueFilePond, { setOptions } from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import axios from "axios";

setOptions({
    server: {
        process: {
            url: "/business/product/upload",
        },
        revert: {
            url: "/business/product/revert",
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
    data() {
        return {
            images: []
        }
    },
    mounted() {

        axios
            .get("/business/product/gallery")
            .then((response) => {
                console.log(response.data)
                this.images = response.data;
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
        handleProcessedFile(error, file) {
            if (error) {
                console.error(error);
            }

            // add the file to our images array
            this.images.push(file.serverId);
        },

        handleRemoveFile(error, file) {
            if (error) {
                console.error(error);
            }

            this.images.pop(file.serverId);
        },
    }
}
</script>