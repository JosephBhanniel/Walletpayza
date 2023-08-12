<template>
    <AppLayout title="Dashboard">
        
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.auth.user.role }} Wallet 
                <div class="flex justify-end mt-4 space-x-4">
                            <button @click="toggleDepositForm" class="px-4 py-2 bg-green-500 text-white rounded">Deposit</button>
                            <button @click="toggleSendForm" class="px-4 py-2 bg-blue-500 text-white rounded">Send</button>
                        </div>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div>
                        <h1 class="text-center text-2xl">Your Wallet Metrics</h1>
                        <div class="md:flex justify-center">
                            <p class="m-2 p-2 bg-indigo-300 rounded shadow">Total Number of Employees: {{ summary_data.employee_count }}</p>
                            <p class="m-2 p-2 bg-indigo-300 rounded shadow">Total Wallet Amount: {{ summary_data.total_amount }}</p>
                            <p class="m-2 p-2 bg-indigo-300 rounded shadow">Total Number of Transactions: {{ summary_data.transaction_count }}</p>
                        </div>
                        
                        
                        
                        <div v-if="showDepositForm" class="mt-4">
                        <h2 class="text-lg font-semibold">Deposit Money</h2>
                        <form @submit.prevent="submitDepositForm">
                            <div class="mt-2">
                                <InputLabel for="Wallet_id" value="Account Number" />
                                <NumberInput
                                    id="Wallet_id"
                                    v-model="depositForm.Wallet_id"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="number"
                                />
                                <InputError class="mt-2" :message="depositForm.errors.Wallet_id" />
                            </div>
                            <div class="mt-2">
                                <InputLabel for="depositAmount" value="Deposit Amount" />
                                <NumberInput
                                    id="depositAmount"
                                    v-model="depositForm.depositAmount"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="number"
                                />
                                <InputError class="mt-2" :message="depositForm.errors.depositAmount" />
                            </div>
                          
                            <div class="mt-2">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Deposit</button>
                            </div>
                        </form>
                    </div>

                    <div v-if="showSendForm" class="mt-4">
                        <h2 class="text-lg font-semibold">Send Money</h2>
                        <form @submit.prevent="submitSendForm">
                            <div class="mt-2">
                                <InputLabel for="recipient_id" value="Recipient Account" />
                                <NumberInput
                                    id="recipient_id"
                                    v-model="sendForm.recipient_id"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="number"
                                />
                                <InputError class="mt-2" :message="sendForm.errors.recipient_id" />
                            </div>
                            <div class="mt-2">
                                <InputLabel for="amount" value="Amount" />
                                <NumberInput
                                    id="amount"
                                    v-model="sendForm.amount"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="number"
                                />
                                <InputError class="mt-2" :message="sendForm.errors.amount" />
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Send</button>
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import NumberInput from '@/Components/NumberInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    summary_data: {
        type: [Array, Object],  // Accepts either an Array or an Object
        required: true
    }
});


const showDepositForm = ref(false);
const showSendForm = ref(false);

// Form data
const depositForm = useForm({
    depositAmount: 0,
    Wallet_id: 0,
});

const sendForm = useForm({
    recipient_id: 0,
    amount: 0,
});

// Methods to toggle the forms
const toggleDepositForm = () => {
    showDepositForm.value = !showDepositForm.value;
    showSendForm.value = false; // Hide the send form
};

const toggleSendForm = () => {
    showSendForm.value = !showSendForm.value;
    showDepositForm.value = false; // Hide the deposit form
};

// Methods to handle deposit and send form submissions
const submitDepositForm = () => {
    depositForm.put(route('deposit'), {
        onSuccess: () => {
            alert("The deposit of "+depositAmount.value+" has been successful!");
            depositForm.reset('Wallet_id', 'depositAmount');
        },
    });
};

const submitSendForm = () => {
    sendForm.put(route('send'), {
        onSuccess: () => {
            alert("The transfer of "+amount.value+" has been successful!");
            depositForm.reset('recipient_id', 'amount');
        },
    });
};
</script>
