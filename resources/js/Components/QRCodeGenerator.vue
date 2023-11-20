<template>
    <qrcode-vue :value="qrData" :size="250" :errorCorrectionLevel="'M'"></qrcode-vue>
  </template>
  
  <script setup>
  import QRCodeVue from 'qrcode.vue';
  import { defineProps } from 'vue';
  
  // Define props
  const props = defineProps({
    qrData: {
      type: String,
      required: true,
    },
  });
  </script>