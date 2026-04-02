<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        LOGS
    </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-xl p-6 space-y-6">

            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2">
                Logs Dashboard
            </h2>

            <!-- Default Log -->
            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">Default Log</span>
                <a href="/test-log" class="px-4 py-2 bg-white text-black rounded-lg border-black border-2 transition">
                    View
                </a>
            </div>
            <!-- All Logs -->
            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">All Logs</span>
                <a href="/test-all-logs" class="px-4 py-2 bg-white text-black rounded-lg border-black border-2 transition">
                    View
                </a>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">Login Logs</span>
                <a href="/test-login-log" class="px-4 py-2 bg-white text-black rounded-lg border-black border-2 transition">
                    View
                </a>
            </div>

            <!-- Payment Logs -->
            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">Payment Logs</span>
                <a href="/test-payment-log" class="px-4 py-2 bg-white text-black rounded-lg border-black border-2 transition">
                    View
                </a>
            </div>
            <!-- Critical Logs -->
            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">Critical Logs</span>
                <a href="/test-critical" class="px-4 py-2 bg-white text-black rounded-lg border-black border-2 transition">
                    View
                </a>
            </div>

        </div>
    </div>
</div>
</x-app-layout>
