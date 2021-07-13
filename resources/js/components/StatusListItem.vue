<template>
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <img class="rounded mr-3 shadow-sm" width="40"
                     src="https://www.irishrsa.ie/wp-content/uploads/2017/03/default-avatar-300x300.png"
                     alt="avatar">
                <div>
                    <h5 class="mb-1" v-text="status.user_name"></h5>
                    <div class="small text-muted" v-text="status.ago"></div>
                </div>
            </div>
            <p class="card-text text-secondary" v-text="status.body"></p>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center p-2">
            <like-btn :status="status"></like-btn>

            <div class="text-secondary mr-2">
                <i class="far fa-thumbs-up"></i>
                <span dusk="likes-count">{{ status.likes_count }}</span>
            </div>

            <form @submit.prevent="addComment">
                <textarea name="comment" v-model="newComment"></textarea>
                <button dusk="comment-btn">Enviar</button>
            </form>

            <div v-for="comment in comments">
                {{ comment.body }}
            </div>
        </div>
    </div>
</template>

<script>
import LikeBtn from "./LikeBtn";

export default {
    components: {LikeBtn},
    props: {
        status: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            newComment: '',
            comments: this.status.comments
        }
    },
    methods: {
        addComment() {
            axios.post(`/statuses/${this.status.id}/comments`, {body: this.newComment})
                .then(res => {
                    this.newComment = '';
                    this.comments.push(res.data.data);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>

</style>
