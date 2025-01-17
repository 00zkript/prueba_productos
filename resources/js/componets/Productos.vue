<template>
    <div class="flex gap-4">


        <div class="py-4 shadow-md p-4 bg-white rounded-md" v-if="!productoEdit.id">
            <h1 class="text-2xl p-3 text-center">Nuevo Productos</h1>
            <form @submit.prevent="createProducto" class="grid gap-3">
                <FormProducto v-model="productoNew"/>
                <button class="px-4 py-3 bg-violet-600 text-slate-50 rounded-md" type="submit">Crear Producto</button>
            </form>
        </div>

        <div class="py-4 shadow-md p-4 bg-white rounded-md" v-if="productoEdit.id" >
            <h1 class="text-2xl p-3 text-center">Editar Productos #{{ productoEdit.id }}</h1>
            <form @submit.prevent="updateProducto" class="grid gap-3">
                <FormProducto v-model="productoEdit"/>
                <button class="px-4 py-3 bg-violet-600 text-slate-50 rounded-md" type="submit">Modificar Producto</button>
            </form>
        </div>


        <div class="py-4 w-full shadow-md p-4 bg-white rounded-md">
            <h1 class="text-2xl p-3 text-center">Productos</h1>
            <table class="table w-full">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(producto,idx) in productos" :key="idx">
                        <td>#{{ idx+1 }}</td>
                        <td>{{ producto.id }}</td>
                        <td>{{ producto.nombre }}</td>
                        <td>{{ producto.descripcion }}</td>
                        <td class="text-center"><img :src="'storage/'+producto.imagen" alt="Imagen del Producto" class="w-20 rounded-md"></td>
                        <td class=" flex gap-2 justify-center">
                            <button class="px-2 py-1 rounded-md bg-violet-600 text-slate-50" @click="editProducto(producto)">Editar</button>
                            <button class="px-2 py-1 rounded-md bg-violet-600 text-slate-50" @click="eliminarProducto(producto.id)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import FormProducto from './partials/FormProducto.vue'

const productos = ref([]);

const productoModel = {
    id: '',
    nombre: '',
    descripcion: '',
    imagen: '',
    imagen_data: ''
}

const productoNew = ref({...productoModel});
const productoEdit = ref({...productoModel})



const fetchProductos = async () => {
    const response = await axios('/api/productos');
    productos.value = response.data;
};

const createProducto = async () => {

    const form =  new FormData();
    form.append('nombre', productoNew.value.nombre);
    form.append('descripcion', productoNew.value.descripcion);
    form.append('imagen', productoNew.value.imagen_data ?? '');

    const response = await axios.post('/api/productos', form);

    productos.value.push(response.data);
    productoNew.value = {...productoModel};


    const inputFile = document.querySelector('input[type=file');
    if (inputFile) {
        inputFile.value = '';
    }
};

const editProducto = async (producto) => {
    productoEdit.value = {...producto};
};

const updateProducto = async () => {

    const form =  new FormData();
    form.append('_method', 'put');
    form.append('nombre', productoEdit.value.nombre);
    form.append('descripcion', productoEdit.value.descripcion);
    form.append('imagen', productoEdit.value.imagen_data ?? '');

    const response = await axios.post('/api/productos/'+productoEdit.value.id, form);
    productoEdit.value = {...productoModel};
    await fetchProductos();
};

const deleteProducto = async (id) => {
    await axios.delete(`/api/productos/${id}`);
    productos.value = productos.value.filter(producto => producto.id !== id);
};

onMounted(fetchProductos);
</script>
