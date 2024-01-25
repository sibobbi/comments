<template>
    <div class="lists">
        <div class="bg-white border border-2 ">
            <h1>{{ this.post.title }}</h1>
            <p>{{ this.post.description }}</p>
            <br>
            <h3>Количество комментариев: {{ this.post.comments_count }}</h3>
            <h2>Комментарии</h2>
            <br>
            <div v-for="(comment,index) in this.comments" class="border border-2">
                <h3>{{ comment.user.name }} ({{ comment.created_at }})</h3>
                <p>{{ comment.body }}</p>
                <a v-on:click="this.setReplyComment(comment,index)" class="border border-3">Ответить
                    пользователю</a>
                <br>
                <div v-for="replyComment in comment.replies" class="reply border border-4">
                    <h3>{{  replyComment.user.name }} ({{ replyComment.created_at }})</h3>
                    <p> {{  replyComment.body }}</p>
                </div>
            </div>
            <br>
            <input v-model="message" type="text" class="comment-input"
                v-bind:placeholder="this.replyUser != null ? 'Ответ для ' + replyUser.name : ''">
            <button type="button" class="btn btn-primary bg" v-on:click="this.createComment()">Отправить</button>
            <br>
            <a v-if="this.replyUser != null" v-on:click="this.replyUser = null; this.new_parent_id = null;this.i_comment = null;">Удалить ответ</a>
            <br>
        </div>
    </div>
</template>
    
<script>
import axios from 'axios';

export default {
    name: "Main",
    data() {
        return {
            post: {},
            comments: [],
            message: '',
            replyUser: null,
            new_parent_id: null,
            i_comment: null
        }
    },
    methods: {
        getPosts() {
            axios.post('http://127.0.0.1:8000/posts/list').then(response => {
                this.post = response.data.post;
                this.comments = response.data.comments;
            })
        },
        createComment() {

            axios.post('http://127.0.0.1:8000/comment/create', {
                post_id: this.post.id,
                parent_comment_id: this.new_parent_id != null ? this.new_parent_id : null,
                body: this.message
            }).then(response => {
                if(this.new_parent_id != null) {
                    this.comments[this.i_comment].replies.push(response.data);
                } else {
                    this.comments.push(response.data);
                }
                this.i_comment = null;
                this.new_parent_id = null;
                this.replyUser = null;
            })
        },
        setReplyComment(comment,i_comment) {
            this.replyUser = comment.user;
            this.new_parent_id = comment.id;
            this.i_comment = i_comment;
        }
    },
    mounted() {
        this.getPosts();
    }
}
</script>
<style scoped>
.lists>div {
    margin: 10px 0px 10px 0px;
}

h1 {
    font-size: 20pt;
}

.comment-input {
    width: 40%;
}
.reply { 
    margin: 5px 5px 5px 20px;
}
.bg {
    background-color: blue;
}</style>