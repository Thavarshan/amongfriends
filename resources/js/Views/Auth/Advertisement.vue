<template>
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 h-full p-10">
        <div>
            <logo :title="config('app.name')" classes="h-8 w-auto text-white"></logo>
        </div>

        <div class="mt-10 max-w-xs">
            <div>
                <h6 class="text-white font-bold">Track balances</h6>

                <p class="text-blue-100 text-sm">
                    Keep track of shared expenses, balances, and who owes who.
                </p>
            </div>

            <div class="mt-6">
                <h6 class="text-white font-bold">Organize expenses</h6>

                <p class="text-blue-100 text-sm">
                    Split expenses with any group: trips, housemates, friends, and family.
                </p>
            </div>

            <div class="mt-6">
                <h6 class="text-white font-bold">Add expenses easily</h6>

                <p class="text-blue-100 text-sm">
                    Quickly add expenses on the go before you forget who paid.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from '@/Views/Components/Logos/Logo';

export default {
    components: {
        Logo
    },
}
</script>
