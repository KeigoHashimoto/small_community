<template>
    <div>
        <!-- 全ての発言を取得 -->
        <div v-for="opinion in opinions" :key="opinion.id">
            <!-- 掲示板作成のためのopinionを表示させない -->
            <div v-if="opinion.user_id != null">
                <div v-if="opinion.board_id === board.id">
                    <!-- 自分の投稿 -->
                    <div v-if="opinion.user_id === authUser.id">
                        <div>
                            <div class="self-opinion" >
                                <div class="self-opinion-content">{{ opinion.opinion }}<br>
                                    <div  v-show="opinion.img_path != ''">
                                        <a :href="'/community-app/uploads/' + opinion.img_path">
                                            <img :src="'/community-app/uploads/' + opinion.img_path" alt="" class="opinion-img">
                                        </a>
                                    </div>
                                </div>
    
                                <div class="self-opinion-profile">
                                    <a :href="'/community-app/show/' + authUser.id">
                                        <img class="self-opinion-profile-img" :src="'/community-app/uploads/' + authUser.profile_img" alt="">
                                    </a>
                                    <p>{{ authUser.name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <!-- 自分以外の投稿 -->
                        <div v-for="user in users" :key="user.id">
                            <div class="opinion">
                                <div v-if="user.id === opinion.user_id" class="opinion-profile">
                                    <a :href="'/community-app/show/' + user.id">
                                        <img class="opinion-profile-img" :src="'/community-app/uploads/' + user.profile_img" alt="">
                                    </a>
                                    <p>{{ user.name }}</p>
                                </div>
            
                                <div class="opinion-content" v-if="opinion.user_id === user.id">{{ opinion.opinion }}<br>
                                    <div  v-show="opinion.img_path != ''">
                                        <a :href="'/community-app/uploads/' + opinion.img_path">
                                            <img :src="'/community-app/uploads/' + opinion.img_path" alt="" class="opinion-img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        data(){
            return{
                opinions:[],
                users:[],
                authUser:[],
            };
        },
        props:{
            board:String,
        },
        methods:{
            getMessages(){
                if(window.location.hostname =='localhost'){
                    axios.get('/messages').then(response => this.opinions = response.data);

                }else{
                    axios.get('/community-app/messages').then(response => this.opinions = response.data);
                }
            },
            getUsers(){
                if(window.location.hostname =='localhost'){
                    axios.get('/users').then(response => this.users = response.data);

                }else{
                    axios.get('/community-app/users').then(response => this.users = response.data);
                }
            },
            getAuthUser(){
                if(window.location.hostname =='localhost'){
                    axios.get('/authUser').then(response => this.authUser = response.data);
                }else{
                    axios.get('/community-app/authUser').then(response => this.authUser = response.data);
                }
            }, 
        },
        mounted() {
            this.getMessages();
            this.getUsers();
            this.getAuthUser();

            Echo.channel('chat')
                .listen('MessageCreated',(e) => {
                    this.getMessages();
                });
        },
    }
</script>
