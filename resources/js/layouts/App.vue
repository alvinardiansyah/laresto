<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
            <a href="#" @click.prevent="" class="navbar-brand">Laresto</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name:'home' }">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name:'about' }">
                            About
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'login' }">
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'register' }">
                            Register
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="container py-4">
            <router-view />
        </div>
    </div>
</template>

<script>
import Home from '../views/Home.vue';

export default {
    components: {
        Home,
    }    
}
</script>