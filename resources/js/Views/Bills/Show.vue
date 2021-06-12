<template>
    <guest-layout>
        <div>
            <div>
                <app-link :href="route('welcome')" class="uniderline-none">
                    <span class="mr-1">&larr;</span> Back to bill calculator
                </app-link>
            </div>

            <div class="mt-10 md:grid md:grid-cols-12 md:gap-6">
                <div class="md:col-span-8 xl:col-span-6 space-y-6">
                    <card :has-action="false" v-for="(person, index) in details.people" :key="index">
                        <template #content>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h5 class="text-xl text-gray-800 font-bold">
                                        {{ person.name }}
                                    </h5>

                                    <div>
                                        Spent <span class="text-gray-600 font-semibold">{{ format(person.spent) }}</span>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <div>
                                        <span class="text-gray-600">
                                            Owes
                                        </span>
                                    </div>

                                    <div>
                                        <span class="text-gray-600 font-semibold">
                                            {{ format(person.in_debt) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="h-px bg-transparent border-t border-gray-300 my-4"></div>

                            <div class="space-y-2">
                                <div>
                                    <div class="mt-2" v-for="(debt, index) in person.debts" :key="index">
                                        <div>
                                            Owes <span class="text-gray-600 font-semibold">{{ format(debt.amount) }}</span> to <span class="text-gray-600 font-semibold">{{ debt.owed_to }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </card>
                </div>

                <div class="mt-10 md:mt-0 md:col-span-4 xl:col-span-6">
                    <div class="text-right">
                        <h1 class="text-5xl font-bold text-gray-800">
                            {{ format(details.total) }}
                        </h1>

                        <h6 class="mt-1 text-lg font-medium text-gray-600">
                            Total charges for {{ details.days }} days.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </guest-layout>
</template>

<script>
import Money from '@/App/Money';
import GuestLayout from '@/Views/Layouts/GuestLayout';
import Card from '@/Views/Components/Cards/Card';
import AppLink from '@/Views/Components/Base/Link';

export default {
    components: {
        GuestLayout,
        AppLink,
        Card
    },

    props: {
        details: Object
    },

    methods: {
        format(amount) {
            return (new Money()).format(amount);
        }
    }
}
</script>
