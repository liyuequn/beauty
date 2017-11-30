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
                    <el-select v-model="type" placeholder="文章分类" @change="getList()">
                        <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="5">
                    <el-input v-model="title" placeholder="标题" @keyup.enter.native="getList()" ></el-input>
                </el-col>
                <el-col :span="6">
                    <el-button type="primary" plain @click="getList()">搜索</el-button>
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
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="标题"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="content"
                    label="简介"
                    :formatter="contentStr"
            >
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="操作"
                    width="220">
                <template slot-scope="scope">
                    <el-button
                            type="success"
                            size="small"
                            @click="$router.push('/articles/'+scope.row.id)"
                            plain
                    >
                        查看
                    </el-button>
                    <el-button
                            type="primary"
                            size="small"
                            @click="$router.push('/article/'+scope.row.id)"
                            plain
                    >
                        编辑
                    </el-button>
                    <el-button
                            type="danger"
                            size="small"
                            @click="delete1(scope.row.id)"
                            plain
                    >
                        删除
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="block" style="text-align: center;">
            <el-pagination
                    background="#F4F9FF"
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
            </el-pagination>
        </div>
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
                    {value:'',label:'全部'},
                    {value:1,label:'技术'},
                    {value:2,label:'生活'},
                ],
                tableData: [],
                //page
                total:0,
                currentPage:1,
                pageSize:10,
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
            contentStr(row,cloumn){
                return row.content.substring(0,100);
            },
            getList(){
                this.loading = true;
                let params = {
                    type:this.type,
                    title:this.title,
                    page:this.currentPage,
                    pageSize:this.pageSize,
                }
                axios.get('/api/articles',{params}).then((res)=>{
                    this.tableData = res.data.data[0];
                    this.total = res.data.meta.total;
                    this.loading = false;
                })
            },
            delete1(id){
                this.$confirm('删除, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then((res)=>{
                    axios.delete('/api/articles/'+id).then((res)=>{
                        this.$message({
                            type: 'success',
                            message: '成功!'
                        });
                        this.getList();
                    })

                })
            },
            handleSizeChange(val){
                this.pageSize = val;
                this.getList();
            },
            handleCurrentChange(val){
                this.currentPage = val;
                this.getList();
            }
        },
        mounted(){
            this.getList();
        }
    }
</script>