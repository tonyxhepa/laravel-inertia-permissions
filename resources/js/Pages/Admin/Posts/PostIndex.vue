<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["posts"]);
const form = useForm({});

const showConfirmDeletePostModal = ref(false);
const { hasPermission } = usePermission();

const confirmDeletePost = () => {
    showConfirmDeletePostModal.value = true;
};

const closeModal = () => {
    showConfirmDeletePostModal.value = false;
};

const deletePost = (id) => {
    form.delete(route("posts.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Posts Index" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Posts Index Page</h1>
                <template v-if="hasPermission('create post')">
                    <Link
                        :href="route('posts.create')"
                        class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                        >New Post</Link
                    >
                </template>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>Title</TableHeaderCell>
                            <TableHeaderCell>Action</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow
                            v-for="post in posts"
                            :key="post.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ post.id }}</TableDataCell>
                            <TableDataCell>{{ post.title }}</TableDataCell>
                            <TableDataCell class="space-x-4">
                                <template v-if="hasPermission('update post')">
                                    <Link
                                        :href="route('posts.edit', post.id)"
                                        class="text-green-400 hover:text-green-600"
                                        >Edit</Link
                                    >
                                </template>
                                <template v-if="hasPermission('delete post')">
                                    <button
                                        @click="confirmDeletePost"
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Delete
                                    </button>
                                </template>

                                <Modal
                                    :show="showConfirmDeletePostModal"
                                    @close="closeModal"
                                >
                                    <div class="p-6">
                                        <h2
                                            class="text-lg font-semibold text-slate-800"
                                        >
                                            Are you sure to delete this Role?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton
                                                @click="deletePost(post.id)"
                                                >Delete</DangerButton
                                            >
                                            <SecondaryButton @click="closeModal"
                                                >Cancel</SecondaryButton
                                            >
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
