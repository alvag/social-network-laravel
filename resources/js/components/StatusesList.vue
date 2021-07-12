<template>
    <div>
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
    }
}
</script>

<style scoped>

</style>
