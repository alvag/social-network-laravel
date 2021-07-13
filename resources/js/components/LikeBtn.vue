<template>
    <button v-if="status.is_liked"
            class="btn btn-sm btn-link" dusk="unlike-btn" @click="unlike(status)">
        <strong>
            <i class="fa fa-thumbs-up text-primary mr-1"></i>
            TE GUSTA
        </strong>
    </button>
    <button v-else
            class="btn btn-sm btn-link" dusk="like-btn" @click="like(status)">
        <i class="far fa-thumbs-up text-primary mr-1"></i>
        ME GUSTA
    </button>
</template>

<script>
export default {
    props: {
        status: {
            type: Object,
            required: true
        }
    },
    methods: {
        like(status) {
            axios.post(`statuses/${status.id}/likes`)
                .then(() => {
                    status.is_liked = true;
                    status.likes_count++;
                })
                .catch(error => {
                    console.log(error)
                });
        },
        unlike(status) {
            axios.delete(`statuses/${status.id}/likes`)
                .then(() => {
                    status.is_liked = false;
                    status.likes_count--;
                })
                .catch(error => {
                    console.log(error.response.data)
                });
        }
    }
}
</script>

<style scoped>

</style>
