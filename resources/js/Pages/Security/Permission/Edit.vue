<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    role: Object,
    permissions: Object,
    rolePermissions: Object,
    userPermissions: Object,
});

const form = useForm({
    permissions: props.rolePermissions,
});

const submit = () => {
    form.patch(route('security.permissions.update', props.role.id))
};

</script>

<template>

    <Head title="Permission" />

    <AuthenticatedLayout :userPermissions="props.userPermissions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ role.name }} Permission</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form class="p-4" @submit.prevent="submit">
                    <div class="flex items-center justify-end mb-4">
                        <PrimaryButton class="ml-4">
                            Update
                        </PrimaryButton>
                    </div>
                    <div class="overflow-x-auto relative rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Name
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="permission in permissions" :key="permission.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">
                                        <input type="checkbox" :value="permission" v-model="form.permissions"
                                            :checked="props.rolePermissions.includes(permission)" class="mr-4">
                                        {{ permission }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>