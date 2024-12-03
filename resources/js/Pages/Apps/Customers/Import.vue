<template>
    <Head>
        <title>Import Customers - Aplikasi Kasir</title>
    </Head>
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-file-import"></i> IMPORT CUSTOMERS</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold">Import Customers from Excel</h5>
                                <form @submit.prevent="handleImport">
                                    <div class="mb-3">
                                        <label class="fw-bold">Select Excel File</label>
                                        <div class="input-group">
                                            <input type="file" ref="fileInput" class="form-control" accept=".xlsx,.xls" required>
                                            <button class="btn btn-success input-group-text" type="submit">IMPORT</button>
                                        </div>
                                    </div>
                                    <div v-if="importError" class="alert alert-danger">
                                        {{ importError }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import LayoutApp from '../../../Layouts/App.vue';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

export default {
    layout: LayoutApp,

    setup() {
        const fileInput = ref(null);
        const importError = ref('');

        const handleImport = async () => {
            const file = fileInput.value.files[0];
            const formData = new FormData();
            formData.append('file', file);

            try {
                const response = await router.post('/apps/customers/importStore', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                // Handle successful response
                Swal.fire({
                    title: 'Success!',
                    text: response.data.message || 'Customers imported successfully.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
            } catch (error) {
                importError.value = error.response?.data?.message || '';
            }
        };

        return {
            fileInput,
            handleImport,
            importError
        };
    }
}
</script>

<style>
/* Add styles if needed */
</style>
