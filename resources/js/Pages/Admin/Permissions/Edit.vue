<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
  permission: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  name: props.permission?.name,
});
</script>

<template>
  <Head title="Update permission" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link
          :href="route('permissions.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
          >Back</Link
        >
      </div>
      <div class="mt-6 max-w-md mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl p-4">Update permission</h1>
        <form
          @submit.prevent="form.put(route('permissions.update', permission.id))"
        >
          <div>
            <InputLabel for="name" value="Name" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              autofocus
              autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.name" />
          </div>
          <div class="flex items-center mt-4">
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Update
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
