<style scoped>
    @import "../../../../../node_modules/github-markdown-css";
    .markdown-body {
        box-sizing: border-box;
        min-width: 200px;
        max-width: 980px;
        margin: 0 auto;
        padding: 45px;
    }

    @media (max-width: 767px) {
        .markdown-body {
            padding: 15px;
        }
    }
</style>
<template>
    <div>
        <el-button type="success" size="small" style="float:right;" @click="$router.push('/article/'+article.id)">编辑</el-button>
        <article v-html="html" class="markdown-body">

        </article>
    </div>

</template>
<script>
    import showdown from 'showdown'
    export default{
        data(){
            return {
                article:{
                    id:null,
                    title:null,
                    type:null,
                    content:null,
                    post_at:null,
                },
                options:[
                    {value:1,label:'生活',value:2,label:'技术'}
                ],
                html:null,
            }
        },
        methods:{
            detail(){
                axios.get('/api/articles/'+this.$route.params.id).then((res)=>{
                    this.article = res.data;
                    document.title = this.article.title;
                    const converter = new showdown.Converter();//初始化
                    converter.setFlavor('github');
                    this.html = converter.makeHtml(this.article.content)//转化

                })
            }
        },
        mounted(){
            this.detail();

        }

    }
</script>