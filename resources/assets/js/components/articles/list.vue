<style>
    .search-bar{
        width:100%;height:64px;background-color:#F4F9FF;display:block;
        padding-top: 20px;padding-left:20px;
        margin-bottom:20px;
    }
</style>
<template>
    <section>
        <div class="search-bar">
            <el-row :gutter="20">
                <el-col :span="4">
                    <el-select v-model="type" placeholder="文章分类">
                        <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="5">
                    <el-input v-model="title" placeholder="标题"></el-input>
                </el-col>
                <el-col :span="6">
                    <el-button type="primary" plain>搜索</el-button>
                    <el-button type="primary" plain @click="$router.push('/articles/write')">写文章</el-button>
                </el-col>
                <el-col :span="6">
                </el-col>
            </el-row>
        </div>
        <el-table
                v-loading="loading"
                :data="tableData"
                style="width: 100%">
            <el-table-column
                    prop="post_at"
                    label="发表日期"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="type"
                    label="类型"
                    :formatter="typeformat"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="标题"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="content"
                    label="简介">
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="120">
                <template slot-scope="scope">
                    <el-button
                            type="text"
                            size="small">
                        查看
                    </el-button>
                    <el-button
                            type="text"
                            size="small"
                            @click="$router.push('/articles/'+1)"
                    >
                        编辑
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <router-view></router-view>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                loading:false,
                title:'',
                type:'',
                options:[
                    {value:1,label:'技术'},
                    {value:2,label:'生活'},
                ],
                tableData: []
            }
        },
        methods:{
            typeformat(row,column){
                var res = '';
                this.options.forEach((item,index)=>{
                    if(row.type==item.value){
                        res = item.label;
                    }
                })
                return res;
            },

            getList(){
                this.loading = true;
                axios.get('/api/articles').then((res)=>{
                    this.tableData = res.data.data;
                    this.loading = false;
                })
            },
        },
        mounted(){
            this.getList();
        }
    }
</script>