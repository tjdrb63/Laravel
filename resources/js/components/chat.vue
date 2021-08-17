<template>
    <div>
        <textarea v-model="comment" cols="95" rows="4"></textarea>
        <button v-on:click="sendComment"> 댓글 쓰기</button>
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
        }
    },
    mounted(){
    },
    methods:{
        sendComment(){
            console.log("Push Btn")
            if(this.comment){
                axios.post('/posts/chats',{
                    comment:this.comment
                })
                .then(res => {
                    console.log("Then.res")
                    this.comments.push(this.comment);
                })
            }
        }
    }
}
</script>
