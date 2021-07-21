<template>
    <button v-if="model.is_liked"
            class="btn btn-sm btn-link" dusk="unlike-btn" @click="unlike()">
        <strong>
            <i class="fa fa-thumbs-up text-primary mr-1"></i>
            TE GUSTA
        </strong>
    </button>
    <button v-else
            class="btn btn-sm btn-link" dusk="like-btn" @click="like()">
        <i class="far fa-thumbs-up text-primary mr-1"></i>
        ME GUSTA
    </button>
</template>

<script>
export default {
    props: {
        model: {
            type: Object,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    },
    methods: {
        like() {
            axios.post(`${this.url}/${this.model.id}/likes`)
                .then(() => {
                    this.model.is_liked = true;
                    this.model.likes_count++;
                })
                .catch(error => {
                    console.log(error);
                    window.location.href = '/login'
                });
        },
        unlike() {
            axios.delete(`${this.url}/${this.model.id}/likes`)
                .then(() => {
                    this.model.is_liked = false;
                    this.model.likes_count--;
                })
                .catch(error => {
                    console.log(error.response.data);
                    window.location.href = '/login'
                });
        }
    }
}
</script>

<style scoped>

</style>
