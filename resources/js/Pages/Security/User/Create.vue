<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    roles: Array,
    userPermissions: Object
});

const form = useForm({
    name: '',
    email: null,
    password: '',
    role_name: '',
});

const submit = () => {
    form.post(route('security.users.store'));
};
</script>

<template>

    <Head title="New User" />

    <AuthenticatedLayout :userPermissions="userPermissions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New User
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="p-4" @submit.prevent="submit">
                    <div>
                        <InputLabel for="role_name" value="Role" />
                        <select v-model="form.role_name" id="role_name" name="role_name"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option v-for="role in roles" :key="role.id" :value="role.name">
                                {{ role.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.role_name" />
                    </div>

                    <div>
                        <InputLabel for="name" value="Name" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                            autocomplete="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-2">
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                            autocomplete="email" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="password" value="Password" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            autofocus autocomplete="password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Store
                        </PrimaryButton>
                    </div>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
