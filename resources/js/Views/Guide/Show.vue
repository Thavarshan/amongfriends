<template>
    <guest-layout>
        <div class="py-5">
            <div class="mb-10">
                <div class="flex items-center justify-center">
                    <logo :title="config('app.name')" classes="h-8 w-auto text-gray-800"></logo>
                </div>
            </div>

            <card :has-action="false" class="max-w-4xl mx-auto">
                <template #content>
                    <div class="prose max-w-full">
                        <div v-html="content"></div>
                    </div>
                </template>
            </card>
        </div>
    </guest-layout>
</template>

<script>
import GuestLayout from '@/Views/Layouts/GuestLayout';
import AppLink from '@/Views/Components/Base/Link';
import Card from '@/Views/Components/Cards/Card';
import Logo from '@/Views/Components/Logos/Logo';

export default {
    components: {
        GuestLayout,
        AppLink,
        Card,
        Logo
    },

    props: ['content'],
}
</script>

