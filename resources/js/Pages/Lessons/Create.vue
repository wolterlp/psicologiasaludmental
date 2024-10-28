<script>
export default {
    name: 'LessonsCreate'
}
</script>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'; // Importar useForm
import AppLayout from '@/Layouts/AppLayout.vue';
import LessonForm from '@/Components/Lessons/Form.vue';

defineProps({
    categories: {
        type: Object,
        required: true,
    },
    levels: {
        type: Object,
        required: true,
    }
})

// Usar useForm para manejar el estado del formulario
const form = useForm({
    name: '',
    description: '',
    content_uri: '',
    level_id: null,
    pdf_uri: '',
    categories:[],
});

// Estado para las categorías seleccionadas
const categoriesSelected = ref([]);



// Recibir categorías seleccionadas
const onCategories = (selectedCategories) => {
    categoriesSelected.value = selectedCategories; // Actualiza el estado local
   
};

// Manejar la presentación del formulario
const handleSubmit = () => {
    form.categories = categoriesSelected.value; // Asignar categorías seleccionadas al formulario
    form.post(route('lessons.store')); // Enviar el formulario
};

</script>

<template>
    <AppLayout title="Create Lesson">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Create Lesson</h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <LessonForm 
                                :form="form" 
                                :categories="categories" 
                                :levels="levels" 
                                @onCategories="onCategories"
                                @submit="handleSubmit" 
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
