<script>
export default {
    name: 'LessonForm'
}
</script>

<script setup>
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '../TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import CollectionSelector from '../Common/CollectionSelector.vue';
import { ref } from 'vue';

const { form, updating, categories, levels } = defineProps({
    form: {
        type: Object,
        required: true
    },
    updating: {
        type: Boolean,
        required: false,
        default: false
    },
    categories: {
        type: Object,
        required: true
    },
    levels: {
        type: Object,
        required: true
    }
});
/*
const emit = defineEmits(['submit', 'onCategories']);
const categoriesSelected = ref([]);

const onCategories = (selectedCategories) => {
    categoriesSelected.value = selectedCategories;
    emit('onCategories', selectedCategories);
};

const lessonsFormulario = () => {
    emit('submit', {
        ...form,
        categories: categoriesSelected.value
    });
};
*/
const emit = defineEmits(['submit', 'onCategories']);
const categoriesSelected = [];

const onCategories = (selectedCategories) => {
    categoriesSelected.value = selectedCategories;
    emit('onCategories', selectedCategories);
};

const lessonsFormulario = () => {
    emit('submit', {
        ...form,
        categories: categoriesSelected.value
    });
};

</script>

<template>
    <FormSection @submitted="lessonsFormulario">
        <template #title>
            {{ updating ? 'Update Lesson' : 'Create New Lesson' }}
        </template>
        
        <template #description>
            {{ updating ? 'Update The Selected Lesson' : 'Create a New Lesson From Scratch' }}
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="name" value="Name" />
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.name" class="mt-2" />
                
                <br />
                
                <InputLabel for="description" value="Description" />
                <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.description" class="mt-2" />
                
                <br />
                
                <InputLabel for="content_uri" value="Content URI" />
                <TextInput id="content_uri" v-model="form.content_uri" type="text" class="mt-1 block w-full" />
                <InputError :message="$page.props.errors.content_uri" class="mt-2" />
                
                <br />
                
                <SecondaryButton class="mt-2 mr-2" type="button">
                    Upload PDF
                </SecondaryButton>
                <InputError :message="$page.props.errors.pdf_uri" class="mt-2" />
                
                <br />
                
                <div class="w-full mt-6 mr-1">
                    <div class="flex">
                        <div class="w-1/2">
                            <InputLabel for="level_id" value="Level" />
                            <select v-model="form.level_id" id="level_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option v-for="level in levels" :key="level.id" :value="level.id"> {{ level.name }} </option>
                            </select>
                            <InputError :message="$page.props.errors.level_id" class="mt-2" />
                        </div>
                        <div class="w-1/2 ml-1">
                            <InputLabel for="categories" value="Categories" />
                            <CollectionSelector name="categories" id="categories" :collection="categories" @onCategories="onCategories"/>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <PrimaryButton @click="lessonsFormulario">
                {{ updating ? 'Update' : 'Create' }}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
