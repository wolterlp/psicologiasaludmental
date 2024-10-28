<script setup>
import { ref } from 'vue';

defineProps({
    collection: {
        type: Array,
        required: true
    }
});

const currentSelection = ref(null); // Cambiado a null para que sea más seguro
const selection = ref([]);
const emit = defineEmits(['onCategories']); // Arreglo con el nombre del evento

const handleAddToSelection = () => {
    if (!currentSelection.value) return; // Verifica si hay selección

    const alreadyExist = selection.value.some(item => item.id === currentSelection.value.id);
    if (alreadyExist) {
        return; // Si ya existe, no hacer nada
    }

    selection.value.push(currentSelection.value);
    emit('onCategories', selection.value); // Emitir evento con la selección actual
};

const handleRemoveSelection = (index) => {
    selection.value = selection.value.filter(item => item.id !== index);
    emit('onCategories', selection.value); // Emitir evento después de la eliminación
};
</script>

<template>
    <div class="w-full">
        <div class="flex">
            <select v-model="currentSelection" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option v-for="(item, index) in collection" :key="index" :value="item">{{ item?.name }}</option>
            </select>
            <button @click="handleAddToSelection" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded ml-1">Add</button>
        </div>
        <div class="mt-1">
            <ul>
                <li v-for="(item, index) in selection" :key="index" class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded ml-1 mb-1 cursor-pointer" @click="handleRemoveSelection(item.id)">
                    {{ item.name }}
                    <span class="float-right cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 24 24" fill="white">
                            <path d="M 10 2 L 9 3 L 4 3 L 4 5 L 5 5 L 5 20 C 5 20.522222 5.1913289 21.05461 5.5683594 21.431641 C 5.9453899 21.808671 6.4777778 22 7 22 L 17 22 C 17.522222 22 18.05461 21.808671 18.431641 21.431641 C 18.808671 21.05461 19 20.522222 19 20 L 19 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 7 5 L 17 5 L 17 20 L 7 20 L 7 5 z M 9 7 L 9 18 L 11 18 L 11 7 L 9 7 z M 13 7 L 13 18 L 15 18 L 15 7 L 13 7 z"></path>
                        </svg>
                    </span>  
                </li>
            </ul>
        </div>
    </div>
</template>
