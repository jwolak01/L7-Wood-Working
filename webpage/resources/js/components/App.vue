
<template class="'w-full">
    <!-- component -->
    <div class="w-full flex justify-center">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="w-full">

            <h3 class="text-2xl font-redHatDisplay text-zinc-800 text-center">Cover Image</h3>
            <div class="mx-10">
                <file-pond class="cursor-pointer" name="coverImage" ref="pond"
                    label-idle="Click to choose Cover image, or drag here ..." @init="filepondInitialized"
                    accepted-file-types="image/png, image/jpg, image/jpeg" allow-multiple="false" allow-remove="true"
                    max-files="1" @processfile="handleProcessedCoverFile" @removefile="handleRemoveCoverFile"/>
            </div>

            <div class="mt-8 mb-24">
                <div class="justify-evenly mt-4 mx-8">
                    <div v-for="(image) in this.coverImage">
                        <img class="h-96 w-full object-cover" :src="'/storage/images/coverImage/' + image">
                    </div>
                </div>
            </div>

            <h3 class="text-2xl text-zinc-800 text-center">Additional Image(s)</h3>

            <div class="mx-10">
                <file-pond class="cursor-pointer" name="image" ref="pond"
                    label-idle="Click to choose image(s), or drag here ..." @init="filepondInitialized"
                    accepted-file-types="image/png, image/jpg, image/jpeg" allow-multiple="true"
                    @processfile="handleProcessedFile" @removefile="handleRemoveFile"></file-pond>
            </div>

            <div class="mt-8 mb-24">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 justify-evenly mt-4 mx-8">
                    <div v-for="(image) in this.images">
                        <img class="h-40 md:h-48 w-full object-cover" :src="'/storage/images/' + image">
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
import axios1 from "axios";
import axios2 from "axios";


setOptions({
    server: {
        process: {
            url: "./upload",
        },
        revert: {
            url: "./revert",
            onload: function (x) {
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
            coverImage: [],
            images: []
        }
    },
    mounted() {

        axios1
            .get("/business/product/gallery")
            .then((response) => {
                console.log(response.data)
                this.images = response.data;
            })
            .catch((error) => {
                console.error(error);
            });

        axios2
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
        },

        handleRemoveCoverFile(error, file){
            if (error) {
                console.error(error);
            }

            this.coverImage.pop(file.serverId);
        },
        handleProcessedFile(error, file) {
            if (error) {
                console.error(error);
            }

            // add the file to our images array
            this.images.push(file.serverId);
        },

        handleRemoveFile(error, file){
            if (error) {
                console.error(error);
            }

            this.images.pop(file.serverId);
        },
    }
}
</script>