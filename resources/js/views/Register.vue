<template>
    <div class="card">
        <div class="card-header">Register</div>

        <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-md-4 col-form-label text-md-right">Role</label>

                    <div class="col-md-6">
                        <select name="role_id" v-model="user.role_id" id="roles" class="form-control">
                            <option v-for="role in roles" :key="role.id" :value="role.id" :selected="2">{{ role.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" v-model="user.name" required autocomplete="name" autofocus>
<!-- 
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" v-model="user.email" required autocomplete="email">
<!-- 
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" v-model="user.password" required autocomplete="new-password">

                        <!-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="user.password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" @click="register">
                            Register
                        </button>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
         return {
            roles: {},
            name: '',
            user: {
                role_id: 2,
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    mounted() {
        this.getRoles();
    },
    methods: {
        getRoles: function() {
            axios.get('/api/roles')
            .then(res => {
                this.roles = res.data
            }).catch(err => {
                console.log(err)
            })
        },
        register: function() {
            console.log(this.user)
            axios.post('/api/register', this.user)
            .then(res => {
                console.log(res)
            }).catch(err => {
                console.log(err)
            })
        }
    } 
}
</script>