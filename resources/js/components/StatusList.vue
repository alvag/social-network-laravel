<template>
    <div @click="redirectIfGuest">
        <status-list-item
            v-for="status in statuses"
            :status="status"
            :key="status.id">
        </status-list-item>
    </div>
</template>

<script>
import StatusListItem from "./StatusListItem";

export default {
    comments: {StatusListItem},
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
