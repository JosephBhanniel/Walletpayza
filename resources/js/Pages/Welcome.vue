
<template>
    <div>
        <div v-if="canLogin" class="bg-gradient-to-r from-green-500 to-gray-900">
             <div class="mx-10 py-2 flex justify-between  ">
                <img class="rounded-full p-1" src="@/../images/logo.jpg" alt="logo" height="60" width="60">
            <div class="py-3">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-white  focus:outline hover:bg-blue-600 p-2 rounded focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4  font-semibold  text-white hover:bg-blue-600 p-2 rounded focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
             </div>
            </div>
        </div>
      <!-- Welcome Section -->
    <section class="py-10 bg-gradient-to-r from-green-500 to-gray-900">
      <div class="container mx-auto text-center p-5 my-2">
        <h1 class="text-white text-4xl font-bold mb-4">Welcome to WalletPayza</h1>
        <p class="text-white mb-8 ">
  Your financial companion for businesses and employees. Manage your money hassle-free, and enjoy secure digital wallets.<br> <em>Simple, seamless, and empowering</em>.
</p>
 <Link :href="route('login')">
        <button class="px-6 py-3 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Get Started</button>
      </Link>
      </div>
    </section>
  
      <!-- Features Cards -->
      <section class="py-16 bg-gray-100 text-center">
    <div class="container mx-auto grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Money Transfer Service (Companies)</h2>
            <p>
                Our platform provides a seamless Money Transfer Service for companies. Companies can securely transfer money from their main wallet to their employees' wallet. By simply providing the recipient's email, wallet ID and the desired amount, companies can initiate transactions quickly and efficiently.
            </p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Money Receipt Service (Employees)</h2>
            <p>
                As part of our platform's offerings, we provide a reliable Money Receipt Service for employees. Employees can receive money from other users or companies with ease. Upon receiving money, the employee's wallet balance is promptly updated, and they receive notifications or alerts for incoming transactions.
            </p>
        </div>
    </div>
</section>


  
      <!-- Footer -->
      <footer class="py-6 bg-black text-white text-center">
        <!--contact details, social media links, etc. here -->
        <p class="mb-2">Contact: info@WalletPayza.com</p>
        <div class="flex justify-center space-x-4">
          <a href="https://twitter.com/twitter" target="_blank" class="text-blue-500 hover:text-blue-300">Twitter</a>
          <a href="https://facebook.com/facebook" target="_blank" class="text-blue-500 hover:text-blue-300">Facebook</a>
       
        </div>
      </footer>
    </div>
  </template>
  
  <script setup>
  import { Head, Link } from '@inertiajs/vue3';
  
  defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  });
  </script>
 