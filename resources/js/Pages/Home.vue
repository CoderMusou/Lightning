<template>
    <div class="py-6 md:py-8">
        <alert v-if="$page.flash.success" class="shadow mb-6">{{ $page.flash.success }}</alert>

        <div class="card card-main">
            <post-list :posts="posts" />
        </div>
    </div>
</template>

<script>
    import LightingLayout from '@/Layouts/LightingLayout'
    import PostList from '@/Lightning/PostList'
    import Alert from '@/Components/Alert'

    export default {
        layout: LightingLayout,
        components: {
            Alert,
            PostList
        },
        props: {
            posts: Object
        }
    }
</script>
