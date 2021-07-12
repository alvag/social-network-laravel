<template>
    <div>
        <form @submit.prevent="handleSubmit">
            <div class="card-body">
            <textarea v-model="body" class="form-control border-0 bg-light" name="body"
                      placeholder="¿Qué estas pensando?"></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="create-status">Publicar</button>
            </div>
        </form>
        <div v-for="status in statuses" v-text="status.body"></div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            body: '',
            statuses: []
        }
    },
    methods: {
        handleSubmit() {
            axios.post('/statuses', {body: this.body})
                .then(res => {
                    this.body = '';
                    this.statuses.push(res.data);
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
