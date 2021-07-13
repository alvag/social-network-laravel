<template>
    <div @click="redirectIfGuest">
        <div class="card shadow-sm border-0 mb-3" v-for="status in statuses">
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

            <div class="card-footer p-2">
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
                <span dusk="likes-count">{{ status.likes_count }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            statuses: []
        }
    },
    mounted() {
        axios.get('statuses')
            .then(res => {
                this.statuses = res.data.data;
            })
            .catch(error => {
                console.log(error.response.data)
            });

        EventBus.$on('status-created', status => this.statuses.unshift(status))
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
