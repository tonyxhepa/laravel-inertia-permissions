<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["permissions"]);

const form = useForm({})

const showConfirmDeletePermissionModal = ref(false)

const confirmDeletePermission = () => {
      showConfirmDeletePermissionModal.value = true;
}

const closeModal = () => {
  showConfirmDeletePermissionModal.value = false;
}

const deletePermission = (id) => {
   form.delete(route('permissions.destroy', id), {
    onSuccess: () => closeModal()
   });
}
</script>

<template>
  <Head title="Permissions" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <h1>Permission Index Page</h1>
        <Link
          :href="route('permissions.create')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
          >New Permission</Link
        >
      </div>
      <div class="mt-6">
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow
              v-for="permission in permissions"
              :key="permission.id"
              class="border-b"
            >
              <TableDataCell>{{ permission.id }}</TableDataCell>
              <TableDataCell>{{ permission.name }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <Link
                  :href="route('permissions.edit', permission.id)"
                  class="text-green-400 hover:text-green-600"
                  >Edit</Link
                >
              <button @click="confirmDeletePermission" class="text-red-400 hover:text-red-600">Delete</button>
               <Modal :show="showConfirmDeletePermissionModal" @close="closeModal">
                 <div class="p-6">
                  <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this Permission?</h2>
                  <div class="mt-6 flex space-x-4">
                    <DangerButton @click="deletePermission(permission.id)">Delete</DangerButton>
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
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
