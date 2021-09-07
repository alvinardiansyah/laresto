<template>
    <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
            <router-view />
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('dashboard mounted')
    }
}
</script>