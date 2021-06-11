<template>
    <div :class="'my-' + span">
        <div class="border-t border-gray-200"></div>
    </div>
</template>

<script>
export default {
    props: {
        span: {
            type: String,
            default: '8'
        }
    }
}
</script>
