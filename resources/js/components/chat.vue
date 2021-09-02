<template>
  <div>
        <textarea class="form-control" v-model="comment" cols="100" rows="4"></textarea>
        <button class="btn btn-outline-primary " v-on:click="sendComment"> 전송 </button>
        <br>
        <br>
        <ul class="list-group">
            <div v-for="c in comments.id.length" :key='c'>
                <li class="list-group-item">{{comments.user_name[c-1]+" : " + comments.comment[c-1] }}</li>
            </div>

        </ul>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name:'chat',
    data(){
        return {
            comment:'',
            comments:{
                'id':[],
                'user_id':[],
                'date':[],
                'comment':[],
                'user_name':[]
            },
            // datas:,
            post_id:''
        }
    },mounted(){
        var location = window.location.pathname
        var locationcut =location.split('/');
        this.post_id=locationcut[3];
        axios.post('/posts/check/'+this.post_id,{

        }).then(res=>{
            res.data.forEach(e => {
                this.comments.id.push(e.id);
                this.comments.comment.push(e.comment);
                this.comments.date.push(e.created_at);
                this.comments.user_id.push(e.user_id);
                this.comments.user_name.push(e.user_name);
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
                console.log(res);
                    this.comment=null
                    this.comments.comment.unshift(res.data.comment);
                    this.comments.id.unshift(res.data.id);
                    this.comments.date.unshift(res.data.created_at);
                    this.comments.user_id.unshift(res.data.user_id);
                    this.comments.user_name.unshift(res.data.user_name);
                })
            }
        }
    }
}
</script>
