<template>
  <div>
        <textarea v-model="comment" cols="95" rows="4"></textarea>
        <button v-on:click="sendComment"> 전송 </button>
        <br>
        <p>{{ comment }}</p>
        <p v-for="com in comments" :key="com">{{com}}</p>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name:'chat',
    data(){
        return {
            comment:'',
            comments:[],
            post_id:''
        }
    },mounted(){
        var location = window.location.pathname
        var locationcut =location.split('/');
        this.post_id=locationcut[3];
        axios.post('/posts/check/'+this.post_id,{

        }).then(res=>{
            res.array.forEach(element => {
                element->comment
            });
        })
    },
    methods:{
        sendComment(){
            console.log("Push Btn")
            if(this.comment){
                axios.post('/posts/chats',{
                    comment:this.comment,
                    post_id:this.post_id
                })
                .then(res => {
                    console.log("Then.res");
                    console.log(res);
                })
            }
        }
    }
}
</script>
