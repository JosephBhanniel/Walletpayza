<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

// Define props using defineProps
const props = defineProps({
  summary_data: {
    type: Array,
    required: true
  }
});


</script>


<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.auth.user.role }} Wallet
               
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div>
                        <h1 class="text-center text-2xl">Your Wallet Metrics</h1>
                       <div class="md:flex justify-center">
                    
                        <p class="m-2 p-2 bg-indigo-300 rounded shadow">Total Wallet Amount: {{ summary_data.total_amount }}</p>
                        <p class="m-2 p-2 bg-indigo-300 rounded shadow">Total Number of Transactions: {{ summary_data.transaction_count }}</p>
                       </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>