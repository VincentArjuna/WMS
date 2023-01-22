<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from "@inertiajs/vue3";


const props = defineProps({
    role: Object,
    userPermissions: Object
});

const form = useForm({
    id: props.role?.id,
    name: props.role?.name,
});

const submit = () => {
    form.visit(route('security.roles.update', form.id))
};

</script>

<template>

    <Head title="Edit Role" />

    <AuthenticatedLayout :userPermissions="props.userPermissions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Role
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">

                <form class="p-4" @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                            autocomplete="name" />
                        <InputError class="mt-2" :message="$page.props.errors.name" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
