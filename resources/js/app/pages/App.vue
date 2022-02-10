<template>
    <div>
        <div class="navbar">
            <div><router-link to="/">Home</router-link></div>
            <div><router-link to="/login">Login</router-link></div>
            <div><router-link to="/dashboard">Dahsboard</router-link></div>
            <div><router-link to="/monitoring">Monitoring</router-link></div>

            <b-button variant="danger">Button</b-button>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    name: "App",
};
</script>

<style scoped>
.navbar {
    display: flex;
    justify-content: center;
    align-items: center;
}
.navbar dev {
    padding: 10px 20px;
    margin: 5;
}
</style>
