<template>
    <div>
        <v-card>
            <v-container>
                <v-simple-table >
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Creations Date</th>
                                <th class="text-left">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in listUsers" :key="item.id">
                                <td>{{ item.name }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.created_at }}</td>
                                <td>
                                    <v-icon
                                        medium
                                        color="#15638A"
                                        @click="dialog = true"
                                        >mdi-pencil</v-icon
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-container>
            <v-btn
                bottom
                color="#15638A"
                dark
                fab
                fixed
                right
                @click="dialog = true"
            >
                <v-icon>mdi-plus</v-icon>
            </v-btn>
            <v-dialog v-model="dialog" width="800">
                <v-card>
                    <v-card-title class="cyan lighten-1" style="color: #fff">
                        Form Users
                    </v-card-title>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="3">
                                <v-text-field label="Name" v-model="user.name">
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" md="3">
                                <v-text-field
                                    label="Email"
                                    v-model="user.email"
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" md="3">
                                <v-text-field
                                    type="password"
                                    label="Password"
                                    v-model="user.password"
                                >
                                </v-text-field>
                            </v-col>
                        </v-row>
                        <div>
                            <div v-for="(errors,id) in errorMessage" :key="id" v-text="errors" style="text-align:center; color:red;">{{errorMessage}}</div>
                        </div>
                        <pre>{{ user }}</pre>
                    </v-container>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" text @click="save">
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            dialog: false,
            user: {
                name: "",
                email: "",
                password: ""
            },
            errorMessage: []
        };
    },
    computed: {
        ...mapState('user', ['listUsers', 'message' ])
    },
    methods: {
        save() {
            this.$store.dispatch("user/saveUser", this.user)
            .then(()=>{
                this.$store.dispatch("user/getList")
                this.dialog = false
            }).catch((e)=>{
                console.log(e.response.data.errors)
                if(e.response.Status === 422){
                    alet('Ya existe usuerio')
                    this.errorMessage = e.response.data.errors
                }
            })
        }
    },
    mounted() {
        this.$store.dispatch("user/getList");
    }
};
</script>
