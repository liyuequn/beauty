<template>
    <div>
        <div style="border-bottom: rgba(192,192,192,0.42) solid 1px;margin-top: 100px;padding-bottom: 16px;">
            {{comments.length}}条评论
            <a href="javascript:;">按喜欢排序</a>
            <a href="javascript:;">按时间正序</a>
            <a href="javascript:;">按时间倒序</a>
        </div>
        <div
                v-for="(item,index) in comments"
                :key="index"
                style="
    border-bottom: rgba(192,192,192,0.42) solid 1px;
    padding: 0px 0px 50px 0;
    margin-top: 50px;
    margin-bottom: 50px;
">
            <div>
                {{item.user_id}}
                @{{item.floor}}楼 · {{item.created_at}}
            </div>
            <div style="margin-top: 20px;">
                {{item.comment}}
            </div>

        </div>
    </div>

</template>
<script>
    import bus from '../../busEvent';
    export default{
        data(){
            return {
                comments:[],
                article_id:0,
            }
        },
        methods:{
            getComments(){
                axios.get('/api/v1/article/comment/'+this.article_id).then((res)=>{
                    this.comments = res.data;
                })
            }
        },
        mounted(){
            var arr = window.location.href.split('/');
            this.article_id = parseInt(arr[arr.length-1]);
            this.getComments();
            var _this = this
            bus.$on('commentEvent',function () {
                _this.getComments();
            });
        }
    }

</script>