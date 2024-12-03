<template>
    <Head>
        <title>Login Account - Yani Grocer</title>
    </Head>
    <div class="col-md-4">
        <div class="fade-in">
            <div class="text-center mb-4">
                <a href="" class="text-dark text-decoration-none">
                    <img src="/images/cash-machine.png" width="70">
                    <h3 class="mt-2 font-weight-bold">Yani Grocer</h3>
                </a>
            </div>
            <div class="card-group">
                <div class="card border-top-purple border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="text-start">
                            <h5>LOGIN ACCOUNT</h5>
                            <p class="text-muted">Sign In to your account</p>
                        </div>
                        <hr>
                        <div v-if="session.status" class="alert alert-success mt-2">
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit" @click="activateForm" :class="{ 'active-form': isFormActive }">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input 
                                    class="form-control" 
                                    v-model="form.email" 
                                    :class="{ 'is-invalid': errors.email, 'active': isActive.email }" 
                                    type="email" 
                                    placeholder="Email Address" 
                                    @focus="activate('email')" 
                                    @blur="deactivate('email')"
                                >
                            </div>
                            <div v-if="errors.email" class="alert alert-danger">
                                {{ errors.email }}
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input 
                                    class="form-control" 
                                    v-model="form.password" 
                                    :class="{ 'is-invalid': errors.password, 'active': isActive.password }" 
                                    type="password" 
                                    placeholder="Password" 
                                    @focus="activate('password')" 
                                    @blur="deactivate('password')"
                                >
                            </div>
                            <div v-if="errors.password" class="alert alert-danger">
                                {{ errors.password }}
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3 text-end">
                                    <Link href="/forgot-password">Forgot Password?</Link>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary shadow-sm rounded-sm px-4 w-100" type="submit">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    // Import layout
    import LayoutAuth from '../../Layouts/Auth.vue';

    // Import reactive
    import { reactive, ref } from 'vue';

    // Import Inertia
    import {
        Head,
        Link,
        router
    } from '@inertiajs/vue3';

    export default {
        layout: LayoutAuth,
        components: {
            Head,
            Link
        },
        props: {
            errors: Object,
            session: Object
        },
        setup() {
            const form = reactive({
                email: '',
                password: '',
            });
            const isActive = reactive({
                email: false,
                password: false,
            });
            const isFormActive = ref(false);

            const submit = () => {
                router.post('/login', {
                    email: form.email,
                    password: form.password,
                });
            };

            const activate = (field) => {
                isActive[field] = true;
            };

            const deactivate = (field) => {
                if (!form[field]) {
                    isActive[field] = false;
                }
            };

            const activateForm = () => {
                isFormActive.value = true;
            };

            return {
                form,
                submit,
                isActive,
                activate,
                deactivate,
                activateForm,
                isFormActive,
            };
        }
    }
</script>
<style>
    .input-group input {
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .input-group input.active {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        animation: pulse 0.5s;
    }

    .active-form {
        animation: formPulse 0.5s forwards;
    }

    @keyframes formPulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .btn-primary {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .btn-primary:active {
        transform: scale(0.95);
    }
</style>
