<script setup>
    const producto = defineModel();

    const handleFileChange = (e) => {
        const input = e.target;
        if (input.files.length > 0 && input.files[0]) {
            producto.value.imagen_data = input.files[0];
        }else{
            producto.value.imagen_data = null;
        }
    }
</script>

<template>
    <div class="grid gap-3">

        <input v-model="producto.nombre" placeholder="Nombre del Producto" />
        <textarea v-model="producto.descripcion" placeholder="Descripción del Producto"  ></textarea>

        <div v-if="producto.imagen" class="justify-center">
            <img :src="'storage/'+producto.imagen" alt="Imagen del Producto" class="w-40 rounded-md" />
        </div>

        <input placeholder="Imagen del Producto" type="file" @change="handleFileChange" />

    </div>

</template>

<style scoped>

</style>
