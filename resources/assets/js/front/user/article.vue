<template>
    <div>
        <div class="article" v-for="(item,index) in articles" :key="index">
            <div class="col-md-8" >
                <img width="40" src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80" class="img-circle" alt="">
                <a href="" class="nickname">{{item.author_name}}</a>
                <span style="margin-left:10px;">{{item.post_at}}</span>
                <a class="article-title" :href="'/p/'+item.id">
                    {{item.title}}
                </a>
                <div class="abstract">
                    <a :href="'/p/'+item.id">
                        {{item.content}}
                    </a>
                </div>
                <div class="article-footer">
                    <button class="btn btn-default btn-xs tab right-15">{{item.title}}</button>
                    <img  src="/images/icon/eye.png" width="20" alt="">
                    <span class="right-15">{{item.hits}}</span>
                    <img  src="/images/icon/comment.png" width="17" alt="">
                    <span class="right-15"></span>
                    <img  src="/images/icon/collection.png" width="17" alt="">
                    <span class="right-15">1000</span>
                </div>
            </div>
            <div class="col-md-4 hidden-xs">
                <img class="thmub"  width="150" src="//upload-images.jianshu.io/upload_images/2206395-3e9a3800e9195ea1.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" alt="">
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                articles:[],
                page:1,
                scrollTop: '',
                clientHeight:'',
                scrollHeight:'',
            }
        },
        methods:{
            menu() {
                this.scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                this.clientHeight = document.documentElement.clientHeight || document.body.clientHeight;
                this.scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
                if(this.scrollHeight == this.scrollTop +this.clientHeight){
                    this.page++;
                    this.getLists();
                }
            },
            getLists(){
                const loading = this.$loading({
                    lock: true,
                    text: 'Loading',
                    spinner: 'el-icon-loading',
                    background: 'white'
                });
                axios.get('/api/v1/articles?page='+this.page+'&pageSize=20&author_id='+sessionStorage.getItem('userId')).then((res)=>{
                    res.data.data.forEach((item,index)=>{
                        this.articles.push(item);
                    })
                    loading.close();
                    if(res.data.data.length==0){
                        this.$message({
                            showClose: true,
                            message: '已经到底了，没有更多文章了',
                            type: 'success'
                        });
                    }
                });
            }
        },
        mounted(){
            this.getLists();
            window.addEventListener('scroll', this.menu)
        }

    }
</script>
<style  scoped>
    .article{overflow:hidden;max-height:500px;width:100%;padding-bottom:25px;padding-top: 17px;background-color: white;border-bottom: 1px solid #f0f0f0;}
    .article-title{color:#333;display: inherit;font-size: 18px;font-weight: 700;line-height: 1.5;}
    .abstract{margin-top: 10px;line-height: 24px;overflow:hidden;}
     .nickname{margin-left:10px;color: #333;font-size: 16px;}
     .tab{background-color: white;border-color: hotpink;}
    article-footer {margin-top: 8px;}
    .thmub {margin-top: 18px;float: right;}
    .col-md-8 {padding: 0;}
    .col-md-4 {padding-right: 0;}
    .right-15{margin-right: 15px;}
</style>