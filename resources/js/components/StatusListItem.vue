<template>
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <img
                    class="rounded mr-3 shadow-sm"
                    width="40"
                    :src="status.user_avatar"
                    alt="avatar"
                />
                <div>
                    <h5 class="mb-1" v-text="status.user_name"></h5>
                    <div class="small text-muted" v-text="status.ago"></div>
                </div>
            </div>
            <p class="card-text text-secondary" v-text="status.body"></p>
        </div>

        <div
            class="card-footer d-flex justify-content-between align-items-center p-2"
        >
            <like-btn :model="status" url="statuses"></like-btn>

            <div class="text-secondary mr-2">
                <i class="far fa-thumbs-up"></i>
                <span dusk="likes-count">{{ status.likes_count }}</span>
            </div>
        </div>
        <div class="card-footer">
            <div v-for="comment in comments" class="mb-3" :key="comment.id">
                <img
                    width="34"
                    class="rounded shadow-sm float-left mr-2"
                    :src="comment.user_avatar"
                    :alt="comment.user_name"
                />
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-2 text-secondary">
                        <a href="#"
                            ><strong>{{ comment.user_name }}</strong></a
                        >
                        {{ comment.body }}
                    </div>
                </div>

                <span dusk="comment-likes-count">{{
                    comment.likes_count
                }}</span>
                <button
                    v-if="comment.is_liked"
                    dusk="comment-unlike-btn"
                    @click="unlikeComment(comment)"
                >
                    TE GUSTA
                </button>
                <button
                    v-else
                    dusk="comment-like-btn"
                    @click="likeComment(comment)"
                >
                    ME GUSTA
                </button>
            </div>

            <form @submit.prevent="addComment" v-if="isAuthenticated">
                <div class="d-flex align-items-center">
                    <img
                        width="34"
                        class="rounded shadow-sm mr-2"
                        src="https://www.irishrsa.ie/wp-content/uploads/2017/03/default-avatar-300x300.png"
                        :alt="currentUser.name"
                    />
                    <div class="input-group">
                        <textarea
                            v-model="newComment"
                            class="form-control border-0 shadow-sm"
                            name="comment"
                            placeholder="Escribe un comentario..."
                            rows="1"
                            required
                        >
                        </textarea>
                        <div class="input-group-append">
                            <button
                                class="btn btn-primary"
                                dusk="comment-btn"
                                :disabled="!newComment"
                            >
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import LikeBtn from './LikeBtn'

export default {
    components: { LikeBtn },
    props: {
        status: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            newComment: '',
            comments: this.status.comments,
        }
    },
    methods: {
        addComment() {
            axios
                .post(`/statuses/${this.status.id}/comments`, {
                    body: this.newComment,
                })
                .then(res => {
                    this.newComment = ''
                    this.comments.push(res.data.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        likeComment(comment) {
            axios
                .post(`/comments/${comment.id}/likes`)
                .then(() => {
                    comment.is_liked = true
                    comment.likes_count++
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
        unlikeComment(comment) {
            axios
                .delete(`/comments/${comment.id}/likes`)
                .then(() => {
                    comment.is_liked = false
                    comment.likes_count--
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
    },
}
</script>

<style scoped></style>
