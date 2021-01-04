<template>
    <div class="py-6 md:py-8">
        <form @submit.prevent="submit" class="card max-w-sm p-6 md:p-8 mx-auto">
            <h1 class="text-3xl text-center">登入</h1>
            <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

            <div class="grid gap-6 mt-6">
                <text-input v-model="form.email" :error="$page.errors.email" label="E-mail" autocomplete="email" ref="emailInput" />
                <text-input v-model="form.password" type="password" label="密碼" />
                <div>
                    <label>
                        <input type="checkbox" class="form-checkbox" v-model="form.remember"> 記住我
                    </label>
                </div>
                <div>
                    <loading-button :loading="loading" class="btn btn-purple">登入</loading-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import LightingLayout from '@/Layouts/LightingLayout'
    import TextInput from '@/Components/TextInput'
    import LoadingButton from '@/Components/LoadingButton'

    export default {
        layout: LightingLayout,
        metaInfo: {
            title: '登入'
        },
        components: {
            TextInput,
            LoadingButton
        },
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    remember: true
                },
                loading: false
            }
        },
        methods: {
            submit() {
                if(this.form['remember'] === false) delete this.form['remember']
                this.$inertia.post('/login', this.form, {
                    onStart: () => this.loading = true,
                    onFinish: () => this.loading = false
                })
            }
        },
        mounted() {
            this.$refs.emailInput.focus()
        }
    }
</script>
