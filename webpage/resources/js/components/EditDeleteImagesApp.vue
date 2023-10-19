<template>

    <h2 class="font-bold font-zinc-800 text-center font-playfairDisplay mb-5">Edit Existing Image(s)</h2>

    <h5>{{ test }}</h5>
        
    
    <!-- <div v-for="productPath in productPaths" class="grid grid-cols-2 gap-2 justify-evenly mr-2 mt-4 mb-5 md:mt-0 mr-5">
                <form id="image-form" action="/images/removeImage" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="checkbox" name="checkbox[]" value="{{ productPath }}"
                        class="absolute mt-2 ml-2 scale-125" form="image-form" />
                    <img src="{{ productPath }}" class="h-36 md:h-48 w-full object-cover" form="image-form" />
                    <input type="hidden" name="id" value="{{ $product->id }}" form="image-form" />
                </form>
            </div> -->

    <button name="imgPath" id="deleteButton" form="image-form" class="absolute w-10 -mt-20 -ml-2"><img
            class="flex-justify-center hover:scale-90 transition ease-out duration-500"
            src="/images/trash.png"></button>
    
    <button type="button" @click="this.created()">hello</button>
</template>

<script>

export default {
    props: ['productPaths'],
    data() {
        return{
            test: "This is a test",
            imagePaths: this.productPaths
        } 
    },
    methods: {
        created() {
    // props are exposed on `this`
    console.log(this.productPaths)
  }
  },
  
}

</script>