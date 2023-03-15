<script setup>
</script>
<template>
  <div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <slot name="header"></slot>
      </thead>
      <tbody>
        <slot></slot>
      </tbody>
    </table>
  </div>
</template>