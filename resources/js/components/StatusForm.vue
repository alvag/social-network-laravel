<template>
    <form @submit.prevent="handleSubmit" v-if="isAuthenticated">
        <div class="card-body">
            <textarea v-model="body" class="form-control border-0 bg-light" name="body"
                      required :placeholder="`¿Qué estas pensando ${currentUser.name}?`">
            </textarea>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="create-status" :disabled="!body">
                <i class="fa fa-paper-plane mr-1"></i>
                Publicar
            </button>
        </div>
    </form>

    <div class="card-body" v-else>
        <a class="btn btn-primary" href="/login">Debes iniciar sesión</a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            body: ''
        }
    },
    methods: {
        handleSubmit() {
            axios.post('/statuses', {body: this.body})
                .then(res => {
                    this.body = '';
                    EventBus.$emit('status-created', res.data.data)
                })
                .catch(error => {
                    console.log(error.response.data);
                })
        }
    }
}
</script>

<style scoped>

</style>
