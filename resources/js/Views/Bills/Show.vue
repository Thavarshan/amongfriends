<template>
    <guest-layout>
        <div>
            We have {{ bill.charges.length }} charges here.
        </div>
    </guest-layout>
</template>

<script>
import GuestLayout from '@/Views/Layouts/GuestLayout';

export default {
    components: {
        GuestLayout
    },

    props: {
        bill: Object
    }
}
</script>
