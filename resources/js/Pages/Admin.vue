<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({
  data: {
    type: Array,
    required: true
  }
});

</script>


<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.auth.user.role }} Dashboard         
            </h2>
        </template>
        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class=" overflow-hidden shadow-xl sm:rounded-lg p-4 bg-gray-200 p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Project Card -->
            <div class=" p-4 shadow-md rounded-md bg-blue-500">
                <h3 class="text-lg font-semibold mb-2">Total Companies : {{ data.companyCount }}</h3>
                
            </div>
            <!-- Project Card -->
            <div class=" p-4 shadow-md rounded-md bg-green-500">
                <h3 class="text-lg font-semibold mb-2">Total Employees : {{ data.employeeCount }}</h3>
            </div>

            <div class=" p-4 shadow-md rounded-md bg-indigo-500">
                <h3 class="text-lg font-semibold mb-2">Total Wallets : {{ data.walletCount }}</h3>
            </div>

            <div class=" p-4 shadow-md rounded-md bg-indigo-500">
                <h1 class="text-lg font-semibold mb-2 text-center ">Transactions</h1>
                <h3 class="text-lg font-semibold mb-2">Total Daily Transactions : {{ data.dailyTransactionsCount }}</h3>
                <h3 class="text-lg font-semibold mb-2">Total Weekly Transactions : {{ data.weeklyTransactionsCount }}</h3>
                <h3 class="text-lg font-semibold mb-2">Total Monthly Transactions : {{ data.monthlyTransactionsCount }}</h3>
                <h3 class="text-lg font-semibold mb-2">Total Yearly Transactions : {{ data.yearlyTransactionsCount }}</h3>
            </div>
            <!-- More projects can be added -->
        </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>