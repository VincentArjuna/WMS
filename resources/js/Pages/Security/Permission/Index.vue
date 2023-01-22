<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    roles: Object,
    userPermissions: Object
});

</script>

<template>

    <Head title="Permission" />

    <AuthenticatedLayout :userPermissions="userPermissions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Permission</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.flash.message"
                    class="p-4 text-sm text-blue-700 bg-blue-100 dark:bg-blue-400 dark:text-blue-800 rounded-lg"
                    role="alert">
                    <div class="max-w-7xl mx-auto"> {{ $page.props.flash.message }}</div>
                </div>

                <div class="overflow-x-auto relative rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    ID
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="role in roles.data" :key="role.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ role.id }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ role.name }}
                                </td>
                                <td class="py-4 px-6">
                                    <Link :href="route('security.permissions.edit', role.id)"
                                        class="font-medium text-blue-500 hover:text-blue-700 mr-2">Edit Permission
                                    </Link>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>